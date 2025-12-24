<?php
include "header.php";
include "functions.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $name = formatName($_POST["name"]);
        $email = $_POST["email"];
        $skills = cleanSkills($_POST["skills"]);

        if (empty($name) || empty($email)) {
            throw new Exception("All fields are required.");
        }

        if (!validateEmail($email)) {
            throw new Exception("Invalid email address.");
        }

        saveStudent($name, $email, $skills);
        $message = "Student saved successfully!";
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>

<h3>Add Student</h3>
<p><?php echo $message; ?></p>

<form method="post">
    Name: <input type="text" name="name"><br><br>
    Email: <input type="text" name="email"><br><br>
    Skills (comma separated):<br>
    <textarea name="skills"></textarea><br><br>
    <button type="submit">Save</button>
</form>

<?php include "footer.php"; ?>
