<?php foreach ($courseListing as $line) {

if (in_array($assignedValue, $_POST["courses"])) {

$totalHours += GetCourseHours($line); //yours

}


    <tr>
                            <td class="code">
                                <input type="checkbox" name="courses[]" value="$assignedValue"> $courseCode</input>
                            </td>
                            <td class="hours">
    $hours hrs/w
    </td>
                        </tr>




$assignedValue++;

}

?>