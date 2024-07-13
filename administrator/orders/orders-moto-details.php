<?php 
    include('../partials-admin/menu.php');
    include ('../../php/mailing/send.php');
?>

<section class="container-admin">
    <div class="wrapper">

    <?php
        //To suppress warnings while leaving all other error reporting enabled
          //error_reporting(E_ALL ^ E_WARNING); 

            //check if id is set or not
            if(isset($_GET['id'])){
                //get values
               // echo $_GET['id'];
               $id = $_GET['id'];

               //sql query to get all data for current motorcycle
               $sql_rent = "SELECT * FROM tbl_order_rent r
                            WHERE id_order_rent=$id";

                $sql_rent_details = "SELECT * FROM tbl_order_rent_details r
                                    INNER JOIN tbl_motorcycle m ON r.id_motorcycle = m.id_motorcycle
                                    WHERE id_order_rent=$id
                                 ";

               //execute the query
               $res_rent = mysqli_query($conn, $sql_rent);

               $res_rent_details = mysqli_query($conn, $sql_rent_details);

               //count rows
               $count_rent = mysqli_num_rows($res_rent);

               $count_rent_details = mysqli_num_rows($res_rent_details);

               if($count_rent = 1){
                $row = mysqli_fetch_assoc($res_rent);
                $first_name = $row['first_name'];
                $second_name = $row['second_name'];
                $client_telephone = $row['client_telephone'];
                $email = $row['email'];
                $birthday = $row['birthday'];
                $license = $row['license'];
                $price = $row['price'];
                $status = $row['status'];
                    if($count_rent_details = 1){
                        $row_details = mysqli_fetch_assoc($res_rent_details);
                        $id_motorcycle = $row_details['id_motorcycle'];
                        $brand = $row_details['brand'];
                        $model = $row_details['model'];
                        $days = $row_details['days'];
                        $paid = $row_details['paid'];
                        $afterpay = $row_details['afterpay'];
                        $delivery = $row_details['delivery'];
                        $bring_back = $row_details['bring_back'];
                        $equipment = $row_details['equipment'];
                        $helmet = $row_details['helmet'];
                        $tank = $row_details['tank'];
                        $date_from = $row_details['date_from'];
                        $date_to = $row_details['date_to'];
                        
                    }
               }
               else{
                //redirect to moto page with session message
                $_SESSION['update-message-error'] = "<div class='error'>Несъществуващо ID.</div>";
                header("location: ".SITEURL."administrator/moto.php");
                die();
               }
            }
        ?>
    <a href="<?php 
                if(isset($_SESSION['url-save'])){
                    echo $_SESSION['url-save'];
                }else{
                    echo SITEURL."administrator/orders/orders-moto.php";
                } 
                ?>" class="btn btn-primary">Назад</a>
    <br><br>
    <h1>Детайли на заявка № <?php echo $id; ?></h1>
    
        <br>
        <i>Контакти</i>
        <div class="order-box text-center">

            <div class="box-column">
                <b>Име</b>
                <div><?php echo $first_name; ?></div>
            </div>

            <div class="box-column">
                <b>Фамилия</b>
                <div><?php echo $second_name; ?></div>
            </div>

            <div class="box-column">
                <b>Телефон</b>
                <div><?php echo $client_telephone; ?></div>
            </div>

            <div class="box-column">
                <b>E-mail</b>
                <div><?php echo $email; ?></div>
            </div>

            <div class="box-column">
                <b>Рожд. дата</b>
                <div><?php echo $birthday; ?></div>
            </div>

            <div class="box-column">
                <b>Категория</b>
                <div><?php echo $license; ?></div>
            </div>

            <div class="box-column">
            <img class="action" onclick="showDiv()" width="32" height="32" src="https://img.icons8.com/ios-filled/50/00A414/settings.png" alt="settings"/></a>
            </div>
           
            <script>
                function showDiv() {
                    document.getElementById('update-contact').style.display = "block";
                    }
            </script>
            <div class="clearfix"></div>

        </div>

        <?php
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

        <div id="update-contact">
            <br>
            <i>Редактиране на контакти</i>
            <form action="<?php echo SITEURL; ?>administrator/orders/orders-moto-details.php?id=<?php echo $id; ?>" method="POST">
                <div class="order-box text-center">
                    <div class="box-column">
                        <b>Име</b>
                        <div><input type="text" name="first_name" value="<?php echo $first_name; ?>"></div>
                    </div>

                    <div class="box-column">
                        <b>Фамилия</b>
                        <div><input type="text" name="second_name" value="<?php echo $second_name; ?>"></div>
                    </div>

                    <div class="box-column">
                        <b>Телефон</b>
                        <div><input type="text" name="client_telephone" value="<?php echo $client_telephone; ?>"></div>
                    </div>

                    <div class="box-column">
                        <b>E-mail</b>
                        <div><input type="text" name="email" value="<?php echo $email; ?>"></div>
                    </div>

                    <div class="box-column">
                        <b>Рожд. дата</b>
                        <div><input type="date" name="birthday" value="<?php echo $birthday; ?>"></div>
                    </div>

                    <div class="box-column">
                        <b>Категория</b>
                        <div>
                        <select name="license">
                            <option value="<?php echo $license;?>"><?php echo $license;?></option>
                            <?php
                            //check category
                            if($license==='A'){
                                ?>
                                <option value="A1">A1</option>
                                <option value="A2">A2</option>
                                <?php
                            }
                            elseif($license==='A1'){
                                ?>
                                <option value="A">A</option>
                                <option value="A2">A2</option>
                                <?php
                            }
                            elseif($license==='A2'){
                                ?>
                                <option value="A">A</option>
                                <option value="A1">A1</option>
                                <?php
                            }
                            ?>
                        </select>
                        </div>
                    </div>

                    <input type="submit" name="update_contact" value="Редактирай" class="btn btn-secondary">

                    <?php
                        if(isset($_POST['update_contact'])){
                            //get the value from FORM
                            $first_name_update = $_POST['first_name'];
                            $second_name_update = $_POST['second_name'];
                            $client_telephone_update = $_POST['client_telephone'];
                            $email_update = $_POST['email'];
                            $birthday_update = $_POST['birthday'];
                            $license_update = $_POST['license'];

                            //sql query
                            $sql_update_client = "UPDATE moto_krastev.tbl_order_rent SET
                                                first_name = '$first_name_update',
                                                second_name = '$second_name_update',
                                                client_telephone = '$client_telephone_update',
                                                email = '$email_update',
                                                birthday = '$birthday_update',
                                                license = '$license_update'
                                                WHERE id_order_rent = $id
                                                ";
                            //execute query
                            $res_update_client = mysqli_query($conn, $sql_update_client);

                            //check if query executed success
                                if($res_update_client){
                                    //send a session message for success update data and redirect
                                    $_SESSION['update'] = "<div class='success'>Успешно редактиране.</div>";
                                    header("location: ".SITEURL."administrator/orders/orders-moto-details.php?id=$id");
                                     //stop the process
                                     die();
                                 }else{
                                     //send a message for error update redirect
                                     $_SESSION['update'] = "<div class='error'>Неуспешно редактиране.</div>";
                                     header("location: ".SITEURL."administrator/orders/orders-moto-details.php?id=$id");
                                     //stop the process
                                     die();
                                 }
                        }
                    ?>  

                    <div class="clearfix"></div>

                </div>
            </form>
        </div>

        <br>
        <i>Детайли</i>
        <div class="order-box text-center">

            <div class="box-column">
                    <b>Мотоциклет</b>
                    <div><?php echo $brand," ",$model ?></div>
                </div>

                <div class="box-column">
                    <b>Дни</b>
                    <div><?php echo $days; ?></div>
                </div>

                <div class="box-column">
                    <b>Дата от</b>
                    <div><?php echo $date_from; ?></div>
                </div>

                <div class="box-column">
                    <b>Дата до</b>
                    <div><?php echo $date_to; ?></div>
                </div>
                <div class="box-column">
                    <b>Вземане от</b>
                    <div><?php echo $delivery; ?></div>
                </div>

                <div class="box-column">
                    <b>Връщане</b>
                    <div><?php echo $bring_back; ?></div>
                </div>

                <div class="box-column">
                    <b>Екипировка</b>
                    <div><?php echo $equipment; ?></div>
                </div>

                <div class="box-column">
                    <b>Каска</b>
                    <div><?php echo $helmet; ?></div>
                </div>

                <div class="box-column">
                    <b>Празен резервоар</b>
                    <div><?php echo $tank; ?></div>
                </div>

                <!--
                <div class="box-column">
                    <img class="action" onclick="showDivDetails()" width="32" height="32" src="https://img.icons8.com/ios-filled/50/00A414/settings.png" alt="settings"/></a>
                </div>
                -->
           
            <!--
                <script>
                    function showDivDetails() {
                        document.getElementById('update-details').style.display = "block";
                        }
                </script>
            -->
                
                <div class="clearfix"></div>
            </div>

            <!--
            <div id="update-details">
                <br>
                <i>Редактиране на детайли</i>
                <form action="<?php /* echo SITEURL; ?>administrator/orders/orders-moto-details.php?id=<?php echo $id; ?>" method="POST">
                    <div class="order-box text-center">

                        <div class="box-column">
                            <b>Дата от</b>
                            <div><input type="date" name="date_from" value="<?php echo $date_from; ?>"></div>
                        </div>

                        <div class="box-column">
                            <b>Дата до</b>
                            <div><input type="date" name="date_to" value="<?php echo $date_to; ?>"></div>
                        </div>

                        <div class="box-column">
                            <b>Вземане от</b>
                            <div>
                            <select name="delivery">
                                <option value="<?php echo $delivery;?>"><?php echo $delivery;?></option>
                                <?php
                                //check delivery
                                if($delivery==='от офис'){
                                    ?>
                                    <option value="летище">летище</option>
                                    <option value="хотел">хотел</option>
                                    <?php
                                }
                                elseif($delivery==='летище'){
                                    ?>
                                    <option value="хотел">хотел</option>
                                    <option value="от офис">от офис</option>
                                    <?php
                                }
                                elseif($delivery==='хотел'){
                                    ?>
                                    <option value="летище">летище</option>
                                    <option value="от офис">от офис</option>
                                    <?php
                                }
                                ?>
                            </select>    
                            </div>
                        </div>

                        <div class="box-column">
                            <b>Връщане</b>
                            <div>
                            <select name="bring_back">
                                <option value="<?php echo $bring_back;?>"><?php echo $bring_back;?></option>
                                <?php
                                //check bring back
                                if($bring_back==='от офис'){
                                    ?>
                                    <option value="летище">летище</option>
                                    <option value="хотел">хотел</option>
                                    <?php
                                }
                                elseif($bring_back==='летище'){
                                    ?>
                                    <option value="хотел">хотел</option>
                                    <option value="от офис">от офис</option>
                                    <?php
                                }
                                elseif($bring_back==='хотел'){
                                    ?>
                                    <option value="летище">летище</option>
                                    <option value="от офис">от офис</option>
                                    <?php
                                }
                                ?>
                            </select>    
                            </div>
                        </div>

                        <input type="submit" name="update_details" value="Редактирай" class="btn btn-secondary">

                        <?php
                            if(isset($_POST['update_details'])){
                                //get the value from FORM
                                $date_from_update = $_POST['date_from'];
                                $date_to_update = $_POST['date_to'];
                                $delivery_update = $_POST['delivery'];
                                $bring_back_update = $_POST['bring_back'];

                                //sql query
                                $sql_update_details = "UPDATE moto_krastev.tbl_order_rent SET
                                                    date_from = '$date_from_update',
                                                    date_to = '$date_to_update'
                                                    WHERE id_order_rent = $id
                                                    ";

                                $sql_update_details_2 = "UPDATE moto_krastev.tbl_order_rent_details SET
                                                        delivery = '$delivery_update',
                                                        bring_back = '$bring_back_update'
                                                        WHERE id_order_rent = $id
                                                        ";
                                    
                                //execute query
                                $res_update_details = mysqli_query($conn, $sql_update_details);
                                $res_update_details_2 = mysqli_query($conn, $sql_update_details_2);

                                //check if query executed success
                                    if($res_update_details && $res_update_details_2){
                                        //send a session message for success update data and redirect
                                        $_SESSION['update'] = "<div class='success'>Успешно редактиране.</div>";
                                        header("location: ".SITEURL."administrator/orders/orders-moto-details.php?id=$id");
                                        //stop the process
                                        die();
                                    }else{
                                        //send a message for error update redirect
                                        $_SESSION['update'] = "<div class='error'>Неуспешно редактиране.</div>";
                                        header("location: ".SITEURL."administrator/orders/orders-moto-details.php?id=$id");
                                        //stop the process
                                        die();
                                    }
                            }*/
                        ?>  

                        <div class="clearfix"></div>

                    </div>
                </form>
            </div>
            -->

        <br>
        <i>Плащане</i>
        <div class="order-box">
            <div class="box-column">
                <div><i>Екипировка:</i></div><hr>
                <div><i>Каска:</i></div><hr>
                <div><i>Празен резервоар:</i></div><hr>
                <div><i>Доставяне:</i></div><hr>
                <div><i>Връщане:</i></div><hr>
                <div><i>Цена за наем мотор:</i></div><hr>
                <div><b>Обща цена:</b></div><hr>

                <div><b>Платено:</b></div><hr>
                
                <div><b>За доплащане:</b></div>
            </div>

            <div class="box-column">
                <div><?php if($equipment == 'Yes'){$equipent_price = 25;}else{$equipent_price = 0;} echo "<i>".$equipent_price." лв.</i>";?></div><hr>
                <div><?php if($helmet == 'Yes'){$helmet_price = 20;}else{$helmet_price = 0;} echo "<i>".$helmet_price." лв.</i>";?></div><hr>
                <div><?php if($tank == 'Yes'){$tank_price = 60;}else{$tank_price = 0;} echo "<i>".$tank_price." лв.</i>";?></div><hr>
                <div>
                    <?php
                    if($delivery == 'от летище'){
                        $delivery_price = 25;}
                    elseif($delivery == 'от хотел'){
                        $delivery_price = 20;
                    }else{
                        $delivery_price = 0;
                    }
                    echo "<i>".$delivery_price." лв.</i>";
                    ?>
                </div><hr>
                <div>
                    <?php
                    if($bring_back == 'от летище'){
                        $bring_back_price = 25;}
                    elseif($delivery == 'от хотел'){
                        $bring_back_price = 20;
                    }else{
                        $bring_back_price = 0;
                    }
                    echo "<i>".$bring_back_price." лв.</i>";
                    ?>
                </div><hr>
                <div><i><?php $price_only_rent = $price - $equipent_price - $helmet_price - $tank_price - $delivery_price - $bring_back_price; echo $price_only_rent?> лв.</i></div><hr>
                <div><b><?php echo $price; ?> лв.</b></div><hr>
                <div><b><?php echo $paid; ?> лв.</b></div><hr>
                <div><b><?php echo $afterpay; ?> лв.</b></div>
            </div>

            <div class="clearfix"></div>
        </div>
        <br>
        
        <?php
            if(isset($_SESSION['status-update'])){
                echo $_SESSION['status-update'];
                unset($_SESSION['status-update']);
            }

            if(isset($_SESSION['mailing'])){
                echo $_SESSION['mailing'];
                unset($_SESSION['mailing']);
            }
        ?>

        <form action="<?php echo SITEURL; ?>administrator/orders/orders-moto-details.php?id=<?php echo $id; ?>" method="POST">
            <div class="status-buttons">
                <div class="btn">Статут: 
                    <?php
                     if($status == 'изчакваща потвърждение'){
                        echo "<b><font color='#ffa502'>".$status."</b>";
                    }
                    elseif($status == 'обработка'){
                        echo "<b><font color='#eccc68'>".$status."</b>";
                    }
                    elseif($status == 'на път'){
                        echo "<b><font color='#ff6b81'>".$status."</b>";
                    }
                    elseif($status == 'потвърдена'){
                        echo "<b><font color='#70a1ff'>".$status."</b>";
                    }
                    elseif($status == 'завършена'){
                        echo "<b><font color='#2ed573'>".$status."</b>";
                    }
                    elseif($status == 'отказана'){
                        echo "<b><font color='#ff4757'>".$status."</b>";
                    }
                    ?>
                </div>
                <input type="submit" name="confirmed" value="потвърдена" class="btn confirmed">
                <input type="submit" name="processing" value="обработка" class="btn processing">
                <input type="submit" name="on-road" value="на път" class="btn on-road">
                <input type="submit" name="finished" value="завършена" class="btn finished">
                <input type="submit" name="canceled" value="отказана" class="btn canceled">
            </div>
        </form>

        <?php
        //check whether who submit button is clicked
            if(isset($_POST['processing']) || isset($_POST['confirmed']) || isset($_POST['finished']) || isset($_POST['canceled']) || isset($_POST['on-road'])){
                $status = "";
                if(isset($_POST['processing'])){
                    $status = "обработка";
                    $active = 'No';
                }else if(isset($_POST['confirmed'])){
                    $status = "потвърдена";
                    $active = 'No';

                    //send mail
                $send_mail = new sendMail;
                $send_mail->recipient_email = $email; //to email

                $title = 'Относно: Потвърждение на заявка №'.$id.' за наем на мотор' ; 
                $send_mail->img_logo = "../../images/logo.png"; //from php/phpmailer/send.php

                $mail_text = "
                Уважаеми ".$second_name.",
                <br>
                <p>Искрено ви благодарим, че избрахте нашите услуги за предстояща Ви мото екскурзия. С удоволствие ви уведомяваме, че вашата заявка за наем на мотор е <b>потвърдена</b>.
                Очаквайте да бъдете уведомени по имейл или телефон за окончателното потвърждение и състоянието за вашата заявка.
                </p>
                <br>
                Детайли за заявката:
                <ul>
                    <li>Име: ".$first_name." ".$second_name."</li>
                    <li>Телефон: ".$client_telephone."</li>
                    <li>Дата на наем: ".date("d.m.Y",strtotime($date_from))."г.</li>
                    <li>Продължителност на наема: ".$days." дни</li>
                    <li>Мотор: ".$brand." ".$model."</li>
                    <li>Номер на мотора: ".$model."-".$id_motorcycle."</li>
                    <li>Вземане: ".$delivery."</li>
                    <li>Връщане: ".$bring_back."</li>
                    <li>Екипировка за пасажер: ".$equipment."</li>
                    <li>Каска за пасажер: ".$helmet."</li>
                    <li>Върни с празен резервоар: ...</li>
                </ul>
                <p>
                    Моля, обърнете внимание, че моторът трябва да бъде върнат до ".date("d.m.Y",strtotime($date_to))."г.
                </p>
                <p>
                    За въпроси или допълнителна информация, не се колебайте да се свържете с нас. Очакваме с нетърпение да ви посрещнем за вашата екскурзия!
                </p>
                <p>С уважение</p> 
                <p>Moto Krastev Rent & Tour</p>
                <img src='cid:logo_moto_krastev' alt='logo_moto_krastev' width='100px'>
                <br>
                <p>Контакти:</p>
                <p>Телефон: +35989 554 6555 / +35988 554 6666</p>
                <p>Имейл: info@motokrastev.bg</p>
                <p>Адрес: България, Варна, бул. Владислав Варненчик 68</p>
                "; 
                
                $send_mail->sendMail($title, $mail_text);

                }else if(isset($_POST['on-road'])){
                    $status = "на път";
                    $active = 'No';
                }else if(isset($_POST['finished'])){
                    $status = "завършена";
                    $active = 'Yes';
                }else if(isset($_POST['canceled'])){
                    $status = "отказана";
                    $active = 'Yes';
                }

                //sql query
            /*    $sql_moto_active = "UPDATE tbl_motorcycle SET
                        active = '$active'
                        WHERE id_motorcycle = $id_motorcycle";
                mysqli_query($conn, $sql_moto_active);
            */
                $sql_status = "UPDATE moto_krastev.tbl_order_rent SET
                                status = '$status'
                                WHERE id_order_rent = $id";
            

                //execute the query and save in database
                $res_status = mysqli_query($conn, $sql_status);
                

                //check whether the query executed or not and data added or not
                if($res_status){
                    $_SESSION['status-update'] = "<div class='success'>Актулизиран статут.</div>";
                    //redirect page
                    header("location: ".SITEURL."administrator/orders/orders-moto-details.php?id=$id");
                    die();
                }else{
                    //failed
                    $_SESSION['status-update'] = "<div class='error'>Неуспешно актулизиране.</div>";
                    header("location: ".SITEURL."administrator/orders/orders-moto-details.php?id=$id");
                    die();
                }
            }
        ?>

    </div>

    <div class="clearfix"></div>
</section>
<?php include('../partials-admin/footer.php');?>