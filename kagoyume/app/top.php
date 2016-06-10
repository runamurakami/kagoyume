<?php require_once("../util/scriptUtil.php");//共通ファイル読み込み(使用する前に、appidを指定してください。)
      require_once("../util/defineUtil.php");
      session_start();
/** @mainpage
 *  商品検索フォームを表示
 */

/**
 * @file
 * @brief 商品検索フォームを表示
 *
 * 商品検索フォームを表示し、
 * フォームから入力された値を条件に、検索APIを利用して、検索した結果をhtmlに埋め込んで表示します。
 * 検索結果に対して、カテゴリーによる絞り込みと、並び順の変更ができます。
 *
 * PHP version 5
 */

$hits = array();
$query = !empty($_GET["query"]) ? $_GET["query"] : "";
$sort =  !empty($_GET["sort"]) && array_key_exists($_GET["sort"], $sortOrder) ? $_GET["sort"] : "-score";
$category_id = isset($_GET["category_id"]) && array_key_exists($_GET["category_id"], $categories) ? $_GET["category_id"] : 1;

if ($query != "") {
    $query4url = rawurlencode($query);
    $sort4url = rawurlencode($sort);
    $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/itemSearch?appid=$appid&query=$query4url&category_id=$category_id&sort=$sort4url";
    $xml = simplexml_load_file($url);
    if ($xml["totalResultsReturned"] != 0) {//検索件数が0件でない場合,変数$hitsに検索結果を格納します。
        $hits = $xml->Result->Hit;
    }
}
  if(isset($_POST['logout'])&& $_POST['logout']=='logout'){
    session_unset();
  }
  if(isset($_SESSION['login_key'])== 'login_key'){
    echo 'ようこそ'?><a href="./my_data.php?id=<?php $_SESSION['userID']?>">
      <?php echo $_SESSION['Username']; ?></a><?php echo 'さん'; ?>

      <form action="./cart.php" method="POST">
      <input type="submit" name="cort" value="買い物カゴ"/>
    </form>
      <form action="./top.php" method="POST">
      <input type="submit" name="logout" value="ログアウト"/>
      <input type="hidden" name="logout" value="logout">
      </form>
  <?php
  }else{
    echo 'ようこそゲストさん';?>
    <form action="./login.php" method="POST">
    <input type="submit" name="login" value="ログイン"/>
    </form>
<?php
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <title>ショッピングデモサイト - 商品を検索する</title>
    <link rel="stylesheet" type="text/css" href="../css/prototype.css"/>
  </head>
      <body>
        <h3>ここでは、shoppingを行うことができます。</h3><br>
          <form action="./search.php" class="Search" method="GET">
          <!--<h1><a href="./ItemSearchForm.php">ショッピングデモサイト - 商品を検索する</a></h1>
          <form action="./ItemSearchForm.php" class="Search">-->
          表示順序:
          <select name="sort">
          <?php foreach ($sortOrder as $key => $value) { ?>
          <option value="<?php echo h($key); ?>" <?php if($sort == $key) echo "selected=\"selected\""; ?>><?php echo h($value);?></option>
          <?php } ?>
          </select>
          キーワード検索：
          <select name="category_id">
          <?php foreach ($categories as $id => $name) { ?>
          <option value="<?php echo h($id); ?>" <?php if($category_id == $id) echo "selected=\"selected\""; ?>><?php echo h($name);?></option>
          <?php } ?>
          </select>
          <input type="text" name="query" value="<?php echo h($query); ?>"/>
          <input type="submit" value="Yahooショッピングで検索"/>
          </form>
          <?php foreach ($hits as $hit) { ?>
          <div class="Item">
              <h2><a href="<?php echo h($hit->Url); ?>"><?php echo h($hit->Name); ?></a></h2>
              <p><a href="<?php echo h($hit->Url); ?>"><img src="<?php echo h($hit->Image->Medium); ?>" /></a><?php echo h($hit->Description); ?></p>
          </div>
          <?php } ?>
  <!-- Begin Yahoo! JAPAN Web Services Attribution Snippet -->
  <a href="http://developer.yahoo.co.jp/about">
  <img src="http://i.yimg.jp/images/yjdn/yjdn_attbtn2_105_17.gif" width="105" height="17" title="Webサービス by Yahoo! JAPAN" alt="Webサービス by Yahoo! JAPAN" border="0" style="margin:15px 15px 15px 15px"></a>
  <!-- End Yahoo! JAPAN Web Services Attribution Snippet -->
      </body>
  </html>
