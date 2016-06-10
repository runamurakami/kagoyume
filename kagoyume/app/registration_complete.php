<?php require_once '../util/scriptUtil.php'; ?>
<?php require_once '../util/dbaccessUtil.php'; ?>
<?php require_once '../util/defineUtil.php'; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
      <title>登録結果画面</title>
</head>
    <body>
    <?php
    if(!(isset($_POST['mode']) && $_POST['mode']!="RESULT")){
        echo 'アクセスルートが不正です。もう一度トップページからやり直してください<br>';
    }else{


        $Username = $_SESSION['Username'];
        $password = $_SESSION['password'];
        $mail = $_SESSION['mail'];
        $address = $_SESSION['address'];

        //データのDB挿入処理。エラーの場合のみエラー文がセットされる。成功すればnull
        $result = insert_profiles($Username, $password, $mail, $address,$total=0);

        //エラーが発生しなければ表示を行う
        if(!isset($result)){
        ?>
        <h1>登録結果画面</h1><br>
        ユーザー名:<?php echo $Username;?><br>
        password:<?php echo $password;?><br>
        メールアドレス:<?php echo $mail;?><br>
        住所:<?php echo $address;?><br><br>
        以上の内容で登録しました。<br>
        <?php
        }else{
            echo 'データの挿入に失敗しました。次記のエラーにより処理を中断します:'.$result;
        }
        //セッションを破棄
        //session_clear();
    }
    echo return_top();
    ?>
    </body>
</html>
