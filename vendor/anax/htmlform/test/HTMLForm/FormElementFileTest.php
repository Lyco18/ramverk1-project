<?php

namespace Anax\HTMLForm;

use PHPUnit\Framework\TestCase;

/**
 * HTML Form elements.
 */
class FormElementFileTest extends TestCase
{

    /**
     * Test
     */
    public function testCreate()
    {
        $name = "name";
        $attr = [];
        
        $elem = new FormElementFile($name, $attr);

        $res = $elem['name'];
        $exp = $name;
        $this->assertEquals($res, $exp, "Name missmatch.");

        $res = $elem['type'];
        $exp = "file";
        $this->assertEquals($res, $exp, "Type missmatch.");

        $res = $elem->getValue();
        $exp = null;
        $this->assertEquals($res, $exp, "Value missmatch.");
    }



    /**
     * Test
     */
    public function testGetHTMLEmpty()
    {
        $name = "name";
        $attr = [];
        
        $elem = new FormElementFile($name, $attr);

        $res = $elem->getHTML();
        $exp = <<<EOD
<p>
<label for='form-element-name'>Name:</label><br>
<input id='form-element-name' type='file' name='name'/>

</p>
<p class='cf-desc'></p>
EOD;
        $this->assertEquals($res, $exp, "Output HTML missmatch.");
    }
}
