# Symfony workflow
Symfony is a powerful PHP framework that empowers developers to build scalable, high-performance web applications with reusable components, comprehensive documentation, and a strong community.

## [Debug mode](https://symfony.com/doc/current/configuration/front_controllers_and_kernel.html#debug-mode)
The second argument to the Kernel constructor specifies if the application should run in "debug mode". Regardless of the configuration environment, a Symfony application can be run with debug mode set to true or false.

This affects many things in the application, such as displaying stack traces on error pages or if cache files are dynamically rebuilt on each request. Though not a requirement, debug mode is generally set to true for the dev and test environments and false for the prod environment.

Similar to configuring the environment you can also enable/disable the debug mode using the .env file:

## [Profiler](https://symfony.com/doc/current/profiler.html)
The profiler is a powerful development tool that gives detailed information about the execution of any request.

### Installation
In applications using Symfony Flex, run this command to install the profiler Symfony pack before using it:

```shell
composer require --dev symfony/profiler-pack
```

## [The Symfony MakerBundle](https://symfony.com/bundles/SymfonyMakerBundle/current/index.html)
Symfony Maker helps you create empty commands, controllers, form classes, tests and more so you can forget about writing boilerplate code. This bundle assumes you're using a standard Symfony directory structure, but many commands can generate code into any application.

### Installation
Run this command to install and enable this bundle in your application:

```shell
composer require --dev symfony/maker-bundle 
```

# [Doctrine Behavioral Extensions](https://github.com/doctrine-extensions/DoctrineExtensions)
This package contains extensions for Doctrine ORM and MongoDB ODM that offer new functionality or tools to use Doctrine more efficiently. These behaviors can be easily attached to the event system of Doctrine and handle the records being flushed in a behavioral way.

### Installation
```shell
composer require gedmo/doctrine-extensions
```

## [Testing](https://symfony.com/doc/current/testing.html)
Whenever you write a new line of code, you also potentially add new bugs. To build better and more reliable applications, you should test your code using both functional and unit tests.

Symfony integrates with an independent library called [PHPUnit](https://phpunit.de/) to give you a rich testing framework. This article covers the PHPUnit basics you'll need to write Symfony tests. To learn everything about PHPUnit and its features, read the [official PHPUnit documentation](https://docs.phpunit.de/en/12.3/).

### Installation
Before creating your first test, install symfony/test-pack, which installs some other packages needed for testing (such as phpunit/phpunit):

```shell
composer require --dev symfony/test-pack
```
