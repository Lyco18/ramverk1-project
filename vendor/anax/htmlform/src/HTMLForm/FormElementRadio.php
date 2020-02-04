<?php

namespace Anax\HTMLForm;

/**
 * Form element
 */
class FormElementRadio extends FormElement
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
        $this['type']     = 'radio';
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

        $ret = null;
        foreach ($this['values'] as $val) {
            $id .= $val;
            $item = $onlyValue  = htmlentities($val, ENT_QUOTES, $this->characterEncoding);
            $value = " value='{$onlyValue}'";
            $checked = isset($this['checked']) && $val === $this['checked']
                ? " checked='checked'"
                : null;

            $ret .= <<<EOD
<{$wrapperElement}{$wrapperClass}>
    <input id='$id'{$type}{$class}{$name}{$value}{$autofocus}{$readonly}{$checked}{$title} />
    <label for='$id'>$item</label>
    {$messages}
</{$wrapperElement}>
EOD;
        }

        return <<<EOD
<{$wrapperElement}{$wrapperClass}>
<p class='cf-label'>{$label}</p>
{$ret}
<p class='cf-desc'>{$description}</p>
</{$wrapperElement}>
EOD;
    }
}
