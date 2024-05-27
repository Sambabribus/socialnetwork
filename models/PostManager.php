<?php
include_once "PDO.php";

function GetOnePostFromId($id)
{
  global $PDO;
  $sql = "SELECT * FROM post WHERE id = :id";
  $stmt = $PDO->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetch();
}

function GetAllPosts()
{
  global $PDO;
  $sql = "SELECT post.*, user.nickname "
    . "FROM post LEFT JOIN user on (post.user_id = user.id) "
    . "ORDER BY post.created_at DESC";
  $stmt = $PDO->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll();
}

function SearchInPosts($search)
{
  global $PDO;
  $sql = "SELECT post.*, user.nickname "
    . "FROM post LEFT JOIN user on (post.user_id = user.id) "
    . "WHERE content like :search "
    . "ORDER BY post.created_at DESC";
  $stmt = $PDO->prepare($sql);
  $searchWithPercent = "%$search%";
  $stmt->bindParam(':search', $searchWithPercent, PDO::PARAM_STR);
  $stmt->execute();
  return $stmt->fetchAll();
}

function GetAllPostsFromUserId($userId)
{
  global $PDO;
  $sql = "SELECT * FROM post WHERE user_id = :userId ORDER BY created_at DESC";
  $stmt = $PDO->prepare($sql);
  $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetchAll();
}

function CreateNewPost($userId, $msg)
{
  global $PDO;

  $sql = "INSERT INTO post(user_id, content) VALUES (:userId, :msg)";

  $stmt = $PDO->prepare($sql);

  $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
  $stmt->bindParam(':msg', $msg, PDO::PARAM_STR);

  $stmt->execute();
}
