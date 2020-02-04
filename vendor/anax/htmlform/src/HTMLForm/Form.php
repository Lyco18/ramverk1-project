<?php

namespace Anax\HTMLForm;

use Psr\Container\ContainerInterface;

/**
 * A utility class to easy creating and handling of forms
 */
class Form implements \ArrayAccess
{
    /**
     * @var array $form       settings for the form
     * @var array $elements   all form elements
     * @var array $output     messages to display together with the form
     * @var array $sessionKey key values for the session
     */
    protected $form;
    protected $elements;
    protected $output;
    protected $sessionKey;

    /**
     * @var boolean $rememberValues remember values in the session.
     */
    protected $rememberValues;

    /**
     * @var Anax\DI\DIInterface $di the DI service container.
     */
    protected $di;



    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        $this->di = $di;
    }



    /**
     * Implementing ArrayAccess for this->elements
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->elements[] = $value;
        } else {
            $this->elements[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->elements[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->elements[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->elements[$offset])
            ? $this->elements[$offset]
            : null;
    }



    /**
     * Add a form element
     *
     * @param array $form     details for the form
     * @param array $elements all the elements
     *
     * @return $this
     */
    public function create($form = [], $elements = [])
    {
        $defaults = [
            // Always have an id
            "id" => "anax/htmlform",

            // Use a default class on <form> to ease styling
            "class" => "htmlform",

            // Wrap fields within <fieldset>
            "use_fieldset"  => true,

            // Use legend for fieldset, set it to string value
            "legend"        => null,

            // Default wrapper element around form elements
            "wrapper-element" => "p",

            // Use a <br> after the label, where suitable
            "br-after-label" => true,

            // Default is to always encode values
            "escape-values" => true,
        ];
        $this->form = array_merge($defaults, $form);

        $this->elements = [];
        if (!empty($elements)) {
            foreach ($elements as $key => $element) {
                $this->elements[$key] = FormElementFactory::create($key, $element);
                $this->elements[$key]->setDefault([
                    "wrapper-element" => $this->form["wrapper-element"],
                    "br-after-label"  => $this->form["br-after-label"],
                    "escape-values"   => $this->form["escape-values"],
                ]);
            }
        }

        // Default values for <output>
        $this->output = [];

        // Setting keys used in the session
        $generalKey = "anax/htmlform-" . $this->form["id"] . "#";
        $this->sessionKey = [
            "save"      => $generalKey . "save",
            "output"    => $generalKey . "output",
            "failed"    => $generalKey . "failed",
            "remember"  => $generalKey . "remember",
        ];

        return $this;
    }



    /**
     * Add a form element
     *
     * @param FormElement $element the formelement to add.
     *
     * @return $this
     */
    public function addElement($element)
    {
        $name = $element;
        if (isset($this->elements[$name])) {
            throw new Exception("Form element '$name' already exists, do not add it twice.");
        }
        $this[$element['name']] = $name;
        return $this;
    }



    /**
     * Get a form element
     *
     * @param string $name the name of the element.
     *
     * @return \Anax\HTMLForm\FormElement
     */
    public function getElement($name)
    {
        if (!isset($this->elements[$name])) {
            throw new Exception("Form element '$name' is not found.");
        }
        return $this->elements[$name];
    }



    /**
     * Remove an form element
     *
     * @param string $name the name of the element.
     *
     * @return $this
     */
    public function removeElement($name)
    {
        if (!isset($this->elements[$name])) {
            throw new Exception("Form element '$name' is not found.");
        }
        unset($this->elements[$name]);
        return $this;
    }



    /**
     * Set validation to a form element
     *
     * @param string $element the name of the formelement to add validation rules to.
     * @param array  $rules   array of validation rules.
     *
     * @return $this
     */
    public function setValidation($element, $rules)
    {
        $this[$element]['validation'] = $rules;
        return $this;
    }



    /**
     * Add output to display to the user for what happened whith the form and
     * optionally add a CSS class attribute.
     *
     * @param string $str   the string to add as output.
     * @param string $class a class attribute to set.
     *
     * @return $this.
     */
    public function addOutput($str, $class = null)
    {
        $key     = $this->sessionKey["output"];
        $session = $this->di->get("session");
        $output  = $session->get($key);

        $output["message"] = isset($output["message"])
            ? $output["message"] . " $str"
            : $str;

        if ($class) {
            $output["class"] = $class;
        }
        $session->set($key, $output);

        return $this;
    }



    /**
     * Set a CSS class attribute for the <output> element.
     *
     * @param string $class a class attribute to set.
     *
     * @return $this.
     */
    public function setOutputClass($class)
    {
        $key     = $this->sessionKey["output"];
        $session = $this->di->get("session");
        $output  = $session->get($key);
        $output["class"] = $class;
        $session->set($key, $output);
        return $this;
    }



    /**
     * Remember current values in session, useful for storing values of
     * current form when submitting it.
     *
     * @return $this.
     */
    public function rememberValues()
    {
        $this->rememberValues = true;
        return $this;
    }




    /**
     * Get value of a form element and respect settings of escaped or
     * raw value.
     *
     * @param string $name the name of the formelement.
     *
     * @return mixed the value of the element.
     */
    public function value($name)
    {
        return isset($this->elements[$name])
            ? $this->elements[$name]->value()
            : null;
    }



    /**
     * Get escaped value of a form element.
     *
     * @param string $name the name of the formelement.
     *
     * @return mixed the value of the element.
     */
    public function escValue($name)
    {
        return isset($this->elements[$name])
            ? $this->elements[$name]->getEscapedValue()
            : null;
    }



    /**
     * Get raw value of a form element.
     *
     * @param string $name the name of the formelement.
     *
     * @return mixed the value of the element.
     */
    public function rawValue($name)
    {
        return isset($this->elements[$name])
            ? $this->elements[$name]->getRawValue()
            : null;
    }



    /**
     * Check if a element is checked
     *
     * @param string $name the name of the formelement.
     *
     * @return mixed the value of the element.
     */
    public function checked($name)
    {
        return isset($this->elements[$name])
            ? $this->elements[$name]->checked()
            : null;
    }



    /**
     * Return HTML for the form.
     *
     * @param array $options with options affecting the form output.
     *
     * @return string with HTML for the form.
     */
    public function getHTML($options = [])
    {
        $defaults = [
            // Only return the start of the form element
            'start'         => false,

            // Layout all elements in one column
            'columns'       => 1,

            // Layout consequtive buttons as one element wrapped in <p>
            'use_buttonbar' => true,
        ];
        $options = array_merge($defaults, $options);

        $form = array_merge($this->form, $options);
        $id      = isset($form['id'])      ? " id='{$form['id']}'" : null;
        $class   = isset($form['class'])   ? " class='{$form['class']}'" : null;
        $name    = isset($form['name'])    ? " name='{$form['name']}'" : null;
        $action  = isset($form['action'])  ? " action='{$form['action']}'" : null;
        $method  = isset($form['method'])  ? " method='{$form['method']}'" : " method='post'";
        $enctype = isset($form['enctype']) ? " enctype='{$form['enctype']}'" : null;
        $cformId = isset($form['id'])      ? "{$form['id']}" : null;

        if ($options['start']) {
            return "<form{$id}{$class}{$name}{$action}{$method}>\n";
        }

        $fieldsetStart  = '<fieldset>';
        $legend         = null;
        $fieldsetEnd    = '</fieldset>';
        if (!$form['use_fieldset']) {
            $fieldsetStart = $fieldsetEnd = null;
        }

        if ($form['use_fieldset'] && $form['legend']) {
            $legend = "<legend>{$form['legend']}</legend>";
        }

        $elementsArray  = $this->getHTMLForElements($options);
        $elements       = $this->getHTMLLayoutForElements($elementsArray, $options);
        $output         = $this->getOutput();

        $html = <<< EOD
\n<form{$id}{$class}{$name}{$action}{$method}{$enctype}>
<input type="hidden" name="anax/htmlform-id" value="$cformId" />
{$fieldsetStart}
{$legend}
{$elements}
{$output}
{$fieldsetEnd}
</form>\n
EOD;

        return $html;
    }



    /**
     * Return HTML for the elements
     *
     * @param array $options with options affecting the form output.
     *
     * @return array with HTML for the formelements.
     */
    public function getHTMLForElements($options = [])
    {
        $defaults = [
            "use_buttonbar" => true,
        ];
        $options = array_merge($defaults, $options);

        $elements = [];
        $buttonbarStarted = false;
        foreach ($this->elements as $element) {
            if ($options["use_buttonbar"]) {
                if ($element->isButton() && !$buttonbarStarted) {
                    $buttonbarStarted = true;
                    $elements[] = [
                        "name" => "buttonbar start",
                        "html" => "\n<p class=\"buttonbar\">\n"
                    ];
                } elseif ($buttonbarStarted && !$element->isButton()) {
                    $buttonbarStarted = false;
                    $elements[] = [
                        "name" => "buttonbar end",
                        "html" => "\n</p>\n"
                    ];
                }
            }

            $elements[] = [
                "name" => $element["name"],
                "html" => $element->getHTML()
            ];
        }

        if ($buttonbarStarted) {
            $elements[] = [
                "name" => "buttonbar end",
                "html" => "\n</p>\n"
            ];
        }

        return $elements;
    }




    /**
     * Place the elements according to a layout and return the HTML
     *
     * @param array $elements as returned from GetHTMLForElements().
     * @param array $options  with options affecting the layout.
     *
     * @return array with HTML for the formelements.
     */
    public function getHTMLLayoutForElements($elements, $options = [])
    {
        $defaults = [
            'columns' => 1,
            'wrap_at_element' => false,  // Wraps column in equal size or at the set number of elements
        ];
        $options = array_merge($defaults, $options);

        $html = null;
        if ($options['columns'] === 1) {
            foreach ($elements as $element) {
                $html .= $element['html'];
            }
        } elseif ($options['columns'] === 2) {
            $buttonbar = null;
            $col1 = null;
            $col2 = null;

            $end = end($elements);
            if ($end['name'] == 'buttonbar') {
                $end = array_pop($elements);
                $buttonbar = "<div class='cform-buttonbar'>\n{$end['html']}</div>\n";
            }

            $size = count($elements);
            $wrapAt = $options['wrap_at_element'] ? $options['wrap_at_element'] : round($size/2);
            for ($i=0; $i<$size; $i++) {
                if ($i < $wrapAt) {
                    $col1 .= $elements[$i]['html'];
                } else {
                    $col2 .= $elements[$i]['html'];
                }
            }

            $html = <<<EOD
<div class='cform-columns-2'>
<div class='cform-column-1'>
{$col1}
</div>
<div class='cform-column-2'>
{$col2}
</div>
{$buttonbar}</div>
EOD;
        }

        return $html;
    }



    /**
     * Get an array with all elements that failed validation together with their id and validation message.
     *
     * @return array with elements that failed validation.
     */
    public function getValidationErrors()
    {
        $errors = [];
        foreach ($this->elements as $name => $element) {
            if ($element['validation-pass'] === false) {
                $errors[$name] = [
                    'id' => $element->GetElementId(),
                    'label' => $element['label'],
                    'message' => implode(' ', $element['validation-messages'])
                ];
            }
        }
        return $errors;
    }



    /**
     * Get output messages as <output>.
     *
     * @return string|null with the complete <output> element or null if no output.
     */
    public function getOutput()
    {
        $output = $this->output;
        $message = isset($output["message"]) && !empty($output["message"])
            ? $output["message"]
            : null;

        $class = isset($output["class"]) && !empty($output["class"])
            ? " class=\"{$output["class"]}\""
            : null;

        return $message
            ? "<output{$class}>{$message}</output>"
            : null;
    }



    /**
     * Init all element with values from session, clear all and fill in with values from the session.
     *
     * @param array $values retrieved from session
     *
     * @return void
     */
    protected function initElements($values)
    {
        // First clear all
        foreach ($this->elements as $key => $val) {
            // Do not reset value for buttons
            if (in_array($this[$key]['type'], array('submit', 'reset', 'button'))) {
                continue;
            }

            // Reset the value
            $this[$key]['value'] = null;

            // Checkboxes must be cleared
            if (isset($this[$key]['checked'])) {
                $this[$key]['checked'] = false;
            }
        }

        // Now build up all values from $values (session)
        foreach ($values as $key => $val) {
            // Take care of arrays as values (multiple-checkbox)
            if (isset($val['values'])) {
                $this[$key]['checked'] = $val['values'];
                //$this[$key]['values']  = $val['values'];
            } elseif (isset($val['value'])) {
                $this[$key]['value'] = $val['value'];
            }

            if ($this[$key]['type'] === 'checkbox') {
                $this[$key]['checked'] = true;
            } elseif ($this[$key]['type'] === 'radio') {
                $this[$key]['checked'] = $val['value'];
            }

            // Keep track on validation messages if set
            if (isset($val['validation-messages'])) {
                $this[$key]['validation-messages'] = $val['validation-messages'];
                $this[$key]['validation-pass'] = false;
            }
        }
    }



    /**
     * Check if a form was submitted and perform validation and call callbacks.
     * The form is stored in the session if validation or callback fails. The
     * page should then be redirected to the original form page, the form
     * will populate from the session and should be rendered again.
     * Form elements may remember their value if 'remember' is set and true.
     *
     * @param callable $callIfSuccess handler to call if function returns true.
     * @param callable $callIfFail    handler to call if function returns true.
     *
     * @throws \Anax\HTMLForm\Exception
     *
     * @return boolean|null $callbackStatus if submitted&validates, false if
     *                                      not validate, null if not submitted.
     *                                      If submitted the callback function
     *                                      will return the actual value which
     *                                      should be true or false.
     */
    public function check($callIfSuccess = null, $callIfFail = null)
    {
        $remember = null;
        $validates = null;
        $callbackStatus = null;
        $values = [];

        // Remember flash output messages in session
        $output = $this->sessionKey["output"];
        $session = $this->di->get("session");
        $this->output = $session->getOnce($output, []);

        // Check if this was a post request
        $requestMethod = $this->di->get("request")->getServer("REQUEST_METHOD");
        if ($requestMethod !== "POST") {
            // Its not posted, but check if values should be used from session
            $failed   = $this->sessionKey["failed"];
            $remember = $this->sessionKey["remember"];
            $save     = $this->sessionKey["save"];

            if ($session->has($failed)) {
                // Read form data from session if the previous post failed
                // during validation.
                $this->InitElements($session->getOnce($failed));
            } elseif ($session->has($remember)) {
                // Read form data from session if some form elements should
                // be remembered
                foreach ($session->getOnce($remember) as $key => $val) {
                    $this[$key]['value'] = $val['value'];
                }
            } elseif ($session->has($save)) {
                // Read form data from session,
                // useful during test where the original form is displayed
                // with its posted values
                $this->InitElements($session->getOnce($save));
            }

            return null;
        }

        $request = $this->di->get("request");
        $formid = $request->getPost("anax/htmlform-id");
        // Check if its a form we are dealing with
        if (!$formid) {
            return null;
        }

        // Check if its this form that was posted
        if ($this->form["id"] !== $formid) {
            return null;
        }

        // This form was posted, process it
        $session->delete($this->sessionKey["failed"]);
        $validates = true;
        foreach ($this->elements as $element) {
            $elementName = $element['name'];
            $elementType = $element['type'];

            $postElement = $request->getPost($elementName);
            if ($postElement) {
                // The form element has a value set
                // Multiple choices comes in the form of an array
                if (is_array($postElement)) {
                    $values[$elementName]['values'] = $element['checked'] = $postElement;
                } else {
                    $values[$elementName]['value'] = $element['value'] = $postElement;
                }

                // If the element is a password, do not remember.
                if ($elementType === 'password') {
                    $values[$elementName]['value'] = null;
                }

                // If the element is a checkbox, set its value of checked.
                if ($elementType === 'checkbox') {
                    $element['checked'] = true;
                }

                // If the element is a radio, set the value to checked.
                if ($elementType === 'radio') {
                    $element['checked'] = $element['value'];
                }

                // Do validation of form element
                if (isset($element['validation'])) {
                    $element['validation-pass'] = $element->Validate($element['validation'], $this);

                    if ($element['validation-pass'] === false) {
                        $values[$elementName] = [
                            'value' => $element['value'],
                            'validation-messages' => $element['validation-messages']
                        ];
                        $validates = false;
                    }
                }

                // Hmmm.... Why did I need this remember thing?
                if (isset($element['remember'])
                    && $element['remember']
                ) {
                    $values[$elementName] = ['value' => $element['value']];
                    $remember = true;
                }

                // Carry out the callback if the form element validates
                // Hmmm, what if the element with the callback is not the last element?
                if (isset($element['callback'])
                    && $validates
                ) {
                    if (isset($element['callback-args'])) {
                        $callbackStatus = call_user_func_array(
                            $element['callback'],
                            array_merge([$this]),
                            $element['callback-args']
                        );
                    } else {
                        $callbackStatus = call_user_func($element['callback'], $this);
                    }
                }
            } else {
                // The form element has no value set

                // Set element to null, then we know it was not set.
                //$element['value'] = null;
                //echo $element['type'] . ':' . $elementName . ':' . $element['value'] . '<br>';

                // If the element is a checkbox, clear its value of checked.
                if ($element['type'] === 'checkbox'
                    || $element['type'] === 'checkbox-multiple'
                ) {
                    $element['checked'] = false;
                }

                // Do validation even when the form element is not set?
                // Duplicate code, revise this section and move outside
                // this if-statement?
                if (isset($element['validation'])) {
                    $element['validation-pass'] = $element->Validate($element['validation'], $this);

                    if ($element['validation-pass'] === false) {
                        $values[$elementName] = [
                            'value' => $element['value'], 'validation-messages' => $element['validation-messages']
                        ];
                        $validates = false;
                    }
                }
            }
        }

        // Prepare if data should be stored in the session during redirects
        // Did form validation or the callback fail?
        if ($validates === false
            || $callbackStatus === false
        ) {
            $session->set($this->sessionKey["failed"], $values);
        } elseif ($remember) {
            // Hmmm, why do I want to use this
            $session->set($this->sessionKey["remember"], $values);
        }

        if ($this->rememberValues) {
            // Remember all posted values
            $session->set($this->sessionKey["save"], $values);
        }

        // Lets se what the return value should be
        $ret = $validates
            ? $callbackStatus
            : $validates;


        if ($ret === true && isset($callIfSuccess)) {
            // Use callback for success, if defined
            if (!is_callable($callIfSuccess)) {
                throw new Exception("Form, success-method is not callable.");
            }
            call_user_func_array($callIfSuccess, [$this]);
        } elseif ($ret === false && isset($callIfFail)) {
            // Use callback for fail, if defined
            if (!is_callable($callIfFail)) {
                throw new Exception("Form, success-method is not callable.");
            }
            call_user_func_array($callIfFail, [$this]);
        }

        return $ret;
    }
}
