<!DOCTYPE html>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
<html>
<body>
    <?php
        include 'connect.php';
        function connection() {
        include_once "connectdb.php";
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "tasklist";
        // Create connection
        return $conn =  connectdb($servername, $username, $password, $dbname);
    }
    ?>

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
                echo "<tr><td>" . $row['id']. '</td><td><a href="?id=' .$row['id'].'">'. $row['description']. "</a></td></tr>";
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

    <?php function display_item() { //Display the item in the list
        $conn = connection();
        //if(filter_has_var(INPUT_POST,'description')) {
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
        //}
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
            List Description: <input type="text" name="description">
            <input type="submit">
        </form>
        <?php if (isset($_POST['description'])) {
            // Step:  filter and insert data into the database
            if (filter_has_var(INPUT_POST, 'description')) {
                $sql = "SELECT * FROM listitem";
                $result = $conn->query($sql);

                $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

                $sql = "INSERT INTO list(id, description) VALUES (NULL,'$description')";
                if ($conn->query($sql) === TRUE) {
                    print "New list record successfully created";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            $conn->close();
        }
    }
    ?>

    <?php function insert_item() { //Insert new items of the list
        $conn = connection();
        if(filter_has_var(INPUT_GET,'id')) {
            $list_id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
        ?>
        <h2>Add a Task Item</h2>

        <form action="index.php?id=<?php echo $list_id; ?>" method="post">
            Task Item Description: <input type="text" name="description"><br>
            Completed: <input type="text" name="completed" size="1"><br>
            <input type="submit">
        </form>
        <?php
            if(filter_has_var(INPUT_GET,'id'))
            {
                //process the form if there is data in it.
                if(filter_has_var(INPUT_POST,'description')) {
                    $description = filter_input(INPUT_POST,'description',FILTER_SANITIZE_SPECIAL_CHARS);
                    $completed = filter_input(INPUT_POST,'completed',FILTER_SANITIZE_SPECIAL_CHARS);

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

    <?php function edit_list() { //Edit list entries
        $conn = connection();
        if (filter_has_var(INPUT_GET, 'id')) {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            if (filter_has_var(INPUT_POST, 'submit')) // this means that the update button was clicked
            {
                $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
                $completed = filter_input(INPUT_POST, 'completed', FILTER_SANITIZE_STRING);
                $sql = "UPDATE list SET description='" . $description . "',completed='" . $completed . "' WHERE id=" . $id;
                //$result = $conn->query($sql);
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
                    Task Item Description: <input type="text" name="description" value="<?php echo $data['description']; ?>"><br>
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

    <?php function edit_item() { //Edit item entries in the list
        $conn = connection();
        if(filter_has_var(INPUT_GET,'id')) {
            $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
            if(filter_has_var(INPUT_POST,'submit')) { // this means that the update button was clicked
                $description = filter_input(INPUT_POST,'description',FILTER_SANITIZE_STRING);
                $completed = filter_input(INPUT_POST,'completed',FILTER_SANITIZE_STRING);
                $sql = "UPDATE listitem SET description='".$description."',completed='".$completed."' WHERE id=".$id;
                $result = $conn->query($sql);
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

    <?php function delete_list() { //Delete a list
        $conn = connection();
        // This checks if a specific task item with the id on the get string is being requested
        if(filter_has_var(INPUT_GET,'id'))
        {
            $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
            if(filter_has_var(INPUT_POST,'submit')) // this means that the delete button was clicked
            {
                $sql = "DELETE FROM list WHERE id=".$id;
                $result = $conn->query($sql);
                if($result)
                {
                    echo "Successfully deleted the task item<br>";
                }
            }
        }
        ?>

            <?php
            if(filter_has_var(INPUT_GET,'id'))
            {
                $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
                $sql = "SELECT * FROM list";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $data = $result->fetch_assoc();
                }
            ?>
            <h2>Delete a List</h2>
            <form action="index.php?id=<?php echo $id; ?>" method="post">
                Are you sure that you want to delete the list?
                <input type="submit" name="submit" value="Yes">
                <input type="submit" name="submit" value="No">
            </form>
    <?php
            }
        $conn->close();
    }
    ?>

    <?php function delete_item() { //Delete an item in the list
        $conn = connection();
        // This checks if a specific task item with the id on the get string is being requested
        if(filter_has_var(INPUT_GET,'id'))
        {
            $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
            if(filter_has_var(INPUT_POST,'submit')) // this means that the delete button was clicked
            {
                $sql = "DELETE FROM listitem WHERE id=".$id;
                $result = $conn->query($sql);
                if($result)
                {
                    echo "Successfully deleted the task item<br>";
                }
            }
        }
        if(filter_has_var(INPUT_GET,'id'))
        {
            $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
            $sql = "SELECT * FROM listitem";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();
            }
            ?>
            <h2>Delete a Task Item</h2>
            <form action="index.php?id=<?php echo $id; ?>" method="post">
                Are you sure that you want to delete the item?
                <input type="submit" name="submit" value="Yes">
                <input type="submit" name="submit" value="No">
            </form>
            <?php
        }
        $conn->close();
    }
    ?>

    <?php
    display_list();
    display_item();
    insert_list();
    insert_item();
    edit_list();
    edit_item();
    delete_list();
    delete_item();
    ?>

</body>
</html>
