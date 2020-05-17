<?php
include_once("../includes/player.php");
session_start();

if (!isset($_POST["id"])){
    header("location: ../index.php");
    exit();
}

($_SESSION["turn"] == "O") ? $player = &$_SESSION["player1"] : $player = &$_SESSION["player2"];
$player->add_move($_POST["id"]);
if ($player->check_win()){
    $_SESSION["winner"] = $player->mark;
    echo "Player ".$player->mark." won!";
} else {
    echo "NULL";
}
($_SESSION["turn"] == "O") ? $_SESSION["turn"] = "X" : $_SESSION["turn"] = "O";
?>
