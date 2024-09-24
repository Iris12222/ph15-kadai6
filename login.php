<?php

require_once __DIR__ . '/functions/user.php';

session_start();

$errorMessages = [];

$email = '';

if (isset($_POST['submit-button'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $isRememberMe = isset($_POST['remember-me']);

    if (empty($email)) {
        $errorMessages['email'] = 'メールアドレスを入力してください';
    }
    if (empty($password) || strlen($password) < 8) {
        $errorMessages['password'] = 'パスワードは8文字以上で入力してください';
    }

    if (empty($errorMessages)) {
        $user = login($email, $password);

        if (!is_null($user)) {
            $_SESSION['id'] = $user['id'];

            if ($isRememberMe) {
                setcookie('id', $user['id'], time() + 60 * 60, '/');
            }

            header('Location: ./my-page.php');
            exit();
        }

        $errorMessages['result'] = '一致するユーザーが見つかりませんでした';
    }
}
?>

<html>
<head>
        <style>
            body {
                font-family: 'Comic Sans MS', cursive, sans-serif;
                background-color: #FFFAF0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            h1 {
                color: #FF69B4;
                text-align: center;
                font-size: 28px;
            }

            .login-container {
                background-color: #FFF0F5;
                padding: 25px;
                border-radius: 15px;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
                width: 320px;
                border: 3px solid #FFB6C1;
            }

            .login-container div {
                margin-bottom: 15px;
            }

            input[type="email"], input[type="password"], input[type="submit"] {
                width: 100%;
                padding: 12px;
                margin-top: 5px;
                border: 2px solid #FFB6C1;
                border-radius: 12px;
                box-sizing: border-box;
                background-color: #FFF;
                font-size: 16px;
            }

            input[type="checkbox"] {
                margin-right: 5px;
            }

            input[type="submit"] {
                background-color: #FF69B4;
                color: white;
                border: none;
                cursor: pointer;
                font-size: 18px;
                transition: background-color 0.3s;
            }

            input[type="submit"]:hover {
                background-color: #FF1493;
            }

            label {
                font-size: 16px;
                color: #FF69B4;
            }

            p {
                color: red;
                font-size: 14px;
                margin: 0;
            }

            a {
                color: white; /* 将文字颜色改为白色 */
                text-decoration: none;
                font-size: 16px;
            }

            a:hover {
                text-decoration: underline;
            }

            button {
                width: 100%;
                padding: 12px;
                background-color: #FF69B4;
                color: white;
                border: none;
                border-radius: 12px;
                cursor: pointer;
                font-size: 18px;
                transition: background-color 0.3s;
                text-align: center;
                margin-top: 10px;
            }

            button:hover {
                background-color: #FF1493;
            }

            /* 可爱的表单装饰 */
            .login-container {
                position: relative;
            }

            .login-container::before {
                content: "🐻";
                font-size: 48px;
                position: absolute;
                top: -60px;
                left: calc(50% - 24px);
            }

            /* 可爱的背景星星 */
            body::before {
                content: "✨";
                font-size: 80px;
                position: absolute;
                top: 20px;
                right: 20px;
                opacity: 0.8;
            }

            body::after {
                content: "✨";
                font-size: 80px;
                position: absolute;
                bottom: 20px;
                left: 20px;
                opacity: 0.8;
            }
        </style>
    </head>
    <body>
        <h1>ログイン</h1>
        <?php if (isset($errorMessages['result'])): ?>
            <p><?php echo $errorMessages['result'] ?></p>
        <?php endif ?>
        <form action="./login.php" method="post">
            <div>
                メールアドレス<br>
                <input type="email" name="email" value="<?php echo $email ?>">
                <?php if (isset($errorMessages['email'])): ?>
                    <p><?php echo $errorMessages['email'] ?></p>
                <?php endif ?>
            </div>
            <div>
                パスワード<br>
                <input type="password" name="password">
                <?php if (isset($errorMessages['password'])): ?>
                    <p><?php echo $errorMessages['password'] ?></p>
                <?php endif ?>
            </div>
            <div>
                <label>
                    <input type="checkbox" name="remember-me">
                    ログイン状態を保存する
                </label>
            </div>
            <div>
                <input type="submit" value="ログイン" name="submit-button">
            </div>
            <div>
                <button><a href="./register.php">会員登録はコチラ</button>

            </div>
        </form>
    </body>
</html>
