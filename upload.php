<?php
include "header.php";
include "functions.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $fileName = uploadPortfolioFile($_FILES["portfolio"]);
        $message = "File uploaded successfully: " . $fileName;
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>

<h3>Upload Portfolio</h3>
<p><?php echo $message; ?></p>

<form method="post" enctype="multipart/form-data">
    Select file:
    <input type="file" name="portfolio">
    <br><br>
    <button type="submit">Upload</button>
</form>

<?php include "footer.php"; ?>
