<?php

namespace Anax\HTMLForm;

/**
 * Ordinary input form element
 */
class FormElementInputButton extends FormElement
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
<span>
<input id='$id'{$type}{$class}{$name}{$value}{$autofocus}{$readonly}{$novalidate}{$title}{$onclick} />
</span>
EOD;
    }
}
