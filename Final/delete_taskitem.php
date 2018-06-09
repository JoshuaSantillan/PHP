<?php
    //Deletes from item table
    function delete_item() {
    $conn = connection();
    // Checks if an item with a specific id is being pulled from string
    if(filter_has_var(INPUT_GET,'item_id')) {
           
        $id = filter_input(INPUT_GET,'item_id',FILTER_SANITIZE_NUMBER_INT);
        // this means that the delete button was clicked
        echo $HTTP_POST_VARS;
        if(filter_has_var(INPUT_POST,'submit-yes'))
        {
            
            $sql = "DELETE FROM listitem WHERE id= " . $id;
            $result = $conn->query($sql);
            if($result)
            {
                echo "Successfully deleted the task item<br>";
            }
        }
            else {
                echo "Delete cancelled";
        }
    }
    if(filter_has_var(INPUT_GET,'item_id')) {
        $id = filter_input(INPUT_GET,'item_id',FILTER_SANITIZE_NUMBER_INT);
        ?>

        <h2>Delete a Task Item</h2>
        <form action="index.php?id=<?php echo $id; ?>" method="post">
            Are you sure that you want to delete the item?
            <input type="submit" name="submit-yes" value="Yes">
            <input type="submit" name="submit-no" value="No">
        </form>

        <?php
    }
    $conn->close();
}
//check for get string for the id and not post because there is no submit - yet in delete item
?>