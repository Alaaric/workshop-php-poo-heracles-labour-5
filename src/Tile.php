<?php

namespace App;

abstract class Tile implements Mappable
{
    private int $x;
    private int $y;
    protected string $image = "";
    protected  bool $crossable = true;

    public function __construct(int $x, int $y) {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return bool
     */
    public function isCrossable($movable): bool
    {
        return $this->crossable;
    }

    /**
     * @param bool $crossable
     */
    public function setCrossable(bool $crossable): void
    {
        $this->crossable = $crossable;
    }

    /**
     * @param int $y
     */
    public function setY(int $y): void
    {
        $this->y = $y;
    }

    /**
     * @param int $x
     */
    public function setX(int $x): void
    {
        $this->x = $x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
       return 'assets/images/' . $this->image;
    }

}