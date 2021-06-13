<?php

namespace kosuha606\VirtualModelHelppack\Event;

class Event
{
    private string $name;
    /**
     * @var mixed
     */
    private $data;
    private object $caller;

    /**
     * @param string $name
     * @param object $caller
     * @param mixed $data
     */
    public function __construct(string $name, object $caller, $data)
    {
        $this->name = $name;
        $this->caller = $caller;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getName(): string
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
    public function getCaller(): object
    {
        return $this->caller;
    }

    /**
     * @param mixed $data
     * @return Event
     */
    public function setData($data): Event
    {
        $this->data = $data;

        return $this;
    }


}
