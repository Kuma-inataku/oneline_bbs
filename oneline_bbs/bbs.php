<?php
$link = mysqli_connect('localhost', 'root', 'root123');

if (! $link) {
  die('データベースに接続できません。：' . mysqli_error($link));
  // die('データベースに接続できません。：'.mysqli_connect_error());
}

// mysqli_select_db('oneline_bbs', $link);
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
} elseif (strlen($_POST['comment'] > 200)) {
  $errors['cpmment'] = 'ひとことは200文字以下にしてください';
} else {
  $comment = $_POST['comment'];
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ひとこと掲示板</title>
</head>
<body>
  <h1>ひとこと掲示板</h1>
  <form action="bbs.php" method="post">
  <div>
    名前：<input type="text" name="namr" id="">
  </div>
  <div>
    ひとこと：<input type="text" name="comment" size="60" id="">
  </div>
  <div>
    <input type="submit" value="送信">
  </div>
  </form>
</body>
</html>