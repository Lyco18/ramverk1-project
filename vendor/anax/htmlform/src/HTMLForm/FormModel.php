<?php

namespace Anax\HTMLForm;

use Psr\Container\ContainerInterface;

/**
 * Base class for form model classes.
 */
abstract class FormModel
{
    /**
     * @var Anax\DI\DIInterface $di   the DI/service container.
     * @var class               $form the main form class.
     */
    protected $di;
    protected $form;



    /**
     * Constructor injects with DI container and creates the form.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        $this->di = $di;
        $this->form = new Form($di);
    }



    /**
     * Customise the check() method to use own methods.
     *
     * @return boolean|null $callbackStatus if submitted&validates, false if
     *                                      not validate, null if not submitted.
     *                                      If submitted the callback function
     *                                      will return the actual value which
     *                                      should be true or false.
     */
    public function check()
    {
        return $this->form->check(
            [$this, "callbackSuccess"],
            [$this, "callbackFail"]
        );
    }



    /**
     * Return HTML for the form.
     *
     * @param array $options with options affecting the form output.
     *
     * @return string with HTML for the form.
     */
    public function getHTML($options = [])
    {
        return $this->form->getHTML($options);
    }



    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirectSelf()->send();
    }



    /**
     * Callback what to do if the form was unsuccessfully submitted, this
     * happen when the submit callback method returns false or if validation
     * fails. This method can/should be implemented by the subclass for a
     * different behaviour.
     */
    public function callbackFail()
    {
        $this->di->get("response")->redirectSelf()->send();
    }
}
