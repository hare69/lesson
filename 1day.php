<?php
    $d = db();
    $page = 0;

    // name.textが入ったら追加
    if(isset($_POST['btn'])){
    if(isset($_POST["name"]) && isset($_POST["text"])){
            $name = $_POST["name"];
            $text = $_POST["text"];
        
            $sql = 'INSERT INTO test (name, text) VALUES (:name, :text)'; //実行したいSQL文
            $stmt = $d->prepare($sql);
        
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':text', $text);
        
            $stmt->execute();//実行
        }
    }

    //editボタン押したら編集画面に
        if(isset($_POST['edit'])){
          $page = 1;
          
        }
          if(isset($_POST['edi'])){
            $i = $_POST['id'];
            $name = $_POST['name'];
            $text = $_POST['text'];
          
            $sql = "UPDATE test SET  name ='" . $name . "' ,  text='" . $text . "' WHERE id = " . $i . " ";
         
            $stmt = $d->prepare($sql);
            $stmt->execute();//実行
            }
        
       
 // editボタン押したら削除
        if(isset($_POST['del'])){
            $i = $_POST['id'];

            $sql = "DELETE FROM test WHERE id = '" . $i . "'";
            $stmt = $d->prepare($sql);
            $stmt->execute();//実行
        }

        


        $sql = 'SELECT * FROM test ORDER BY id DESC'; //実行したいSQL文
        $stmt = $d->query($sql); //実行
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //結果を受け取る

    ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="1day.php" method="POST">
    <h1>作成フォーム</h1>
    <p>お名前：</p>
    <input type="text" name="name">
    <p>ひとこと：</p>
    <input type="text" name="text">
    <input type="submit" value="送信" name="btn">
    </form>

        <table border="1">
            <tr>
                 <th>編集</th>
                <th>id</th>
                <th>お名前</th>
                <th>ひとこと</th>
            </tr>
            <?php foreach($result as $data){ ?>
            <tr>
                <td>
                <form action="1day.php" method="POST">
                <input type="submit" name="edit" value="編集">
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                </form>
                </td>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo $data['text']; ?></td>
                <td>
                <form action="1day.php" method="POST">
                <input type="submit" name="del" value="削除">
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                </form>
                </td>
         
            </tr>
            <?php } ?>
        </table>


    <?php if($page === 1){ ?>
    <h1>更新フォーム</h1>
        <form action="1day.php" method="POST">
       
    

            <p>お名前：</p>
            <input type="text" name="name" value="<?php echo $data['name']; ?>">
        
            <p>ひとこと：</p>
            <input type="text" name="text" value="<?php echo $data['text']; ?>">
    
            <input type="submit" name="edi" value="送信">
            <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">



        </form>
       <?php } ?>


    <!-- // $stmt->execute($params);

    // db("INSERT INTO test (name, text) VALUES (:name, :text)" , $params);

   

    // 挿入する値を配列に格納する
     
     
    // 挿入する値が入った変数をexecuteにセットしてSQLを実行
   
    // 登録完了のメッセージ
    // echo '登録完了しました';


    // db('select * FROM test');

    



    ?> -->

</body>
</html>

<?php  
    function db(){
        $dsn = 'mysql:host=localhost;dbname=test;charset=UTF8';//文字コード絶対！
        $user = 'root';
        $pass = 'root';

        try{
            $dbh = new PDO($dsn,$user,$pass,[ //接続
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]); //接続する
            return $dbh;
            }catch(PDOException $e){
            echo '接続失敗',$e->getMessage();
            exit();
            }
    }