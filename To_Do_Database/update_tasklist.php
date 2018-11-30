<?php function edit_list() { //Edit list entries
    $conn = connection();
    if (filter_has_var(INPUT_GET, 'id')) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        // this means that the update button was clicked
        if (filter_has_var(INPUT_POST, 'submit')) {

            $description = filter_input(INPUT_POST, 'update_list_description', FILTER_SANITIZE_STRING);
            $sql = "UPDATE list SET description='" . $description ."'Where id=" . $id;
            $conn->query($sql);
            echo "Successfully updated the task list<br>";
            header('Location: index.php');
            exit;
        }
    }

    if(filter_has_var(INPUT_GET, 'id')) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $sql = "SELECT * FROM list";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            ?>

            <h2>Update a Task List</h2>

            <form action="index.php?id=<?php echo $id; ?>" method="post">
                Task Item Description: <input type="text" name="update_list_description" value="<?php echo $data['description']; ?>"><br>
                Completed: <input type="text" name="completed" value="y/n" size="1"></br>
                <input type="submit" name="submit" value="Update">
            </form>
            <?php
        }
        else {
            echo "No record found for id=" . $id . "<br>";
        }
    }
    $conn->close();
}
?>

