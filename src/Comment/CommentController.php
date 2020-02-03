<?php

namespace Lyco\Comment;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lyco\Comment\HTMLForm\CreateForm;
use Lyco\Comment\HTMLForm\UpdateForm;
use Lyco\Post\Post;
use Lyco\User\User;
use \Michelf\MarkdownExtra;


// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class CommentController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * @var $data description
     */

    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
     public function createAction(int $id) : object
     {
         $userId = $this->di->get("session")->get("userId");
         if (!$userId) {
             $this->di->get("response")->redirect("user/login");
         }

         //Form
         $form = new CreateForm($this->di, $id);
         $form->check();

         //Post
         $post = new Post();
         $post->setDb($this->di->get("dbqb"));

         //Post
         $comment = new Comment();
         $comment->setDb($this->di->get("dbqb"));


         $data = [
             "comments" => $comment->find("postId", $id),
             "post" => $post->find("postId", $id),
             "userId" => $userId,
             "filter" => new MarkdownExtra()
         ];

         //Page
         $page = $this->di->get("page");
         $page->add("post/crud/view-post", $data);

         $page->add("post/crud/create", [
             "form" => $form->getHTML(),
         ]);

         return $page->render([
             "title" => "comment",
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
         $userId = $this->di->get("session")->get("userId");

         //Comment
         $comment = new Comment();
         $comment->setDb($this->di->get("dbqb"));
         $comment->find("commentId", $id);

         if (!$userId || ($comment->id != $userId)) {
             $this->di->get("response")->redirect("user/login");
         }

         //Form
         $form = new UpdateForm($this->di, $id);
         $form->check();

         //Page
         $page = $this->di->get("page");
         $page->add("post/crud/update", [
             "form" => $form->getHTML(),
             "type" => "comment"
         ]);

         return $page->render([
             "title" => "Edit comment",
         ]);
     }
}
