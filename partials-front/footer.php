 <!-- Start Footer section-->
 <section class="footer">
        <div class="container">

            <div class="box-1">
                <h3>Свържи се с нас</h3>
                <br>
                <span><b>АДРЕС:</b> </span>
                <br>
                <p>България, Варна, бул. Владислав Варненчик 68</p>
                <span><b>ТЕЛЕФОН /WHATSAPP, TELEGRAM/: </b></span>
                <br>
                <p>+35989 554 6555</p>
                <p>+35988 554 6666</p>
                <span><b>ИМЕЙЛ: </b></span>
                <br>
                <p>info@motokrastev.bg</p>
                <span><b>РАБОТНО ВРЕМЕ: </b></span>
                <p>Пон - Съб / 10:00 - 18:00</p>
                <p>Неделя - почивен ден</p>
            </div>

            <div class="box-1">
                <form action="" method="POST">
                    <h3>Бюлетин</h3>
                    <br>
                    <span>Абонирайте се за нашия бюлетин и ние ще ви информираме за нашите нови обиколки и услуги:</span>
                    <br>
                    <input class="input-style" type="text" name="email-subscribe" placeholder="Въведи Email" required>
                    <input type="submit" name="subscribe-submit" value="Абонирай се" class="btn btn-primary">
                </form>
                
                <?php
                    if (isset($_POST['subscribe-submit'])) {
                        $email_sub = mysqli_real_escape_string($conn, $_POST['email-subscribe']);
                        $subscribe_date = date("Y-m-d H:i:s");
                        
                        $sql_check_email = "SELECT COUNT(*) FROM tbl_subscribers WHERE email='$email_sub'";
                        $res_check_email = mysqli_query($conn, $sql_check_email);
                        $row_check_email = mysqli_fetch_assoc($res_check_email);

                        $count_email = $row_check_email['COUNT(*)'];
                        
                        if ($count_email == 0) {
                            $checkEmail = true;
                        }else{
                            $checkEmail = false;
                        }

                        if ($checkEmail) {

                            //sql query for insert data in table
                            $sql_sub = "INSERT INTO moto_krastev.tbl_subscribers SET
                                        email = '$email_sub',
                                        name = '',
                                        subscribe_date = '$subscribe_date',
                                        status = 'активен'
                            ";
                            //execute query
                            $res_sub = mysqli_query($conn, $sql_sub);

                            if($res_sub){
                                $_SESSION['header-email'] = "Успешно абониране";
                                $_SESSION['sub-message'] = "Вие успешно се абонирахте за нашия бюлетин с E-mail: ".$email_sub;
                                $_SESSION['url-previous'] = $_SERVER['REQUEST_URI'];
                                header("location: ".SITEURL."subsciption-message.php");
                            }else{
                                $_SESSION['header-email'] = "Грешка в абонирането";
                                $_SESSION['sub-message'] = "Възникна някаква грешка. Свържете се с нас";
                                $_SESSION['url-previous'] = $_SERVER['REQUEST_URI'];
                                header("location: ".SITEURL."subsciption-message.php");
                            }
                        }else{

                            $sql_status_check = "SELECT id_subscriber, status FROM moto_krastev.tbl_subscribers WHERE email = '$email_sub'";
                            $res_status_check = mysqli_query($conn, $sql_status_check);
                            $count_status_check = mysqli_num_rows($res_status_check);

                            if($count_status_check === 1){
                                $row_status = mysqli_fetch_assoc($res_status_check);
                                $id_subscriber = $row_status['id_subscriber'];
                                $current_status = $row_status['status'];

                                if($current_status === 'активен'){
                                    $_SESSION['header-email'] = "Този E-mail вече е абониран";
                                    $_SESSION['sub-message'] = "Вие вече сте абониран за нашия бюлетин с E-mail: ".$email_sub;
                                    $_SESSION['url-previous'] = $_SERVER['REQUEST_URI'];
                                    header("location: ".SITEURL."subsciption-message.php");

                                }
                                else if($current_status === 'неактивен'){
                                    
                                    $sql_status_active = "UPDATE moto_krastev.tbl_subscribers SET
                                                            unsubscribe_date = NULL,
                                                            status = 'активен'
                                                            WHERE id_subscriber = $id_subscriber
                                                            ";
                                    $res_status_active = mysqli_query($conn, $sql_status_active);

                                    $_SESSION['header-email'] = "Добре дошли отново";
                                    $_SESSION['sub-message'] = "Вие отново активирахте успешно абонамента си към нас с E-mail: ".$email_sub;
                                    $_SESSION['url-previous'] = $_SERVER['REQUEST_URI'];
                                    header("location: ".SITEURL."subsciption-message.php");
                                }
                            }
                        }
                    }
                ?>
            </div>

            <div class="box-1 text-center">
                <h3>Последвай ни:</h3>
                <br>
                <a href="#"><img width="48" height="48" src="https://img.icons8.com/color/48/facebook-new--v1.png" alt="facebook-new--v1"/></a>
                <a href="#"><img width="48" height="48" src="https://img.icons8.com/color/48/instagram-new--v1.png" alt="instagram-new--v1"/></a>
                <a href="#"><img width="48" height="48" src="https://img.icons8.com/color/48/twitterx--v1.png" alt="x--v1"/></a>
            </div>

          
        </div>

        <div class="clearfix"></div>
        <hr class="footer-hr">
        <div class="footer-rules text-center"> © Moto Krastev Rent & Tour. Всички права запазени. Уеб дизайн <a href="#">Daniel Krastev</a></div>
    </section>
    <!-- End Footer section-->
</body>
</html>