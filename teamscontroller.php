<?php
$action = "";
$teams = getTeams();

function addTeam($teams)
{
    $teamname = $_POST["teamname"];
    if ($teamname !== "") {
        if (in_array($teamname, $teams)) {
            header('Location: ./index.php?err=0');
            exit;
        } else {
            file_put_contents("./teams.txt", $teamname . PHP_EOL, FILE_APPEND);
            header('Location: ./index.php');
            exit;
        };
    } else {
        header('Location: ./index.php?err=2');
        exit;
    }
}

function deleteTeams($teams)
{
    $teamname  = $_POST["teamname"];
    $newArray = array_diff($teams, $teamname);
    $implodedArray = implode(PHP_EOL, $newArray);
    file_put_contents(
        "./teams.txt",
        $implodedArray
    );
    header('Location: ./index.php');
    exit;
}

function getTeams()
{
    if (file("./teams.txt")) {
        return file("./teams.txt", FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
    };
}

if (isset($_POST["action"])) {
    $action = $_POST["action"];
    if ($action == "add" && isset($_POST["teamname"])) {
        addTeam($teams);
    } elseif ($action == "del" && isset($_POST["teamname"])) {
        deleteTeams($teams);
    } else {
        header('Location: ./index.php?err=2');
        exit;
    }
} else {
    header('Location: ./index.php?err=4');
    exit;
}
