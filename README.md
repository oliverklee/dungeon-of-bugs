# Dungeon of Bugs

This project is a dungeon crawler game using PHP and the Symfony console.

It also is an exercise for my workshops on test-driven development (PHP).

## Requirements

You'll need one of these:

- local PHP 8.1+ and Composer 2
- Docker and [DDEV](https://github.com/ddev/ddev)

## Running the PHPUnit tests

### On the command line

#### Running all tests

| Description                        | Command                              |
|------------------------------------|--------------------------------------|
| Composer script with local PHP     | `composer ci:tests:all`              |
| direct PHPUnit call with local PHP | `vendor/bin/phpunit --testsuite all` |
| Composer script with DDEV          | `ddev composer ci:tests:all`         |
| direct PHPUnit call with DDEV      | `ddev exec phpunit --testsuite all`  |

#### Running only the unit tests

| Description                        | Command                               |
|------------------------------------|---------------------------------------|
| Composer script with local PHP     | `composer ci:tests:unit`              |
| direct PHPUnit call with local PHP | `vendor/bin/phpunit --testsuite unit` |
| Composer script with DDEV          | `ddev composer ci:tests:unit`         |
| direct PHPUnit call with DDEV      | `ddev exec phpunit --testsuite unit`  |

#### Running only the functional tests

| Description                        | Command                                     |
|------------------------------------|---------------------------------------------|
| Composer script with local PHP     | `composer ci:tests:functional`              |
| direct PHPUnit call with local PHP | `vendor/bin/phpunit --testsuite functional` |
| Composer script with DDEV          | `ddev composer ci:tests:functional`         |
| direct PHPUnit call with DDEV      | `ddev exec phpunit --testsuite functional`  |

#### Running a single testcase

This example is for running the testcase

| Description                        | Command                                             |
|------------------------------------|-----------------------------------------------------|
| direct PHPUnit call with local PHP | `vendor/bin/phpunit tests/Unit/PlaceholderTest.php` |
| direct PHPUnit call with DDEV      | `ddev exec phpunit tests/Unit/PlaceholderTest.php`  |
