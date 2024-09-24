<?php

require_once __DIR__ .'/functions/user.php';

session_start();

if (!isset($_SESSION['id']) && !isset($_COOKIE['id'])) {
    header('Location: ./login.php');
    exit();
}

$id = $_SESSION['id'] ?? $_COOKIE['id'];

$name = $_POST['name'] ?? '名無しさん';

$user = getUser($id);

if (is_null($user)) {
    header('Location: ./login.php');
    exit();
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
                flex-direction: column;
            }

            h1 {
                color: #FF69B4;
                text-align: center;
                font-size: 28px;
            }

            .profile-container {
                background-color: #FFF0F5;
                padding: 25px;
                border-radius: 15px;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
                width: 320px;
                border: 3px solid #FFB6C1;
            }

            table {
                width: 100%;
                margin-bottom: 15px;
                border-collapse: collapse;
            }

            td {
                padding: 10px;
                border: 2px solid #FFB6C1;
                background-color: #FFF;
                font-size: 16px;
                color: #555;
            }

            td:first-child {
                background-color: #FFB6C1;
                font-weight: bold;
                text-align: right;
                color: white;
                border-radius: 8px 0 0 8px;
            }

            td:last-child {
                border-radius: 0 8px 8px 0;
            }

            a {
                display: inline-block;
                padding: 10px 20px;
                background-color: #FF69B4;
                color: white;
                text-decoration: none;
                border-radius: 12px;
                font-size: 16px;
                text-align: center;
                margin-top: 20px;
                transition: background-color 0.3s;
            }

            a:hover {
                background-color: #FF1493;
            }

            .profile-container {
                position: relative;
            }

            .profile-container::before {
                content: "🐰";
                font-size: 48px;
                position: absolute;
                top: -60px;
                left: calc(50% - 24px);
            }

            body::before {
                content: "🌸";
                font-size: 80px;
                position: absolute;
                top: 20px;
                right: 20px;
                opacity: 0.8;
            }

            body::after {
                content: "🌸";
                font-size: 80px;
                position: absolute;
                bottom: 20px;
                left: 20px;
                opacity: 0.8;
            }
        </style>
    <body>
        <h1>マイページ</h1>
        <table>
            <tr>
                <td>ID</td>
                <td>
                    <?php echo $user['id'] ?>
                </td>
            </tr>
            <tr>
                <td>名前</td>
                <td>
                    <?php echo $user['name'] ?>
                </td>
            </tr>
            <tr>
                <td>生年月日</td>
                <td>
                    <?php echo $user['birth'] ?>
                </td>
            </tr>
            <tr>
                <td>メールアドレス</td>
                <td>
                    <?php echo $user['email'] ?>
                </td>
            </tr>
            <tr>
                <td>電話番号</td>
                <td>
                    <?php echo $user['tel'] ?>
                </td>
            </tr>
            <tr>
                <td>区市町村</td>
                <td>
                    <?php echo $user['address'] ?>
                </td>
            </tr>
        </table>
        <div>
            <a href="./logout.php">
                ログアウト
            </a>
        </div>
    </body>
</html>


