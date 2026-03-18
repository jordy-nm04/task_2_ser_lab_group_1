<?php

$conn= new mysqli("localhost","root", "", "todolist");
if ($conn-> connect_error) {
    die("Connection Failed". $conn->connect_error);
}
if (isset($_POST["addtask"])){
    $task= $_POST["task"];
    $conn-> query("INSERT INTO tasks (task) VALUES ('$task')");
    
}

if (isset($_GET["delete"])){
    $id= $_GET["delete"];
    $conn->query("DELETE FROM tasks WHERE id='$id'");
   
}
if (isset($_GET["complete"])){
    $id= $_GET["complete"];
    $conn->query("UPDATE tasks SET status = 'completed' WHERE id= '$id'");
   
}
if (isset($_GET["undo"])){
    $id = $_GET["undo"];
    $conn->query("UPDATE tasks SET status = 'pending' WHERE id='$id'");
   
}
$result= $conn-> query("SELECT * FROM tasks ORDER BY id DESC");
?>

<link rel = "stylesheet" href="style3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.min.css">


    <ul>
            <?php while ($row= $result->fetch_assoc()):?>
                <li class="<?php echo $row["status"];?>">
                    <strong><?php echo $row["task"]; ?></strong>
                    <div class="actions">
                        <?php if ($row['status'] !== 'completed'): ?>
                             <a href="dashboard.php?complete=<?php echo $row['id']; ?>" class="complete-btn">
                                 <i class="fa-solid fa-check"></i>
                            </a>
                        <?php else: ?>
                            <a href="dashboard.php?undo=<?php echo $row['id']; ?>" class="undo-btn">
                                <i class="fa-solid fa-rotate-left"></i>
                            </a>
                        <?php endif; ?>

                        <a href="dashboard.php?delete=<?php echo $row['id']; ?>" class="delete-btn">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </li>
            <?php endwhile?>
    </ul>

