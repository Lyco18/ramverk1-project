<?php

namespace Anax\HTMLForm;

use PHPUnit\Framework\TestCase;

/**
 * HTML Form elements.
 */
class FormElementSubmitTest extends TestCase
{

    /**
     * Test
     */
    public function testCreate()
    {
        $name = "name";
        $attr = [];
        
        $elem = new FormElementSubmit($name, $attr);

        $res = $elem['name'];
        $exp = $name;
        $this->assertEquals($res, $exp, "Name missmatch.");

        $res = $elem['type'];
        $exp = "submit";
        $this->assertEquals($res, $exp, "Type missmatch.");

        $res = $elem->getValue();
        $exp = "Name";
        $this->assertEquals($res, $exp, "Value missmatch.");
    }



    /**
     * Test
     */
    public function testGetHTMLEmpty()
    {
        $name = "name";
        $attr = [];
        
        $elem = new FormElementSubmit($name, $attr);

        $res = $elem->getHTML();
        $exp = <<<EOD
<span>
<input id='form-element-name' type='submit' name='name' value='Name' />
</span>
EOD;
        $this->assertEquals($res, $exp, "Output HTML missmatch.");
    }



    /**
     * Test
     */
    public function testGetHTMLFormNoValidate()
    {
        $name = "name";
        $attr = [
            "formnovalidate" => true
        ];
        
        $elem = new FormElementSubmit($name, $attr);

        $res = $elem->getHTML();
        $exp = <<<EOD
<span>
<input id='form-element-name' type='submit' name='name' value='Name' formnovalidate='formnovalidate' />
</span>
EOD;
        $this->assertEquals($res, $exp, "Output HTML missmatch.");
    }
}
