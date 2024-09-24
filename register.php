<?php

require_once __DIR__ . '/functions/user.php';

session_start();

if (isset($_POST['submit-button'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $birth = "$year-$month-$day";
    $tel = $_POST['tel'];
    $address = $_POST['address'];
    $password = password_hash($password, PASSWORD_BCRYPT);

    $user = [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'birth' => $birth,
        'tel' => $tel,
        'address' => $address,
    ];

    $user = saveUser($user);

    $_SESSION['id'] = $user['id'];

    header('Location: ./my-page.php') ;
    exit();
}

?>
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

            .register-container {
                background-color: #FFF;
                padding: 25px;
                border-radius: 15px;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
                width: 320px;
                border: 3px solid #FFB6C1;
            }

            .register-container div {
                margin-bottom: 15px;
            }

            input[type="text"], input[type="email"], input[type="password"], input[type="tel"], input[type="address"], select {
                width: 100%;
                padding: 12px;
                margin-top: 5px;
                border: 2px solid #FFB6C1;
                border-radius: 12px;
                box-sizing: border-box;
                background-color: #FFF;
                font-size: 16px;
            }

            input[type="submit"] {
                width: 100%;
                padding: 12px;
                background-color: #FF69B4;
                color: white;
                border: none;
                border-radius: 12px;
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

            .register-container {
                position: relative;
            }

            .register-container::before {
                content: "🐱";
                font-size: 48px;
                position: absolute;
                top: -60px;
                left: calc(50% - 24px);
            }
            body::before {
                content: "💖";
                font-size: 80px;
                position: absolute;
                top: 20px;
                right: 20px;
                opacity: 0.8;
            }
            body::after {
                content: "💖";
                font-size: 80px;
                position: absolute;
                bottom: 20px;
                left: 20px;
                opacity: 0.8;
            }
        </style>
<html>
    <body>
        <h1>会員登録</h1>
        <form action="./register.php" method="post">
            <div>
                お名前<br>
                <input type="text" name="name">
            </div>
            <div>
                メールアドレス<br>
                <input type="email" name="email">
            </div>
            <div>
                パスワード<br>
                <input type="password" name="password">
            </div>
            <div>
                生年月日<br>
                <select name="year" id="year" required>
                    <?php for ($i = 1900; $i <= 2024; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                    ?>
                </select>
                <select name="month" id="month" required>
                    <?php for ($i = 1; $i <= 12; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                    ?>
                </select>
                <select name="day" id="day" required>
                    <?php for ($i = 1; $i <=31; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                    ?>
                </select>
            </div>
            <div>
                電話番号<br>
                <input type="tel" name="tel">
            </div>
            <div>
            区市町村<br>
                <input type="address" name="address">
            </div>
            <div>
                <input type="submit" value="登録" name="submit-button">
            </div>
        </form>
    </body>
</html>
