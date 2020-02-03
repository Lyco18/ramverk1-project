<?php

namespace Lyco\Tag;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lyco\Tag\HTMLForm\CreateForm;
use Lyco\Post\Post;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class TagController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;
    /**
     * @var $data description
     */
    public $tag;

    /**
     * Show all items.
     *
     * @return object as a response object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $tag = new Tag();
        $tag->setDb($this->di->get("dbqb"));

        $page->add("tag/crud/view-all", [
            "tags" => $tag->findAll(),
        ]);

        return $page->render([
            "title" => "A collection of items",
        ]);
    }



    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function createAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new CreateForm($this->di, $id);
        $form->check();

        $page->add("tag/crud/create", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Create a tag",
        ]);
    }

    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function viewAction($tag) : object
    {
        $page = $this->di->get("page");
        $tags = new Tag();
        $tags->setDb($this->di->get("dbqb"));

        $posts = new Post();
        $posts->setDb($this->di->get("dbqb"));

        $page->add("tag/crud/view-tag", [
            "items" => $tags->findAll(),
            "tags" => $tag,
            "post" => $posts->findAll()
        ]);

        return $page->render([
            "title" => "A collection of items",
        ]);
    }
}
