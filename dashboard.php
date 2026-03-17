<?php
date_default_timezone_set('Africa/Lusaka'); 

$conn = new mysqli("localhost", "root", "", "todolist");

if (isset($_POST["addtask"])) {
    $task = $_POST["task"];
   
    $conn->query("INSERT INTO tasks (task, created_at) VALUES ('$task', NOW())");
    header("Location: dashboard.php");
    exit();
}

if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $conn->query("DELETE FROM tasks WHERE id='$id'");
    header("Location: dashboard.php");
    exit();
}


if (isset($_GET["complete"])) {
    $id = $_GET["complete"];
    
    $conn->query("UPDATE tasks SET status='completed', updated_at=NOW() WHERE id='$id'");
    header("Location: dashboard.php");
    exit();
}

$result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");

function timeAgo($datetime) {
    date_default_timezone_set('Africa/Lusaka'); 
    $created_at = new DateTime($datetime);
    $now = new DateTime();
    $interval = $created_at->diff($now);

    if ($interval->invert) {
        return "just now";
    }

    if ($interval->d > 0) return $interval->d . " days ago";
    if ($interval->h > 0) return $interval->h . " hours ago";
    if ($interval->i > 0) return $interval->i . " minutes ago";
    if ($interval->s > 10) return $interval->s . " seconds ago"; 
    
    return "just now";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Colored List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="main-title"><h1>Todo List</h1></div>
        <form action="dashboard.php" method="post">
            <input type="text" name="task" placeholder="Enter new task" required>
            <button type="submit" name="addtask">Add Task</button>
        </form>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li class="<?php echo $row["status"]; ?>">
                    <strong><?php echo htmlspecialchars($row["task"]); ?></strong>
                    <small style="color: gray; font-style: italic;">
                        (added <?php echo timeAgo($row["created_at"]); ?>)
                    </small>
                    <div class="actions">
                        <a href="dashboard.php?complete=<?php echo $row['id']; ?>">Complete</a>
                        <a href="dashboard.php?delete=<?php echo $row['id']; ?>">Delete</a>
                    </div>
                </li>
            <?php endwhile ?>
        </ul>
    </div>

    <div class="footer">
        <p>Designed by <strong>Jordy NM</strong></p>
        <div class="social-icons">
            <a href="https://www.instagram.com/jordy_nm04?igsh=bDEyNWs0ZHdzdXE4&utm_source=qr" target="_blank">
                <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/instagram.svg" alt="Instagram">
            </a>
            <a href="https://wa.me/260763717530" target="_blank">
                <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/whatsapp.svg" alt="WhatsApp">
            </a>
            <a href="https://www.facebook.com/share/1DKTndAx9g/?mibextid=wwXIfr" target="_blank">
                <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/facebook.svg" alt="Facebook">
            </a>
        </div>
    </div>
</body>
</html>
