<?php
include "header.php";

if (file_exists("students.txt")) {
    $students = file("students.txt", FILE_IGNORE_NEW_LINES);
    foreach ($students as $student) {
        list($name, $email, $skills) = explode("|", $student);
        $skillsArray = explode(",", $skills);

        echo "<p><strong>Name:</strong> $name<br>";
        echo "<strong>Email:</strong> $email<br>";
        echo "<strong>Skills:</strong>";
        echo "<ul>";
        foreach ($skillsArray as $skill) {
            echo "<li>$skill</li>";
        }
        echo "</ul></p>";
    }
} else {
    echo "No students found.";
}

include "footer.php";
?>
