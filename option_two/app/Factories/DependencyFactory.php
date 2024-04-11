<?php

namespace App\Factories;

use App\Contracts\ContactInterface;
use App\Contracts\ContactRepositoryInterface;
use App\Repository\ContactRepository;
use App\Models\Contact;

class DependencyFactory
{
    /**
     * @return ContactRepositoryInterface
     */
    public static function createContactRepository(): ContactRepositoryInterface
    {
        return new ContactRepository();
    }

    /**
     * @return ContactInterface
     */
    public static function createContact(): ContactInterface
    {
        return new Contact();
    }
}