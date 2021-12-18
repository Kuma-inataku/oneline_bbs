<?php
$link = mysqli_connect('localhost', 'root', 'root123');

if (! $link) {
  die('データベースに接続できません。：'.mysqli_connect_error());
}

mysqli_select_db($link, 'oneline_bbs');

$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = null;
  if (!isset($_POST['name']) || !strlen($_POST['name'])) {
    $errors['name'] = '名前を入力してください';
  } elseif (strlen($_POST['name']) > 40) {
    $errors['name'] = '名前は40文字以下にしてください';
  } else {
    $name = $_POST['name'];
  }
}

$comment = null;
if (!isset($_POST['comment']) || !strlen($_POST['comment'])) {
  $errors['comment'] = '一言を入力してください。';
} elseif (strlen($_POST['comment']) > 200) {
  $errors['comment'] = 'ひとことは200文字以下にしてください';
} else {
  $comment = $_POST['comment'];
}

if (count($errors) === 0) {
  $sql = "INSERT INTO `post` (`name`, `comment`, `created_at`) VALUES ('"
  .mysqli_real_escape_string($link, $name)."','"
  .mysqli_real_escape_string($link, $comment)."','"
  .date('Y-m-d H:i:s')."')";

  mysqli_query($link, $sql);

  header('Location:http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}
include 'view/bbs_view.php';
?>
