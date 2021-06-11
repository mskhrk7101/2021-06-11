<?php
// var_dump($_POST);
// exit();

session_start();
include('functions.php');

$username = $_POST['username'];
$password = $_POST['password'];

$pdo = connect_to_db();

$sql = 'SELECT * FROM user_table WHERE username=:username AND password=:password AND is_deleted=0';

// exit('ok');

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

// exit('ok');

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $val = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$val) {
        echo '<p>ログインに誤りがあります。</p>';
        echo '<a href="login.php">login</a>';
        exit();
    } else {
        $_SESSION = array();
        $_SESSION['session_id'] = session_id();
        $_SESSION['is_admin'] = $val['is_admin'];
        $_SESSION['username'] = $val['username'];
        header('Location:read.php');
        exit();
    }
}
// exit('ok');
