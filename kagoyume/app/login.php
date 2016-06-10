<?php require_once '../util/defineUtil.php'; ?>
<?php require_once '../util/scriptUtil.php'; ?>
<?php require_once '../util/dbaccessUtil.php'; ?>
<?php
session_start();
$message = '';

if (isset($_POST['Username']) && isset($_POST['password'])){
  $login = login($_POST['Username'],$_POST['password']);
  //ログイン処理
  if ($_POST['Username'] == $login[0]['name']&& $_POST['password'] == $login[0]['password']){
    $_SESSION['login_key'] ='login_key';
    $_SESSION['Username'] = $login[0]['name'];
    $_SESSION['userID'] = $login[0]['userID'];
    $message = 'ログインに成功しました';
    //header("Location: active.php");
  }else {
    $message = 'ユーザー名、パスワードが不正です';
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ログインページ</title>
  </head>
  <body>
    <form class="" action="login.php" method="POST">

        ユーザー名:
        <br>
        <input type="text" name="Username" value="<?php echo form_value('Username');?>">
        <br><br>

        password:
        <br>
        <input type="text" name="password" value="<?php echo form_value('password');?>">
        <br><br>

        <input type="submit" name="btnSubmit" value="ログイン">
        <a href="<?php echo REGISTRATION;?>">新規会員登録</a>
    </form>
    <div><?php echo $message; ?></div>
    <?php echo return_top(); ?>
  </body>
</html>
