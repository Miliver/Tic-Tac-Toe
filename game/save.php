<?php
include_once("../includes/connection.php");
include_once("../includes/player.php");

session_start();

if (!isset($_SESSION["rowNum"])){
    header("location: ../");
    exit();
}

if (isset($_POST["name"])){
    $name = $_POST["name"];

    if (empty($name)) $errorMsg = "Name can not be empty";
    else if (strlen($name) > 150) $errorMsg = "Name is too long";
    else {
        $query = "SELECT name FROM games WHERE name='".$name."'";
        $result = $mysqli->query($query);
        if ($result->num_rows > 0) $errorMsg = "Name is alredy used";
        else {
            ($_SESSION["turn"] == "O") ? $turn = 1 : $turn = 2;
            if (isset($_SESSION["winner"])) ($_SESSION["winner"] == "O") ? $winner = 1 : $winner = 2;
            else $winner = 0;
            $query = "INSERT INTO games (name, rows, turn, winner) VALUES ('".$name."', ".$_SESSION["rowNum"].", ".$turn.", ".$winner.")";
            
            if(!$mysqli->query($query)) $errorMsg = "Something goes wrong";
            else {
                foreach ($_SESSION["player1"]->moves as &$move){
                    $moveId = $move[1].".".$move[2];
                    $query = "INSERT INTO moves (name, move_id, player) VALUES ('".$name."', ".$moveId.", 1)";
                    $mysqli->query($query);
                }
                foreach ($_SESSION["player2"]->moves as &$move){
                    $moveId = $move[1].".".$move[2];
                    $query = "INSERT INTO moves (name, move_id, player) VALUES ('".$name."', ".$moveId.", 2)";
                    $mysqli->query($query);
                }
                $msg = "Game has been saved";
            }
        }
    }
}



function resetName(){
    $_POST["name"] = NULL;
    header("location: save.php");
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width">
        <title>Tic Tac Toe</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="../js/eventOnClicked.js"></script>
    </head>
    <body>
    <div class="container">
        <header>
            <nav>
                <div class="row text-right">
                    <a href="index.php">Back</a>
                </div>
            </nav>
        <header>
        <?php if (isset($errorMsg)) { ?>
            <small style="color:#aa0000"><?php echo $errorMsg; ?></small>
        <?php } ?>
        <?php if (isset($msg)) { ?>
            <small><?php echo $msg; ?></small>
        <?php } ?>
        <form action="save.php" method="post" autocomplate="off">
        <div class="form-group" id="save_input">
            <label>Name a game</label>
            <input type="text" class="form-control" name="name" placeholder="My first super game" />
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>
    </body>
</html>