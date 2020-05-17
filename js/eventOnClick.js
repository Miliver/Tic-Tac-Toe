function boxClicked(square){
    switchPlayers();
    if (document.getElementById(square.target.id).innerText == ""){
        document.getElementById(square.target.id).innerText = symbol;
        $.ajax({
            type: "POST",
            url: "game_handler.php",
            data: "id=" + square.target.id,
            success: function(msg){
                console.log(msg);
                if (msg != "NULL"){
                    for (var i = 0; i < boxes.length; i++){
                        boxes[i].removeEventListener("click", boxClicked, false);
                    }
                    $("#result").html(msg);
                }
            }
        });
    } else {
        switchPlayers();
    }
}

function switchPlayers(){
    (symbol == "O") ? symbol = "X" : symbol = "O";
}