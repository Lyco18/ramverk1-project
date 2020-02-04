<?php

namespace Anax\HTMLForm;

use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class FormModelStyle extends FormModel
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
                //"class" => "htmlform class1 class2",
                //"use_fieldset" => false,
                "legend" => "Legend",
                //"wrapper-element" => "div",
                //"br-after-label" => true,
            ],
            [
                "text" => [
                    "type"        => "text",
                    "description" => "Here you can place a description.",
                    "placeholder" => "Here is a placeholder",
                    //"wrapper-element" => "div",
                    //"wrapper-class"   => "wclass",
                    //"class"           => "specific",
                    //"br-after-label" => false,
                ],
                        
                "password" => [
                    "type"        => "password",
                    "description" => "Here you can place a description.",
                    "placeholder" => "Here is a placeholder",
                ],

                "hidden" => [
                    "type"        => "hidden",
                    "value"       => "secret value",
                ],

                "file" => [
                    "type"        => "file",
                    "description" => "Here you can place a description.",
                ],

                "textarea" => [
                    "type"        => "textarea",
                    "description" => "Here you can place a description.",
                    "placeholder" => "Here is a placeholder",
                ],

                "radio" => [
                    "type"        => "radio",
                    "label"       => "What is your preferred choice of fruite?",
                    "description" => "Here you can place a description.",
                    "values"      => [
                        "tomato",
                        "potato",
                        "apple",
                        "pear",
                        "banana"
                    ],
                    "checked"     => "potato",
                ],

                "checkbox" => [
                    "type"        => "checkbox",
                    "description" => "Here you can place a description.",
                ],

                "select" => [
                    "type"        => "select",
                    "label"       => "Select your fruite:",
                    "description" => "Here you can place a description.",
                    "options"     => [
                        "tomato" => "tomato",
                        "potato" => "potato",
                        "apple"  => "apple",
                        "pear"   => "pear",
                        "banana" => "banana",
                    ],
                    "value"    => "potato",
                ],

                "selectm" => [
                    "type"        => "select-multiple",
                    "label"       => "Select one or more fruite:",
                    "description" => "Here you can place a description.",
                    "size"        => 6,
                    "options"     => [
                        "tomato" => "tomato",
                        "potato" => "potato",
                        "apple"  => "apple",
                        "pear"   => "pear",
                        "banana" => "banana",
                    ],
                    "checked"   => ["potato", "pear"],
                ],

                "reset" => [
                    "type"      => "reset",
                ],

                "button" => [
                    "type"      => "button",
                    "onclick"   => "alert('hej');"
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
        // These return a single value
        // Type checkbox returns true if checked
        $elements = [
            "text", "password", "hidden", "file", "textarea", "select",
            "radio", "checkbox",
        ];
        foreach ($elements as $name) {
            $this->form->addOutput(
                "$name has value: "
                . $this->form->value($name)
                . "</br>"
            );
        }

        // Select multiple returns an array
        $elements = [
            "selectm",
        ];
        foreach ($elements as $name) {
            $this->form->addOutput(
                "$name has value: "
                . implode($this->form->value($name), ", ")
                . "</br>"
            );
        }

        // Set <output> class
        $this->form->setOutputClass("info");

        // Remember values during resubmit, useful when failing (retunr false)
        // and asking the user to resubmit the form.
        $this->form->rememberValues();

        return true;
    }
}
