<?php
    $title = "Sign up page";
?>

<!DOCTYPE html>
<hmtl>

<?php include '/header.php'; ?>

<body>


<h1>Sign up<h1>

<form action="createAccount.php" method="POST">
    
        <input type="text" id="txtUser" name="txtUser" placeholder="Username">
        <label for ="User"> User name </label><br/><br/>

        <input type ="password" id ="txtPassword" name= "txtPassword" placeholder="Password">
        <label for = "Password">Password </label><br/><br/>

    <input type="submit" value="Create Account" />
</form>

</body>
<?php include '/footer.php';?>

</html>