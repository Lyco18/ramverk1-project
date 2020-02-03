<?php

namespace Lyco\User\HTMLForm;

use Lyco\User\User;
use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class UserLoginForm extends FormModel
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
                "legend" => "User Login"
            ],
            [
                "acronym" => [
                    "type"        => "text",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "password" => [
                    "type"        => "password",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Login",
                    "callback" => [$this, "callbackSubmit"]
                ],

                "create" => [
                    "type" => "submit",
                    "value" => "Create User",
                    "callback" => [$this, "callbackRegister"]
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

         // Try to login
         $user = new User();
         $user->setDb($this->di->get("dbqb"));
         $res = $user->verifyPassword($acronym, $password);

         if (!$res) {
            $this->form->rememberValues();
            $this->form->addOutput("User or password did not match.");
            $this->di->get("session")->delete("acronym");
            return false;
         }

         $this->di->get("session")->set("userId", $user->acronym);
         $this->di->get("session")->set("userName", $acronym);
         return true;
     }

    /**
     * Redirect for create button
     */
    public function callbackRegister()
    {
        $this->di->get("response")->redirect("user/create");
    }


    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("post")->send();
    }
}
