<?php

namespace Anax\HTMLForm;

use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class FormModelValidateNotEmpty extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Legend",
            ],
            [
                "text" => [
                    "type" =>"text",
                    "label" => "Text, not empty (as input type=text)",
                    "validation" => ["not_empty"],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Submit",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $this->form->addOutput("Validation passes.");

        // Remember values during resubmit, for sake of the example
        $this->form->rememberValues();

        return true;
    }
}
