<?php
session_start();
$name = htmlspecialchars($_POST['name'] ?? '');
$phone = htmlspecialchars((int)$_POST['phone'] ?? '');

$contacts = json_decode(file_get_contents('contacts.json'), true);

$isUnique = true;
foreach ($contacts as $contact) {
    if ($contact['phone'] == $phone) {
        $isUnique = false;
        $_SESSION['checkIfExists'] = true;
        break;
    }
}
if ($isUnique) {
    $id = uniqid();
    $contacts[] = ['id' => $id, 'name' => $name, 'phone' => $phone];
    file_put_contents('contacts.json', json_encode($contacts));
}
header('Location: index.php');
exit;
?><?php
