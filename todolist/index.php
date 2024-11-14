<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = $_POST['task'];
    $due_date = $_POST['due_date'];
    $due_time = $_POST['due_time'];

    $sql = "INSERT INTO tasks (user_id, task, due_date, due_time) VALUES ('$user_id', '$task', '$due_date', '$due_time')";
    $conn->query($sql);
}

$sql = "SELECT * FROM tasks WHERE user_id='$user_id' ORDER BY due_date, due_time";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; display: flex; justify-content: center; padding-top: 20px; }
        .container { max-width: 600px; width: 100%; padding: 20px; background-color: #ffffff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); }
        h2 { text-align: center; color: #333; }
        form { margin-bottom: 20px; }
        label { font-weight: bold; margin-top: 10px; display: block; }
        input[type="text"], input[type="date"], input[type="time"], input[type="submit"] {
            width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px;
        }
        input[type="submit"] { background-color: #007bff; color: white; cursor: pointer; }
        input[type="submit"]:hover { background-color: #0056b3; }
        .task-list { margin-top: 20px; }
        .task-item { padding: 10px; border: 1px solid #ddd; margin-bottom: 10px; background-color: #f9f9f9; }
    </style>
    <script>
        // JavaScript untuk mencegah pemilihan tanggal sebelum hari ini
        document.addEventListener("DOMContentLoaded", function() {
            let dateInput = document.querySelector('input[type="date"]');
            let today = new Date().toISOString().split("T")[0];
            dateInput.setAttribute("min", today);
        });
    </script>
</head>
<body>
    <div class="container">
        <h2>To-Do List</h2>
        <form method="post" action="index.php">
            <label>Task:</label>
            <input type="text" name="task" required>
            <label>Due Date:</label>
            <input type="date" name="due_date" required>
            <label>Due Time:</label>
            <input type="time" name="due_time" required>
            <input type="submit" value="Add Task">
        </form>

        <div class="task-list">
            <?php while ($task = $result->fetch_assoc()): ?>
                <div class="task-item">
                    <strong><?php echo $task['task']; ?></strong><br>
                    Due Date: <?php echo $task['due_date']; ?>, Time: <?php echo $task['due_time']; ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
