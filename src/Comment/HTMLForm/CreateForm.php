<?php

namespace Lyco\Comment\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Lyco\Post\Post;
use Lyco\User\User;
use Lyco\Comment\Comment;

/**
 * Form to create an item.
 */
class CreateForm extends FormModel
{
    public $postId;
    public $id;
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di, $postId)
    {
        parent::__construct($di);
        $this->postId = $postId;
        $this->replyId = $this->di->get("request")->getGet("replyId");

        $this->form->create(
            [
                "commentId" => __CLASS__
            ],
            [
                "comment" => [
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Send",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }

    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));
        $comment->postId = $this->postId;
        $comment->replyId = $this->replyId;
        $comment->id = $this->di->get("session")->get("userId");
        $comment->text = $this->form->value("comment");
        $comment->save();
        return true;
    }

    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("post/view/" . $this->postId)->send();
    }
}
