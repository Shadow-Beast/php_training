<?php
    /**
     * Import css files from css folder
     */
    function importCSS() {
        echo '<link rel="stylesheet" href="css/reset.css" />';
        echo '<link rel="stylesheet" href="css/style.css" />';
    }

    /**
     * Create chessboard
     * 
     * @param $max_rows
     * @param $max_columns
     */
    function createChessBoard($max_rows, $max_columns) {        
        echo '<table class="chess_table" cellspacing="0" cellpadding="0">';
        for ($row = 0; $row < $max_rows; $row++) {
            echo '<tr>';
            for ($col = 0; $col < $max_columns; $col++) {
                if (($row+$col) % 2 == 0) {
                    echo '<td class="white_square"></td>';
                } else {
                    echo '<td class="black_square"></td>';
                }
            }
            echo '</tr>';
        }
        echo '</table>';
    }

    importCSS();
    createChessBoard(8, 8);
?>