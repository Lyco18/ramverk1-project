<?php

namespace Anax\HTMLForm;

/**
 * Form element
 */
class FormElementFileMultiple extends FormElement
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
        $this['type'] = 'file-multiple';
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
<input id='$id' type='file' multiple{$class}{$name}{$value}{$autofocus}{$required}{$readonly}{$placeholder}{$title}{$multiple}{$pattern}{$max}{$min}{$step}/>
{$messages}
</{$wrapperElement}>
<p class='cf-desc'>{$description}</p>
EOD;
    }
}
