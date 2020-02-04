Anax Database Active Record
==================================

[![Latest Stable Version](https://poser.pugx.org/anax/database-active-record/v/stable)](https://packagist.org/packages/anax/database-active-record)
[![Join the chat at https://gitter.im/canax/database-active-record](https://badges.gitter.im/canax/database-active-record.svg)](https://gitter.im/canax/database-active-record?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

[![Build Status](https://travis-ci.org/canax/database-active-record.svg?branch=master)](https://travis-ci.org/canax/database-active-record)
[![CircleCI](https://circleci.com/gh/canax/database-active-record.svg?style=svg)](https://circleci.com/gh/canax/database-active-record)

[![Build Status](https://scrutinizer-ci.com/g/canax/database-active-record/badges/build.png?b=master)](https://scrutinizer-ci.com/g/canax/database-active-record/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/canax/database-active-record/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/canax/database-active-record/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/canax/database-active-record/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/canax/database-active-record/?branch=master)

[![Maintainability](https://api.codeclimate.com/v1/badges/ab0c4d472565d95e64ff/maintainability)](https://codeclimate.com/github/canax/database-active-record/maintainability)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/6dff6044d25646e9bcaea3a333108ded)](https://www.codacy.com/app/mosbth/database-active-record?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=canax/database-active-record&amp;utm_campaign=Badge_Grade)

Anax Database Active Record module is an implementation of the Active Record design pattern for model classes using a database.

The implementation uses the module [`anax\database-query-builder`](https://github.com/canax/database-query-builder) which builds upon the module [`anax\database`](https://github.com/canax/database).

The module is tested using MySQL and SQLite.



Table of content
------------------
<!--
* [Install](#Install)
* [Development](#Development)
-->
* [Class, interface, trait](#class-interface-trait)
* [Exceptions](#exceptions)
* [Basic usage](#basic-usage)
* [Dependency](#Dependency)
* [License](#License)



Class, interface, trait
------------------

The following classes, interfaces and traits exists.

| Class, interface, trait            | Description |
|------------------------------------|-------------|
| `Anax\Database\ActiveRecordModel`  | An Active Record implementation using the Anax Database Query Builder. |



Exceptions
------------------

All exceptions are in the namespace `Anax\DatabaseActiveRecord\Exception\`. The following exceptions exists and may be thrown. 

| Exception               | Description |
|-------------------------|-------------|
| `ActiveRecordException` | General module specific exception. |



Basic usage
------------------

The Active Record design pattern is implemented through the class `Anax\DatabaseActiveRecord\DatabaseActiveRecord`. A model class which wants to use the implementation should extend this class to get access to the methods implementing Active Record usage.

<!-- Here should a basic usa case come, perhaps from the book example -->



Dependency
------------------

This module depends upon, and extends, the database abstraction layer [`anax\database`](https://github.com/canax/database).

The module is usually used within an Anax installation but can also be used without Anax.



License
------------------

This software carries a MIT license. See [LICENSE.txt](LICENSE.txt) for details.



```
 .  
..:  Copyright (c) 2013 - 2018 Mikael Roos, mos@dbwebb.se
```
