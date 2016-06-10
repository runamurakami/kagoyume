<?php
require_once '../util/scriptUtil.php';//共通ファイル読み込み(使用する前に、appidを指定してください。)
require_once '../util/defineUtil.php';
session_start();

//var_dump($_POST['item']);

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
}

if(isset($_POST['empty_cart'])){
    $_SESSION['add_cart'] = NULL;
}
if(isset($_POST['delete_item'])){
    $itemcode = $_POST['itemcode'];
    $itemcode = htmlspecialchars($itemcode, ENT_QUOTES);
    unset($_SESSION['cart'][$itemcode]);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
     $sum = 0;
     if(isset($_SESSION['add_cart'])){ ?>
    <table border=1>
              <tr>
                  <th>写真</th>
                  <th>商品名</th>
                  <th>価格</th>
                  <th>個数</th>
              </tr>
              <?php
              foreach($_SESSION['add_cart'] as $key => $value){  ?>
                  <tr>
                      <td>  <img src= "<?php echo $value['image'];?>"/></td>
                      <td><?php echo $value['name'];?></td>
                      <td><?php echo $value['price'].'円';?></td>
                      <td><?php echo $value['qty'].'個'?></td>
                      <td><form method="POST" action="cart.php">
                            <input type="hidden" name="id" value="' . $itemcode .'">
                            <input type="submit" name="delete_item" value="削除">
                          </form>
                      </td>
                  </tr>
    </table>
    
    <br><br>
    <table>
              <?php
              $sum +=(int)$value['price']*$value['qty'];
            }
            echo "合計:".number_format($sum)."円";
            ?>
            <form class="" action="./buy_confirm.php" method="post">
              <input type="submit" name="buy" value="購入する">
              <input type="hidden" name="buy" value="">
            </form>
            <p>
            <form method="POST" action="cart.php">
              <input type="submit" name="empty_cart" value="カートを空にする">
            </form>
            </p>

            <?php
        }else{
          echo "カートは空です";
        }

          echo return_top();
          ?>
    </table>
</html>
