<?php
include_once "header.php";
include_once "navbar.php";
?>


<div id="container" class="container overridemargin">
    <div id="content" class="row">
        <div class="col-md-12">


            <?php
            $amount = $_POST["convertAmount"];
            $unit = htmlentities($_POST["convertUnit"]);
            $pattern = "/^[1-9][0-9]*$/";


            if ($unit != "noEntry") {

                $trimmedAmount = trim($amount);

                if (strlen($trimmedAmount) > 0) {
                    preg_match($pattern, $amount, $matches);
                    if (empty($matches)) {
                        echo '<div class = "error">You did not input a valid number.</div>';
                    } else {
                        ConvertLiquid($amount, $unit);
                    }
                } else {
                    echo '<div class = "error">You did not enter a number.</div>';
                }
            } else {
                $pattern = "/^[1-9][0-9]*$/";
                $trimmedAmount = trim($amount);
                if (strlen($trimmedAmount) == 0) {
                    echo '<div class = "error">You did not enter an amount.<br>You did not select a unit to convert.</div>';
                } else if (strlen($trimmedAmount) > 0) {
                    preg_match($pattern, $amount, $matches);
                    if (empty($matches)) {
                        echo '<div class = "error">You did not input a valid number.<br>You did not select a unit to convert.</div>';
                    }
                } else {
                    echo '<div class = "error">You did not select a unit to convert.</div>';
                }

            }

            function ConvertLiquid($amount, $unit)
            {

                if ($unit == "Gallons") {

                    $result = $amount * 3.78541;
                    $convertedUnit = "Litres";
                } else {
                    $result = $amount / 3.78541;
                    $convertedUnit = "Gallons";
                }

                echo '<div class = "result">' . $amount . " " . $unit . " is equal to " . $result . " " . $convertedUnit . ".</div>";
            }

            ?>


        </div>
    </div>
</div>
<div id="footer">
</div>
