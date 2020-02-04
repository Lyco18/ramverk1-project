<?php

namespace Anax\HTMLForm;

/**
 * Ordinary input form element
 */
class FormElementInput extends FormElement
{
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
<input id='$id'{$type}{$class}{$name}{$value}{$autofocus}{$required}{$readonly}{$placeholder}{$title}{$multiple}{$pattern}{$maxlength}{$max}{$min}{$step}/>
{$messages}
</{$wrapperElement}>
<p class='cf-desc'>{$description}</p>
EOD;
    }
}
