<?php
namespace Models;

class Classe
{
    private ?int $id;
    private string $name;
    private string $url_img;

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getUrlImg(): string { return $this->url_img; }

    public function setId(?int $id): void { $this->id = $id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setUrlImg(string $url_img): void { $this->url_img = $url_img; }
}