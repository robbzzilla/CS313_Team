<?php
require 'dbConnect.php';
$db = get_db();

$book = $_POST['book'];
$chapter = $_POST['chapter'];
$verse = $_POST['verse'];
$content = $_POST['content'];
$topicIds = $_POST['chkTopics'];

if (!empty($_POST))
{
	$conn = $db;
	$query = 'INSERT INTO scripture(book, chapter, verse, content) VALUES(:book, :chapter, :verse, :content)';
	$st = $conn->prepare($query);
	$st->bindValue(":book", $book, PDO::PARAM_STR);
	$st->bindValue(":chapter", $chapter, PDO::PARAM_INT);
	$st->bindValue(":verse", $verse, PDO::PARAM_INT);
	$st->bindValue(":content", $content, PDO::PARAM_STR);
    $st->execute();

    $scriptureId = $conn->lastInsertId("scripture_id_seq");

    
    
    foreach ($topicIds as $topicID)
    {
        $query = 'INSERT INTO scripture_topic(scripture_id, topic_id) VALUES(:scriptureID, :topicID)';
        $st = $conn->prepare($query);
        
        $st->bindValue(":scriptureID", $scriptureID, PDO::PARAM_INT);
        $st->bindValue(':topicID', $topicID, PDO::PARAM_INT);

        $st->execute();
    }

    $conn = null;
}
    header("Location: topicShow.php");
?>
