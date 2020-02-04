<?php

namespace Anax\HTMLForm;

use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class FormModelValidateCustom extends FormModel
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
                "input" => [
                    "type" =>"text",
                    "label" => "Add string (only validates string \"Mumintrollet\")",
                    "validation" => [
                        "custom_test" => [
                            "message" => "Your string did not match Mumintrollet.",
                            "test" => function ($value) {
                                return $value == "Mumintrollet";
                            }
                        ]
                    ],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Validate string",
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
