<?php

namespace App;

interface Movable extends Mappable
{
    /**
     * @param int $y
     */
    public function setY(int $y): void;

    /**
     * @param int $x
     */
    public function setX(int $x): void;


}