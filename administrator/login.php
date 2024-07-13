<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Moto Krastev Admin</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body bgcolor="#f5f5f5">
        
    <div class="login-box">
        <div class="title-login-box">
            <h2>Вход за администратори</h2>
            <p>Моля въведете данните за вход!</p>
        </div>

        <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }

        ?>

        <!-- Login form starts here-->
        <form action="" method="post">
            <div class="row">
                Потребителско име: <br>
                <input type="text" name="username" placeholder="Въведи потр. име">
            </div>
            
            <div class="row">
                Парола:  <br>
                <input type="password" name="password" placeholder="Въведи парола">
            </div>
            
            <div class="btn-login-submit">
                <input type="submit" name="submit" value="Влез">
            </div>
            
        </form>
        <!-- Login form ends here-->


        
    </div>

    <div class="coy-info">
        <p class="text-center">Created By <a href="#">Daniel Krastev</a></p>
    </div>
    </body>
</html>

<?php 
//check whetger submit button is clicked or not
if(isset($_POST['submit'])){
    //process for login
    //1.get the data from login form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    //2. SQL to check whether the username and pass exsits or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    //3. execute the query
    $res = mysqli_query($conn, $sql);

    //4. count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if($count==1){
        //User available and login successs
        $_SESSION['login'] = "<div class='success '>Успешно влизане.</div>";
        $_SESSION['user'] = $username; //to check whether the user is logged in or not and logout will unset it
        
        //redirect to home page/dashboard
        header("location:".SITEURL."administrator/");

    }else{
        //user not available and login fail
        $_SESSION['login'] = "<div class='error text-center'>Потребителското име или парола са грешни.</div>";
        //redirect to home page/dashboard
        header("location:".SITEURL."administrator/login.php");
    }

}

?>