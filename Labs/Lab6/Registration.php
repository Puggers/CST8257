<html>

<?php include('header.php'); ?>

<body>


<?php
include "navbar.php";
?>

<?php
session_start();
//Declaring variables... so many variables.
$CourseList = fopen("CourseList.txt", 'r');
$value = 0;
$error = 0;
$courses = array();
$listCourses = array();
$nameError = "";
$pwError = "";
$phoneError = "";
$postalError = "";
$patternPassword = "((?=.*\d)(?=.*[A-Z])(?=.*\W).{6,20})";
$patternPhone = "/^[0-9][0-9][0-9]\W[0-9][0-9][0-9]\W[0-9][0-9][0-9][0-9]$/";
$patternPostal = "/([A-Z]|[a-z])[0-9]([A-Z]|[a-z]) ?[0-9]([A-Z]|[a-z])[0-9]/";
$hidden = "";
$hoursError = "";
$totalHours = 0;
$checked = "";
$listCourses = explode("\n", fread($CourseList, filesize("CourseList.txt")));
$boxlist = array();
$_SESSION['finishedHours'] = array();
$_SESSION['finishedNames'] = array();
$action = "Registration.php";


foreach ($listCourses as $line) {
//Check if item was selected in last post, if it was, set checked value
    if (isset($_POST["selectedCourses"]) && in_array($value, $_POST["selectedCourses"])) {

        $totalHours += GetCourseHours($line);
        array_push($_SESSION['finishedHours'], GetCourseHours($line));
        array_push($_SESSION['finishedNames'], GetCourseName($line));
        $checked = "checked";
    } else {
        $checked = "";
    }

    array_push($boxlist, '<div class="checkbox"><label><input type="checkbox" ' . $checked . ' name="selectedCourses[]" value="' . $value . '">' . $line . '<br></label></div>');

    $value++;
}
//Error Checking
if (isset($_POST["submit"]) && !empty($_POST)) {

    $_SESSION['userName'] = $_POST["userName"];
    $trimmedname = trim($_SESSION['userName']);
    if (strlen($trimmedname) == 0) {
        $nameError = '<div class="alert alert-danger alertwidth" role="alert"><span class="glyphicon glyphicon-exclamation-sign error" aria-hidden="true"></span><span class="sr-only">Error:</span> Name is empty</div>';
        $error++;
    }

    $password = $_POST["password"];
    $repassword = $_POST["repassword"];
    $trimmedpassword = trim($password);

    if (strlen($trimmedpassword) == 0) {
        $pwError = '<div class="alert alert-danger alertwidth" role="alert"><span class="glyphicon glyphicon-exclamation-sign error" aria-hidden="true"></span><span class="sr-only">Error:</span> Please enter a password.</div>';
        $error++;
    } else {
        preg_match($patternPassword, $password, $matches);

        if (count($matches) == 0) {
            $pwError = '<div class="alert alert-danger alertwidth" role="alert"><span class="glyphicon glyphicon-exclamation-sign error" aria-hidden="true"></span><span class="sr-only">Error:</span> Password does not match required format.</div>';
            $error++;
        } else if ($trimmedpassword != $repassword) {

            $pwError = '<div class="alert alert-danger alertwidth" role="alert"><span class="glyphicon glyphicon-exclamation-sign error" aria-hidden="true"></span><span class="sr-only">Error:</span> Passwords did not match.</div>';
            $error++;
        }

    }

    $phone = $_POST["phone"];
    $trimmedphone = trim($phone);
    if (strlen($trimmedphone) == 0) {
        $phoneError = '<div class="alert alert-danger alertwidth" role="alert"><span class="glyphicon glyphicon-exclamation-sign error" aria-hidden="true"></span><span class="sr-only">Error:</span> Phone number is empty.</div>';
        $error++;
    } else {
        preg_match($patternPhone, $trimmedphone, $matches);
        if (empty($matches)) {
            $phoneError = '<div class="alert alert-danger alertwidth" role="alert"><span class="glyphicon glyphicon-exclamation-sign error" aria-hidden="true"></span><span class="sr-only">Error:</span> Incorrect Format, please use nnn-nnn-nnnn</div>';
            $error++;
        }
    }

    $postal = $_POST["postal"];
    $trimmedpostal = trim($postal);
    if (strlen($trimmedpostal) == 0) {
        $postalError = '<div class="alert alert-danger alertwidth" role="alert"><span class="glyphicon glyphicon-exclamation-sign error" aria-hidden="true"></span><span class="sr-only">Error:</span> Postal Code is empty.</div>';
        $error++;
    } else {
        preg_match($patternPostal, $trimmedpostal, $matches);
        if (empty($matches)) {
            $postalError = '<div class="alert alert-danger alertwidth" role="alert"><span class="glyphicon glyphicon-exclamation-sign error" aria-hidden="true"></span><span class="sr-only">Error:</span> Invalid postal code entered.</div>';
            $error++;
        }
    }


    if ($totalHours == 0) {
        $hoursError = '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign error" aria-hidden="true"></span><span class="sr-only">Error:</span> You did not select a course.</div>';
        $error++;
    } elseif ($totalHours > 20) {
        $hoursError = '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign error" aria-hidden="true"></span><span class="sr-only">Error:</span> Too many hours.</div>';
        $error++;
    } elseif ($totalHours < 10 && $totalHours != 0) {
        $hoursError = '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign error" aria-hidden="true"></span><span class="sr-only">Error:</span> Not enough hours.</div>';
        $error++;
    }
    if ($error == 0) {
        header("Location: Result.php");
}

}
if (isset($_POST["reset"])) {
    session_destroy();
    $_POST = array();
    header("Refresh:0");
}


