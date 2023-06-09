<?php
session_start();

$tasks = [];

if(isset($_POST["task"])) {
    $task = $_POST["task"];

    array_push($tasks, $task);

    $_SESSION["tasks"][] = $task; // Append new task to existing array
}

if(isset($_SESSION["tasks"])) {
    $tasks = $_SESSION["tasks"];
}

if(isset($_GET["remove"])) { // Check if remove parameter is set in the URL
    $index = $_GET["remove"];

    if(isset($tasks[$index])) {
        unset($tasks[$index]); // Remove the task from the array
        $_SESSION["tasks"] = $tasks; // Update the session variable
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>My To-Do List</title>

		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap">
		<link rel="stylesheet" href="style.css">
	</head>

	<body>
		<div class="container">
			<h1>My To-Do List</h1>

			<form action="/" method="POST">
				<input type="text" name="task" placeholder="Enter task..." minlength="1" maxlength="64" required>
				<button type="submit">Add</button>
			</form>

			<?php foreach ($tasks as $index => $task): ?>
				<p>
					<span></span>
					<?php echo $task; ?>
					<a type="submit" class="remove" href="/?remove=<?php echo $index; ?>">Remove</a>
				</p>
			<?php endforeach; ?>
		</div>
	</body>
</html>
