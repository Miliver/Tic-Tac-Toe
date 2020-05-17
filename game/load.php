<?php
    include_once("../includes/connection.php");
    include_once("../includes/player.php");

    session_start();
    if (!isset($_POST["game_name"])){
        header("location: ../");
        exit();
    }

    $game_name = $_POST["game_name"];

    $query = "SELECT * FROM games WHERE name='".$game_name."'";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();

    $_SESSION["rowNum"] = $row["rows"];
    $_SESSION["player1"] = new Player("O");
    $_SESSION["player2"] = new Player("X");
    ($row["turn"] == 1) ? $turn = "O" : $turn = "X";
    $_SESSION["turn"] = $turn;
    if ($row["winner"] != 0){
        ($row["winner"] == 1) ? $_SESSION["winner"] = "O" : $_SESSION["winner"] = "X";
    }

    $query = "SELECT * FROM moves WHERE name='".$game_name."'";
    $result = $mysqli->query($query);
    while ($row = $result->fetch_assoc()) {
        ($row["player"] == 1) ? $player = &$_SESSION["player1"] : $player = &$_SESSION["player2"];
        $player->add_move($row["move_id"]);
    }

    header("location: index.php");
?>