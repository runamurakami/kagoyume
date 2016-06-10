<?php

//DBへの接続を行う。成功ならPDOオブジェクトを、失敗なら中断、メッセージの表示を行う
function connect2MySQL(){
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=kagoyume_db;charset=utf8','murakami','runrun22');
        //SQL実行時のエラーをtry-catchで取得できるように設定
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die('DB接続に失敗しました。次記のエラーにより処理を中断します:'.$e->getMessage());
    }
}
//レコードの挿入を行う。失敗した場合はエラー文を返却する
function insert_profiles($Username, $password, $mail, $address,$total){
    //db接続を確立
    $insert_db = connect2MySQL();

    //DBに全項目のある1レコードを登録するSQL
    $insert_sql = "INSERT INTO user_t(name,password,mail,address,total,newDate)"
            . "VALUES(:name,:password,:mail,:address,:total,:newDate)";

    //現在時をdatetime型で取得
    $datetime =new DateTime();
    $date = $datetime->format('Y-m-d H:i:s');

    //クエリとして用意
    $insert_query = $insert_db->prepare($insert_sql);

    //SQL文にセッションから受け取った値＆現在時をバインド
    $insert_query->bindValue(':name',$Username);
    $insert_query->bindValue(':password',$password);
    $insert_query->bindValue(':mail',$mail);
    $insert_query->bindValue(':address',$address);
        $insert_query->bindValue(':total',$total);
    $insert_query->bindValue(':newDate',$date);

    //SQLを実行
    try{
        $insert_query->execute();
    } catch (PDOException $e) {
        //接続オブジェクトを初期化することでDB接続を切断
        $insert_db=null;
        return $e->getMessage();
    }

    $insert_db=null;
    return null;
}

function login($Username,$password ){
    //db接続を確立
    $login_db = connect2MySQL();

    //DBに全項目のある1レコードを登録するSQL
    $login_sql = "SELECT * FROM user_t WHERE name = :name and password = :password";

    //クエリとして用意
    $login_query = $login_db->prepare($login_sql);

    //SQL文に受け取った値＆現在時をバインド
    $login_query->bindValue(':name',$Username);
    $login_query->bindValue(':password',$password);

    //SQLを実行
    try{
        $login_query->execute();
    } catch (PDOException $e) {
        //接続オブジェクトを初期化することでDB接続を切断
        $login_db=null;
        return $e->getMessage();
    }
    return $login_query->fetchall(PDO::FETCH_ASSOC);
}

function profile_detail($userID){
    //db接続を確立
    $detail_db = connect2MySQL();

    $detail_sql = "SELECT * FROM user_t WHERE userID=:userID";

    //クエリとして用意
    $detail_query = $detail_db->prepare($detail_sql);

    $detail_query->bindValue(':userID',$userID);

    //SQLを実行
    try{
        $detail_query->execute();
    } catch (PDOException $e) {
        $detail_query=null;
        return $e->getMessage();
    }

    $result = $detail_query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

//レコードの更新を行う。失敗した場合はエラー文を返却する
function update_profile($userID, $Username, $password, $mail, $address){
    //db接続を確立
    $update_db = connect2MySQL();

    //DBに全項目のある1レコードを登録するSQL
    $update_sql = "UPDATE user_t SET name = :name, password = :password, mail = :mail,"
            . " address = :address, newDate = :newDate WHERE userID = :userID";

    //現在時をdatetime型で取得
    $datetime =new DateTime();
    $date = $datetime->format('Y-m-d H:i:s');

    //クエリとして用意
    $update_query = $update_db->prepare($update_sql);

    //SQL文に受け取った値＆現在時をバインド
    $update_query->bindValue(':userID',$userID);
    $update_query->bindValue(':name',$Username);
    $update_query->bindValue(':password',$password);
    $update_query->bindValue(':mail',$mail);
    $update_query->bindValue(':address',$address);
    $update_query->bindValue(':newDate',$date);

    //SQLを実行
    try{
        $update_query->execute();
    } catch (PDOException $e) {
        //接続オブジェクトを初期化することでDB接続を切断
        $update_db=null;
        return $e->getMessage();
    }

    $update_db=null;
    return null;
}

function delete_profile($id){
    //db接続を確立
    $delete_db = connect2MySQL();

    $delete_sql = "DELETE FROM user_t WHERE userID=:id";

    //クエリとして用意
    $delete_query = $delete_db->prepare($delete_sql);

    $delete_query->bindValue(':id',$id);

    //SQLを実行
    try{
        $delete_query->execute();
    } catch (PDOException $e) {
        $delete_query=null;
        return $e->getMessage();
    }
    return null;
}
//レコードの挿入を行う。失敗した場合はエラー文を返却する
function insert_item($userID, $total, $type){
    //db接続を確立
    $item_db = connect2MySQL();

    //DBに全項目のある1レコードを登録するSQL
    $item_sql = "INSERT INTO buy_t(userID,total,type,buyDate)"
            . "VALUES(:userID,:total,:type,:buyDate)";

    //現在時をdatetime型で取得
    $datetime =new DateTime();
    $date = $datetime->format('Y-m-d H:i:s');

    //クエリとして用意
    $item_query = $item_db->prepare($item_sql);

    //SQL文にセッションから受け取った値＆現在時をバインド
    $item_query->bindValue(':userID',$userID);
    $item_query->bindValue(':total',$total);
    $item_query->bindValue(':type',$type);
    $item_query->bindValue(':buyDate',$date);

    //SQLを実行
    try{
        $item_query->execute();
    } catch (PDOException $e) {
        //接続オブジェクトを初期化することでDB接続を切断
        $item_db=null;
        return $e->getMessage();
    }

    $item_db=null;
    return null;
}
//レコードの挿入を行う。失敗した場合はエラー文を返却する
function insert_total($total,$userID){
    //db接続を確立
    $total_db = connect2MySQL();

    //DBに全項目のある1レコードを登録するSQL
    $total_sql = "UPDATE user_t SET total = total + :total WHERE userID = :userID";
    //クエリとして用意
    $total_query = $total_db->prepare($total_sql);

    //SQL文にセッションから受け取った値＆現在時をバインド
    $total_query->bindValue(':total',$total);
    $total_query->bindValue(':userID',$userID);


    //SQLを実行
    try{
        $total_query->execute();
    } catch (PDOException $e) {
        //接続オブジェクトを初期化することでDB接続を切断
        $total_db=null;
        return $e->getMessage();
    }

    $total_db=null;
    return null;
}
