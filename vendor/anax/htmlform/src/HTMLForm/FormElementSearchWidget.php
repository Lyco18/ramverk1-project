<?php

namespace Anax\HTMLForm;

/**
 * Form element
 */
class FormElementSearchWidget extends FormElement
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
        $this['type'] = 'search-widget';
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

        $label = isset($this['label'])
            ? " value='{$this['label']}'"
            : null;
        $classSubmit = isset($this['class-submit'])
            ? " class='{$this['class-submit']}'"
            : null;

        return <<<EOD
<{$wrapperElement}{$wrapperClass}>
<input id='$id' type='search'{$class}{$name}{$value}{$autofocus}{$required}{$readonly}{$placeholder}/>
<input id='do-{$id}' type='submit'{$classSubmit}{$label}{$readonly}{$title}/>
</{$wrapperElement}>
<p class='cf-desc'>{$description}</p>
EOD;
    }
}
