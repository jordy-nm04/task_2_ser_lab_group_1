<?php
$conn = new mysqli("localhost","root","","todolist",3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$totalTasks = $conn->query("SELECT COUNT(*) AS total FROM tasks")->fetch_assoc()['total'];
$completedTasks = $conn->query("SELECT COUNT(*) AS completed FROM tasks WHERE status='completed'")->fetch_assoc()['completed'];
$pendingTasks = $conn->query("SELECT COUNT(*) AS pending FROM tasks WHERE status!='completed'")->fetch_assoc()['pending'];
?>

<link rel="stylesheet" href="style2.css">

<div class="task-counter">
    <div class="counter-box">
        <h3>Total</h3>
        <p><?php echo $totalTasks; ?></p>
    </div>

    <div class="counter-box completed">
        <h3>Completed</h3>
        <p><?php echo $completedTasks; ?></p>
    </div>

    <div class="counter-box pending">
        <h3>Pending</h3>
        <p><?php echo $pendingTasks; ?></p>
    </div>
</div>

