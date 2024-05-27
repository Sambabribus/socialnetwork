<?php
$action = $_GET["action"] ?? "display";

switch ($action) {

  case 'register':
    // code...
    break;

  case 'logout':
    // code...
    break;

  case 'login':
    // code...
    break;

  case 'newMsg':
    // code...
    break;

  case 'newComment':
    // code...
    break;

  case 'display':
  default:
    include "../models/PostManager.php";
    $posts = GetAllPosts();

    include "../models/CommentManager.php";
    $commentManager = new CommentManager($pdo); // Assuming $pdo is your database connection

    $comments = array();

    foreach ($posts as $post) {
      $postId = $post['id'];
      $comments[$postId] = $commentManager->GetAllCommentsFromPostId($postId);
    }

    include "../views/DisplayPosts.php";
    break;
}
