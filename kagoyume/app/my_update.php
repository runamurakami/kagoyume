<?php
require_once '../util/defineUtil.php';
require_once '../util/scriptUtil.php';
require_once '../util/dbaccessUtil.php';
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
      <title>変更入力画面</title>
</head>
<body>
    <?php
    //アクセスルート固定のためmodeがPOSTされている　かつ　POST値がUPDATEの場合のみ表示
    if(!isset($_POST['mode']) || $_POST['mode']!="UPDATE"){
        echo '不正なリクエストです<br>';
    }else{
        //セッションからの値を格納
        $userID = form_value('userID');
        $Username = form_value('name');
        $password = form_value('password');
        $mail = form_value('mail');
        $address = form_value('address');

    ?>
        <form action="<?php echo MY_UPDATE_RESULT ?>" method="POST">
          ユーザー名:
          <input type="text" name="name" value="<?php echo $Username; ?>">
          <br><br>

          password:
          <input type="text" name="password" value="<?php echo $password; ?>">
          <br><br>

          mailaddres:
          <input type="text" name="mail" value="<?php echo $mail; ?>">
          <br><br>

          住所:
          <input type="text" name="address" value="<?php echo $address; ?>">
          <br><br>

            <input type="hidden" name="mode"  value="UPDATE_RESULT">
            <input type="hidden" name="userID"  value="<?php echo $userID;?>">
            <input type="submit" name="btnSubmit" value="以上の内容で更新を行う">
        </form>
        <form action="<?php echo MYDATA; ?>?id=<?php echo $userID;?>" method="POST">
          <input type="submit" name="NO" value="詳細画面に戻る"style="width:100px">
        </form>
    <?php
    }
    echo return_top(); ?>
</body>

</html>
