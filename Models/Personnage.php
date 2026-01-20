<?php

namespace Models;

/**
 * Classe représentant un Brawler (Personnage)
 */
class Personnage
{
    /** @var int|null Identifiant unique du brawler */
    private ?int $id;

    /** @var string url pour l'image du brawler */
    private string $url_img;

    /** @var string Nom du brawler */
    private string $name;

    /** @var string Classe du brawler */
    private string $classe;

    /** @var string Rareté du brawler */
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