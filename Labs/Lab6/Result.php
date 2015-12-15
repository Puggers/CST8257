<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="registration.css">
    <title>Course Registration Complete</title>
</head>

<?php
session_start();
$hours = $_SESSION["finishedHours"];
$names = $_SESSION["finishedNames"];
$username = $_SESSION["userName"];
$i =0;


?>

<body>


<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h2>Thank You, <?php echo $username ?> for using online course registration!</h2>
            <table class="table table-striped">

                <tr>
                    <td><h3>Course</h3></td>
                    <td><h3>Hours/Week</h3></td>
                    <?php

                    foreach ($names as $course){

                        echo '<tr><td>'.$course.'</td><td>'.$hours[$i].'</td></tr>';

                        $i++;
                    }

                    session_destroy();

                    ?>
                </tr>

            </table>

        </div>
    </div>
</div>
</body>
</html>