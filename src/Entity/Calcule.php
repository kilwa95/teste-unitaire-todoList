<?php

namespace App\Entity;

use App\Repository\CalculeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CalculeRepository::class)
 */
class Calcule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function add(int $a, int $b): int
    {
        return $a + $b;
    }

    public function sub(int $a, $b): int
    {
        return $a - $b;
    }
}
