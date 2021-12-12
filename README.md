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


