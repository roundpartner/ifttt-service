<?php

namespace RoundPartner\Maker;

use RoundPartner\Maker\Entity\Request;

class RequestFactory
{
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
        $entity = new Request();
        $entity->event = $event;
        $entity->value1 = $value1;
        $entity->value2 = $value2;
        $entity->value3 = $value3;
        return $entity;
    }
}
