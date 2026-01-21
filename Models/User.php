<?php
namespace Models;

/**
 * Classe représentant un utilisateur
 */
class User
{
    /** @var ?int $id Identifiant unique de l'utilisateur */
    private ?int $id;

    /** @var string $username Nom d'utilisateur */
    private string $username;

    /** @var string $password Mot de passe haché de l'utilisateur */
    private string $password;

    /* Getters et Setters */

    /**
     * Fonction pour obtenir l'identifiant de l'utilisateur
     * @return int|null
     */
    public function getId(): ?int { return $this->id; }

    /**
     * Fonction pour obtenir le nom d'utilisateur
     * @return string
     */
    public function getUsername(): string { return $this->username; }

    /**
     * Fonction pour obtenir le mot de passe haché de l'utilisateur
     * @return string
     */
    public function getPassword(): string { return $this->password; }

    /**
     * Fonction pour définir l'identifiant de l'utilisateur
     * @param int|null $id
     * @return void
     */
    public function setId(?int $id): void { $this->id = $id; }

    /**
     * Fonction pour définir le nom d'utilisateur
     * @param string $username
     * @return void
     */
    public function setUsername(string $username): void { $this->username = $username; }

    /**
     * Fonction pour définir le mot de passe haché de l'utilisateur
     * @param string $password
     * @return void
     */
    public function setPassword(string $password): void { $this->password = $password; }
}