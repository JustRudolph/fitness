<?php
// Database connection
$host = 'localhost';
$dbname = 'reserveringen_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Define valid class types
$class_types = ['Cardio Fitness', 'Yoga Classes', 'Strength Training', 'Boxing', 'Cardio'];

// Fetch reserved lessons
$stmt = $pdo->query("SELECT les_naam, naam, telefoon, email, created_at FROM lessen ORDER BY created_at ASC");
$lessen = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $les_naam = trim($_POST['les'] ?? '');
    $naam = trim($_POST['naam'] ?? '');
    $telefoon = trim($_POST['telefoon'] ?? '');
    $email = trim($_POST['email'] ?? null);

    if (!empty($les_naam) && !empty($naam) && !empty($telefoon)) {
        try {
            // Check for duplicate reservation
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM lessen WHERE telefoon = :telefoon AND les_naam = :les_naam");
            $stmt->execute([
                ':telefoon' => $telefoon,
                ':les_naam' => $les_naam,
            ]);

            if ($stmt->fetchColumn() > 0) {
                session_start();
                $_SESSION['error'] = "You've already picked this class!";
            } else {
                // Insert new reservation
                $stmt = $pdo->prepare("INSERT INTO lessen (les_naam, naam, telefoon, email) VALUES (:les_naam, :naam, :telefoon, :email)");
                $stmt->execute([
                    ':les_naam' => $les_naam,
                    ':naam' => $naam,
                    ':telefoon' => $telefoon,
                    ':email' => $email,
                ]);
                session_start();
                $_SESSION['success'] = "Reservation added successfully!";
            }
        } catch (PDOException $e) {
            session_start();
            $_SESSION['error'] = "Failed to add reservation: " . $e->getMessage();
        }
    } else {
        session_start();
        $_SESSION['error'] = "Please fill in all required fields.";
    }

    header("Location: index.php");
    exit;
}

session_start();
$success = $_SESSION['success'] ?? null;
$error = $_SESSION['error'] ?? null;
unset($_SESSION['success'], $_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Reservation</title>
    <link rel="stylesheet" href="/css/styles.css">
    <style>
        main {
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center vertically */
            align-items: center; /* Center horizontally */
            min-height: calc(100vh - 80px); /* Full height minus the navbar height */
            margin-top: 80px; /* Ensure content is below the navbar */
            padding: 20px;
            box-sizing: border-box;
        }

        form {
            width: 100%;
            max-width: 400px; /* Limit the form width */
        }
        body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #111;
    color: #f0f0f0;
}

main {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    box-sizing: border-box;
}

h1 {
    text-align: center;
    margin-top: 20px; /* Add some spacing from the top */
    font-size: 2rem;
    color: #fff;
}

.reservation-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    max-width: 500px;
    width: 100%;
    padding: 20px;
    background-color: #1a1a1a;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    margin-top: 50px; /* Space between the heading and the box */
}

form {
    width: 100%;
}

form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

form input,
form select,
form button {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #444;
    border-radius: 5px;
    background-color: #222;
    color: #f0f0f0;
    font-size: 16px;
}

form button {
    background-color: #4CAF50;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s;
}

form button:hover {
    background-color: #45a049;
}

.success,
.error {
    text-align: center;
    margin-bottom: 20px;
    font-weight: bold;
}

.success {
    color: green;
}

.error {
    color: red;
}
    </style>
</head>
<body>
    <nav>
        <a href="/pages/index.php" class="logo">Gym Powerhouse</a>
        <ul>
            <li><a href="/pages/index.php">Home</a></li>
            <li><a href="/pages/aanbiedingen.php">Offers</a></li>
            <li><a href="/pages/login.php">Login</a></li>
            <li><a href="/pages/programs.php">Programs</a></li>
            <li><a href="/pages/prijs_filter.php">Lesson Filter</a></li>
            <li><a href="../reserveringen/index.php">Reservations</a></li>
        </ul>
    </nav>

    <main>
        <h1>Add New Reservation</h1>

        <!-- Display Success or Error Messages -->
        <?php if ($success): ?>
            <p class="success" style="color: green; text-align: center;"><?php echo $success; ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p class="error" style="color: red; text-align: center;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="create.php">
            <label for="les">Select a class:</label>
            <select id="les" name="les" required>
                <option value="">-- Select a class --</option>
                <?php foreach ($class_types as $type): ?>
                    <option value="<?php echo htmlspecialchars($type); ?>">
                        <?php echo htmlspecialchars($type); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="naam">Name:</label>
            <input type="text" id="naam" name="naam" required>

            <label for="telefoon">Phone Number:</label>
            <input type="text" id="telefoon" name="telefoon" required>

            <label for="email">Email (optional):</label>
            <input type="email" id="email" name="email">

            <button type="submit">Add</button>
        </form>
    </main>
</body>
</html>