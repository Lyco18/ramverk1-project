<?php

namespace Anax\HTMLForm;

use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class FormModelSelectOption extends FormModel
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
                "expmonth" => [
                    "type" => "select",
                    "label" => "Expiration month:",
                    
                    "options" => [
                        "default" => "Select credit card expiration month...",
                        "01" => "January",
                        "02" => "February",
                        "03" => "March",
                        "04" => "April",
                        "05" => "May",
                        "06" => "June",
                        "07" => "July",
                        "08" => "August",
                        "09" => "September",
                        "10" => "October",
                        "11" => "November",
                        "12" => "December",
                    ],
                    //"value"   => "8",
                ],
                
                "doPay" => [
                    "type" => "submit",
                    "value" => "Perform payment",
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
        $this->form->addOutput(
            "<p>Selected month is: "
            . $this->form->value("expmonth")
            . "</p>"
        );

        // Remember values during resubmit, for sake of the example
        $this->form->rememberValues();

        return true;
    }
}
