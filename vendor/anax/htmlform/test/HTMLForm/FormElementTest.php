<?php

namespace Anax\HTMLForm;

use PHPUnit\Framework\TestCase;

/**
 * HTML Form elements.
 */
class FormElementTestTest extends TestCase
{

    /**
     * Test
     */
    public function testCreateElement()
    {
        $element = new FormElementTest('test');

        $res = $element['name'];
        $exp = 'test';
        $this->assertEquals($res, $exp, "Created element name missmatch.");

        $res = $element->characterEncoding;
        $exp = 'UTF-8';
        $this->assertEquals($res, $exp, "Character encoding missmatch.");
    }



    /**
     * Test
     *
     * @expectedException \Anax\HTMLForm\Exception
     */
    public function testValidationRuleNotFound()
    {
        $element = new FormElementTest('test');

        $element->validate(['no-such-rule']);
    }



    /**
     * Test
     */
    public function testGetValue()
    {
        $element = new FormElementTest('test', ['value' => 42]);

        $res = $element['value'];
        $exp = 42;
        $this->assertEquals($res, $exp, "Form element value missmatch, array syntax.");

        $res = $element->getValue();
        $exp = 42;
        $this->assertEquals($res, $exp, "Form element value missmatch, method.");
    }



    /**
     * Test
     *
     * @return void
     *
     */
    public function testValidateEmail()
    {
        $element = new FormElementTest('test');

        $element['value'] = 'mos@dbwebb.se';
        $res = $element->validate(['email']);
        $this->assertTrue($res, "Validation email fails.");
    }
}
