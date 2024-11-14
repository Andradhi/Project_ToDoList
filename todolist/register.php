<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background-color: #f4f4f9; }
        .container { max-width: 400px; width: 100%; padding: 20px; background-color: #ffffff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); }
        h2 { text-align: center; color: #333; }
        label { font-weight: bold; margin-top: 10px; display: block; }
        input[type="text"], input[type="password"], input[type="submit"] {
            width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px;
        }
        input[type="submit"] { background-color: #28a745; color: white; cursor: pointer; }
        input[type="submit"]:hover { background-color: #218838; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registrasi Akun</h2>
        <form method="post" action="register.php">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <input type="submit" value="Daftar">
        </form>
    </div>
</body>
</html>
