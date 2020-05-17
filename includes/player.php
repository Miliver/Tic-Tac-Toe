<?php
class Player{
    public $moves;
    public $mark;
    private $win = 5;
    
    public function __construct($player_mark){
        $this->moves = array();
        $this->mark = $player_mark;
    }

    public function add_move($id){
        list($row, $column) = explode(".", $id);
        array_push($this->moves, array(false, $row, $column));
    }

    public function check_win(){
        $ret = false;
        foreach ($this->moves as &$box){
            if ($this->count_for_box($box)){
                $ret = true;
                break;
            }
            $box[0] = true;
        }
        foreach ($this->moves as &$box){
            $box[0] = false;
        }
        return $ret;
    }

    private function count_for_box(&$box){
        if (($this->count_direction($box, -1, -1, 0) + $this->count_direction($box, 1, 1, 0) + 1) >= $this->win) return true;
        if (($this->count_direction($box, -1, 0, 0) + $this->count_direction($box, 1, 0, 0) + 1) >= $this->win) return true;
        if (($this->count_direction($box, -1, 1, 0) + $this->count_direction($box, 1, -1, 0) + 1) >= $this->win) return true;
        if (($this->count_direction($box, 0, 1, 0) + $this->count_direction($box, 0, -1, 0) + 1) >= $this->win) return true;
        return false;
    }

    private function count_direction(&$box, $x, $y, $count){
        $tmp = $this->find_in_moves($box[1] + $x, $box[2] + $y);
        if ($tmp != false){
            return $this->count_direction($tmp, $x, $y, $count+1);
        }
        return $count;
    }

    private function find_in_moves($x, $y){
        if ($x < 0 || $y < 0) return false;
        foreach($this->moves as &$box){
            if (!$box[0] && $box[1] == $x && $box[2] == $y){
                return $box;
            }
        }
        return false;
    }
}
?>