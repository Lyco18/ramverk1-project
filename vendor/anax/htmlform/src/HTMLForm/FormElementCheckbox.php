<?php

namespace Anax\HTMLForm;

/**
 * Form element
 */
class FormElementCheckbox extends FormElement
{

    /**
     * Constructor
     *
     * @param string $name       of the element.
     * @param array  $attributes to set to the element. Default is an empty array.
     */
    public function __construct($name, $attributes = [])
    {
        parent::__construct($name, $attributes);

        $this['type'] = 'checkbox';
        
        $this['checked'] = isset($attributes['checked'])
            ? $attributes['checked']
            : false;
            
        $this['value'] = isset($attributes['value'])
            ? $attributes['value']
            : $name;
            
        $this->UseNameAsDefaultLabel(null);
    }



    /**
     * Get the value of the form element.
     *
     * @return array the checked values of the form element.
     */
    public function value()
    {
        return $this['checked'];
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

        return <<<EOD
<p>
    <input id='$id'{$type}{$class}{$name}{$value}{$autofocus}{$required}{$readonly}{$checked}{$title} />
    <label for='$id'>$label</label>
    {$messages}
</p>
<p class='cf-desc'>{$description}</p>
EOD;
    }
}
