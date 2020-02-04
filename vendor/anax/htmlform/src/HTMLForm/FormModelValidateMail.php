<?php

namespace Anax\HTMLForm;

use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class FormModelValidateMail extends FormModel
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
                "mail1" => [
                    "type" =>"text",
                    "label" => "Email (as input type=text)",
                    "validation" => ["email"],
                ],

                "mail2" => [
                    "type" =>"email",
                    "label" => "Email (as input type=email)",
                    "validation" => ["email"],
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
