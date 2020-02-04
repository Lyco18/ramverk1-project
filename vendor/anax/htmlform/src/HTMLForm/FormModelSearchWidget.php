<?php

namespace Anax\HTMLForm;

use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class FormModelSearchWidget extends FormModel
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
                "search" => [
                    "type"        => "search-widget",
                    "description" => "Here you can place a description.",
                    "placeholder" => "Here is a placeholder",
                    "label"       => "Search",
                    "callback"    => [$this, "callbackSubmit"],
                ]
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
        $this->form->addOutput(
            "Searchstring is: "
            . $this->form->value("search")
            . "</br>"
        );

        // Remember values during resubmit, for sake of the example
        $this->form->rememberValues();

        return true;
    }
}
