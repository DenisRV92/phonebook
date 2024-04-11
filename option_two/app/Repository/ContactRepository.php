<?php

namespace App\Repository;

//use Models\Contact;

use App\Contracts\ContactRepositoryInterface;
use App\Models\Contact;

class ContactRepository implements ContactRepositoryInterface
{
    private $contactsFile = 'contacts.json';

    /**
     * @return array
     * @throws \Exception
     */
    public function getAll(): array
    {
        try {
            $contactsData = file_get_contents($this->contactsFile);
            $contacts = json_decode($contactsData, true);

            if (!$contacts) {
                return [];
            }

            return array_map(function ($contactData) {
                return new Contact($contactData['name'], $contactData['phone'], $contactData['id']);
            }, $contacts);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param Contact $contact
     * @return void
     * @throws \Exception
     */
    public function add(Contact $contact): void
    {
        try {
            $contacts = $this->getAll();
            $contacts[] = $contact;
            $this->saveAll($contacts);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function delete(int $id): void
    {
        try {
            $contacts = array_filter($this->getAll(), function ($contact) use ($id) {
                return $contact->getId() !== $id;
            });
            $this->saveAll($contacts);
        } catch
        (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param array $contacts
     * @return void
     * @throws \Exception
     */
    public function saveAll(array $contacts): void
    {
        try {
            $contactsData = array_map(function ($contact) {
                return [
                    'id' => $contact->getId(),
                    'name' => $contact->getName(),
                    'phone' => $contact->getPhone()
                ];
            }, $contacts);

            file_put_contents($this->contactsFile, json_encode($contactsData));
        } catch
        (\Exception $e) {
            throw $e;
        }
    }

}

?>