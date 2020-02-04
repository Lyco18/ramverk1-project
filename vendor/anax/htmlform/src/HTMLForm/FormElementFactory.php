<?php

namespace Anax\HTMLForm;

/**
 * Factory to create form elements.
 */
class FormElementFactory
{
    /**
     * Create a formelement from an array, factory returns the correct
     * instance.
     *
     * @param string $name       name of the element.
     * @param array  $attributes to use when creating the element.
     *
     * @return the instance of the form element.
     */
    public static function create($name, $attributes)
    {
        // Not supported is type=image, <button>, list, output, select-optgroup
        $types = [

            // Standard HTML 4.01
            'text'              => '\Anax\HTMLForm\FormElementText',
            'file'              => '\Anax\HTMLForm\FormElementFile',
            'password'          => '\Anax\HTMLForm\FormElementPassword',
            'hidden'            => '\Anax\HTMLForm\FormElementHidden',
            'textarea'          => '\Anax\HTMLForm\FormElementTextarea',
            'radio'             => '\Anax\HTMLForm\FormElementRadio',
            'checkbox'          => '\Anax\HTMLForm\FormElementCheckbox',
            'select'            => '\Anax\HTMLForm\FormElementSelect',
            'select-multiple'   => '\Anax\HTMLForm\FormElementSelectMultiple',
            'submit'            => '\Anax\HTMLForm\FormElementSubmit',
            'reset'             => '\Anax\HTMLForm\FormElementReset',
            'button'            => '\Anax\HTMLForm\FormElementButton',

            // HTML5
            'color'             => '\Anax\HTMLForm\FormElementColor',
            'date'              => '\Anax\HTMLForm\FormElementDate',
            'number'            => '\Anax\HTMLForm\FormElementNumber',
            'range'             => '\Anax\HTMLForm\FormElementRange',
            'tel'               => '\Anax\HTMLForm\FormElementTel',
            'email'             => '\Anax\HTMLForm\FormElementEmail',
            'url'               => '\Anax\HTMLForm\FormElementUrl',
            'search'            => '\Anax\HTMLForm\FormElementSearch',
            'file-multiple'     => '\Anax\HTMLForm\FormElementFileMultiple',
            'datetime'          => '\Anax\HTMLForm\FormElementDatetime',
            'datetime-local'    => '\Anax\HTMLForm\FormElementDatetimeLocal',
            'month'             => '\Anax\HTMLForm\FormElementMonth',
            'time'              => '\Anax\HTMLForm\FormElementTime',
            'week'              => '\Anax\HTMLForm\FormElementWeek',

            // Custom
            'search-widget'     => '\Anax\HTMLForm\FormElementSearchWidget',
            'checkbox-multiple' => '\Anax\HTMLForm\FormElementCheckboxMultiple',
            // Address
        ];

        // $attributes['type'] must contain a valid type creating an object
        // to succeed.
        $type = isset($attributes['type']) ? $attributes['type'] : null;
        if (!($type && isset($types[$type]))) {
            throw new Exception("Form element does not exists and can not be created: $name - $type");
        }
        return new $types[$type]($name, $attributes);
    }
}
