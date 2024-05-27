<?php
include_once "PDO.php";

function GetOneUserFromId($id)
{
  global $PDO;
  $response = $PDO->query("SELECT * FROM user WHERE id = $id");
  return $response->fetch();
}

function GetAllUsers()
{
  global $PDO;
  $response = $PDO->query("SELECT * FROM user ORDER BY nickname ASC");
  return $response->fetchAll();
}

function GetUserIdFromUserAndPassword($username, $password)
{
  global $PDO;

  $sql = "SELECT id FROM user WHERE nickname = :username AND password = :password";


  $stmt = $PDO->prepare($sql);


  $stmt->bindParam(':username', $username, PDO::PARAM_STR);
  $stmt->bindParam(':password', $password, PDO::PARAM_STR);


  $stmt->execute();


  $result = $stmt->fetch(PDO::FETCH_ASSOC);


  if ($result) {
    return $result['id'];
  } else {
    return -1;
  }
}
