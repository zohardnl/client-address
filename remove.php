<?php
    include('includes/connection.php');

    $id = $_POST['id'];

    foreach ($id as $val) {
        $query = "DELETE FROM clients2 WHERE id='$val'";
        $result = mysqli_query( $conn, $query );
    }

    if( $result ) {
    // redirect to client page with query string
        header("Location: clients.php?alert=deleted");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // close the mysql connection
    mysqli_close($conn);
?>