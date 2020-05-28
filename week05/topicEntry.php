<?php
    require 'dbConnect.php';
    $db = get_db();
    ?>
<!DOCTYPE html>
<html>
   <?php include 'head.php';?>
   <body>
      <form method="POST" action="topicInsert.php">
         <input type="text" id="book" placeholder="Book"><br>
         <input type="text" id="chapter" placeholder="Chapter"><br>
         <input type="text" id="verse" placeholder="Verse"><br>
         <textarea id="content" placeholder="content"><br>
         <?php 
            try
            {
                $statement = $db->prepare('SELECT id, name FROM topic');
                $statement->execute();

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {
                    $id = $row['id'];
                    $name = $row['name'];

                    echo "<input type='checkbox' name='chkTopics[]' id='chkTopics$id' value='$id'>";
                    echo "<label for='chkTopics$id'>$name</label><br />";
                    echo "\n";
                }
            }
            catch (PDOException $ex)
            {
                echo "Error connectiong to DB. Details: $ex";
                die();
            }
         ?>
         <input type="submit" value="Add to Database" />
      </form>
   </body>
</html>