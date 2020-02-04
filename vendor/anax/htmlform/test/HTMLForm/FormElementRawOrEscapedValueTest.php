<?php

namespace Anax\HTMLForm;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * HTML Form elements.
 */
class FormElementRawOrEscapedValueTest extends TestCase
{
    /** @var DIFactoryConfig Service container */
    private $di;


    /**
     * Setup
     */
    public function setUp()
    {
        $this->di = new DIFactoryConfig(__DIR__ . "/../../htdocs/incl/di.php");
        //$this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
    }



    /**
     * Check default settings of value and rawValue for element.
     */
    public function testCreateElementDefault()
    {
        $name = "name";
        $attr = [];
        $value = "<script>";
        $encodedValue = "&lt;script&gt;";

        $elem = new FormElementText($name, $attr);
        $elem->setValue($value);

        $res = $elem->getRawValue();
        $this->assertEquals($value, $res);

        $res = $elem->getEscapedValue();
        $this->assertEquals($encodedValue, $res);

        $res = $elem->rawValue();
        $this->assertEquals($value, $res);

        $res = $elem->escValue();
        $this->assertEquals($encodedValue, $res);

        // $res = $elem->value();
        // $this->assertEquals($encodedValue, $res);
    }



    /**
     * Check default settings of value and rawValue for form.
     */
    public function testCreateFormDefault()
    {
        $value = "<script>";
        $encodedValue = "&lt;script&gt;";

        $form = new Form($this->di);
        $form->create([], [
            "field1" => [
                "type" => "text",
                "value" => $value
            ]
        ]);

        $res = $form->rawValue("field1");
        $this->assertEquals($value, $res);

        $res = $form->escValue("field1");
        $this->assertEquals($encodedValue, $res);

        // $res = $form->value("field1");
        // $this->assertEquals($encodedValue, $res);
    }



    /**
     * Check form settings for all values encoded to true.
     */
    public function testCreateFormEscapeValuesTrue()
    {
        $value = "<script>";
        $encodedValue = "&lt;script&gt;";

        $form = new Form($this->di);
        $form->create([
            "escape-values" => true,
        ], [
            "field1" => [
                "type" => "text",
                "value" => $value
            ]
        ]);

        $res = $form->rawValue("field1");
        $this->assertEquals($value, $res);

        $res = $form->escValue("field1");
        $this->assertEquals($encodedValue, $res);

        // $res = $form->value("field1");
        // $this->assertEquals($encodedValue, $res);
    }



    /**
     * Check form settings for all values encoded to false.
     */
    public function testCreateFormEscapeValuesFalse()
    {
        $value = "<script>";
        $encodedValue = "&lt;script&gt;";

        $form = new Form($this->di);
        $form->create([
            "escape-values" => false,
        ], [
            "field1" => [
                "type" => "text",
                "value" => $value
            ]
        ]);

        $res = $form->rawValue("field1");
        $this->assertEquals($value, $res);

        $res = $form->escValue("field1");
        $this->assertEquals($encodedValue, $res);

        // $res = $form->value("field1");
        // $this->assertEquals($value, $res);
    }



    /**
     * Form set to true, form element set to false.
     */
    public function testFormTrueFormElementFalse()
    {
        $value = "<script>";
        $encodedValue = "&lt;script&gt;";

        $form = new Form($this->di);
        $form->create([
            //"escape-values" => true,
        ], [
            "field1" => [
                "type" => "text",
                "value" => $value,
                "escape-values" => false,
            ]
        ]);

        $res = $form->rawValue("field1");
        $this->assertEquals($value, $res);

        $res = $form->escValue("field1");
        $this->assertEquals($encodedValue, $res);

        // $res = $form->value("field1");
        // $this->assertEquals($value, $res);
    }
}
