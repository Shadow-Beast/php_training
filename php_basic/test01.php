<?php

    $txt="Hello World\n";
    echo nl2br($txt);
    $x = 4;
    $y = 5;
    function addNumber($z)
    {
        $y = 3;
        echo $z+$y;
    }
    addNumber($x);
    echo " != ",$x+$y;
    
?>