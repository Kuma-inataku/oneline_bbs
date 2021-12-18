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
    <?php if(count($errors)): ?>
      <ul class="error_list">
        <?php foreach ($errors as $error): ?>
          <li>
            <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  <div>
    名前：<input type="text" name="name" id="">
  </div>
  <div>
    ひとこと：<input type="text" name="comment" size="60" id="">
  </div>
  <div>
    <input type="submit" value="送信">
  </div>
  </form>
  <?php 
  $sql = "SELECT * FROM `post` ORDER BY `created_at` DESC";
  $result = mysqli_query($link, $sql);

  $posts = [];

  if ($result !== false && mysqli_num_rows($result)) {
    while ($post = mysqli_fetch_assoc($result)) {
      $posts[] = $post;
    }
  }
  ?>
  <?php if(count($posts) > 0): ?>
    <ul>
      <?php foreach($posts as $post): ?>
      <li>
        <?php echo htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8') ?> :
        <?php echo htmlspecialchars($post['comment'], ENT_QUOTES, 'UTF-8') ?> - 
        <?php echo htmlspecialchars($post['created_at'], ENT_QUOTES, 'UTF-8') ?>
      </li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
  <?php 
    mysqli_free_result($result);
    mysqli_close($link);
  ?>
</bodys>
</html>