<?php

namespace Anax\HTMLForm;

/**
 * Form element
 */
class FormElementTextarea extends FormElement
{

    /**
     * Constructor
     *
     * @param string $name       of the element.
     * @param array  $attributes to set to the element. Default is an empty
     *                           array.
     */
    public function __construct($name, $attributes = [])
    {
        parent::__construct($name, $attributes);
        $this['type'] = 'textarea';
        $this->UseNameAsDefaultLabel();
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
<{$wrapperElement}{$wrapperClass}>
<label for='$id'>$label</label>$brAfterLabel
<textarea id='$id'{$class}{$name}{$autofocus}{$required}{$readonly}{$placeholder}{$title}>{$onlyValue}</textarea>
</{$wrapperElement}>
<p class='cf-desc'>{$description}</p>
EOD;
    }
}
