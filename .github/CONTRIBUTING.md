# CONTRIBUTING

We are using [GitHub Actions](https://github.com/features/actions) as a continuous integration system.

For details, see [`workflows/continuous-integration.yml`](workflows/continuous-integration.yml).

## Coding Standards

We are using [`friendsofphp/php-cs-fixer`](https://github.com/FriendsOfPHP/PHP-CS-Fixer) to enforce coding standards.

Run

```
$ make coding-standards
```

to automatically fix coding standard violations.

## Static Code Analysis

We are using [`phpstan/phpstan`](https://github.com/phpstan/phpstan) to statically analyze the code.

Run

```
$ make static-code-analysis
```

to run a static code analysis.

We are also using the baseline feature of [`phpstan/phpstan`](https://medium.com/@ondrejmirtes/phpstans-baseline-feature-lets-you-hold-new-code-to-a-higher-standard-e77d815a5dff).

Run

```
$ make static-code-analysis-baseline
```

to regenerate the baselines in [`../phpstan-with-extension-baseline.neon`](../phpstan-with-extension-baseline.neon) and [`../phpstan-without-extension-baseline.neon`](../phpstan-without-extension-baseline.neon).

## Tests

We are using [`phpunit/phpunit`](https://github.com/sebastianbergmann/phpunit) to drive the development.

Run

```
$ make tests
```

to run all the tests.

## Extra lazy?

Run

```
$ make
```

to enforce coding standards, perform a static code analysis, and run tests!
