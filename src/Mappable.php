<?php

namespace App;

interface Mappable
{
    /**
     * @return int
     */
    public function getY(): int;

    /**
     * @return int
     */
    public function getX(): int;

    /**
     * @param string $image
     */
    public function setImage(string $image);

    /**
     * @return string
     */
    public function getImage(): string;
}