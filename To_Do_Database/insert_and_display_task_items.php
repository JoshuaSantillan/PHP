<?php function display_item() { //Display the item in the list
    $conn = connection();
    ?>
    <h2>List Items Table</h2>

    <table>
        <tr>
            <th>Id</th>
            <th>List</th>
            <th>Description</th>
        </tr>
        <?php
        $sql = "SELECT * FROM listitem";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $list_record = $conn->query("SELECT * FROM listitem WHERE id=" . $row['list_id']);
                $row2 = $list_record->fetch_assoc();

                //LIST ITEM
                echo "<tr><td>" . $row['id'] . '</td><td>' . $row2['description'] . '</td><td><a href="index.php?item_id=' . $row["id"] . '">' . $row['description'] . "</a></td></tr>";
            }
        }
        $conn->close();
        ?>
    </table>
    <?php
}
?>

<?php function insert_item() { //Insert new items of the list
    $conn = connection();
    if(filter_has_var(INPUT_GET,'id')) {
        $list_id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
        ?>
        <h2>Add a Task Item</h2>

        <form action="index.php?id=<?php echo $list_id; ?>" method="post">
            Task Item Description: <input type="text" name="item_description"><br>
            <input type = "hidden" name="m" value="insert_item">
            Completed: <input type="text" name="item_completed" size="1"><br>
            <input type="submit">
        </form>
        <?php
        if(filter_has_var(INPUT_GET,'id'))
        {
            //process the form if there is data in it.
            if(filter_has_var(INPUT_POST,'item_description')) {
                $description = filter_input(INPUT_POST,'item_description',FILTER_SANITIZE_SPECIAL_CHARS);
                $completed = filter_input(INPUT_POST,'item_completed',FILTER_SANITIZE_SPECIAL_CHARS);

                $sql = "INSERT INTO listitem (list_id,description,completed) VALUES ('$list_id','$description','$completed')";

                if ($conn->query($sql) === TRUE) {
                    print "New list item record successfully created";
                }
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }
} ?>
