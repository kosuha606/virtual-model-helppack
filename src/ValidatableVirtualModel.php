<?php

/** @noinspection PhpUnused */

namespace kosuha606\VirtualModelHelpers;

use Exception;
use kosuha606\VirtualModel\VirtualModelEntity;

abstract class ValidatableVirtualModel extends VirtualModelEntity
{
    private array $errors = [];

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
     * @throws Exception
     */
    public function validate(): ValidatableVirtualModel
    {
        foreach ($this->validators() as $attribute => $method) {
            if (!method_exists($this, $method)) {
                throw new Exception("Validator for attribute $attribute was not found");
            }

            $this->$method($attribute);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return !$this->errors;
    }

    /**
     * @param string $attribute
     */
    public function required(string $attribute): void
    {
        if (!$this->$attribute) {
            $this->addError($attribute, sprintf($this->errorMessages()['required'], $attribute));
        }
    }

    /**
     * @param string $attribute
     * @param string $error
     */
    public function addError(string $attribute, string $error): void
    {
        $this->errors[$attribute] = $error;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $config
     * @return bool
     * @throws Exception
     */
    public function save($config = []): bool
    {
        if ($this->validate()->isValid()) {
            return parent::save($config);
        }

        return false;
    }
}
