<?php
$id = $_GET['id'] ?? '';

$contacts = json_decode(file_get_contents('contacts.json'), true);

foreach ($contacts as $key => $contact) {
    if ($contact['id'] === $id) {
        unset($contacts[$key]);
        break;
    }
}

file_put_contents('contacts.json', json_encode($contacts));

header('Location: index.php');
exit;
?><?php
