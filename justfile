dev:
    zellij --layout dev.kdl

check:
    ./vendor/bin/pint

ide:
    php artisan ide-helper:generate
    php artisan ide-helper:eloquent
    php artisan ide-helper:models -W
