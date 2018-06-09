<?php function delete_list() { //Delete a list
    $conn = connection();
    // Checks if a specific task list is being requested
    if(filter_has_var(INPUT_GET,'id')) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        // this means that the delete button was clicked
        if (filter_has_var(INPUT_POST, 'submit-yes')) {
            $sql = "DELETE FROM list WHERE id=" . $id;
            $result = $conn->query($sql);
            if ($result) {
                echo "Successfully deleted the task list<br>";
            }
        }
            else {
                echo "Delete cancelled";
        }
    }
    ?>

    <?php
    if(filter_has_var(INPUT_GET,'id')) {
        $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
        ?>

        <h2>Delete a List</h2>
        <form action="index.php?id=<?php echo $id; ?>" method="post">
            Are you sure that you want to delete the list?
            <input type="submit" name="submit-yes" value="Yes">
            <input type="submit" name="submit-no" value="No">
        </form>
        <?php
    }
    $conn->close();
}
?>