<?php
session_start();
?>
<html>
<head>
    <title>Lab 3: For Loop</title>
</head>

<body>


<form name="clientinfo" action="">
    <table>
        <tr>
            <td><label for="clientid">Client ID: </label>
            </td>
            <td><input type="text" name="clientid"></td>
        </tr>
        <tr>
            <td><label for="amount">Amount: </label></td>
            <td><input type="text" name="amount"</td>
        </tr>
        <tr>
            <td><input type="submit" name="append" value="Append"></td>
            <td><input type="submit" name="submit"></td>
        </tr>


    </table>

</form>


<?php

if (isset($_GET["clientid"]) && isset($_GET["amount"])) {

    if (isset($_GET["append"])) {

        $amount = $_GET["amount"];
        $clientid = $_GET["clientid"];

        $_SESSION["cuslist"][$clientid] = $amount;

        //echo implode(", ",  $_SESSION["cuslist"]);
        //echo sizeof($_SESSION["cuslist"]);
        foreach($_SESSION["cuslist"] as $element){

        }
    }

}
?>
</body>
</html>