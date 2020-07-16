<?php

namespace kosuha606\VirtualModelHelppack;

use kosuha606\VirtualModel\VirtualModelEntity;

abstract class ValidatableVirtualModel extends VirtualModelEntity
{
    /**
     * @var array
     */
    private $errors = [];

    /**
     * @return array
     */
    abstract public function validators(): array;

    /**
     * @return array
     */
    public function errorMessages(): array
    {
        return [
            'required' => "Поле %s обязательно для заполнения",
        ];
    }

    /**
     * @throws \Exception
     */
    public function validate()
    {
        foreach ($this->validators() as $attribute => $method) {
            if (!method_exists($this, $method)) {
                throw new \Exception("Validator for attribute $attribute was not found");
            }

            $this->$method($attribute);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return !$this->errors;
    }

    /**
     * @param $attribute
     */
    public function required($attribute)
    {
        if (!$this->$attribute) {
            $this->addError($attribute, sprintf($this->errorMessages()['required'], $attribute));
        }
    }

    /**
     * @param $attribute
     * @param $error
     */
    public function addError($attribute, $error)
    {
        $this->errors[$attribute] = $error;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $config
     * @return |null
     * @throws \Exception
     */
    public function save($config = [])
    {
        if ($this->validate()->isValid()) {
            return parent::save($config);
        }

        return false;
    }
}