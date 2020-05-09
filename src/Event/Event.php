<?php

namespace kosuha606\VirtualModelHelppack\Event;

class Event
{
    private $name;
    private $data;
    private $caller;

    /**
     * @param string $name
     * @param object $caller
     * @param mixed $data
     */
    public function __construct($name, $caller, $data)
    {
        $this->name = $name;
        $this->caller = $caller;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return object
     */
    public function getCaller()
    {
        return $this->caller;
    }

    /**
     * @param mixed $data
     * @return Event
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }


}
