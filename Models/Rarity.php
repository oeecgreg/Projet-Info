<?php
namespace Models;

class Rarity {
    /** @var ?int $id Identifiant unique de la rareté */
    private ?int $id;

    /** @var string $name Nom de la rareté */
    private string $name;

    /** @var string $color_code Code couleur associé à la rareté */
    private string $color_code;

    /* Getters et Setters */

    /**
     * Fonction pour obtenir l'identifiant de la rareté
     * @return int|null
     */
    public function getId(): ?int { return $this->id; }

    /**
     * Fonction pour obtenir le nom de la rareté
     * @return string
     */
    public function getName(): string { return $this->name; }

    /**
     * Fonction pour obtenir le code couleur de la rareté
     * @return string
     */
    public function getColorCode(): string { return $this->color_code; }

    /**
     * Fonction pour définir l'identifiant de la rareté
     * @param int|null $id
     * @return void
     */
    public function setId(?int $id): void { $this->id = $id; }

    /**
     * Fonction pour définir le nom de la rareté
     * @param string $name
     * @return void
     */
    public function setName(string $name): void { $this->name = $name; }

    /**
     * Fonction pour définir le code couleur de la rareté
     * @param string $color
     * @return void
     */
    public function setColorCode(string $color): void { $this->color_code = $color; }
}