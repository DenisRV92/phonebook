<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Телефонный справочник</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<div class='wrapper'>
    <h1>Телефонный справочник</h1>
    <?php if (isset($_SESSION['checkIfExists'])) {
        echo '<h5>Пользователь с таким телефоном существует </h5>';
        usleep(100000);
        unset($_SESSION['checkIfExists']);
    } ?>
    <h2>Добавить контакт</h2>
    <form action="add_contact.php" method="post">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" required>
        <label for="phone">Телефон:</label>
        <input type="number" id="phone" name="phone" required>
        <button type="submit">Добавить</button>
    </form>

    <h2>Список контактов</h2>
    <?php
    $contacts = json_decode(file_get_contents('contacts.json'), true);

    // Отображение списка контактов
    if ($contacts) {
        echo '<ul>';
        foreach ($contacts as $contact) {
            echo '<li>' . $contact['name'] . ' - ' . $contact['phone'] . ' <a href="delete_contact.php?id=' . $contact['id'] . '">Удалить</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Контактов пока нет</p>';
    }
    ?>
</div>
</body>
</html>