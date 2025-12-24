<?php

function formatName($name) {
    return ucwords(trim($name));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    $skills = explode(",", $string);
    return array_map("trim", $skills);
}

function saveStudent($name, $email, $skillsArray) {
    $line = $name . "|" . $email . "|" . implode(",", $skillsArray) . PHP_EOL;
    file_put_contents("students.txt", $line, FILE_APPEND);
}

function uploadPortfolioFile($file) {
    $allowedTypes = ["pdf", "jpg", "jpeg", "png"];
    $maxSize = 2 * 1024 * 1024;

    if ($file['error'] !== 0) {
        throw new Exception("File upload error.");
    }

    if ($file['size'] > $maxSize) {
        throw new Exception("File size exceeds 2MB.");
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowedTypes)) {
        throw new Exception("Invalid file type.");
    }

    if (!is_dir("uploads")) {
        throw new Exception("Upload directory not found.");
    }

    $newName = uniqid("portfolio_") . "." . $ext;
    $destination = "uploads/" . $newName;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new Exception("Failed to move uploaded file.");
    }

    return $newName;
}
