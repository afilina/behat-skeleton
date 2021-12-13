# Behat Example

Working example of a simple Behat suite to accompany this [article](https://afilina.com/learn/acceptance/test-harness).

You can use this as a starting point for your acceptance tests, expanding it to fit your needs.

## Usage

Clone this repository to your computer and run:

```
composer install
vendor/bin/behat
```

The [example feature](features/example.feature) has two scenarios:
- Visit the example.com/home page and verify the content of the page.
- Set the application to the desired state by creating a database entry (SQLite file).
