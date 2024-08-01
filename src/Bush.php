<?php

namespace App;

use App\Tile;

class Bush extends Tile
{
protected string $image = "bush.png";
protected bool $crossable = false;

public function isCrossable($movable): bool
{
   return $movable instanceof Hind;
}
}