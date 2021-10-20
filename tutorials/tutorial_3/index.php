<?php
    /**
     * Import css files from css folder
     */
    function importCSS() {
        echo '<link rel="stylesheet" href="css/reset.css" />';
        echo '<link rel="stylesheet" href="css/style.css" />';
    }

    /**
     * Create Birthday Form
     */
    function createBirthdayForm() {
        echo '<form class="birthday-form" action="index.php"><fieldset>';
        echo '<legend>Age Calculator</legend>';
        echo '<label for="birthday">Birthday: </label>';
        echo '<input type="date" id="birthday" name="birthday"';
        if(!empty($_GET["birthday"])) {
            echo ' value=',$_GET["birthday"];
        }
        echo '><br>';
        echo '<input class="calculate-btn" type="submit" value="Calculate">';
        calculateBirthday();
        echo '</fieldset></form>';
    }

    /**
     * Calculate Birthday
     */
    function calculateBirthday() {        
        if(!empty($_GET["birthday"])) {
            echo '<div class="result-block">';

            $birthday = explode("-",$_GET["birthday"]);
            $birth_day = $birthday[2];
            $birth_month = $birthday[1];
            $birth_year = $birthday[0];

            $current_day = date("d");
            $current_month = date("m");
            $current_year = date("Y");

            $age = $current_year-$birth_year;
            if($age != 0 && $birth_month > $current_month){
                $age--;
            }
            if($age != 0 && $birth_month == $current_month && $birth_day > $current_day) {
                $age--;
            }

            echo 'You are <span>',$age,'</span> years old!';
            echo '</div>';
        }      
    }

    importCSS();
    createBirthdayForm();
?>