<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отписване от бюлетин</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        .unsubscribe-container {
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            text-align: center;
        }
        .unsubscribe-container h1 {
            color: #333;
        }
        .unsubscribe-container form {
            margin-top: 20px;
        }
        .unsubscribe-container input[type="email"] {
            padding: 10px;
            width: 90%;
            margin-bottom: 10px;
        }
        .unsubscribe-container button {
            padding: 10px 20px;
            background-color: #FF0000;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="unsubscribe-container">
        <h1>Отписване от бюлетин Moto Krastev Rent & Tour</h1>
        <p>Моля, въведете вашия имейл адрес, за да се отпишете от нашия бюлетин.</p>
        <form action="unsubscribe-newsletter.php" method="POST">
            <input type="email" name="email" placeholder="Вашият имейл адрес" required>
            <button type="submit" name="submit-unsub">Отпиши ме</button>
        </form>

        <?php
        if(isset($_POST['submit-unsub'])){
            $email_client = $_POST['email'];
            $unsubscribe_date = date("Y-m-d H:i:s");

            $sql_unsub = "UPDATE tbl_subscribers SET
            unsubscribe_date = '$unsubscribe_date',
            status = 'неактивен'
            WHERE email = '$email_client'";

            $res_unsub = mysqli_query($conn, $sql_unsub);

            if($res_unsub){
                echo 'Вие се отписахте успешно.';
            }else{
                echo 'Няма абониран даден e-mail.';
            }
        }
            
        ?>
    </div>
</body>
</html>