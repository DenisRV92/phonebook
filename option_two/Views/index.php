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
    <form action="contacts" method="post">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" required>
        <label for="phone">Телефон:</label>
        <input type="number" id="phone" name="phone" required>
        <button type="submit">Добавить</button>
    </form>

    <h2>Список контактов</h2>
    <?php if ($contacts): ?>
        <ul>
            <?php foreach ($contacts as $contact): ?>
                <li>
                    <?php echo $contact->getName(); ?> - <?php echo $contact->getPhone(); ?>
                    <form action="contacts/<?php echo $contact->getId(); ?>" method="post"
                          style="display: inline;">
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="delete" type="submit">Удалить</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Контактов пока нет</p>
    <?php endif; ?>
</div>
</body>
</html>