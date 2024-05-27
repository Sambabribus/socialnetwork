<?php
include_once "PDO.php";

function GetOneUserFromId($id)
{
  global $PDO;
  $sql = "SELECT * FROM user WHERE id = :id";
  $stmt = $PDO->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetch();
}

function GetAllUsers()
{
  global $PDO;
  $sql = "SELECT * FROM user ORDER BY nickname ASC";
  $stmt = $PDO->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll();
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

function IsNicknameFree($nickname)
{
  global $PDO;
  $response = $PDO->prepare("SELECT * FROM user WHERE nickname = :nickname ");
  $response->execute(
    array(
      "nickname" => $nickname
    )
  );
  return $response->rowCount() == 0;
}

function CreateNewUser($nickname, $password)
{
  global $PDO;
  $response = $PDO->prepare("INSERT INTO user (nickname, password) values (:nickname , :password )");
  $response->execute(
    array(
      "nickname" => $nickname,
      "password" => $password
    )
  );
  return $PDO->lastInsertId();
}
