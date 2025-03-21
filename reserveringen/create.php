<?php
session_start();

// Database connection
$host = 'localhost';
$dbname = 'reserveringen_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $_SESSION['error'] = "Failed to connect to the database: " . $e->getMessage();
    header("Location: index.php");
    exit;
}

// Valid class types
$class_types = ['Cardio Fitness', 'Yoga Classes', 'Strength Training', 'Boxing', 'Cardio'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $les = trim($_POST['les'] ?? '');
    $naam = trim($_POST['naam'] ?? '');
    $telefoon = trim($_POST['telefoon'] ?? '');
    $email = trim($_POST['email'] ?? null);

    // Validate inputs
    if (empty($les) || empty($naam) || empty($telefoon)) {
        $_SESSION['error'] = "Please fill in all required fields!";
    } elseif (!in_array($les, $class_types)) {
        $_SESSION['error'] = "Invalid class selected!";
    } else {
        try {
            // Check for duplicate reservation
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM lessen WHERE telefoon = ? AND les_naam = ?");
            $stmt->execute([$telefoon, $les]);

            if ($stmt->fetchColumn() > 0) {
                $_SESSION['error'] = "You have already reserved this class!";
            } else {
                // Insert new reservation
                $stmt = $pdo->prepare("INSERT INTO lessen (les_naam, naam, telefoon, email) VALUES (?, ?, ?, ?)");
                $stmt->execute([$les, $naam, $telefoon, $email]);
                $_SESSION['success'] = "Reservation for '$naam' successfully added!";
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Something went wrong: " . $e->getMessage();
        }
    }
}

// Redirect back to the form
header("Location: index.php");
exit;
