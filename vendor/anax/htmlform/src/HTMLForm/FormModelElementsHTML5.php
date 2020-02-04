<?php

namespace Anax\HTMLForm;

use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class FormModelElementsHTML5 extends FormModel
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
                //"wrapper-element" => "div",
            ],
            [
                "color" => [
                    "type"        => "color",
                    "description" => "Here you can place a description.",
                    "placeholder" => "Here is a placeholder",
                ],

                "date" => [
                    "type"        => "date",
                    "description" => "Here you can place a description.",
                    "placeholder" => "Here is a placeholder",
                ],

                "datetime" => [
                    "type"        => "datetime",
                    "description" => "Here you can place a description.",
                    "placeholder" => "Here is a placeholder",
                ],

                "datetime-local" => [
                    "type"        => "datetime-local",
                    "description" => "Here you can place a description.",
                    "placeholder" => "Here is a placeholder",
                ],

                "time" => [
                    "type"        => "time",
                    "description" => "Here you can place a description.",
                    "placeholder" => "Here is a placeholder",
                ],

                "week" => [
                    "type"        => "week",
                    "description" => "Here you can place a description.",
                    "placeholder" => "Here is a placeholder",
                ],

                "month" => [
                    "type"        => "month",
                    "description" => "Here you can place a description.",
                    "placeholder" => "Here is a placeholder",
                ],

                "number" => [
                    "type"        => "number",
                    "description" => "Here you can place a description.",
                    "placeholder" => "Here is a placeholder",
                ],

                "range" => [
                    "type"        => "range",
                    "description" => "Here you can place a description.",
                    "placeholder" => "Here is a placeholder",
                    "value"       => 42,
                    "min"         => 0,
                    "max"         => 100,
                    "step"        => 2,
                ],

                "search" => [
                    "type"        => "search",
                    "label"       => "Search:",
                    "description" => "Here you can place a description.",
                    "placeholder" => "Here is a placeholder",
                ],

                "tel" => [
                    "type"        => "tel",
                    "description" => "Here you can place a description.",
                    "placeholder" => "Here is a placeholder",
                ],

                "email" => [
                    "type"        => "email",
                    "description" => "Here you can place a description.",
                    "placeholder" => "Here is a placeholder",
                ],

                "url" => [
                    "type"        => "url",
                    "description" => "Here you can place a description.",
                    "placeholder" => "Here is a placeholder",
                ],

                "file-multiple" => [
                    "type"        => "file-multiple",
                    "description" => "Here you can place a description.",
                ],

                "reset" => [
                    "type"      => "reset",
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
        // Read all values for the sake of this example
        $elements = [
            "color", "date", "datetime", "datetime-local", "time",
            "week", "month", "number", "range", "search", "tel",
            "email", "url", "file-multiple",
        ];
        foreach ($elements as $name) {
            $this->form->addOutput(
                "$name has value: "
                . $this->form->value($name)
                . "</br>"
            );
        }

        // Remember values during resubmit, for sake of the example
        $this->form->rememberValues();

        return true;
    }
}
