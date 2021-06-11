<?php
// var_dump($_POST);
// exit();
session_start();
include('functions.php');
check_session_id();

$pdo = connect_to_db();
// 

if (
    !isset($_POST['name']) || $_POST['name'] == '' ||
    !isset($_POST['furigana']) || $_POST['furigana'] == '' ||
    !isset($_POST['email']) || $_POST['email'] == '' ||
    !isset($_POST['tel']) || $_POST['tel'] == '' ||
    !isset($_POST['sex']) || $_POST['sex'] == '' ||
    !isset($_POST['item']) || $_POST['item'] == '' ||
    !isset($_POST['content']) || $_POST['content'] == '' ||
    !isset($_POST['username']) || $_POST['username'] == '' ||
    !isset($_POST['password']) || $_POST['password'] == ''
) {
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

// exit('ok');

$name = $_POST['name'];
$furigana = $_POST['furigana'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$sex = $_POST['sex'];
$item = $_POST['item'];
$content = $_POST['content'];
$username = $_POST['username'];
$password = $_POST['password'];

// exit('ok');
$pdo = connect_to_db();

try {
    $pdo = new PDO('mysql:dbname=gsacf_09;charset=utf8;port=3306;host=localhost', 'root', '');
} catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
}
// exit('ok');

$sql = 'UPDATE contactForm2_table SET name=:name, furigana=:furigana, email=:email, tel=:tel, sex=:sex, item=:item, content=:content, created_at=sysdate(), updated_at=sysdate(), WHERE id=:id';

// exit('ok');

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':furigana', $furigana, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
$stmt->bindValue(':sex', $sex, PDO::PARAM_STR);
$stmt->bindValue(':item', $item, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute();

// exit('ok');

if ($status == false) {
    $error = $stmt->errorInfo();
    exit('QueryError:' . $error[2]);
} else {
    header("Location:select.php");
    exit;
}
