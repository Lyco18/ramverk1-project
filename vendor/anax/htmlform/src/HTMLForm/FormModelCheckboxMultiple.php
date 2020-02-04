<?php

namespace Anax\HTMLForm;

use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class FormModelCheckboxMultiple extends FormModel
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
                "legend" => "Legend"
            ],
            [
                "items" => [
                    "type"        => "checkbox-multiple",
                    "values"      => ["tomato", "potato", "apple", "pear", "banana"],
                    "checked"     => ["potato", "pear"],
                ],
                "submit" => [
                    "type"      => "submit",
                    "callback"  => [$this, "callbackSubmit"],
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
        // Get the selected items as an array
        $items = $this->form->value("items");

        // Print output for sake of this example
        $this->form->addOutput(
            "<p>Selected items are: '"
            . implode(", ", $items)
            . "'."
        );

        // Remember values during resubmit, for sake of the example
        $this->form->rememberValues();

        return true;
    }
}
