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
      <title>削除確認画面</title>
</head>
  <body>
    <?php
    //アクセスルート固定のためmodeがPOSTされている　かつ　POST値がUPDATEの場合のみ表示
    if(!isset($_POST['mode']) || $_POST['mode']!="DELETE"){
        echo '不正なリクエストです<br>';
    }else{
        //セッションからの値を格納
        $id = form_value('id');
        $Username = form_value('name');
        $password = form_value('password');
        $mail = form_value('mail');
        $address = form_value('address');
        $newDate = form_value('newDate');
        ?>
        <h1>削除確認</h1>
        このユーザーをマジで削除しますか？
        ユーザー名:<?php echo $Username;?><br>
      　パスワード:<?php echo $password;?><br>
        メールアドレス:<?php echo $mail;?><br>
        住所:<?php echo $address;?><br>
        登録日時:<?php echo date('Y年n月j日　G時i分s秒', strtotime($newDate)); ?><br>

        <form action="<?php echo MY_DELETE_RESULT; ?>" method="POST">
          <input type="hidden" name="mode"  value="DELETE_RESULT">
          <input type="hidden" name="ID"  value="<?php echo $id;?>">
          <input type="submit" name="YES" value="はい"style="width:100px">
        </form><br>
        <form action="<?php echo RESULT_DETAIL; ?>?id=<?php echo $id;?>" method="POST">
          <input type="submit" name="NO" value="詳細画面に戻る"style="width:100px">
        </form>
    <?php
    }
        echo return_top();?>
   </body>
</html>
