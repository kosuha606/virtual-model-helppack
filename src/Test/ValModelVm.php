<?php

/** @noinspection PhpUnused */

namespace kosuha606\VirtualModelHelpers\Test;

use kosuha606\VirtualModelHelpers\ValidatableVirtualModel;

class ValModelVm extends ValidatableVirtualModel
{
    /**
     * @return array
     */
    public function validators(): array
    {
        return [
            'name' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name',
        ];
    }
}
