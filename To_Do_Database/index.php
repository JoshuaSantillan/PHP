<!DOCTYPE html>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #F9A9FB;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #97F5EF;
    }
</style>
<html>
<body>

<?php

        include 'connect.php';
        include 'insert_and_display_lists.php';
        include 'insert_and_display_task_items.php';
        include 'update_dispaly_task_lists.php';
        include 'update_display_task_items.php';
        include 'delete_tasklist.php';
        include 'delete_taskitem.php';

        insert_list();

        // if something with id var clicked display following
       if(filter_has_var(INPUT_GET, 'id')) {
            delete_list();
            insert_item();
            edit_list();
        }
        // if something with item_id var clicked display the following
        else if(filter_has_var(INPUT_GET,'item_id')) {
            edit_item();
            delete_item();
        }
        // displays lists
    display_list();
    display_item();

        // connection to database
        function connection()
        {
            include_once "connectdb.php";
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "tasklist";
            // Create connection
            return $conn =  connectdb($servername, $username, $password, $dbname);
        }
    ?>

</body>
</html>