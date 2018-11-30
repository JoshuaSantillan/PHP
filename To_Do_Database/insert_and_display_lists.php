<?php function display_list() { /*Display the list*/
    $conn = connection();
    ?>
    <h2>List Table</h2>

    <table>
        <tr>
            <th>Id</th>
            <th>List</th>
        </tr>
        <?php
        $sql = "SELECT * FROM list";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['id']. '</td><td><a href="?id=' .$row['id']. '">'. $row['description']. "</a></td></tr>";
            }
        }
        else {
            echo $conn->error;
        }
        $conn->close();
        ?>
    </table>
    <?php
}
?>

<?php function insert_list() { //Insert new lists
    $conn = connection();
    ?>
    <h2>Add a List</h2>

    <form action="index.php" method="post">
        List Description: <input type="text" name="list_description">
        <input type="hidden" name="m" value="insert_list">
        <input type="submit">
    </form>
    <?php
        // Step:  filter and insert data into the database
        if (filter_has_var(INPUT_POST, 'list_description')) {
            $description = filter_input(INPUT_POST, 'list_description', FILTER_SANITIZE_SPECIAL_CHARS);
            $sql = "INSERT INTO list(id, description) VALUES (NULL,'$description')";
            if ($conn->query($sql) === TRUE) {
                print "New list record successfully created";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        $conn->close();
    }
?>