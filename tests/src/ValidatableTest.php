<?php

use kosuha606\VirtualModelHelppack\Test\ValModelVm;
use kosuha606\VirtualModelHelppack\Test\VirtualTestCase;

class ValidatableTest extends VirtualTestCase
{
    /**
     * @throws Exception
     */
    public function testErrors()
    {
        $model = ValModelVm::create([
            'name' => null,
        ])->validate();

        $this->assertEquals(false, $model->isValid());
    }
}