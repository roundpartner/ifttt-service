<?php

namespace RoundPartner\Maker\Entity;

class Request
{
    /**
     * @var string
     */
    public $event;

    /**
     * @var string
     */
    public $value1;

    /**
     * @var string
     */
    public $value2;

    /**
     * @var string
     */
    public $value3;

    /**
     * @param string $event
     * @param string $value1
     * @param string $value2
     * @param string $value3
     *
     * @return Request
     */
    public static function factory($event, $value1, $value2, $value3)
    {
        $entity = new static();
        $entity->event = $event;
        $entity->value1 = $value1;
        $entity->value2 = $value2;
        $entity->value3 = $value3;
        return $entity;
    }
}
