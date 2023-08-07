composer install
php artisan key:generate
php artisan jwt:secret
php artisan migrate
php artisan db:seed

php artisan import:abilities ./storage/import/abilities.csv
php artisan import:translations ./storage/import/translations-en.csv
php artisan import:translations ./storage/import/translations-lt.csv

npm install
npm run build
