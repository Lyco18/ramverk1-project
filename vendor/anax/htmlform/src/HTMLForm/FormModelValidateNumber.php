<?php

namespace Anax\HTMLForm;

use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class FormModelValidateNumber extends FormModel
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
                "num1" => [
                    "type" =>"text",
                    "label" => "Numeric (as input type=text)",
                    "validation" => ["number"],
                ],

                "num2" => [
                    "type" =>"number",
                    "label" => "Numeric (as input type=number)",
                    "validation" => ["number"],
                ],

                "num3" => [
                    "type" =>"range",
                    "label" => "Numeric (as input type=range)",
                    "validation" => ["number"],
                    "value"       => 42,
                    "min"         => 0,
                    "max"         => 100,
                    "step"        => 2,
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
