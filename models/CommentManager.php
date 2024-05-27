<?php
include_once "PDO.php";

function GetOneCommentFromId($id)
{
  global $PDO;
  $sql = "SELECT * FROM comment WHERE id = :id ";
  $stmt = $PDO->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetch();
}

function GetAllComments()
{
  global $PDO;
  $sql = "SELECT * FROM comment ORDER BY created_at ASC";
  $stmt = $PDO->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll();
}

function GetAllCommentsFromUserId($userId)
{
  global $PDO;
  $sql = "SELECT comment.*, user.nickname "
    . "FROM comment LEFT JOIN user on (comment.user_id = user.id) "
    . "WHERE comment.user_id = :userId "
    . "ORDER BY comment.created_at ASC";
  $stmt = $PDO->prepare($sql);
  $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetchAll();
}

class CommentManager
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function GetAllCommentsFromPostId($postId)
  {
    $sql = "SELECT comment.id, comment.content, comment.created_at, user.nickname 
              FROM comment 
              INNER JOIN user ON comment.user_id = user.id 
              WHERE comment.post_id = :postId";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $comments;
  }
}
