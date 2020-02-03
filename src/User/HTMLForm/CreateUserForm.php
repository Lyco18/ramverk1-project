<?php

namespace Lyco\User\HTMLForm;

use Lyco\User\User;
use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class CreateUserForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Create user",
            ],
            [
                "acronym" => [
                    "type"        => "text",
                ],

                "password" => [
                    "type"        => "password",
                ],

                "password-again" => [
                    "type"        => "password",
                    "validation" => [
                        "match" => "password"
                    ],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Create user",
                    "callback" => [$this, "callbackSubmit"]
                ],

                "login" => [
                    "type" => "submit",
                    "value" => "Back to Login",
                    "callback" => [$this, "callbackLogin"]
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

        // Get values from the submitted form
        $acronym       = $this->form->value("acronym");
        $password      = $this->form->value("password");
        $passwordAgain = $this->form->value("password-again");
        // Check password matches
        if ($password !== $passwordAgain ) {
            $this->form->rememberValues();
            $this->form->addOutput("User or password did not match.");
            return false;
        }
        // Save to database
        $user = New User();
        $user->setDb($this->di->get("dbqb"));
        $user->acronym = $acronym;
        $user->setPassword($password);
        $user->save();
        $this->id = $user->id;
        $this->form->addOutput("User created");
        return true;
    }

    /**
     * Redirect to login
     */
    public function callbackLogin()
    {
        $this->di->get("response")->redirect("user/login");
    }
}
