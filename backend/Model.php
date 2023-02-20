<?php

abstract class Model extends DbModel
{
    public const RULE_REQUIRED = 'required';
    public const RULE_UNIQUE = 'unique';
    public const RULE_NO_SPECIAL_CHARACTERS = 'noSpecialCharacters';
    public const RULE_STRING = 'string';
    public const RULE_FLOAT = 'float';
    public array $errors = [];

    abstract public function rules() : array;

    public function labels(): array
    {
        return [];
    }

    public function loadData(array $data)
    {
        foreach ($data as $key => $value)
        {
            if(property_exists($this, $key)) {
                if ($value != null) {
                    $this->$key = $value;
                }
            }
        }

    }

    public function getLabel($attribute)
    {
        return $this->labels()[$attribute] ?? $attribute;
    }

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (is_array($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addErrorForRule($attribute, self::RULE_REQUIRED, ['field' => $this->getLabel($attribute)]);
                }
                if ($ruleName === self::RULE_STRING && !strlen($value) > 0) {
                    $this->addErrorForRule($attribute, self::RULE_STRING, ['field' => $this->getLabel($attribute)]);
                }
                if ($ruleName === self::RULE_FLOAT && !is_numeric($value) > 0) {
                    $this->addErrorForRule($attribute, self::RULE_FLOAT, ['field' => $this->getLabel($attribute)]);
                }
                if ($ruleName === self::RULE_NO_SPECIAL_CHARACTERS && !preg_match('/^[^!@#$%^&*<>?\s]+$/', $value)) {
                    $this->addErrorForRule($attribute, self::RULE_NO_SPECIAL_CHARACTERS, ['field' => $this->getLabel($attribute)]);
                }
                if ($ruleName === self::RULE_UNIQUE) {
                    $product = $this->findOne([$attribute => $value]);
                    if ($product) {
                        $this->addErrorForRule($attribute, self::RULE_UNIQUE, ['field' => $this->getLabel($attribute)]);
                    }
                }
            }
        }
        return empty($this->errors);
    }

    private function addErrorForRule(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => 'The {field} input is required',
            self::RULE_UNIQUE => 'The {field} input already exist',
            self::RULE_STRING => 'The {field} input must be a STRING value',
            self::RULE_FLOAT => 'The {field} input must be a NUMERIC value',
            self::RULE_NO_SPECIAL_CHARACTERS => 'No special character allowed for {field} input.',
        ];

    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
}