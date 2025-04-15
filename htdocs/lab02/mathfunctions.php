<?php
    function factorial($n){
        if ($n < 0) {
            return "error: input must be a positive integer";
        }

        $result = 1;
        $factor = $n;
        while($factor > 1){
            $result = $result * $factor;
            $factor--;
        }
        return $result;
    }
?>