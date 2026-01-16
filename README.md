# Dungeon of Bugs

This project is a dungeon crawler game using PHP and the Symfony console.

It also is an exercise for my workshops on test-driven development (PHP).

## Requirements

You'll need one of these:

- local PHP 8.3+ and Composer 2
- Docker and [DDEV](https://github.com/ddev/ddev)

## Running the game

With local PHP:

```bash
bin/dungeon-of-bugs <path-to-level-file>
```

With DDEV:

```bash
ddev exec dungeon-of-bugs
```

## Running the PHPUnit tests

### On the command line

#### Running all tests

| Description                        | Command                              |
|------------------------------------|--------------------------------------|
| Composer script with local PHP     | `composer check:tests:all`           |
| direct PHPUnit call with local PHP | `vendor/bin/phpunit --testsuite all` |
| Composer script with DDEV          | `ddev composer check:tests:all`      |
| direct PHPUnit call with DDEV      | `ddev exec phpunit --testsuite all`  |

#### Running only the unit tests

| Description                        | Command                               |
|------------------------------------|---------------------------------------|
| Composer script with local PHP     | `composer check:tests:unit`           |
| direct PHPUnit call with local PHP | `vendor/bin/phpunit --testsuite unit` |
| Composer script with DDEV          | `ddev composer check:tests:unit`      |
| direct PHPUnit call with DDEV      | `ddev exec phpunit --testsuite unit`  |

#### Running only the functional tests

| Description                        | Command                                     |
|------------------------------------|---------------------------------------------|
| Composer script with local PHP     | `composer check:tests:functional`           |
| direct PHPUnit call with local PHP | `vendor/bin/phpunit --testsuite functional` |
| Composer script with DDEV          | `ddev composer check:tests:functional`      |
| direct PHPUnit call with DDEV      | `ddev exec phpunit --testsuite functional`  |

#### Running a single testcase

This example is for running the testcase

| Description                        | Command                                             |
|------------------------------------|-----------------------------------------------------|
| direct PHPUnit call with local PHP | `vendor/bin/phpunit tests/Unit/PlaceholderTest.php` |
| direct PHPUnit call with DDEV      | `ddev exec phpunit tests/Unit/PlaceholderTest.php`  |

### In PHPStorm

First, you need to configure the PHP interpreter in PHPStorm:

- [local interpreter](https://www.jetbrains.com/help/phpstorm/configuring-local-interpreter.html)
- [remote interpreter with DDEV](https://ddev.readthedocs.io/en/latest/users/install/phpstorm/)

After this, configure PHPUnit:

1. enter the PhpStorm settings
2. PHP > Test Frameworks
3. add a new PHPUnit configuration
4. in "PHPUnit library",
   select "Use Composer autoloader" and set `vendor/autoload.php` as path
5. in "Test Runner",
   select "Default configuration file" and set `phpunit.xml` as path to script

Now you can right-click on a testcase or a directory and select "Run".

## Credits

Part of the code has been copied from the Snake Console game by @dbu.
