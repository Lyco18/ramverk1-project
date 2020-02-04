[![Build Status](https://travis-ci.com/Lyco18/ramverk1-project.svg?branch=master)](https://travis-ci.com/Lyco18/ramverk1-project)

Ramverk1 Final project
=========================

Following is a final project for the course ramverk1.
A forum about the Gold Coast!

To re-use this, download from github and use composer install:
```git clone
```

Run following commands:
```$ mkdir data
$ chmod 777 data
$ touch data/db.sqlite
$ chmod 666 data/db.sqlite
$ sqlite3 data/db.sqlite < sql/ddl/ddl_sqlite.sql
```

To re-route index page, change following in **vendor/anax/content/src/content/FileBasedContentController**:

```/**
 * A controller for flat file markdown content.
 */
class FileBasedContentController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * This is the index method action
     *
     * @return object
     */
    public function indexAction() : object
    {
        $this->di->get("response")->redirect("tag/home");
    }
```
