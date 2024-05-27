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
    $comments = array();

    if (isset($_GET['search'])) {
      $posts = SearchInPosts($_GET['search']);
    } else {
      $posts = GetAllPosts();
    }

    $commentManager = new CommentManager($PDO);

    foreach ($posts as $post) {
      $postId = $post['id'];
      $comments[$postId] = $commentManager->GetAllCommentsFromPostId($postId);
    }

    include "../views/DisplayPosts.php";
    break;
}
