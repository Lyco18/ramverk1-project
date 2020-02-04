<?php

namespace Anax\HTMLForm;

/**
 * A utility class to easy creating and handling of forms
 */
abstract class FormElement implements \ArrayAccess
{

    /**
     * @var array $attributes        settings to use to create element
     * @var array $config            default settings to use to create element
     * @var array $characterEncoding setting for character encoding
     */
    public $attributes;
    public $config;
    public $characterEncoding;



    /**
     * Constructor creating a form element.
     *
     * @param string $name       of the element.
     * @param array  $attributes to set to the element. Default is an empty
     *                           array.
     */
    public function __construct($name, $attributes = [])
    {
        $this->attributes = $attributes;
        $this['name'] = $name;
        //$this['key'] = $name;
        //$this['name'] = isset($this['name']) ? $this['name'] : $name;

        $this->characterEncoding = 'UTF-8';
        $this->default["wrapper-element"] = "p";
        $this->default["br-after-label"] = true;
        $this->default["escape-values"] = true;
    }



    /**
     * Set default values to use, merge incoming with existing.
     *
     * @param array  $options key value array with settings to use.
     *
     * @return void
     */
    public function setDefault($options)
    {
        $this->default = array_merge($this->default, $options);
    }



    /**
     * Implementing ArrayAccess for this->attributes
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->attributes[] = $value;
        } else {
            $this->attributes[$offset] = $value;
        }
    }



    /**
     * Implementing ArrayAccess for this->attributes
     */
    public function offsetExists($offset)
    {
        return isset($this->attributes[$offset]);
    }



