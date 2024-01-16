<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "register";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone-number'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
   // $hobbies = implode(', ', $_POST['Hobbies']); // Fix the missing semicolon
   $hobbies = $_POST['Hobbies'];
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO info (fname, lname, gender, age, dob, email, PASSWORD, phone, address, state, pincode, hobbies) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssisssssiss", $fname, $lname, $gender, $age, $dob, $email, $password, $phone, $address, $state, $pincode, $hobbies);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.replace('registersucces.html');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
