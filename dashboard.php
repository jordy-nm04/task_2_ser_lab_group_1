<?php

$conn = new mysqli("localhost","root","", "todolist",3307);
if ($conn-> connect_error) {
    die("Connection Failed". $conn->connect_error);
}

if (isset($_POST["addtask"])){
    $task= $_POST["task"];
    $conn-> query("INSERT INTO tasks (task) VALUES ('$task')");
    header("Location: dashboard.php");
}
if (isset($_GET["delete"])){
    $id= $_GET["delete"];
    $conn->query("DELETE FROM tasks WHERE id='$id'");
    header("Location: dashboard.php");
}
if (isset($_GET["complete"])){
    $id= $_GET["complete"];
    $conn->query("UPDATE tasks SET status = 'completed' WHERE id= '$id'");
    header("Location: dashboard.php");
}

$result= $conn-> query("SELECT * FROM tasks ORDER BY id DESC");
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
       <div class="main-title"> <h1>Jordy’s Todo List</h1></div>
       <?php include "task_counter.php"; ?>
       <?php include "icon.php"; ?>
        <form action="dashboard.php" method="post">
            <input type="text" name="task" placeholder="Enter new task" id="">
            <button type="submit" name="addtask">Add Task</button>
        </form>
        <ul>
            <?php while ($row= $result->fetch_assoc()):?>
                <li class="<?php echo $row["status"];?>">
                    <strong><?php echo $row["task"]; ?></strong>
                    <div class="actions">
                        <a href="dashboard.php?complete=<?php echo $row['id'];?>">Complete</a>

                        <a href="dashboard.php?delete=<?php echo $row['id'];?>">Delete</a>
                    </div>
                </li>
            <?php endwhile?>
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