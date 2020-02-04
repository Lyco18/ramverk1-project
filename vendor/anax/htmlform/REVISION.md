Revision history
=================================



v2.0.0 (2018-12-10)
---------------------------------

* Add validators for Codeclimate and Codacy.
* Integrated with Anax version 2 modules.



v2.0.0-beta.1 (2018-12-10)
---------------------------------

* Update package.json requirement to PHP 7.2.



v1.1.2 (2018-04-04)
---------------------------------

* Update to selected="selected" for select options.


v1.1.1 (2018-03-26)
---------------------------------

* Added maxlength to input through PR #10.


v1.1.0 (2018-03-05)
---------------------------------

* Remove lockfile for composer.json.
* Add requirement >PHP7.0 in composer.json.
* Update testclasses to support PHPUnit namespace.
* Travis to test only on >PHP7.0.
* CircleCI upgrade to version 2 and PHP7.2 using own image.
* Add PHP Warnings during phpunit.
* Fix #8 deprecated each() in PHP7.2.
* Makefile to install different versions of phpunit, depending on PHP-version.
* Use Docker to test in different version of PHP.


v1.0.4 (2018-02-26)
---------------------------------

* Add docker support.
* Merge pr #7 to make value() use htmlentities with respect to xss.



v1.0.3 (2017-09-19)
---------------------------------

* Always have default class=htmlform on <form>.
* Add test for styling forms.
* Move use_fieldset to create(), can be overridden in getHTML().
* Move legend to create(), can be overridden in getHTML().
* Make Form properties protected, not public.
* Enable to set class attribute to the output element through Form::setOUtputClass().
* Create FormElementInputButton and move createHTML there.
* Make FormElement abstract and create a FormElementFactory.
* Add option to add JavaScript in onclick for buttons.
* Make <br> after label configurable on create and on specific element.


v1.0.2 (2017-08-24)
---------------------------------

* Removing Form constructor, must call create explicit.
* Integrating with Anax DI, depending on anax/di.
* Depending on anax/session.
* Depending on anax/request.
* Depending on anax/response.
* Depending on anax/url.
* Rewriting FormModel, use Form instead of extend.
* Update all example programs for FormModel.
* New setup of class FormModel, use Form, not extend.
* New example programs for validate.


v1.0.1 (2017-08-17)
---------------------------------

* Last tag before integrating Anax DI.
* Remove reference to Lydia in FormElement.


v1.0.0 (2017-08-15)
---------------------------------

* First setup, copied from mos/cform and rewritten to the anax namespace.
