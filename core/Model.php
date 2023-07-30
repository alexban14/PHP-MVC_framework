<?php

namespace app\core;


/**
 * Class Model
 * @author Ban Alexandru <alexbanut10@gmail.com>
 * @package app\core
 **/
abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';

    public function loadData($data)
    {
        foreach ($data as $key => $value)
        {
            // we check that the current instance of a model class has the given properties from the posted data
            // the we assign the given post data to the properties of the current model instance
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    // each model instance has its own validation rules
    abstract public function rules(): array;

    public array $errors = [];
    
    // this fucntion checks all of them
    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL); 
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, $rule); 
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX, $rule); 
                }
                if ($ruleName === self::RULE_MATCH && $value !==  $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH, $rule); 
                }
            }
        } 

        return empty($this->errors);
    }

    public function addError(string $attribute, string $rule, $params = []): void
    {
        $message = $this->errorMessages()[$rule] ?? '';

        // iterating over the a rule paramas (values of a rule) so we can render them in the error msg
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}" , $value, $message);
        }

        $this->errors[$attribute][] = $message;
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}'
        ];
    }

    public function hasErrors($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
    
}
