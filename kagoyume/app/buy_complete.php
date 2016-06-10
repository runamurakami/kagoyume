<?php require_once '../util/scriptUtil.php'; ?>
<?php require_once '../util/dbaccessUtil.php';
      require_once '../util/defineUtil.php';
      session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
      <title>購入結果画面</title>
</head>
    <body>
    <?php
     $_SESSION['type'] = $_POST['type'];
    //if(!(isset($_POST['mode']) && $_POST['mode']!="RESULT")){
        //echo 'アクセスルートが不正です。もう一度トップページからやり直してください<br>';
    //}else{
   if(isset($_SESSION['total'])){
        $userID = $_SESSION['userID'];
        $total = $_SESSION['total'];
        $type = $_SESSION['type'];
        //データのDB挿入処理。エラーの場合のみエラー文がセットされる。成功すればnull
        $result = insert_item($userID, $total, $type);
        $Total = insert_total($total,$userID);



        //エラーが発生しなければ表示を行う
        if(!isset($result)){
        ?>

        商品の購入が完了しました。<br>
        <?php
        }else{
            echo 'データの挿入に失敗しました。次記のエラーにより処理を中断します:'.$result;
        }
      }
    echo return_top();
    ?>
    </body>
</html>
