<?php
	$errors = "";
	
	$db = mysqli_connect('localhost', 'root', '','to_do_list');
	if(isset($_POST['submit'])){
		$task = $_POST['task'];
		if(empty($task)){
			$errors="you must fill in the task";
		}else{
			mysqli_query($db, "INSERT INTO task (task) VALUES ('$task')");
			header('location: todolist.php');
		}
	}
	
	if(isset($_GET['del_task'])) {
		$id = $_GET['del_task'];
		mysqli_query($db, "DELETE FROM task WHERE id=$id");
		header('location: todolist.php');
	}
	
	$tasks=mysqli_query($db, "SELECT * FROM task");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Todo list application with PHP and MYSQL</title>
	<link rel="stylesheet" type="text/css" href="style.css"
</head>
<body>
	<div class="heading">
		<h2>To do list application with PHP and MYSQL</h2>
	</div>
	
	<form method="POST" action="todolist.php">
	<?php if (isset($errors)) { ?>
		<p><?php echo $errors; ?> </p>
	<?php } ?>
		<input type="text" name="task" class="task_input">
		<button type="submit" class="add_btn" name="submit">Add Task</button>
	</form>
	
	<table>
		<thead>
			<tr>
				<th>N</th>
				<th>Task</th>
				<th>Action</th>
			<tr>
		</thead>
		
		<tbody>
		<?php $i = 1; while($row = mysqli_fetch_array($tasks)){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td class="task"><?php echo $row['task'];?></td>
				<td class="delete">
					<a href="todolist.php?del_task=<?php echo $row['id']; ?>">x</a>
				</td>
			</tr>
		<?php $i++; } ?>
			
		</tbody>
	</table>
	

</body>
</html>