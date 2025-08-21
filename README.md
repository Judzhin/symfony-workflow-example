# Symfony workflow
Symfony is a powerful PHP framework that empowers developers to build scalable, high-performance web applications with
reusable components, comprehensive documentation, and a strong community.

## [Debug mode](https://symfony.com/doc/current/configuration/front_controllers_and_kernel.html#debug-mode)
The second argument to the Kernel constructor specifies if the application should run in "debug mode". Regardless of the
configuration environment, a Symfony application can be run with debug mode set to true or false.

This affects many things in the application, such as displaying stack traces on error pages or if cache files are
dynamically rebuilt on each request. Though not a requirement, debug mode is generally set to true for the dev and test
environments and false for the prod environment.

Similar to configuring the environment you can also enable/disable the debug mode using the .env file:

## [Profiler](https://symfony.com/doc/current/profiler.html)
The profiler is a powerful development tool that gives detailed information about the execution of any request.

### Installation
In applications using Symfony Flex, run this command to install the profiler Symfony pack before using it:

```shell
composer require --dev symfony/profiler-pack
```

## [The Symfony MakerBundle](https://symfony.com/bundles/SymfonyMakerBundle/current/index.html)
Symfony Maker helps you create empty commands, controllers, form classes, tests and more so you can forget about writing
boilerplate code. This bundle assumes you're using a standard Symfony directory structure, but many commands can
generate code into any application.

### Installation
Run this command to install and enable this bundle in your application:

```shell
composer require --dev symfony/maker-bundle 
```

## [DoctrineMigrationsBundle](https://symfony.com/bundles/DoctrineMigrationsBundle/current/index.html)
Database migrations are a way to safely update your database schema both locally and on production. Instead of running the doctrine:schema:update command or applying the database changes manually with SQL statements, migrations allow to replicate the changes in your database schema in a safe manner.

Migrations are available in Symfony applications via the DoctrineMigrationsBundle, which uses the external Doctrine Database Migrations library. Read the documentation of that library if you need a general introduction about migrations.

### Installation
Run this command in your terminal:

```shell
composer require doctrine/doctrine-migrations-bundle "^3.0"
```

## [Doctrine-fixtures-bundle](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html) && [Faker](https://fakerphp.org/)
Fixtures are used to load a "fake" set of data into a database that can then be used for testing or to help give you
some interesting data while you're developing your application.

This bundle is compatible with any database supported by Doctrine ORM (MySQL, PostgreSQL, SQLite, etc.). If you are
using MongoDB, you must use DoctrineMongoDBBundle instead.

Faker is a PHP library that generates fake data for you. Whether you need to bootstrap your database, create
good-looking XML documents, fill-in your persistence to stress test it, or anonymize data taken from a production
service, Faker is for you.

It's heavily inspired by Perl's [Data::Faker](https://metacpan.org/pod/Data::Faker), and by
Ruby's [Faker](https://rubygems.org/gems/faker).

### Installation
```shell
composer require --dev doctrine/doctrine-fixtures-bundle fakerphp/faker
```

## [Doctrine Behavioral Extensions](https://github.com/doctrine-extensions/DoctrineExtensions)
This package contains extensions for Doctrine ORM and MongoDB ODM that offer new functionality or tools to use Doctrine
more efficiently. These behaviors can be easily attached to the event system of Doctrine and handle the records being
flushed in a behavioral way.

### Installation
```shell
composer require gedmo/doctrine-extensions
```

## [Testing](https://symfony.com/doc/current/testing.html)
Whenever you write a new line of code, you also potentially add new bugs. To build better and more reliable
applications, you should test your code using both functional and unit tests.

Symfony integrates with an independent library called [PHPUnit](https://phpunit.de/) to give you a rich testing
framework. This article covers the PHPUnit basics you'll need to write Symfony tests. To learn everything about PHPUnit
and its features, read the [official PHPUnit documentation](https://docs.phpunit.de/en/12.3/).

### Installation
Before creating your first test, install symfony/test-pack, which installs some other packages needed for testing (such
as phpunit/phpunit):

```shell
composer require --dev symfony/test-pack
```

## [VichUploaderBundle](https://github.com/dustin10/VichUploaderBundle)
The VichUploaderBundle is a Symfony bundle that attempts to ease file uploads that are attached to ORM entities, MongoDB
ODM documents, or PHPCR ODM documents.

### Get the bundle using composer
Add VichUploaderBundle by running this command from the terminal at the root of your Symfony project:

```shell
composer require vich/uploader-bundle
```

## [Gaufrette Bundle](https://github.com/KnpLabs/KnpGaufretteBundle)
Gaufrette is a PHP library providing a filesystem abstraction layer. This abstraction layer allows you to develop
applications without needing to know where all their media files will be stored or how.

Documentation is available the [official page of Gaufrette](https://github.com/KnpLabs/Gaufrette).

### Installation
As this bundle is an integration for Symfony of the Gaufrette library, it requires you to first install Gaufrette in
your project.

Note that, you need to install separately the adapters you want to use. You can find more details about these packages
here, and the full list adapters on packagist.

```shell
composer require knplabs/knp-gaufrette-bundle
```

## LiipImagineBundle
The [LiipImagineBundle](https://github.com/liip/LiipImagineBundle) package provides an image manipulation abstraction
toolkit for Symfony-based projects.

### Installation
Open a command console, enter your project directory, and execute the following command to download the latest stable
version of this bundle and add it as a dependency to your project:

```shell
composer require liip/imagine-bundle
```

If you accept the Symfony Flex recipe during installation, the bundle is registered, routing set up and the
configuration skeleton file is created. You can now adapt the configuration to your needs. Otherwise, you need to
configure the bundle with the next steps.

## [PagerfantaBundle](https://www.babdev.com/open-source/packages/pagerfantabundle/docs)
The PagerfantaBundle is a Symfony bundle integrating Pagerfanta into an application.

This bundle is a continuation of the WhiteOctoberPagerfantaBundle.

### Installation
```shell
composer require babdev/pagerfanta-bundle pagerfanta/doctrine-orm-adapter
```
