<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contactsubmission";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['contact_name'];
    $email = $_POST['contact_email'];
    $message = $_POST['contact_message'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute the statement
    if ($stmt->execute()) {
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Thank You</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    background-color: #f0f0f0;
                }
                .thank-you-message {
                    margin-top: 50px;
                    font-size: 24px;
                    color: black;
                    animation: fadeIn 2s;
                }
                @keyframes fadeIn {
                    from { opacity: 0; }
                    to { opacity: 1; }
                }
                .back-link {
                    display: inline-block;
                    margin-top: 20px;
                    padding: 10px 20px;
                    background-color: #007BFF;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                    transition: background-color 0.3s ease;
                }
                .back-link:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>
        <body>
            <div class="thank-you-message">
                Thank you for your message!
            </div>
            <a href="index.html" class="back-link">Go back to Home</a>
        </body>
        </html>';
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
