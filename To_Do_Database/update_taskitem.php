<?php function edit_item() { //Edit item entries in the list
    $conn = connection();
    if(filter_has_var(INPUT_GET,'item_id')) {
        $id = filter_input(INPUT_GET,'item_id',FILTER_SANITIZE_NUMBER_INT);
        if(filter_has_var(INPUT_POST,'submit')) { // this means that the update button was clicked
            $description = filter_input(INPUT_POST,'description',FILTER_SANITIZE_STRING);
            $completed = filter_input(INPUT_POST,'completed',FILTER_SANITIZE_STRING);
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
                Task Item Description: <input type="text" name="description" value="<?php echo $data['description'];?>"><br>
                Completed: <input type="text" name="completed" value="<?php echo $data['completed'];?>" size="1"><br>
                <input type="submit" name="submit" value="Update">
            </form>

            <h2>List Items Table</h2>

            <table>
                <tr>
                    <th>Id</th>
                    <th>List</th>
                    <th>Description</th>
                </tr>
                <?php
                // Create connection
                $sql = "SELECT * FROM listitem";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $list_record = $conn->query("SELECT * FROM listitem WHERE id=" . $row['list_id']);
                        $row2 = $list_record->fetch_assoc();
                        if($_GET['item_id'] == $row["id"]) {
                            //ORIGINAL
                            echo "<tr><td>" . $row["id"] . "<td>" . $row2['description'] . "</td>" . "<td>" . $row["description"] . "<td></tr>";
                        }
                    }
                }
                ?>
            </table>
            <?php
        }
        else {
            echo "No record found for id=".$id."<br>";
        }
    }
    $conn->close();
}
?>
