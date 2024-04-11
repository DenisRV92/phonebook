<?php

namespace App\Contracts;

interface ContactInterface
{
    public function getId(): int;

    public function getName(): string;

    public function getPhone(): mixed;

    public function setName(string $name): void;

    public function setPhone(int $phone): void;

}