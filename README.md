# oneline_bbs
パーフェクトPHP学習

# 書籍との差分

## 全体
### phpcsに基づいた可読性の向上
ex.
```
if(!$link){
```
↓
```
if (! $link) {
```

※(の前、)の後を1文字開ける

### ifの使い方（主にバリデーション）
* elseは使わずにエラー処理時はif(!~)などで早々にエラー処理する

 * ソースコード読者が正常処理だけに意識すればいいように考慮

ex.
```
if ( // エラー条件1 ) {
  // エラー処理1
} elseif (エラー条件2) {
  // エラー処理2
} else {
  正常処理
}
```
↓
```
if ( // エラー条件1 ) {
  // エラー処理1
} elseif (エラー条件2) {
  // エラー処理2
}

正常処理
```

### 非推奨記述の変更
ex.

mysql_connect → mysqli_connect

### DB保存時
```
if (count($errors) === 0) {
  $sql = "INSERT INTO `post` (`name`, `comment`, `created_at`) VALUES ('"
  .mysqli_real_escape_string($link, $name)."','"
  .mysqli_real_escape_string($link, $comment)."','"
  .date('Y-m-d H:i:s')."')";
}
```

* $errorsで常にエラーメッセージを意識しないといけないのはキツイ
* foreachで回すとか、そもそもオブジェクト指向で全体を書くとか

 
## 書籍のミス修正

```
$link = mysqli_connect('localhost', 'root', '');

if (! $link) {
  die('データベースに接続できません。：' . mysqli_error($link));
}
```
↓
```
$link = mysqli_connect('localhost', 'root', '');

if (! $link) {
  die('データベースに接続できません。：'.mysqli_connect_error());
}
```

* $linkには\mysqli|false|nullが返ってくる
* しかし、if文の条件でif (! $link) { にしてしまうと、if文内の$linkはfalse|nullしか返さなくなりエラーが発生
* mysqli_connect_error()メソッドを用いて解決

### DB選択
```
mysqli_select_db('oneline_bbs', $link);
↓
mysqli_select_db($link, 'oneline_bbs');
```

* 引数が逆

### SQL設定
```
.mysqli_real_escape_string($name)."','"
.mysqli_real_escape_string($comment)."','"
↓  
.mysqli_real_escape_string($link, $name)."','"
.mysqli_real_escape_string($link, $comment)."','"
```

* 引数不足


