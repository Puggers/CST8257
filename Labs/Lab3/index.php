<html>

<?php
include_once "header.php";

?>

<body>
<?php
include_once "navbar.php";
?>

<h4 class="fixmargin2">1. For Loop</h4>
<h4 class="fixmargin2">2. Foreach Loop</h4>
<h4 class="fixmargin2">3. While Loop</h4>

<form name="initial" class="form-horizontal fixmargin2" action="" method="POST">
    <input type="text" name="userInput" class="form-control fixwidth">
    <button type="submit" class="btn btn-default" name="submit" value="Submit">Submit
</form>

<?php

if (isset($_POST["userInput"]) && !empty($_POST["userInput"])) {

    $userInput = $_POST["userInput"];


    switch ($userInput) {
        case "1":
            header("Location: forloop.php");
            die();
            break;

        case "2":
            header("Location: foreachloop.php");
            break;

        case "3":
            header("Location: whileloop.php");
            break;

        default:

            echo "Not a valid input";
    }
} ?>
</div>
</div>
</div>

</body>
</html>