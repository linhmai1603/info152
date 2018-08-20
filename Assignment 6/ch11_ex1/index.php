<?php
if (isset($_POST['tasklist'])) {
    $task_list = $_POST['tasklist'];
} else {
    $task_list = array();

    // some hard-coded starting values to make testing easier
    $task_list[] = 'Write chapter';
    $task_list[] = 'Edit chapter';
    $task_list[] = 'Proofread chapter';
}

$errors = array();

switch( $_POST['action'] ) {
    case 'Add Task':
        $new_task = $_POST['newtask'];
        if (empty($new_task)) {
            $errors[] = 'The new task cannot be empty.';
        } else {
            array_push($task_list, $new_task);
        }
        break;
    case 'Delete Task':
        $task_index = $_POST['taskid'];
        unset($task_list[$task_index]);
        $task_list = array_values($task_list);
        break;

    case 'Modify Task':
		$task_index = $_POST['taskid'];
        $task_to_modify = $task_list[$task_index];
        break;
    case 'Save Changes':
		$task_index = $_POST['modifiedtaskid'];
		$task_name = $_POST['modifiedtask'];
        $task_list[$task_index] = $task_name;
        break;
    case 'Cancel Changes':
		break;
    case 'Promote Task':
        $task_index = $_POST['taskid'];
        $temp = $task_list[$task_index];
		$task_list[$task_index] = $task_list[$task_index -1];
		$task_list[$task_index -1] = $temp;
        break;
    case 'Sort Tasks':
		sort($task_list);
		break;
}

include('task_list.php');
?>