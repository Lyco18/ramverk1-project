<?php

namespace Anax\HTMLForm;

/**
 * Form element
 */
class FormElementSelect extends FormElement
{

    /**
     * Constructor
     *
     * @param string $name       of the element.
     * @param array  $attributes to set to the element. Default is an empty array.
     *
     * @throws Exception if missing <options>
     */
    public function __construct($name, $attributes = [])
    {
        parent::__construct($name, $attributes);
        $this['type'] = 'select';
        $this->UseNameAsDefaultLabel();
        
        if (!is_array($this['options'])) {
            throw new Exception("Select needs options, did you forget to specify them when creating the element?");
        }
    }



    /**
     * Get HTML code for a element.
     *
     * @return string HTML code for the element.
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function getHTML()
    {
        $details = $this->getHTMLDetails();
        extract($details);
        
        $options = null;
        foreach ($this['options'] as $optValue => $optText) {
            $options .= "<option value='{$optValue}'"
                . (($this['value'] == $optValue)
                    ? " selected=\"selected\""
                    : null)
                . ">{$optText}</option>\n";
        }

        return <<<EOD
<p>
<label for='$id'>$label</label>$brAfterLabel
<select id='$id'{$class}{$name}{$autofocus}{$required}{$readonly}{$checked}{$title}>
{$options}
</select>
{$messages}
</p>
<p class='cf-desc'>{$description}</p>
EOD;
    }
}
