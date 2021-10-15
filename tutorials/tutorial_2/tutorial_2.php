<?php
    /**
     * Import css files from css folder
     */
    function importCSS() {
        echo '<link rel="stylesheet" href="css/reset.css" />';
        echo '<link rel="stylesheet" href="css/style.css" />';
    }

    /**
     * Create diamond shape with characters
     * @param $character
     * @param $max_number
     */
    function createDiamondShapeWithCharacter($character, $max_number) {
        echo '<div class="diamond-shape-block">';
        
        $max_charInRow;
        if ($max_number%2 != 0) {
            $max_charInRow=1;
        }
        else {
            $max_charInRow=2;
        }

        while ($max_charInRow < $max_number) {
            for ($charInRow = 0; $charInRow < $max_charInRow; $charInRow++) {
                echo $character;
            }
            $max_charInRow= $max_charInRow + 2;
            echo "<br>";
        }
        while ($max_charInRow > 0) {            
            for ($charInRow = 0; $charInRow < $max_charInRow; $charInRow++) {
                echo $character;
            }            
            $max_charInRow= $max_charInRow - 2;
            echo "<br>";
        }

        echo '</div>';
    }

    importCSS();
    createDiamondShapeWithCharacter('*',11);
?>