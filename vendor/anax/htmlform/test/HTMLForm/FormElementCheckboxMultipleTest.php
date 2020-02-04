<?php

namespace Anax\HTMLForm;

use PHPUnit\Framework\TestCase;

/**
 * HTML Form elements.
 */
class FormElementCheckboxMultipleTest extends TestCase
{
    /**
     * Test
     */
    public function testCreate()
    {
        $name = "name";
        $attr = [
            "values" => []
        ];

        $elem = new FormElementCheckboxMultiple($name, $attr);

        $res = $elem['name'];
        $exp = $name;
        $this->assertEquals($res, $exp, "Name missmatch.");

        $res = $elem['type'];
        $exp = "checkbox-multiple";
        $this->assertEquals($res, $exp, "Type missmatch.");

        $res = $elem->getValue();
        $exp = null;
        $this->assertEquals($res, $exp, "Value missmatch.");

        $res = is_array($elem['values']) && empty($elem['values']);
        $exp = true;
        $this->assertEquals($res, $exp, "Values missmatch.");
    }



    /**
     * Test
     *
     * @expectedException \Anax\HTMLForm\Exception
     */
    public function testCreateException()
    {
        $name = "name";
        $attr = [];

        $elem = new FormElementCheckboxMultiple($name, $attr);
    }



    /**
     * Test
     */
    public function testGetHTMLEmpty()
    {
        $name = "name";
        $attr = [
            "values" => []
        ];

        $elem = new FormElementCheckboxMultiple($name, $attr);

        $res = $elem->getHTML();
        $exp = <<<EOD
<div>
<p></p>

<p class='cf-desc'></p>
</div>
EOD;

        $this->assertEquals($exp, $res, "Output HTML missmatch.");
    }



    /**
     * Test
     */
    public function testGetHTML()
    {
        $name = "name";
        $attr = [
            'values' => [
                'A',
                'B',
            ],
        ];

        $elem = new FormElementCheckboxMultiple($name, $attr);

        $res = $elem->getHTML();
        $exp = <<<EOD
<div>
<p></p>
<p>
<input id='form-element-nameA'type='checkbox' name='name[]' value='A' />
<label for='form-element-nameA'>A</label>

</p><p>
<input id='form-element-nameAB'type='checkbox' name='name[]' value='B' />
<label for='form-element-nameAB'>B</label>

</p>
<p class='cf-desc'></p>
</div>
EOD;
        $this->assertEquals($exp, $res, "Output HTML missmatch.");
    }
}
