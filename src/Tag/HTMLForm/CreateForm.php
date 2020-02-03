<?php

namespace Lyco\Tag\HTMLForm;
use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Lyco\Tag\Tag;

/**
 * Form to create an item.
 */
class CreateForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di, $postId)
    {
        parent::__construct($di);
        $this->postId = $postId;
        $this->form->create(
            [
                "tagId" => __CLASS__
            ],
            [
                "tag" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],
                "submit" => [
                    "type" => "submit",
                    "value" => "Create tag",
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
    public function callbackSubmit($postId) : bool
    {
        $tag = new Tag();
        $tag->setDb($this->di->get("dbqb"));
        $tagArray = $tag->findAll();
        if (!in_array($this->form->value("tag"), $tagArray)) {
            $tag->tag = $this->form->value("tag");
            $tag->postId = $this->postId;
            $tag->save();
            return true;
        }
        return false;
    }

    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("post/view/ . $this->postId")->send();
    }

    /**
     * Callback what to do if the form was unsuccessfully submitted, this
     * happen when the submit callback method returns true.
     */
    public function callbackFail()
    {
        $this->di->get("response")->redirect("tag")->send();
    }
}
