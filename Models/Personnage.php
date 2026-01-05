<?php

namespace Models;

class Personnage
{
    private ?int $id;
    private string $url_img;
    private string $name;
    private string $classe;
    private string $rarity;

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getUrlImg(): string { return $this->url_img; }
    public function getName(): string { return $this->name; }
    public function getClasse(): string { return $this->classe; }
    public function getRarity(): string { return $this->rarity; }

    // Setters
    public function setId(?int $id): void { $this->id = $id; }
    public function setUrlImg(string $url_img): void { $this->url_img = $url_img; }
    public function setName(string $name): void { $this->name = $name; }
    public function setClasse(string $classe): void { $this->classe = $classe; }
    public function setRarity(string $rarity): void { $this->rarity = $rarity; }
}