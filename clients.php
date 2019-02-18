<?php
session_start();

$user = $_SESSION['loggedId'];

// if user is not logged in
if (!$_SESSION['loggedInUser']) {

    // send them to the login page
    header("Location: index.php");
}

// connect to database
include 'includes/connection.php';

// query & result
$query = "SELECT * FROM clients2 WHERE user='$user'";
$result = mysqli_query($conn, $query);

// check for query string
if (isset($_GET['alert'])) {

    // new client added
    if ($_GET['alert'] == 'success') {
        $alertMessage = "<div class='alert alert-success'>New client added! <a class='close' data-dismiss='alert'>&times;</a></div>";

        // client updated
    } else if ($_GET['alert'] == 'updatesuccess') {
        $alertMessage = "<div class='alert alert-success'>Client updated! <a class='close' data-dismiss='alert'>&times;</a></div>";

        // client deleted
    } else if ($_GET['alert'] == 'deleted') {
        $alertMessage = "<div class='alert alert-success'>Client deleted! <a class='close' data-dismiss='alert'>&times;</a></div>";
    }

}

// close the mysql connection
mysqli_close($conn);

include 'includes/header.php';
?>

<h1>Client Address Book</h1>

<div id="info" class='alert alert-success' style="display:none;"><a class='close' data-dismiss='alert'>&times;</a></div>

<?php echo $alertMessage; ?>

<div class="col-md-12">
    <table class="table table-striped table-bordered">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Edit <button class="pull-right btn btn-primary" id="checkall">Select All</button>
            </th>
        </tr>

        <?php

if (mysqli_num_rows($result) > 0) {

    // we have data!
    // output the data

    while ($row = mysqli_fetch_assoc($result)) {

        $userClient = $row['id'];

        echo "<tr>";

        echo "<td>" . $row['name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['phone'] . "</td>";

        echo '<td><a href="edit.php?id=' . $row['id'] . '" type="button" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-edit"></span>&nbsp
                    </a>
                    <span class="pull-right">
                    <label>Remove</label>
                    <input type="checkbox" class="removeBox" name="removeBox"
                    style="vertical-align:text-bottom;"
                    value="' . $userClient . '"
        />
        </span>
        </td>';

        echo "</tr>";
    }

} else { // if no entries
    echo "<div class='alert alert-warning'>You have no clients!</div>";
}

mysqli_close($conn);

?>
        <tr>
            <td colspan="7">
                <div class="text-center">
                    <a href="add.php" type="button" class="pull-left btn btn-sm btn-success">
                        <span class="glyphicon glyphicon-plus"></span>
                        Add Client
                    </a>
                    <a type="button" class="btn btn-sm btn-danger pull-right" id="remove">
                        <span class="glyphicon glyphicon-minus"></span>
                        Remove Clients
                    </a>
                </div>
            </td>
        </tr>
    </table>
</div>

<?php
include 'includes/footer.php';
?>