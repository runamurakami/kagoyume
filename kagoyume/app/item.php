<?php
require_once '../util/scriptUtil.php';//共通ファイル読み込み(使用する前に、appidを指定してください。)
require_once '../util/defineUtil.php';
session_start(); ?>
<html>
<body>
<?php
$hits = array();

if(isset($_GET['item'])){
  $itemcode = $_GET['item'];
};

$itemcode = rawurlencode($itemcode);
    $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/itemLookup?appid=$appid&itemcode=$itemcode&responsegroup=large";
    $xml = simplexml_load_file($url);
    $hits = $xml->Result->Hit;
    //var_dump($hits);

    /*  foreach ($hits as $hit) { ?>
    <div class="Item">
        <h2><a href="<?php echo h($hit);?>"><?php echo h($hit->Name); ?></a></h2>
       <p><a href="<?php echo h($hit); ?>"></a>価格<?php echo h($hit->Price); ?>円</p>
       <p><a href="<?php echo h($hit); ?>"><img src="<?php echo h($hit->Image->Medium); ?>"/></a></p>
    </div>
     <?php } */?>

<?php
    if(isset($_SESSION['login_key'])== 'login_key'){
      echo 'ようこそ'?><a href="./my_data.php?id=<?php $_SESSION['userID']?>">
        <?php echo $_SESSION['Username']; ?></a><?php echo 'さん'; ?>

        <form action="cart.php" method="POST">
        <input type="submit" name="cart" value="買い物カゴ"/>
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
} ?>
    </body>

  </html>



<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
        <title>ショッピングデモサイト - 設定した値で商品リストを表示する - 「<?php echo h($query); ?>」の検索結果</title>
        <link rel="stylesheet" type="text/css" href="../css/prototype.css"/>
    </head>
    <body>
        <h1><a href="./search.php">ショッピングデモサイト - 検索結果</a></h1>
        <img src="<?php echo h($hits->Image->Small); ?>"/><br>
        名前:<?php echo h($hits->Name); ?><br>
        価格:<?php echo h($hits->Price); ?>円<br>
        評価:<?php echo h($hits->Review->Rate); ?><br>
      <form action="./add.php?itemcode=<?php echo $itemcode; ?>" method="post">
        <input type="submit" name="add_cart" value="カートに入れる">
        <input type="hidden" name="item"value="<?php echo $itemcode ?>">
      </form>
      <?php echo return_top(); ?>
    </body>
<!-- Begin Yahoo! JAPAN Web Services Attribution Snippet -->
<a href="http://developer.yahoo.co.jp/about">
<img src="http://i.yimg.jp/images/yjdn/yjdn_attbtn2_105_17.gif" width="105" height="17" title="Webサービス by Yahoo! JAPAN" alt="Webサービス by Yahoo! JAPAN" border="0" style="margin:15px 15px 15px 15px"></a>
<!-- End Yahoo! JAPAN Web Services Attribution Snippet -->
</html>
