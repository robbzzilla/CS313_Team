<?php
    session_start();
    $title = "Sign in page";
    $badLogin = false;

    if (isset($_POST['txtUser']) && isset($_POST['txtPassword']))
    {
        $username = $_POST['txtUser'];
        $password + $_POST['txtPassword'];

        require("/dbConnect.php");
        $db = get_db();

        $query = 'SELECT password FROM usr WHERE username=:username';

        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);

        $result = $statement->execute();

        if($result)
        {
            $row = $statement->fetch();
            $hashedPasswordFromDB = $row['password'];

            if (password_verify($password, $hashedPasswordFromDB))
            {
                $_SESSION['username'] = $username;
                header("Location: welcome.php");
                die();
            }
            else
            {
                $badLogin = true;
            }
        }
        else
        {
            $badLogin = true;
        }
    }
?>

<!DOCTYPE html>
<hmtl>

<?php include 'header.php'; ?>

<body>
<?php
    if($badLogin)
    {
        echo"Incorrect username or password<br/><br/>\n";
    }
?>
<div>
        <h3> Please sign in </h3>

    <form action="signin.php" method="POST">

        <input type="text" id="txtUser" name="txtUser" placeholder="Username">
        <label for ="User"> User name </label><br/><br/>

        <input type ="password" id ="txtPassword" name= "txtPassword" placeholder="Password">
        <label for = "Password">Password </label><br/><br/>

        <input type = "submit" value ="Sign in"/> 
    </form>
    <br>

</div>

</body>

<a href="signup.php">Sign up for a new Account</a>

</html>
