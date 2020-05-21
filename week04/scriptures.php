
<?php

    try
    {
        $dbUrl = getenv('DATABASE_URL');

        $dbOpts = parse_url($dbUrl);

        $dbHost = $dbOpts["host"];
        $dbPort = $dbOpts["port"];
        $dbUser = $dbOpts["user"];
        $dbPassword = $dbOpts["pass"];
        $dbName = ltrim($dbOpts["path"],'/');

        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'head.php';?>
<body>
    <h1>Scripture Resources</h1>
    <form>
        <select>
        <?php
            foreach ($db->query('SELECT DISTINCT book FROM scriptures') as $row)
            {
                echo '<option value="' . $row['book'] . '">' . $row['book'] . '</option>';
            }
        ?>
        </select>
    </form>
</body>
</html>