<?php

namespace App\Models;

use App\Contracts\ContactInterface;
use App\Contracts\ContactRepositoryInterface;

class Contact implements ContactInterface
{
    private int $id;
    private string $name;
    private int $phone;

    public function __construct($name = '', $phone = '', $id = null)
    {
        $this->name = $name;
        $this->phone = (int)$phone;
        $this->id = $id ?: mt_rand();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPhone(): int
    {
        return $this->phone;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param int $phone
     * @return void
     */
    public function setPhone(int $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @param ContactRepositoryInterface $contactRepo
     * @param int $phone
     * @return bool
     */
    public function checkIfExists(ContactRepositoryInterface $contactRepo, int $phone): bool
    {
        $contacts = $contactRepo->getAll();
        foreach ($contacts as $contact) {
            if ($contact->getPhone() === $phone) {
                return false;
            }
        }

        return true;
    }

}

?>