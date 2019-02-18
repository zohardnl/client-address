<?php
    session_start();

    include('includes/functions.php');

    if( isset( $_POST['signup'] ) ) {
    
        // create variables
        // wrap data with validate function
        $formName = validateFormData( $_POST['clientName'] );
        $formEmail = validateFormData( $_POST['clientEmail'] );
        $formPass = password_hash(validateFormData( $_POST['clientPassword'] ),PASSWORD_DEFAULT);
        
        // connect to database
        include('includes/connection.php');
        
        // create query
        $query = "INSERT INTO `users2` (`user`,`name`, `email`, `password`) VALUES (NULL, '$formName', '$formEmail', '$formPass')";
        
        // store the result
        $result = mysqli_query( $conn, $query );
        
        if( $result ) {
            
            // refresh page with query string
            header( "Location: index.php?signup=success");
            
        } else {
            
            // something went wrong
            echo "Error: ". $query ."<br>" . mysqli_error($conn);
        }
        
    }
    // close the mysql connection
    mysqli_close($conn);

    include('includes/header.php');

?>

<h1>Sign Up</h1>

<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post" class="row">
    <div class="form-group col-sm-6">
        <label for="client-name">User Name *</label>
        <input type="text" class="form-control input-lg" id="client-name" name="clientName" value="" required>
    </div>
    <div class="form-group col-sm-6">
        <label for="client-email">Email *</label>
        <input type="email" class="form-control input-lg" id="client-email" name="clientEmail" value="" required>
    </div>
    <div class="form-group col-sm-6">
        <label for="client-password">Password *</label>
        <input type="password" class="form-control input-lg" id="client-password" name="clientPassword" value=""
            required>
    </div>
    <div class="col-sm-12">
        <a href="index.php" type="button" class="btn btn-lg btn-default">Cancel</a>
        <button type="submit" class="btn btn-lg btn-success pull-right" name="signup">Sign Up</button>
    </div>
</form>

<?php
    include('./includes/footer.php');
?>