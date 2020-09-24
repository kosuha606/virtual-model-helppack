<?php

namespace kosuha606\VirtualModelHelppack\Test;

use kosuha606\VirtualModelHelppack\ValidatableVirtualModel;

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
