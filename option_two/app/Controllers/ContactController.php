<?php

namespace App\Controllers;

use App\Contracts\ContactInterface;
use App\Contracts\ContactRepositoryInterface;

class ContactController
{
    private ContactRepositoryInterface $contactRepo;
    private ContactInterface $contact;

    public function __construct(ContactRepositoryInterface $contactRepo, ContactInterface $contact)
    {
        $this->contactRepo = $contactRepo;
        $this->contact = $contact;
    }

    /**
     * @return void
     */
    public function index(): void
    {
        try {
            $contacts = $this->contactRepo->getAll();
            include 'Views/index.php';
        } catch (\Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    /**
     * @return void
     */
    public function store(): void
    {
        try {
            $name = htmlspecialchars($_POST['name'] ?? '');
            $phone = htmlspecialchars((int)$_POST['phone'] ?? '');
            if ($this->contact->checkIfExists($this->contactRepo, $phone)) {
                if (!empty($name) && !empty($phone)) {
                    $this->contact->setName($name);
                    $this->contact->setPhone($phone);
                    $this->contactRepo->add($this->contact);
                }
            } else {
                $_SESSION['checkIfExists'] = true;
            }

            header('Location: /option_two/');
            exit;
        } catch (\Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    /**
     * @return void
     */
    public function destroy(): void
    {
        try {
            $id = (int)$_GET['id'];
            $this->contactRepo->delete($id);
            header('Location: /option_two/');
            exit;
        } catch (\Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
}

?>