    /**
     * Implementing ArrayAccess for this->attributes
     */
    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }



    /**
     * Implementing ArrayAccess for this->attributes
     */
    public function offsetGet($offset)
    {
        return isset($this->attributes[$offset]) ? $this->attributes[$offset] : null;
    }



    /**
     * Get id of an element.
     *
     * @return HTML code for the element.
     */
    public function getElementId()
    {
        return ($this['id'] = isset($this['id']) ? $this['id'] : 'form-element-' . $this['name']);
    }



    /**
     * Get alll validation messages.
     *
     * @return HTML code for the element.
     */
    public function getValidationMessages()
    {
        $messages = null;
        if (isset($this['validation-messages'])) {
            $message = null;
            foreach ($this['validation-messages'] as $val) {
                $message .= "<li>{$val}</li>\n";
            }
            $messages = "<ul class='validation-message'>\n{$message}</ul>\n";
        }
        return $messages;
    }



    /**
     * Get details for a HTML element, prepare for creating HTML code for it.
     *
     * @return HTML code for the element.
     */
    public function getHTMLDetails()
    {
        // Add disabled to be able to disable a form element
        // Add maxlength
        $id =  $this->getElementId();

        $class = isset($this['class'])
            ? "{$this['class']}"
            : null;

        $validates = (isset($this['validation-pass']) && $this['validation-pass'] === false)
            ? ' validation-failed'
            : null;

        $class = (isset($class) || isset($validates))
            ? " class='{$class}{$validates}'"
            : null;

        $wrapperElement = isset($this['wrapper-element'])
            ? $this['wrapper-element']
            : $this->default["wrapper-element"];

        $wrapperClass = isset($this['wrapper-class'])
            ? " class=\"{$this['wrapper-class']}\""
            : null;

        $brAfterLabel = isset($this['br-after-label'])
            ? $this['br-after-label']
            : $this->default["br-after-label"];

        $brAfterLabel = $brAfterLabel
            ? "<br>"
            : null;

        $name = " name='{$this['name']}'";

        $label = isset($this['label'])
            ? ($this['label'] . (isset($this['required']) && $this['required']
                ? "<span class='form-element-required'>*</span>"
                : null))
            : null;

        $autofocus = isset($this['autofocus']) && $this['autofocus']
            ? " autofocus='autofocus'"
            : null;

        $required = isset($this['required']) && $this['required']
            ? " required='required'"
            : null;

        $readonly = isset($this['readonly']) && $this['readonly']
            ? " readonly='readonly'"
            : null;

        $placeholder = isset($this['placeholder']) && $this['placeholder']
            ? " placeholder='{$this['placeholder']}'"
            : null;

        $multiple = isset($this['multiple']) && $this['multiple']
            ? " multiple"
            : null;

        $max = isset($this['max'])
            ? " max='{$this['max']}'"
            : null;

        $min = isset($this['min'])
            ? " min='{$this['min']}'"
            : null;

        $low = isset($this['low'])
            ? " low='{$this['low']}'"
            : null;

        $high = isset($this['high'])
            ? " high='{$this['high']}'"
            : null;

        $optimum = isset($this['optimum'])
            ? " optimum='{$this['optimum']}'"
            : null;

        $step = isset($this['step'])
            ? " step='{$this['step']}'"
            : null;

        $size = isset($this['size'])
            ? " size='{$this['size']}'"
            : null;

        $text = isset($this['text'])
            ? htmlentities($this['text'], ENT_QUOTES, $this->characterEncoding)
            : null;

        $checked = isset($this['checked']) && $this['checked']
            ? " checked='checked'"
            : null;

        $type = isset($this['type'])
            ? " type='{$this['type']}'"
            : null;

        $title = isset($this['title'])
            ? " title='{$this['title']}'"
            : null;

        $pattern = isset($this['pattern'])
            ? " pattern='{$this['pattern']}'"
            : null;

        $description = isset($this['description'])
            ? $this['description']
            : null;

        $novalidate = isset($this['formnovalidate'])
            ? " formnovalidate='formnovalidate'"
            : null;

        $onlyValue = isset($this['value'])
            ? htmlentities($this['value'], ENT_QUOTES, $this->characterEncoding)
            : null;

        $value = isset($this['value'])
            ? " value='{$onlyValue}'"
            : null;

        $onclick = isset($this['onclick'])
            ? " onclick=\"{$this['onclick']}\""
            : null;

        $maxlength = isset($this['maxlength'])
            ? " maxlength='{$this['maxlength']}'"
            : null;

        $messages = $this->getValidationMessages();

        return [
            'id'             => $id,
            'class'          => $class,
            'wrapperElement' => $wrapperElement,
            'wrapperClass'   => $wrapperClass,
            'brAfterLabel'   => $brAfterLabel,
            'name'           => $name,
            'label'          => $label,
            'autofocus'      => $autofocus,
            'required'       => $required,
            'readonly'       => $readonly,
            'placeholder'    => $placeholder,
            'multiple'       => $multiple,
            'min'            => $min,
            'max'            => $max,
            'maxlength'      => $maxlength,
            'low'            => $low,
            'high'           => $high,
            'step'           => $step,
            'optimum'        => $optimum,
            'size'           => $size,
            'text'           => $text,
            'checked'        => $checked,
            'type'           => $type,
            'title'          => $title,
            'pattern'        => $pattern,
            'description'    => $description,
            'novalidate'     => $novalidate,
            'onlyValue'      => $onlyValue,
            'value'          => $value,
            'onclick'        => $onclick,
            'messages'       => $messages,
        ];
    }



    /**
     * Get HTML code for a element, must be implemented by each subclass.
     *
     * @return HTML code for the element.
     */
    abstract public function getHTML();



    /**
     * Validate the form element value according a ruleset.
     *
     * @param array     $rules validation rules.
     * @param Form|null $form  the parent form.
     *
     * @return boolean true if all rules pass, else false.
     */
    public function validate($rules, $form = null)
    {
        $regExpEmailAddress = '/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i';
        $tests = [
            'fail' => [
                'message' => 'Will always fail.',
                'test' => 'return false;'
            ],

            'pass' => [
                'message' => 'Will always pass.',
                'test' => 'return true;'
            ],

            'not_empty' => [
                'message' => 'Can not be empty.',
                'test' => 'return $value != "";'
            ],

            'not_equal' => [
                'message' => 'Value not valid.',
                'test' => 'return $value != $arg;'
            ],

            'number' => [
                'message' => 'Must be a number.',
                'test' => 'return is_numeric($value);'
            ],

            'email' => [
                'message' => 'Must be an email adress.',
                'test' => function ($value) {
                    return preg_match('/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i', $value) === 1;
                }
            ],

            'match' => [
                'message' => 'The field does not match.',
                'test' => 'return $value == $form[$arg]["value"] ;'
            ],

            'must_accept' => [
                'message' => 'You must accept this.',
                'test' => 'return $checked;'
            ],

            'custom_test' => true,
        ];

        // max tecken, min tecken, datum, tid, datetime, mysql datetime

        $pass = true;
        $messages = array();
        $value = $this['value'];
        $checked = $this['checked'];

        foreach ($rules as $key => $val) {
            $rule = is_numeric($key) ? $val : $key;
            if (!isset($tests[$rule])) {
                throw new Exception("Validation of form element failed, no such validation rule exists: $rule");
            }
            $arg = is_numeric($key) ? null : $val;

            $test = ($rule == 'custom_test') ? $arg : $tests[$rule];
            $status = null;
            if (is_callable($test['test'])) {
                $status = $test['test']($value);
            } else {
                $status = eval($test['test']);
            }

            if ($status === false) {
                $messages[] = $test['message'];
                $pass = false;
            }
        }

        if (!empty($messages)) {
            $this['validation-messages'] = $messages;
        }
        return $pass;
    }



    /**
     * Use the element name as label if label is not set.
     *
     * @param string $append a colon as default to the end of the label.
     *
     * @return void
     */
    public function useNameAsDefaultLabel($append = ':')
    {
        if (!isset($this['label'])) {
            $this['label'] = ucfirst(strtolower(str_replace(array('-','_'), ' ', $this['name']))).$append;
        }
    }



    /**
     * Use the element name as value if value is not set.
     *
     * @return void
     */
    public function useNameAsDefaultValue()
    {
        if (!isset($this['value'])) {
            $this['value'] = ucfirst(strtolower(str_replace(array('-','_'), ' ', $this['name'])));
        }
    }



    /**
     * Get the value of the form element.
     *
     * @deprecated
     *
     * @return mixed the value of the form element.
     */
    public function getValue()
    {
        return $this['value'];
    }



    /**
     * Get the escaped value of the form element.
     *
     * @return mixed the value of the form element.
     */
    public function getEscapedValue()
    {
        return htmlentities($this['value']);
    }



    /**
     * Get the unescaped value of the form element.
     *
     * @return mixed the value of the form element.
     */
    public function getRawValue()
    {
        return $this['value'];
    }



    /**
     * Get the value of the form element and respect configuration
     * details whether it should be raw or escaped.
     *
     * @return mixed the value of the form element.
     */
    public function value()
    {
        $escape = isset($this->default["escape-values"])
            ? $this->default["escape-values"]
            : true;

        return $escape
            ? $this->getEscapedValue()
            : $this->getRawValue();
    }



    /**
     * Get the escaped value of the form element and respect configuration
     * details whether it should be raw or escaped.
     *
     * @return mixed the value of the form element.
     */
    public function escValue()
    {
        return $this->getEscapedValue();
    }



    /**
     * Get the raw value of the form element.
     *
     * @return mixed the value of the form element.
     */
    public function rawValue()
    {
        return $this->getRawValue();
    }



    /**
     * Set the value for the element.
     *
     * @param mixed $value set this to be the value of the formelement.
     *
     * @return mixed the value of the form element.
     */
    public function setValue($value)
    {
        return $this['value'] = $value;
    }



    /**
     * Get the status of the form element if it is checked or not.
     *
     * @return mixed the value of the form element.
     */
    public function checked()
    {
        return $this['checked'];
    }



    /**
     * Check if the element is a button.
     *
     * @return boolean true or false.
     */
    public function isButton()
    {
        return in_array($this["type"], ["submit", "reset", "button"]);
    }
}
