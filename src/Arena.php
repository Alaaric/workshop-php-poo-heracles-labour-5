<?php

namespace App;

use Exception;

class Arena
{
    public const array DIRECTIONS = [
        'N' => [0, -1],
        'S' => [0, 1],
        'E' => [1, 0],
        'W' => [-1, 0],
    ];

    private array $tiles;

    private array $monsters;
    private Hero $hero;

    private int $size = 10;

    public function __construct(
        Hero $hero, array $monsters, ?array $tiles = null)
    {
        $this->hero = $hero;
        $this->monsters = $monsters;
        $this->tiles = $tiles;
    }

    /**
     * @throws Exception
     */
    public function move(Movable $movable, string $direction): void
    {
        $x = $movable->getX();
        $y = $movable->getY();
        if (!key_exists($direction, self::DIRECTIONS)) {
            throw new Exception('Unknown direction');
        }

        $destinationX = $x + self::DIRECTIONS[$direction][0];
        $destinationY = $y + self::DIRECTIONS[$direction][1];

        if ($destinationX < 0 || $destinationX >= $this->getSize() || $destinationY < 0 || $destinationY >= $this->getSize()) {
            throw new Exception('Out of Map');
        }
        $tile = $this->getTile($destinationX, $destinationY);
        if (isset($tile) && !$tile->isCrossable($movable) ) {
            throw new Exception('Not crossable');
        }

        foreach ($this->getMonsters() as $monster) {
            if ($monster->getX() == $destinationX && $monster->getY() == $destinationY) {
                throw new Exception('Not free');
            }
        }

        $movable->setX($destinationX);
        $movable->setY($destinationY);
    }

    /**
     * @throws Exception
     */
    public function arenaMove(string $destination): void
    {
        $this->move($this->hero, $destination);
        foreach ($this->monsters as $monster) {
            if ($monster instanceof Movable) {
                $this->move($monster, array_rand(self::DIRECTIONS));
            }
        };
}

    private function getTile(int $x, int $y): ?Tile {
        $nextTile = null;
        foreach ($this->tiles as $tile) {
       $tile->getX() === $x && $tile->getY() === $y ? $nextTile = $tile : null;
        }
        return $nextTile;
    }

    public function getTiles(): array{
     return  $this->tiles;
    }

    public function getDistance(Fighter $startFighter, Fighter $endFighter): float
    {
        $Xdistance = $endFighter->getX() - $startFighter->getX();
        $Ydistance = $endFighter->getY() - $startFighter->getY();
        return sqrt($Xdistance ** 2 + $Ydistance ** 2);
    }

    /**
     * @throws Exception
     */
    public function battle(int $id): void
    {
        $monster = $this->getMonsters()[$id];
        if ($this->touchable($this->getHero(), $monster)) {
            $this->getHero()->fight($monster);
        } else {
            throw new Exception('Monster out of range');
        }

        if (!$monster->isAlive()) {
            $this->getHero()->setExperience($this->getHero()->getExperience() + $monster->getExperience());
            unset($this->monsters[$id]);
        } else {
            if ($this->touchable($monster, $this->getHero())) {
                $monster->fight($this->getHero());
            } else {
                throw new Exception('Hero out of range');
            }
        }
    }

    public function touchable(Fighter $attacker, Fighter $defenser): bool
    {
        return $this->getDistance($attacker, $defenser) <= $attacker->getRange();
    }

    /**
     * @return array
     */

    /**
     * @param array $tiles
     */
    public function setTiles(array $tiles): void
    {
        $this->tiles = $tiles;
    }

    /**
     * Get the value of monsters
     */
    public function getMonsters(): array
    {
        return $this->monsters;
    }

    /**
     * Set the value of monsters
     *
     */
    public function setMonsters($monsters): void
    {
        $this->monsters = $monsters;
    }

    /**
     * Get the value of hero
     */
    public function getHero(): Hero
    {
        return $this->hero;
    }

    /**
     * Set the value of hero
     */
    public function setHero($hero): void
    {
        $this->hero = $hero;
    }

    /**
     * Get the value of size
     */
    public function getSize(): int
    {
        return $this->size;
    }
}
