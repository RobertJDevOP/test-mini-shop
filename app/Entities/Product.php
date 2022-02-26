<?php

namespace App\Entities;

class Product
{
    private int $price,$reference;
    public string $urlImage,$description,$name;

    public function __construct()
    {
        $this->reference=4711081355274;
        $this->urlImage='http://localhost:8000/storage/pc.jpg';
        $this->description='Computador Convertible 2en1 Gaming ROG Flow X13 13.4" Pulgadas GV301QE- AMD Ryzen 9- 16 GB RAM - Disco Estado Sólido 1TB- Negro + Obsequios';
        $this->name='Portatil gamer ROC';
        $this->price=16199000;
    }

    public function getReference(): int
    {
        return $this->reference;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

}
