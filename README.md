# Pint

Pint is a tool that can help correct code style issues in your project. You can use it by invoking the Pint binary that is located in your project's \`vendor/bin\` directory:

```bash
./vendor/bin/pint
```

You also have the option to run Pint on specific files or directories:

```bash
./vendor/bin/pint app/Models
```

```bash
./vendor/bin/pint app/Models/User.php
```

Pint will then generate a detailed list of all the files it has updated. If you want more information about the changes Pint has made, you can use the \`-v\` option:

```bash
./vendor/bin/pint -v
```

If you only want Pint to inspect your code for style errors without making any changes to the files, use the \`--test\` option:

```bash
./vendor/bin/pint --test
```

If you prefer Pint to only modify the files that have uncommitted changes according to Git, you can use the \`--dirty\` option:

```bash
./vendor/bin/pint --dirty
```

# Larastan 

Focuses on finding errors in your code.

Configuration is in root directory `phpstan.neon`

```yaml
includes:
- ./vendor/nunomaduro/larastan/extension.neon

parameters:

    paths:
        - app/

    # Level 9 is the highest level
    level: 5

#    ignoreErrors:
#        - '#PHPDoc tag @var#'
#
#    excludePaths:
#        - ./*/*/FileToBeExcluded.php
#
#    checkMissingIterableValueType: false
```

For all available options, please take a look at the [PHPStan documentation](https://phpstan.org/config-reference).

3: Finally, you may start analyzing your code using the `phpstan` console command:

```bash
./vendor/bin/phpstan analyse
```

If you are getting the error `Allowed memory size exhausted`, then you can use the `--memory-limit` option fix the problem:

```bash
./vendor/bin/phpstan analyse --memory-limit=2G
```

## Ignoring errors

Ignoring a specific error can be done either with a php comment or in the configuration file:

```php
// @phpstan-ignore-next-line
$test->badMethod();

$test->badMethod(); // @phpstan-ignore-line
```

# Tests

Tests checks api, so execute on fresh copy, test database

<code>
php artisan db:refresh_test && ./vendor/bin/pest
</code>
