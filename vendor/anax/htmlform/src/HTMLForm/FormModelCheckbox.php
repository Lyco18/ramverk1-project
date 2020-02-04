<?php

namespace Anax\HTMLForm;

use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class FormModelCheckbox extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);

        $license = "You must accept the <a href=http://opensource.org/licenses/GPL-3.0>license agreement</a>.";
        
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Legend"
            ],
            [
                "accept_mail" => [
                    "type"      => "checkbox",
                    "label"     => "It´s great if you send me product information by mail.",
                    "checked"   => false,
                ],

                "accept_phone" => [
                    "type"      => "checkbox",
                    "label"     => "You may call me to try and sell stuff.",
                    "checked"   => true,
                ],

                "accept_agreement" => [
                    "type"        => "checkbox",
                    "label"       => $license,
                    "required"    => true,
                    "validation"  => ["must_accept"],
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
        $elements = ["accept_mail", "accept_phone", "accept_agreement"];
        foreach ($elements as $name) {
            $this->form->addOutput(
                "$name is "
                . ($this->form->value($name)
                    ? ""
                    : "not ")
                . "checked</br>"
            );
        }

        // Remember values during resubmit, for sake of the example
        $this->form->rememberValues();

        return true;
    }
}
