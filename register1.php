<html>
<body>
<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; // Default XAMPP password is empty
$dbname = "my_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate required fields
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['contactNumber'])) {
        die("Error: All fields are required!");
    }

    // Sanitize and escape data
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $contact = $conn->real_escape_string($_POST["contactNumber"]);

    // Insert into database
    $sql = "INSERT INTO users (name, email, contact) VALUES ('$name', '$email', '$contact')";
    
    if ($conn->query($sql) === TRUE) 
{
    echo "Data saved successfully!";
    echo '
    <script>
        alert("Thank you for registering! If we organize a trip, we will send the itinerary to your email address.");
        window.location.href = "aws.html"; // Redirect back to home page
    </script>
    ';
} 
else 
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}
} 
else 
{
    echo "Form not submitted!";
}
$conn->close();
?>
</body>
</html>