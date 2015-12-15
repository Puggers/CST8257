<html>

<html>
<?php
include_once "header.php";
?>

<body>

<?php
include "navbar.php";
?>
<div class="fixmargin">

        <?php
                $error = 0;
                echo "<h1>Thank you, ".$_POST['name']." for using our deposit calculation tool.</h1>"
        ?>

          <?php

            if (isset($_POST["submit"])) {
              //Define pattern for principal amount
                $pattern = "/^[1-9][0-9]*$/";
                $principalamount = $_POST["principalamount"];
                $trimmedamount = trim($principalamount);
                //Check if input is empty, and if matches regex pattern, assign error text to variable and add to error counter if error, if not print.
                if (strlen($trimmedamount) == 0) {
                    $echoprincipal = "<div class = \"error\">Principal is Empty</div>";
                    $error++;
                } else {
                    preg_match($pattern, $trimmedamount, $matches);
                    $echoprincipal = implode("", $matches);
                    if (empty($matches)) {
                        $echoprincipal = "<div class = \"error\">Invalid amount entered</div>";
                        $error++;
                    }
                }
            }

            if (isset($_POST["submit"])) {
              //Define pattern for interest rate, allow decimals
                $pattern = "/^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)$/";
                $interestrate = $_POST["interestrate"];
                $trimmedrate = trim($interestrate);
                //Check if input is empty, and if matches regex pattern, assign error text to variable and add to error counter if error, if not send data to variable.
                if (strlen($trimmedrate) == 0) {
                    $echointerest = "<div class = \"error\">Interest rate is Empty</div>";
                    $error++;
                } else {
                    preg_match($pattern, $trimmedrate, $matches);
                    $echointerest = implode("", $matches);
                    if (empty($matches)) {
                        $echointerest = "<div class = \"error\">Invalid amount entered</div>";
                        $error++;
                    }
                }
            }

            if (isset($_POST["submit"])) {
              //Define pattern for principal amount
                $pattern = "/^[0-9][0-9][0-9]\W[0-9][0-9][0-9]\W[0-9][0-9][0-9][0-9]$/";
                $phone = $_POST["phone"];
                $trimmedphone = trim($phone);
                //Check if input is empty, and if matches regex pattern, assign error text to variable and add to error counter if error, if not send data to variable.
                if (strlen($trimmedphone) == 0) {
                    $echophone = "<div class = \"error\">Phone number is Empty</div>";
                    $error++;
                } else {
                    preg_match($pattern, $trimmedphone, $matches);
                    $echophone = implode("", $matches);
                    if (empty($matches)) {
                        $echophone = "<div class = \"error\">Incorrect format, please use nnn-nnn-nnnn</div>";
                        $error++;
                    }
                }
            }

            if (isset($_POST["submit"])) {
                $name = $_POST["name"];
                $trimmedname = trim($name);
                //Check if input is empty, assign error text to variable and add to error counter if error, if not send data to variable.
                if (strlen($trimmedname) == 0) {
                    $echoname = "<div class = \"error\">Name is Empty</div>";
                    $error++;
                } else {
                    preg_match($pattern, $trimmedphone, $matches);
                    $echoname = implode("", $matches);
                }
            }

            if (isset($_POST["submit"])) {
              //Define pattern for email
                $pattern = "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/";
                $email = $_POST["email"];
                $trimmedemail = trim($email);
                //Check if input is empty, assign error text to variable and add to error counter if error, if not send data to variable.
                if (strlen($trimmedemail) == 0) {
                    $echoemail = "<div class = \"error\">Email is Empty</div>";
                    $error++;
                } else {
                    preg_match($pattern, $trimmedemail, $matches);
                    $echoemail = implode("", $matches);
                    if (empty($matches)) {
                        $echoemail = "<div class = \"error\">Incorrect email</div>";
                        $error++;
                    }
                }
            }
            if ($error == 0) {
                $hiddencusinfo = "hidden";
                $hiddencalc = null;
            } else {
                $hiddencusinfo = null;
                $hiddencalc = "hidden";
            }
            ?>
            <div name="errorsonpage" <?php echo $hiddencusinfo; ?>>

              <br>
              <h3>We can not calculate the payments because you entered the following invalid data(red):</h3>
              <br>

              <table class="table table-striped">
                <tr>
                  <td class="heading">Principal Amount:
                  </td>
                  <td>
                    <?php echo $echoprincipal; ?>
                  </td>
                </tr>
                <tr>
                  <td class="heading">Interest Rate:
                  </td>
                  <td>
                    <?php
                            echo $echointerest;
                            ?>
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
                  <td class="heading">Your Name:
                  </td>
                  <td>
                    <?php

                            echo $echoname;

                            ?>
                  </td>
                </tr>
                <tr>
                  <td class="heading">Your Phone Number:
                  </td>
                  <td>
                    <?php

                            echo $echophone;

                            ?>
                  </td>
                </tr>
                <tr>
                  <td class="heading">Your Email:
                  </td>
                  <td>
                    <?php

                            echo $echoemail;

                            ?>
                  </td>
                </tr>

                <tr>
                  <td class="heading">Your Preferred Contact Method:
                  </td>
                  <td>
                    <?php

                            if (isset($_POST["contact"])) {
                                echo htmlentities($_POST["contact"]);
                            } else {
                                echo "<div class = \"error\">No option selected.</div>";
                            } ?>
                  </td>
                </tr>

                <tr>
                  <td class="heading">Your Preferred Contact Time:
                  </td>
                  <td>

                    <?php

                            if (isset($_POST["time"])) {
                                $time = array();
                                $time = implode(", ", $_POST["time"]);
                                echo $time;
                            } else {
                                echo "<div class = \"error\">No option selected.</div>";
                            } ?>


                  </td>
                </tr>
              </table>


            </div>

            <div name="calculated" <?php echo $hiddencalc; ?>>
              <table class="table table-striped">
                <tr>
                  <td>Year</td>
                  <td>Principal at Year Start</td>
                  <td>Interest for the Year</td>
                </tr>


                <?php

                    $pamount = $principalamount;
                    $irate = $interestrate / 100;

                    $years = htmlentities($_POST['years']);
                    for ($i = 1; $i <= $years; $i++) {

                        printf("<tr><td>" . $i . "</td><td>$" . number_format($pamount, 2) . "</td><td>$" . number_format(($pamount * $irate), 2) . "</td></tr>");

                        $pamount += $pamount * $irate;


                    } ?>

              </table>
            </div>
      </div>
    </div>
  </div>
</div>
</body>

</html>
