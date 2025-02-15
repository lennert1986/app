<?php

class SmartyTextbox
{
    private $name;
    private $type;
    private $id;
    private $attributes;
    private $smartyVariable;
    private $smarty;
    private $required;
    private $style;

    public function __construct($formKey, $type, $id, $smartyVariable, $attributes, $required, &$smarty, $style = '')
    {
        $this->name = $this->GetName($formKey);
        $this->type = empty($type) ? 'text' : $type;
        $this->id = empty($id) ? $this->GetName($formKey) : $id;
        $this->attributes = $attributes;
        $this->smartyVariable = $smartyVariable;
        $this->required = $required;
        $this->smarty = $smarty;
        $this->style = $style;
    }

    public function Html()
    {
        $value = htmlspecialchars($this->GetValue(), ENT_QUOTES, 'UTF-8');
        $required = $this->required ? ' required="required"' : '';
        $style = !empty($this->style) ? ' style="' . htmlspecialchars($this->style, ENT_QUOTES, 'UTF-8') . '"' : '';
        $attributes = !empty($this->attributes) ? ' ' . htmlspecialchars($this->attributes, ENT_QUOTES, 'UTF-8') : '';

        return "<input type=\"{$this->GetInputType()}\" name=\"{$this->name}\" id=\"{$this->id}\" value=\"$value\"{$required}{$style}{$attributes} />";
    }

    protected function GetInputType()
    {
        return $this->type;
    }

    private function GetName($formKey)
    {
        return FormKeys::Evaluate($formKey);
    }

    private function GetValue()
    {
        $value = $this->GetPostedValue();

        if (empty($value)) {
            $value = $this->GetTemplateValue();
        }

        return !empty($value) ? trim($value) : '';
    }

    private function GetPostedValue()
    {
        if (class_exists('ServiceLocator') && method_exists(ServiceLocator::GetServer(), 'GetForm')) {
            return ServiceLocator::GetServer()->GetForm($this->name);
        }
        return null;
    }

    private function GetTemplateValue()
    {
        if ($this->smarty instanceof Smarty && !empty($this->smartyVariable)) {
            $var = $this->smarty->getTemplateVars($this->smartyVariable);
            if (!empty($var)) {
                return trim($var);
            }
        }
        return '';
    }
}

class SmartyPasswordbox extends SmartyTextbox
{
    protected function GetInputType()
    {
        return 'password';
    }
}
