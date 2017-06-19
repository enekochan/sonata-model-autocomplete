php app/console doctrine:database:drop --force
php app/console doctrine:database:create
php app/console doctrine:schema:update --force
php app/console doctrine:fixtures:load --no-interaction
php app/console cache:clear
php app/console assets:install web --env=dev --symlink --relive
php app/console server:run &
open http://127.0.0.1:8000/admin
