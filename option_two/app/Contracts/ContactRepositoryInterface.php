<?php

namespace App\Contracts;

use App\Models\Contact;

interface ContactRepositoryInterface
{
    public function getAll(): array;

    public function add(Contact $contact): void;

    public function delete(int $id): void;

    public function saveAll(array $contacts): void;

}