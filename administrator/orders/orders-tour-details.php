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

               //sql query to get all data
               $sql_tour = "SELECT t.first_name, t.second_name, t.client_telephone, t.email, t.birthday, t.license, t.price, t.id_tour, t.date_from, t.status, t.date_order, tt.country, tt.cities, tt.price tour_price
                            FROM tbl_order_tour t
                            INNER JOIN tbl_tour tt ON tt.id_tour = t.id_tour
                            WHERE id_order_tour=$id";

                $sql_tour_details = "SELECT * FROM tbl_order_tour_details r
                                    WHERE id_order_tour=$id
                                 ";

               //execute the query
               $res_tour = mysqli_query($conn, $sql_tour);

               $res_tour_details = mysqli_query($conn, $sql_tour_details);

               //count rows
               $count_tour = mysqli_num_rows($res_tour);

               $count_tour_details = mysqli_num_rows($res_tour_details);

               if($count_tour = 1){
                $row = mysqli_fetch_assoc($res_tour);
                $first_name = $row['first_name'];
                $second_name = $row['second_name'];
                $client_telephone = $row['client_telephone'];
                $email = $row['email'];
                $birthday = $row['birthday'];
                $license = $row['license'];
                $total_price = $row['price'];
                $price_tour = $row['tour_price'];
                $country = $row['country'];
                $cities = $row['cities'];
                $date_from = $row['date_from'];
                $id_tour = $row['id_tour'];
                $date_order = $row['date_order'];
                $status = $row['status'];
                    if($count_tour_details = 1){
                        $row_details = mysqli_fetch_assoc($res_tour_details);
                        $days = $row_details['days'];
                        $motorcycle_data = json_decode($row_details['motorcycle_data']);
                        $paid = $row_details['paid'];
                        $single_room = $row_details['single_room'];
                        $passenger = $row_details['passenger'];
                        $equipment_pax = $row_details['equipment_pax'];
                        $helmet_pax = $row_details['helmet_pax'];
                    }
               }
               else{
                //redirect to moto page with session message
                $_SESSION['update-message-error'] = "<div class='error'>Несъществуващо ID.</div>";
                header("location: ".SITEURL."administrator/tour.php");
                die();
               }

               //check if the tour have a passenger
               if($passenger == 'Yes'){
                $sql_tbl_order_tour_passenger = "SELECT * FROM tbl_order_tour_passenger
                                                WHERE id_order_tour = $id
                                                ";
                //execute the query
                $res_tbl_order_tour_passenger = mysqli_query($conn, $sql_tbl_order_tour_passenger);
                //count rows
                $count_tour_passenger = mysqli_num_rows($res_tbl_order_tour_passenger);

                if($count_tour_passenger = 1){
                    $row_passenger = mysqli_fetch_assoc($res_tbl_order_tour_passenger);
                    $first_name_pax = $row_passenger['first_name_pax'];
                    $second_name_pax = $row_passenger['second_name_pax'];
                    $telephone_pax = $row_passenger['telephone_pax'];
                    $email_pax = $row_passenger['email_pax'];
                }
               }
            }
        ?>
    <a href="<?php 
                if(isset($_SESSION['url-save'])){
                    echo $_SESSION['url-save'];
                }else{
                    echo SITEURL."administrator/orders/orders-tour.php";
                } 
                ?>" class="btn btn-primary">Назад</a>
    <br><br>
    <h1>Детайли на заявка № <?php echo $id; ?></h1>
    <h3>Дата на заявка: <?php echo $date_order; ?></h3>
    
        <br>
        <h3><i>Контакти</i></h3>
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
            if(isset($_SESSION['update-contact'])){
                echo $_SESSION['update-contact'];
                unset($_SESSION['update-contact']);
            }
        ?>

        <div id="update-contact">
            <br>
            <i>Редактиране на контакти</i>
            <form action="<?php echo SITEURL; ?>administrator/orders/orders-tour-details.php?id=<?php echo $id; ?>" method="POST">
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
                            $sql_update_tour_client = "UPDATE moto_krastev.tbl_order_tour SET
                                                first_name = '$first_name_update',
                                                second_name = '$second_name_update',
                                                client_telephone = '$client_telephone_update',
                                                email = '$email_update',
                                                birthday = '$birthday_update',
                                                license = '$license_update'
                                                WHERE id_order_tour = $id
                                                ";
                            //execute query
                            $res_update_tour_client = mysqli_query($conn, $sql_update_tour_client);

                            //check if query executed success
                                if($res_update_tour_client){
                                    //send a session message for success update data and redirect
                                    $_SESSION['update-contact'] = "<div class='success'>Успешно редактиране.</div>";
                                    header("location: ".SITEURL."administrator/orders/orders-tour-details.php?id=$id");
                                     //stop the process
                                     die();
                                 }else{
                                     //send a message for error update redirect
                                     $_SESSION['update-contact'] = "<div class='error'>Неуспешно редактиране.</div>";
                                     header("location: ".SITEURL."administrator/orders/orders-tour-details.php?id=$id");
                                     //stop the process
                                     die();
                                 }
                        }
                    ?>  

                    <div class="clearfix"></div>

                </div>
            </form>
        </div>
        
        <?php 
        if($passenger == 'Yes')
        {
        ?>

        <br>
        <h3><i>Контакти на пасажера</i></h3>
        <div class="order-box text-center">

            <div class="box-column">
                <b>Име</b>
                <div><?php echo $first_name_pax; ?></div>
            </div>

            <div class="box-column">
                <b>Фамилия</b>
                <div><?php echo $second_name_pax; ?></div>
            </div>

            <div class="box-column">
                <b>Телефон</b>
                <div><?php echo $telephone_pax; ?></div>
            </div>

            <div class="box-column">
                <b>E-mail</b>
                <div><?php echo $email_pax; ?></div>
            </div>

            <div class="box-column">
            <img class="action" onclick="showDivPassenger()" width="32" height="32" src="https://img.icons8.com/ios-filled/50/00A414/settings.png" alt="settings"/></a>
            </div>
           
            <script>
                function showDivPassenger() {
                    document.getElementById('update-contact-passenger').style.display = "block";
                    }
            </script>
            <div class="clearfix"></div>

        </div>

        <div id="update-contact-passenger">
            <br>
            <i>Редактиране на контакти на пасажер</i>
            <form action="<?php echo SITEURL; ?>administrator/orders/orders-tour-details.php?id=<?php echo $id; ?>" method="POST">
                <div class="order-box text-center">
                    <div class="box-column">
                        <b>Име</b>
                        <div><input type="text" name="first_name_pax" value="<?php echo $first_name_pax; ?>"></div>
                    </div>

                    <div class="box-column">
                        <b>Фамилия</b>
                        <div><input type="text" name="second_name_pax" value="<?php echo $second_name_pax; ?>"></div>
                    </div>

                    <div class="box-column">
                        <b>Телефон</b>
                        <div><input type="text" name="telephone_pax" value="<?php echo $telephone_pax; ?>"></div>
                    </div>

                    <div class="box-column">
                        <b>E-mail</b>
                        <div><input type="text" name="email_pax" value="<?php echo $email_pax; ?>"></div>
                    </div>

                    <input type="submit" name="update_contact_pax" value="Редактирай" class="btn btn-secondary">

                    <?php
                        if(isset($_POST['update_contact_pax'])){
                            //get the value from FORM
                            $first_name_update = $_POST['first_name_pax'];
                            $second_name_update = $_POST['second_name_pax'];
                            $client_telephone_update = $_POST['telephone_pax'];
                            $email_update = $_POST['email_pax'];

                            //sql query
                            $sql_update_client_pax = "UPDATE moto_krastev.tbl_order_tour_passenger SET
                                                first_name_pax = '$first_name_update',
                                                second_name_pax = '$second_name_update',
                                                telephone_pax = '$client_telephone_update',
                                                email_pax = '$email_update'
                                                WHERE id_order_tour = $id
                                                ";
                            //execute query
                            $res_update_client_pax = mysqli_query($conn, $sql_update_client_pax);

                            //check if query executed success
                                if($res_update_client_pax){
                                    //send a session message for success update data and redirect
                                    $_SESSION['updatep-contact'] = "<div class='success'>Успешно редактиране.</div>";
                                    header("location: ".SITEURL."administrator/orders/orders-tour-details.php?id=$id");
                                     //stop the process
                                     die();
                                 }else{
                                     //send a message for error update redirect
                                     $_SESSION['update-contact'] = "<div class='error'>Неуспешно редактиране.</div>";
                                     header("location: ".SITEURL."administrator/orders/orders-tour-details.php?id=$id");
                                     //stop the process
                                     die();
                                 }
                        }
                    ?>  

                    <div class="clearfix"></div>

                </div>
            </form>
        </div>
        <?php 
        } 
        ?>

        <?php
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

        <br>
        <h3><i>Детайли</i></h3>
        <div class="order-box text-center">

            <div class="box-column">
                    <b>Мотоциклет</b>
                    <div><?php echo $motorcycle_data[0]; ?></div>
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
                    <b>Самостоятелна стая</b>
                    <div><?php echo $single_room; ?></div>
                </div>

                <div class="box-column">
                    <b>Пасажер</b>
                    <div><?php echo $passenger; ?></div>
                </div>

                <div class="box-column">
                    <b>Екипировка за пасажер</b>
                    <div><?php echo $equipment_pax; ?></div>
                </div>

                <div class="box-column">
                    <b>Каска за пасажер</b>
                    <div><?php echo $helmet_pax; ?></div>
                </div>
                
                <div class="clearfix"></div>
            </div>

        <br>
        <h3><i>Плащане</i></h3>
        <div class="order-box">
            <div class="box-column">
                <div><i>Цена за наем мотор:</i></div><hr>
                <div><i>Самостоятелна стая:</i></div><hr>
                <div><i>Пасажер:</i></div><hr>
                <div><i>Екипировка:</i></div><hr>
                <div><i>Каска:</i></div><hr>
                <div><i>Цена на мото тура:</i></div>

                <div><b>Обща цена:</b></div><hr>
                <div><b>Платено:</b></div><hr>
                <div><b>За доплащане:</b></div>
            </div>

            <div class="box-column">
                <div><i><?php echo $motorcycle_data[1]; ?> лв.</i></div><hr>
                <div><i><?php if($single_room == 'Yes'){$single_room_price = 150;}else{$single_room_price = 0;} echo "<i>".number_format($single_room_price, 2)." лв.</i>";?></i></div><hr>
                <div><?php if($passenger == 'Yes'){$passenger_price = 350;}else{$passenger_price = 0;} echo "<i>".number_format($passenger_price, 2)." лв.</i>";?></div><hr>
                <div><?php if($equipment_pax == 'Yes'){$equipent_price = 25;}else{$equipent_price = 0;} echo "<i>".number_format($equipent_price, 2)." лв.</i>";?></div><hr>
                <div><?php if($helmet_pax == 'Yes'){$helmet_price = 20;}else{$helmet_price = 0;} echo "<i>".number_format($helmet_price, 2)." лв.</i>";?></div><hr>
                <div><i><?php echo number_format($price_tour, 2); ?> лв.</i></div><hr>
                
                <div><b><?php echo number_format($total_price, 2); ?> лв.</b></div><hr>
                <div><b><?php echo number_format($paid, 2); ?> лв.</b></div><hr>
                <div><b><?php echo number_format($total_price - $paid, 2); ?> лв.</b></div>
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

        <form action="<?php echo SITEURL; ?>administrator/orders/orders-tour-details.php?id=<?php echo $id; ?>" method="POST">
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
                $send_mail->img_logo = "../../images/logo.png"; //from php/phpmailer/send.php

                $title = 'Относно: Потвърждение на заявка №'.$id.' за мото пътешествието Ви.' ; 

                $mail_text = "
                Уважаеми ".$second_name.",
                <br>
                <p>Искрено ви благодарим, че избрахте нашите услуги за предстояща Ви мото екскурзия. С удоволствие ви уведомяваме, че вашата заявка за мото тура е <b>потвърдена</b>.
                Очаквайте да бъдете уведомени по имейл или телефон за окончателното потвърждение и състоянието за вашата заявка.
                </p>
                <br>
                Детайли за заявката:
                <ul>
                    <li>Име: ".$first_name." ".$second_name."</li>
                    <li>Телефон: ".$client_telephone."</li>
                    <li>Дата на наем: ".date("d.m.Y",strtotime($date_from))."г.</li>
                    <li>Продължителност на наема: ".$days." дни</li>
                    <li>Мотор: ".$motorcycle_data[0]."</li>
                    <li>Самостоятелна стая: ".$single_room."</li>
                    <li>Пасажер: ".$passenger."</li>
                    <li>Екипировка за пасажер: ".$equipment_pax."</li>
                    <li>Каска за пасажер: ".$helmet_pax."</li>
                </ul>
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
                    //sql query for -1 reservation count because order is canceled
                    $sql_reservation_count= "UPDATE moto_krastev.tbl_tour 
                                            SET reservations_count = reservations_count - 1
                                            WHERE id_tour = $id_tour
                                            ";
                    mysqli_query($conn, $sql_reservation_count);
                }

                $sql_status = "UPDATE moto_krastev.tbl_order_tour SET
                                status = '$status'
                                WHERE id_order_tour = $id";

                //execute the query and save in database
                $res_status = mysqli_query($conn, $sql_status);

                //check whether the query executed or not and data added or not
                if($res_status){
                    $_SESSION['status-update'] = "<div class='success'>Актулизиран статут.</div>";
                    //redirect page
                    header("location: ".SITEURL."administrator/orders/orders-tour-details.php?id=$id");
                    die();
                }else{
                    //failed
                    $_SESSION['status-update'] = "<div class='error'>Неуспешно актулизиране.</div>";
                    header("location: ".SITEURL."administrator/orders/orders-tour-details.php?id=$id");
                    die();
                }
            }
            
        ?>

    </div>

    <div class="clearfix"></div>
</section>
<?php include('../partials-admin/footer.php');?>