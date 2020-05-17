<?php
    include_once("./includes/connection.php");  
    session_start();
    
    (!isset($_SESSION["rowNum"])) ? : header("location: game");
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width">
        <title>Tic Tac Toe</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/style.css?version=55"/>
    </head>
    <body>
        <div class="container">
        <main>
            <h1>Tic tac toe</h1>
            <div class="row">
            <div class="col-sm-6 text-center">
                <h2>Create new game</h2>
                <?php if (isset($_GET["error"])) { ?>
                    <small style="color:#aa0000">Wrong input!</small>
                <?php } ?>
                <form action="game/index.php" method="post" autocomplate="off">
                    <div class="form-group">
                        <label>Write number of rows</label>
                        <input type="number" class="form-control" name="rowNum" placeholder="5" />
                        <small class="form-text text-muted">It must be number greater than 4</small>
                        <button type="submit" class="btn btn-primary">Play!</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-6 text-center">
                <h2>Or</h2>
                <form action="game/load.php" method="post" autocomplete="off">
                <div class="form-group">
                    <label>Load saved game</label>
                    <select name="game_name" class="form-control">
                        <?php 
                            $query = "SELECT name FROM games ORDER BY name";
                            if ($result = $mysqli->query($query)) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='".$row["name"]."'>".$row["name"]."</option>";
                                }
                            }
                        ?>
                    </select>
                    <button type="submit" class="btn btn-primary">Load</button>
                </div>
                </form>
            </div>
            </div>
        </main>
        </div>
    </body>
</html>

