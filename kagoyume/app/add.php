<?php
require_once '../util/scriptUtil.php';//共通ファイル読み込み(使用する前に、appidを指定してください。)
require_once '../util/defineUtil.php';
session_start();

$hits = array();
if(isset($_POST['item'])){
   $itemcode = $_POST['item'];

    $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/itemLookup?appid=$appid&itemcode=$itemcode";
    $xml = simplexml_load_file($url);
    $hits = $xml->Result->Hit;

//echo "<pre>";
//var_dump($_POST);
//echo "</pre>";
    $name = h($hits->Name);
    $price = h($hits->Price);
    $image = h($hits->Image->Small);

    $_SESSION['add_cart'][$itemcode] = array('name' => $name, 'price' => $price,'image'=> $image ,'qty' => 1);
    var_dump($_SESSION['add_cart'][$itemcode]);
}

//echo "<pre>";
//var_dump($_SESSION);
//echo "</pre>";
if(isset($_SESSION['login_key'])== 'login_key'){
  echo 'ようこそ'?><a href="./mydata.php?id=<?php $_SESSION['userID']?>">
    <?php echo $_SESSION['Username']; ?></a><?php echo 'さん'; ?>

    <form action="<?php echo CART ?>" method="POST">
    <input type="submit" name="cort" value="買い物カゴ"/>
    <input type="hidden" name="item" value="<?php echo $itemcode ?>">

    <form action="top.php" method="POST">
    <input type="submit" name="logout" value="ログアウト"/>
<?php
}else{
  echo 'ようこそゲストさん';?>
  <form action="login.php" method="POST">
  <input type="submit" name="login" value="ログイン"/>
<?php
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
        <title>買い物カゴ</title>
        <link rel="stylesheet" type="text/css" href="../css/prototype.css"/>
    </head>
    <body>

        <h1><a href="./search.php">ショッピングデモサイト </a></h1>
        商品をカートに追加しました。

      <form action="<?php echo CART ?>" method="POST">
        <input type="submit" name="order" value="ご注文手続きへ">
        <input type="hidden" name="item" value="<?php echo $itemcode; ?>">
      </form>
    </body>
    <?php   echo return_top();  ?>
<!-- Begin Yahoo! JAPAN Web Services Attribution Snippet -->
<a href="http://developer.yahoo.co.jp/about">
<img src="http://i.yimg.jp/images/yjdn/yjdn_attbtn2_105_17.gif" width="105" height="17" title="Webサービス by Yahoo! JAPAN" alt="Webサービス by Yahoo! JAPAN" border="0" style="margin:15px 15px 15px 15px"></a>
<!-- End Yahoo! JAPAN Web Services Attribution Snippet -->
</html>
