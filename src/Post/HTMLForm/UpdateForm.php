<?php

namespace Lyco\Post\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Lyco\Post\Post;

/**
 * Form to update an item.
 */
class UpdateForm extends FormModel
{
    public $postId;
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     * @param integer             $postId to update
     */
    public function __construct(ContainerInterface $di, $postId)
    {
        parent::__construct($di);
        $post = $this->getItemDetails($postId);
        $this->form->create(
            [
                "postId" => __CLASS__,
                "legend" => "Update details of the item",
            ],
            [
                "postId" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $post->postId,
                ],

                "acronym" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $post->acronym,
                ],

                "title" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $post->title,
                ],

                "text" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $post->text,
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Save",
                    "callback" => [$this, "callbackSubmit"]
                ],

                "reset" => [
                    "type"      => "reset",
                ],
            ]
        );
    }



    /**
     * Get details on item to load form with.
     *
     * @param integer $postId get details on item with id.
     *
     * @return Post
     */
    public function getItemDetails($postId) : object
    {
        $post = new Post();
        $post->setDb($this->di->get("dbqb"));
        $post->find("postId", $postId);
        return $post;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $post = new Post();
        $post->setDb($this->di->get("dbqb"));
        $post->find("postId", $this->form->value("postId"));
        $post->acronym  = $this->form->value("acronym");
        $post->title = $this->form->value("title");
        $post->text = $this->form->value("text");
        $post->save();
        return true;
    }

    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("post")->send();
    }
}