//Retrieve hours from each line read in from file
function GetCourseHours($CourseLine)
{
    $pattern1digit = "/ ([0-9]) /";
    $pattern2digits = "/ ([0-9][0-9]) /";

    preg_match($pattern1digit, $CourseLine, $matches);
    if (!empty($matches)) {

        return $matches[0];
    } else {
        preg_match($pattern2digits, $CourseLine, $matches);
        return $matches[0];

    }
}

//Retrieve course name from each line read in from file
function GetCourseName($CourseLine)
{
    $namePattern = "/\w{1,8}\D{0,60}/";

    preg_match($namePattern, $CourseLine, $matches);

    return $matches[0];
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h2>Please Enter the required registration data</h2>

            <form class="form-horizontal formtopmargin" action="<?php echo $action; ?>" method="POST">

                <div class="form-group">
                    <label for="userName" class="col-sm-2 control-label">User Name:</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control txtoverrides" id="userName"
                               name="userName" <?php if (!empty($_SESSION["userName"])) {
                            echo 'value="' . $_SESSION["userName"] . '"';
                        } ?>
                               placeholder="User Name">
                        <?php echo $nameError ?>
                    </div>

                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password:</label>

                    <div class="col-sm-10">
                        <ul>
                            <li>At least 6 characters long</li>
                            <li> Contain at least one uppercase letter</li>
                            <li>At least one lowercase letter</li>
                            <li>At least one numeric character</li>
                            <li>One special character</li>
                        </ul>
                        <input type="password" class="form-control txtoverrides" id="password"
                               name="password" <?php if (!empty($password)) {
                            echo 'value="' . $password . '"';
                        } ?>
                               placeholder="Password">
                        <?php echo $pwError ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="repassword" class="col-sm-2 control-label">Re-Enter Password:</label>

                    <div class="col-sm-10">
                        <input type="password" class="form-control txtoverrides" id="repassword"
                               name="repassword" <?php if (!empty($repassword)) {
                            echo 'value="' . $repassword . '"';
                        } ?>
                               placeholder="Re-Enter Password">
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone" class="col-sm-2 control-label">Phone Number:</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control txtoverrides" id="phone"
                               name="phone" <?php if (!empty($phone)) {
                            echo 'value="' . $phone . '"';
                        } ?>
                               placeholder="Phone Number (nnn-nnn-nnnn)">
                        <?php echo $phoneError ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone" class="col-sm-2 control-label">Postal Code:</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control txtoverrides" id="postal"
                               name="postal" <?php if (!empty($postal)) {
                            echo 'value="' . $postal . '"';
                        } ?>
                               placeholder="Postal Code">
                        <?php echo $postalError ?>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="submit" class="btn btn-default">Submit</button>
                        <button type="submit" name="reset" class="btn btn-default">Reset Form</button>
                    </div>
                </div>

                <div class="list">
                    <h2>Please select your desired courses</h2>
                    <h4>Min:10 hours, Max: 20 hours</h4>
                    <h4><?php echo $hoursError; ?></h4>

                </div>


                <?php

                echo implode("", $boxlist);


                ?>

            </form>


        </div>
    </div>
</div>

</body>

</html>
