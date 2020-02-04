<?php

namespace Anax\HTMLForm;

/**
 * Form element
 */
class FormElementHidden extends FormElement
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
        $this['type'] = 'hidden';
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
        return "<input id='$id'{$type}{$class}{$name}{$value} />";
    }
}
