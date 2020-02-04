<?php

namespace Anax\HTMLForm;

/**
 * Ordinary input form element
 */
class FormElementText extends FormElementInput
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
        $this['type'] = 'text';
        $this->UseNameAsDefaultLabel();
    }
}
