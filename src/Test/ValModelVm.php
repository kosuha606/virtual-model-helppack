<?php

namespace kosuha606\VirtualModelHelppack\Test;

use kosuha606\VirtualModelHelppack\ValidatableVirtualModel;

class ValModelVm extends ValidatableVirtualModel
{
    public function validators(): array
    {
        return [
            'name' => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'name',
        ];
    }
}