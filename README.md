# Installation Instructions

1. Copy and rename \`.env.example\` to \`.env\`.
2. Copy and rename \`.env.testing.example\` to \`.env.testing\`.

In both files add/change:

```
[----- must be same -----]
DB_USERNAME=
DB_PASSWORD=
DB_PASSWORD\_ROOT=
[----- can be different -----]
MASTER_NAME=your-username
MASTER_EMAIL=your-login-email
MASTER_PASSWORD=your-login-password
```

Run the following commands:

```shell
docker compose build
docker compose up -d
docker compose exec php bash
```

Inside the container bash, run the following commands:

```shell
composer install
chmod -R 777 ./storage
php artisan key:generate
php artisan jwt:secret
php artisan migrate
php artisan db:seed
```

Then, navigate to \`https://localhost/admin\` in your web browser. You may need to add an exception for a self-signed SSL certificate.

If getting memmory allocation error, try:

```shell
chmod -R 777 ./storage
```

You can log in using the `MASTER_EMAIL` and `MASTER_PASSWORD` you defined in your \`.env\` file.

# Tests

Tests checks api, so execute on fresh copy, test database

Will load environment variables from .env.testing
```bash
php artisan db:refresh_test && APP_ENV=testing php artisan db:seed && ./vendor/bin/pest --coverage
```
#
