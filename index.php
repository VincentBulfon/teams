<?php
$teams = [];
$errors = [
    "0" => "l'équipe existe déjà dans le classement",
    "1" => "Il n'y a plus d'équipes dans le classement",
    "2" => "Le nom de l'équipe ne peut pas être vide",
    "3" => "l'action ne peut pas être indéfinie"
];
$err = $_GET['err'] ?? false;

if (file("./teams.txt")) {
    $teams = file("./teams.txt", FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teams</title>
</head>

<body>
    <form action="./teamscontroller.php" method="POST">
        <label for="teamadd">Ajouter un équipe&nbsp;:</label>
        <input type="text" id="teamadd" name="teamname">
        <button type="submit" name="action" value="add">Ajouter une équipe</button>
    </form>
    <ul>
        <?php foreach ($teams as $team) : ?>
            <li><?= $team ?></li>
        <?php endforeach; ?>
    </ul>
    <br>
    <form action="./teamscontroller.php" method="POST">
        <button type="submit" name="action" value="del">Effacer la/les équipes</button><br>
        <br>
        <?php if (!$teams) : ?>
            <?php $err = 1 ?>
        <?php endif; ?>
        <?php if ($teams) : ?>
            <?php foreach ($teams as $team) : ?>
                <input type="checkbox" name="teamname[]" id="<?= $team ?>" value="<?= $team ?>">
                <label for="<?= $team ?>"><?= $team ?></label><br>
            <?php endforeach; ?>
        <?php elseif ($teams = []) : ?>
            <span>Hoho</span>
        <?php endif; ?>
        <?php if ($err !== false) : ?>
            <span><?= $errors[$err] ?></span>
        <?php endif; ?>
    </form>
</body>

</html>