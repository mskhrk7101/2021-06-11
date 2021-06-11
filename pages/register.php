<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザ登録画面</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="contact.js"></script>
</head>

<body>
    <div>
        <h1>株式会社 G's ACADEMY-FUKUOKA-</h1>
    </div>
    <div>
        <h2>会員登録フォーム</h2>
    </div>
    <form action="register_act.php" method="POST">
        <fieldset>
            <legend>ユーザ登録画面</legend>
            <div>
                username<span>必須</span> <input type="text" name="username" value="">
            </div>
            <div>
                <label>パスワード<span>必須</span></label>
                <input type="text" name="password">
            </div>
            <div>
                <button>Register</button>
            </div>
            <a href="login.php"> ログイン</a>
        </fieldset>
    </form>

</body>

</html>