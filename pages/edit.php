 <?php
    // var_dump($_GET);
    // exit();
    session_start();
    include('functions.php');
    check_session_id();

    $id = $_GET['id'];
    // echo $id;
    // exit('ok');


    $pdo = connect_to_db();


    try {
        $pdo = new PDO('mysql:dbname=gsacf_09;charset=utf8;port=3306;host=localhost', 'root', '');
    } catch (PDOException $e) {
        echo json_encode(["db error" => "{$e->getMessage()}"]);
        exit();
    }
    $sql = 'SELECT * FROM contactForm2_table WHERE id=:id';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $status = $stmt->execute();

    // exit('ok');

    $view = '';
    if ($status == false) {
        $error = $stmt->errorInfo();
        // exit('ErrorQuery:' . $error[2]);
        echo json_encode(["error_msg" => "{$error[2]}"]);
        exit();
    } else {
        $row = $stmt->fetch();
        $row['sex'] = '男性' or '';

        $row['item'] = 'seleed';
    }
    ?>
 <!DOCTYPE html>
 <html lang="ja">

 <head>
     <meta charset="UTF-8">
     <title>登録情報一覧</title>
     <link rel="stylesheet" href="style.css">
     <script type="text/javascript" src="contact.js"></script>
 </head>

 <body>
     <div>
         <h1>株式会社 G's ACADEMY-FUKUOKA-</h1>
     </div>
     <div>
         <h2>登録情報一覧</h2>
     </div>
     <div>
         <form action="update.php" method="post" name="form" onsubmit="return validate()">
             <h1 class="contact-title">会員登録 内容入力</h1>
             <p>お客様情報をご入力の上、「確認画面へ」ボタンをクリックしてください。</p>
             <div>
                 <div>
                     <label>お名前</label>
                     <input type="text" name="name" placeholder="例）山田太郎" value="<?= $row['name'] ?>">
                 </div>
                 <div>
                     <label>ふりがな</label>
                     <input type="text" name="furigana" placeholder="例）やまだたろう" value="<?= $row['furigana'] ?>">
                 </div>
                 <div>
                     <label>メールアドレス</label>
                     <input type="text" name="email" placeholder="例）kutsuo@example.com" value="<?= $row['email'] ?>">
                 </div>
                 <div>
                     <label>電話番号</label>
                     <input type="text" name="tel" placeholder="例）0000000000" value="<?= $row['tel'] ?>">
                 </div>
                 <div>
                     <label>性別</label>
                     <input type="radio" name="sex" value="男性" checked="<?= $row['sex'] ?>"> 男性
                     <input type="radio" name="sex" value="女性" checked="<?= $row['sex'] ?>"> 女性
                 </div>
                 <div>
                     <label>好きな👟ブランド</label>
                     <select name="item" value="" selected="<?= $row['item'] ?>">
                         <option value="">項目を選択してください</option>
                         <option value="NIKE" selected="<?= $row['item'] ?>">NIKE</option>
                         <option value="addidas" selected="<?= $row['item'] ?>">addidas</option>
                         <option value="その他" selected="<?= $row['item'] ?>">その他</option>
                     </select>
                 </div>
                 <div>
                     <label>理由</label>
                     <textarea name="content" rows="5" placeholder="内容を入力" input name="content" oncopy="return false" onpaste="return false" oncontextmenu="return false" type="text"><?= $row['content'] ?></textarea>
                 </div>
             </div>
             <input type="hidden" name="id" value="<?= $row['id'] ?>">
             <button type="submit">確認画面へ</button>
         </form>
     </div>
 </body>

 </html>