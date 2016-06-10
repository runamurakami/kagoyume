<?php
require_once '../util/scriptUtil.php';//共通ファイル読み込み(使用する前に、appidを指定してください。)
require_once '../util/defineUtil.php';
session_start();

//var_dump($_POST['item']);

if(isset($_SESSION['login_key'])== 'login_key'){
  echo 'ようこそ'?><a href="./my_data.php?id=<?php $_SESSION['userID']?>">
    <?php echo $_SESSION['Username']; ?></a><?php echo 'さん'; ?>

    <form action="cort.php" method="POST">
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
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <table border=1>
              <tr>
                  <th>写真</th>
                  <th>商品名</th>
                  <th>価格</th>
                  <th>個数</th>
              </tr>
              <?php
              $sum = 0;
              foreach($_SESSION['add_cart'] as $key => $value){  ?>
                  <tr>
                      <td>  <img src= "<?php echo $value['image'];?>"/></td>
                      <td><?php echo $value['name'];?></td>
                      <td><?php echo $value['price'].'円';?></td>
                      <td><?php echo $value['qty'].'個'?></td>
                  </tr>
              <?php
              $sum += $value['price']*$value['qty'];
            }
            echo "合計:".$sum."円";
            $_SESSION['total'] = $sum;
            ?>
            <form class="" action="./buy_complete.php" method="post">
            <br>
                <?php
                for($i = 1; $i<=3; $i++){ ?>
                  <input type="radio" name="type" value="<?php echo $i; ?>"<?php if($i==form_value('type')){echo "checked";}?>><?php echo ex_typenum($i);?><br>
                <?php } ?>
            <br>

              <input type="submit" name="buy" value="購入を確定">
              <input type="hidden" name="buy" value="">
            </form>

　　　   <?php echo return_top(); ?>
    </table>
</html>
