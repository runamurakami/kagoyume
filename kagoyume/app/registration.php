<?php require_once '../util/defineUtil.php'; ?>
<?php require_once '../util/scriptUtil.php'; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>新規登録画面</title>
  </head>
  <body>
    <form action="<?php echo REGISTRATION_CONFIRM ?>" method="POST">

        ユーザー名:
        <input type="text" name="Username" value="<?php echo form_value('Username'); ?>">
        <br><br>

        password:
        <input type="text" name="password" value="<?php echo form_value('password'); ?>">
        <br><br>

        mailaddres:
        <input type="text" name="mail" value="<?php echo form_value('mail'); ?>">
        <br><br>

        住所:
        <input type="text" name="address" value="<?php echo form_value('address'); ?>">
        <br><br>

　　　　　<input type="hidden" name="mode" value="REGISTRATION_CONFIRM">　
        <input type="submit" name="btnSubmit" value="登録する">
    </form>
    <?php echo return_top(); ?>

  </body>
</html>
