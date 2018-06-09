<?php function edit_item() { //Edit item entries in the list
    $conn = connection();
    if(filter_has_var(INPUT_GET,'item_id')) {
        $id = filter_input(INPUT_GET,'item_id',FILTER_SANITIZE_NUMBER_INT);
        if(filter_has_var(INPUT_POST,'submit')) { // this means that the update button was clicked
            $description = filter_input(INPUT_POST,'list_item_description',FILTER_SANITIZE_STRING);
            $completed = filter_input(INPUT_POST,'item_completed',FILTER_SANITIZE_STRING);
            $sql = "UPDATE listitem SET description='".$description."',completed='".$completed."' WHERE id=".$id;
            $conn->query($sql);
            echo "Successfully updated the task item<br>";
            header('Location: index.php');
            exit;
        }
    }
    if(filter_has_var(INPUT_GET,'item_id')) {
        $id = filter_input(INPUT_GET,'item_id',FILTER_SANITIZE_NUMBER_INT);
        $sql = "SELECT * FROM listitem";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            ?>
            <h2>Update a Task Item</h2>

            <form action="index.php?id=<?php echo $id; ?>" method="post">
                Task Item Description: <input type="text" name="list_item_description" value="<?php echo $data['description'];?>"><br>
                Completed: <input type="text" name="item_completed" value="<?php echo $data['completed'];?>" size="1"><br>
                <input type="submit" name="submit" value="Update">
            </form>

            <?php
        }
        else {
            echo "No record found for id=".$id."<br>";
        }
    }
    $conn->close();
}
?>