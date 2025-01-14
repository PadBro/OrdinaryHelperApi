<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\CreateRequest;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function template(): JsonResponse
    {
        if (! request()->user()?->hasRole('Owner')) {
            abort(403);
        }

        $permissions = [];
        foreach (CreateRequest::$models as $model) {
            $permissions[$model] = [];
            foreach (CreateRequest::$operations as $operation) {
                $permissions[$model][] = $operation;
            }
        }

        foreach (CreateRequest::$specialPermissions as $key => $specialPermission) {
            $permissions[$key] = [
                ...$permissions[$key] ?? [],
                ...$specialPermission,
            ];
        }

        return response()->json($permissions);
    }

    public function index(): JsonResponse
    {
        if (! request()->user()?->hasRole('Owner')) {
            abort(403);
        }

        $roles = Role::whereNotIn('name', ['Owner', 'Bot'])->with('permissions')->get()->map(function (Role $role) {
            return [
                'role' => $role->name,
                'permissions' => $role->permissions->pluck('name'),
            ];
        });

        return response()->json($roles);
    }

    public function store(CreateRequest $request): JsonResponse
    {
        $validatedRoles = collect($request->validated());
        $roles = $validatedRoles->pluck('role')
            ->push('Owner', 'Bot');
        Role::whereNotIn('name', $roles)->delete();

        $validatedRoles->each(function ($validatedRole) {
            $role = Role::firstOrCreate(['guard_name' => 'web', 'name' => $validatedRole['role']]);

            /**
             * @var array<array<bool>> $permissions
             */
            $permissions = $validatedRole['permissions'];
            $mappedPermissions = collect($permissions)
                /**
                 * @var array<bool> $permissions
                 */
                ->flatMap(fn (array $permissions, string $model) => collect($permissions)
                    ->filter(fn ($value) => $value === true)
                    ->keys()
                    ->map(fn ($operation) => "$model.$operation"))
                ->values();

            $role->syncPermissions($mappedPermissions);
        });

        return response()->json();
    }
}
