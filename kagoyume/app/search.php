<?php
require_once '../util/scriptUtil.php';//共通ファイル読み込み(使用する前に、appidを指定してください。)
require_once '../util/defineUtil.php';
session_start();
/** @mainpage
 *  指定したキーワードで商品を検索、表示
 */

/**
 * @file
 * @brief 指定したキーワードで商品を検索、表示
 *
 * 商品検索APIを使用して、
 * あらかじめ変数$queryに指定したキーワードで商品を検索し,
 * その結果をhtmlに埋め込んで表示します。
 *
 * PHP version 5
 */

$hits = array();
//$query = isset($_GET['query']);//検索したいキーワードを指定してください。
if(isset($_GET['query'])){
  $query = $_GET['query'];
};
//var_dump($query);
if ($query != "") {
    $query4url = rawurlencode($query);
    $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/itemSearch?appid=$appid&query=$query4url";
    $xml = simplexml_load_file($url);
    if ($xml["totalResultsReturned"] != 0) {//検索件数が0件でない場合,変数$hitsに検索結果を格納します。
        $hits = $xml->Result->Hit;
    }
}
if(isset($_SESSION['login_key'])== 'login_key'){
  echo 'ようこそ'?><a href="./my_data.php?id=<?php $_SESSION['userID']?>">
    <?php echo $_SESSION['Username']; ?></a><?php echo 'さん'; ?>

    <form action="cart.php" method="POST">
    <input type="submit" name="cort" value="買い物カゴ"/>
    </form>

    <form action="top.php" method="POST">
    <input type="submit" name="logout" value="ログアウト"/>
    </form>
<?php
}else{
  echo 'ようこそゲストさん';?>
  <form action="login.php" method="POST">
  <input type="submit" name="login" value="ログイン"/>
  </form>
<?php
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
        <title>ショッピングデモサイト - 設定した値で商品リストを表示する - 「<?php echo h($query); ?>」の検索結果</title>
        <link rel="stylesheet" type="text/css" href="../css/prototype.css"/>
    </head>
    <body>
        <h2><a href="./search.php">ショッピングデモサイト - 設定した値で商品リストを表示する - 「<?php echo h($query); ?>」の検索結果</a></h1>
        <?php foreach ($hits as $hit) { ?>
        <div class="Item">
            <h2><a href="./item.php?item=<?php echo h($hit->Code);?>"><?php echo h($hit->Name); ?></a></h2>
           <p><a href="ITEM"><img src="<?php echo h($hit->Image->Medium); ?>" /></a>価格<?php echo h($hit->Price); ?>円</p>
        </div>
        <?php }
        echo return_top();?>

    </body>
<!-- Begin Yahoo! JAPAN Web Services Attribution Snippet -->
<a href="http://developer.yahoo.co.jp/about">
<img src="http://i.yimg.jp/images/yjdn/yjdn_attbtn2_105_17.gif" width="105" height="17" title="Webサービス by Yahoo! JAPAN" alt="Webサービス by Yahoo! JAPAN" border="0" style="margin:15px 15px 15px 15px"></a>
<!-- End Yahoo! JAPAN Web Services Attribution Snippet -->
</html>
