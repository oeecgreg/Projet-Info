<?php
namespace Models;

class Classe
{
    /** @var ?int $id Identifiant unique de la classe */
    private ?int $id;

    /** @var string $name Nom de la classe */
    private string $name;
    
    /** @var string $url_img URL de l'image représentant la classe */
    private string $url_img;

    /* Getters et Setters */

    /**
     * Fonction pour obtenir l'identifiant de la classe
     * @return int|null
     */
    public function getId(): ?int { return $this->id; }

    /**
     * Fonction pour obtenir le nom de la classe
     * @return string
     */
    public function getName(): string { return $this->name; }

    /**
     * Fonction pour obtenir l'URL de l'image de la classe
     * @return string
     */
    public function getUrlImg(): string { return $this->url_img; }

    /**
     * Fonction pour définir l'identifiant de la classe
     * @param int|null $id
     * @return void
     */
    public function setId(?int $id): void { $this->id = $id; }

    /**
     * Fonction pour définir le nom de la classe
     * @param string $name
     * @return void
     */
    public function setName(string $name): void { $this->name = $name; }
    
    /**
     * Fonction pour définir l'URL de l'image de la classe
     * @param string $url_img
     * @return void
     */
    public function setUrlImg(string $url_img): void { $this->url_img = $url_img; }
}