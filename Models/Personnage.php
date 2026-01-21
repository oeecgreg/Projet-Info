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

    /* Getters */

    /**
     * Fonction pour obtenir l'identifiant du brawler
     * @return int|null
     */
    public function getId(): ?int { return $this->id; }

    /**
     * Fonction pour obtenir l'URL de l'image du brawler
     * @return string
     */
    public function getUrlImg(): string { return $this->url_img; }

    /**
     * Fonction pour obtenir le nom du brawler
     * @return string
     */
    public function getName(): string { return $this->name; }

    /**
     * Fonction pour obtenir la classe du brawler
     * @return string
     */
    public function getClasse(): string { return $this->classe; }

    /**
     * Fonction pour obtenir la rareté du brawler
     * @return string
     */
    public function getRarity(): string { return $this->rarity; }

    // Setters

    /**
     * Fonction pour définir l'identifiant du brawler
     * @param int|null $id
     * @return void
     */
    public function setId(?int $id): void { $this->id = $id; }

    /**
     * Fonction pour définir l'URL de l'image du brawler
     * @param string $url_img
     * @return void
     */
    public function setUrlImg(string $url_img): void { $this->url_img = $url_img; }

    /**
     * Fonction pour définir le nom du brawler
     * @param string $name
     * @return void
     */
    public function setName(string $name): void { $this->name = $name; }

    /**
     * Fonction pour définir la classe du brawler
     * @param string $classe
     * @return void
     */
    public function setClasse(string $classe): void { $this->classe = $classe; }

    /**
     * Fonction pour définir la rareté du brawler
     * @param string $rarity
     * @return void
     */
    public function setRarity(string $rarity): void { $this->rarity = $rarity; }
}