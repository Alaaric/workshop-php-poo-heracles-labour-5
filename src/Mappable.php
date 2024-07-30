<?php

namespace App;

interface Mappable
{
    /**
     * @param int $y
     */
    public function setY(int $y): void;

    /**
     * @param int $x
     */
    public function setX(int $x): void;

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