<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Абониране за Moto Krastev</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .container h1 {
            color: #4CAF50;
            margin-bottom: 20px;
        }
        .container p {
            font-size: 1.2em;
            color: #333;
        }

        .container .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
    </style>
    <script>
            let timeleft = 8;
            let downloadTimer = setInterval(function(){
            if(timeleft <= 0){
                clearInterval(downloadTimer);
                window.location.href = "<?php if(isset($_SESSION['url-previous'])){
                                            echo $_SESSION['url-previous'];
                                        } ?>"
            } else {
                document.getElementById("js-countdown-seconds").innerHTML = timeleft + " секунди";
            }
            timeleft -= 1;
            }, 1000);
    </script>
</head>
<body>
    <div class="container">
        
        <h1>
            <?php
                if(isset($_SESSION['header-email'])){
                    echo $_SESSION['header-email'];
                    unset($_SESSION['header-email']);
                }
            ?>
        </h1>
        <p>
            <?php
                if(isset($_SESSION['sub-message'])){
                    echo $_SESSION['sub-message'];
                    unset($_SESSION['sub-message']);
                }
            ?>
        </p>
        <p>Ще бъдете пренасочени обратно към предишната страница след <span id="js-countdown-seconds">8 секунди</span>.</p>
        <a href="<?php if(isset($_SESSION['url-previous'])){
                                            echo $_SESSION['url-previous'];
                                            unset($_SESSION['url-previous']);
                                                                            } ?>"
                                         class="button">Върнете се към предишната страница</a>
    </div>
</body>
</html>