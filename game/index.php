<?php
    include_once("../includes/player.php");
    session_start();
    if (!isset($_SESSION["rowNum"])) {
        if (!isset($_POST["rowNum"])){
            header("location: ../");
            exit();
        } else {
            $rowNum = $_POST["rowNum"];
            if ($rowNum < 4){
                header("location: ../index.php?error=1");
                exit();
            }

            $_SESSION["rowNum"] = $rowNum;
            $_SESSION["player1"] = new Player("O");
            $_SESSION["player2"] = new Player("X");
            $_SESSION["turn"] = "O";
        }
    }
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width">
        <title>Tic Tac Toe</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css?version=90"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="../js/eventOnClick.js"></script>
    </head>
    <body>
        <div class="container">
        <header>
            <nav>
                <div class="row">
                    <a href="destroy.php">End game</a>
                    <a href="save.php">Save game</a>
                </div>
            </nav>
        <header>
        </div>
        <main>
            <div id="table">
            <table>
                <?php
                    for ($i = 1; $i < $_SESSION["rowNum"]; $i++){
                        if ($i % 10 == 0) $i++;
                        echo "<tr>";
                        for ($j = 1; $j < $_SESSION["rowNum"]; $j++){
                            if ($j % 10 == 0) $j++;
                            echo "<td class='box' id='".$i.".".$j."'></td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </table>
            </div>
        </main>
        
        <div id="result"></div>
        <script type="text/javascript">
            const boxes = document.querySelectorAll(".box");
            <?php
                if ($_SESSION["turn"] == "O")
                    echo "var symbol = 'X';";
                else
                    echo "var symbol = 'O';";
            ?>
            for (var i = 0; i < boxes.length; i++){
                boxes[i].innerText = "";
                boxes[i].addEventListener("click", boxClicked, false);
            }
            <?php
                
                foreach ($_SESSION["player1"]->moves as &$move)
                    echo "document.getElementById(".$move[1].".".$move[2].").innerText = 'O';";
                foreach ($_SESSION["player2"]->moves as &$move)
                    echo "document.getElementById(".$move[1].".".$move[2].").innerText = 'X';";
                    
                if (isset($_SESSION["winner"])){ ?>
                    for (var i = 0; i < boxes.length; i++){
                        boxes[i].removeEventListener("click", boxClicked, false);
                    }
                    var div = document.getElementById("result");
                    div.innerHTML += <?php echo "'Player ".$_SESSION["winner"]." won!'"; ?>
                <?php }
            ?>
        </script>

    </body>
</html>