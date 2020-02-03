<?php

namespace Lyco\Post;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lyco\Post\HTMLForm\CreateForm;
use Lyco\Post\HTMLForm\UpdateForm;
use Lyco\Post\Post;
use Lyco\User\User;
use Lyco\Tag\Tag;
use Lyco\Comment\Comment;


// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class PostController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;
    /**
     * Show all items.
     *
     * @return object as a response object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $post = new Post();
        $post->setDb($this->di->get("dbqb"));

        $page->add("post/crud/view-all", [
            "items" => $post->findAll(),
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
    public function createAction() : object
    {
        if (!$this->di->get("session")->has("userId")) {
            $this->di->get("response")->redirect("user/login");
        }
        $page = $this->di->get("page");
        $form = new CreateForm($this->di);
        $form->check();

        $page->add("post/crud/create", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Create a post",
        ]);
    }

    /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     *
     * @return object as a response object
     */
    public function updateAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new UpdateForm($this->di, $id);
        $form->check();

        $page->add("post/crud/update", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Update a post",
        ]);
    }

    /**
     * Handler with form to view an item.
     *
     * @param int $id the id to view.
     *
     * @return object as a response object
     */
     public function viewAction(int $id) : object
     {
         $page = $this->di->get("page");

         // posts
         $post = new Post();
         $post->setDb($this->di->get("dbqb"));
         $posts = $post->find("postId", $id);

         // tags
         $tag = new Tag();
         $tag->setDb($this->di->get("dbqb"));
         $tags = $tag->find("postId", $id);

         // comments
         $comment = new Comment();
         $comment->setDb($this->di->get("dbqb"));
         $comments = $comment->find("postId", $id);

         $data = [
             "post" => $posts,
             "comments" => $comments,
             "tags" => $tags,
             "userId" => $this->di->get("session")->get("userId"),
             "get" => $_GET
         ];

         $page->add("post/crud/view-post", $data);

         return $page->render([
             "title" => "Showing post",
         ]);
     }
}
