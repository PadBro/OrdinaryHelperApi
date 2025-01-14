<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    private $operations = [
        'create',
        'read',
        'update',
        'delete',
    ];

    private $models = [
        'faq',
        'rule',
        'serverContent',
        'serverContentMessage',
        'reactionRole',
        'application',
        'applicationQuestion',
        'applicationAnswerQuestion',
        'applicationResponse',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->models as $model) {
            foreach ($this->operations as $operation) {
                Permission::create(['name' => $model.'.'.$operation]);
            }
        }
        Permission::create(['name' => 'serverContent.resend']);

        Role::create(['name' => 'Owner']);
        Role::create(['name' => 'Bot']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->operations as $operation) {
            foreach ($this->models as $model) {
                Permission::where(['name' => $model.'.'.$operation])->delete();
            }
        }
        Permission::where(['name' => 'serverContent.resend'])->delete();

        Role::whereIn('name', ['Owner', 'Bot']);
    }
};
