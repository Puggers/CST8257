<html>

<body>
    <LINK href="DepositCalculator.css" rel="stylesheet" type="text/css"></LINK>
    <h1>Thank you,
    <?php echo $_POST['name']; ?> for using our deposit calculation tool.</h1>

    <br> You have entered the following data:
    <br>
    <table>
        <tr>
            <td class="heading">Principal Amount:
            </td>
            <td>
                <?php echo $_POST['principalamount']; ?>
            </td>
        </tr>
        <tr>
            <td class="heading">Interest Rate:
            </td>
            <td>
                <?php echo $_POST['interestrate']; ?>%
            </td>
        </tr>
        <tr>
            <td class="heading">Years to Deposit:
            </td>
            <td>
                <?php echo htmlentities($_POST['years']); ?>
            </td>
        </tr>
        <tr>
            <td class="heading">Your Phone Number:
            </td>
            <td>
                <?php echo ($_POST['phone']); ?>
            </td>
        </tr>
        <tr>
            <td class="heading">Your Email:
            </td>
            <td>
                <?php echo ($_POST['email']); ?>
            </td>
        </tr>

        <tr>
            <td class="heading">Your Preferred Contact Method:
            </td>
            <td>
                <?php echo htmlentities($_POST["contact"]); ?>
            </td>
        </tr>

        <tr>
            <td class="heading">Your Preferred Contact Time:
            </td>
            <td>
                <?php
$time = array();
$time = implode(", ", $_POST["time"]);
                echo $time; ?>

            </td>
        </tr>
    </table>

</body>

</html>
