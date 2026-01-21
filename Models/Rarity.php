<?php
namespace Models;

class Rarity {
    private ?int $id;
    private string $name;
    private string $color_code;

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getColorCode(): string { return $this->color_code; }

    public function setId(?int $id): void { $this->id = $id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setColorCode(string $color): void { $this->color_code = $color; }
}