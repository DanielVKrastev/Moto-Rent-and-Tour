<?php 
include('config/constants.php');
include ('php/mailing/send.php');
    $subscribe_submit = 'No';
    if(isset($_SESSION['order_rent_moto'])){
        $id_motorcycle = $_SESSION['order_rent_moto']['id_motorcycle'];
        $first_name = $_SESSION['order_rent_moto']['first_name'];
        $second_name = $_SESSION['order_rent_moto']['second_name'];
        $client_telephone = $_SESSION['order_rent_moto']['client_telephone'];
        $email = $_SESSION['order_rent_moto']['email'];
        $category = $_SESSION['order_rent_moto']['category'];
        $birthday = $_SESSION['order_rent_moto']['birthday'];
        $price = $_SESSION['order_rent_moto']['price'];
        $paid = $_SESSION['order_rent_moto']['paid'];
        $afterpay = $_SESSION['order_rent_moto']['afterpay'];
        $days = $_SESSION['order_rent_moto']['days'];
        $equipment_option = $_SESSION['order_rent_moto']['equipment_option'];
        $helmet_option = $_SESSION['order_rent_moto']['helmet_option'];
        $tank_option = $_SESSION['order_rent_moto']['tank_option'];
        $date_from = $_SESSION['order_rent_moto']['date_from'];
        $date_to = $_SESSION['order_rent_moto']['date_to'];
        $delivery = $_SESSION['order_rent_moto']['delivery'];
        $bring_back = $_SESSION['order_rent_moto']['bring_back'];
        $date_order = $_SESSION['order_rent_moto']['date_order'];
        $subscribe_submit = $_SESSION['order_rent_moto']['subscribe_submit'];

        //sql query
        $sql_tbl_order_rent = "INSERT INTO moto_krastev.tbl_order_rent SET
                    first_name = '$first_name',
                    second_name = '$second_name',
                    client_telephone = '$client_telephone',
                    email = '$email',
                    license = '$category',
                    date_order = '$date_order',
                    birthday = '$birthday',
                    price = $price,
                    status = 'изчакваща потвърждение'
                    ";
        //execute the query and save in database
        $res_tbl_order_rent = mysqli_query($conn, $sql_tbl_order_rent);

        //last row in tbl_order_rent
        $sql_last_row = "SELECT id_order_rent FROM moto_krastev.tbl_order_rent WHERE id_order_rent =(SELECT MAX(id_order_rent ) FROM moto_krastev.tbl_order_rent)";
        $res_last_row = mysqli_query($conn, $sql_last_row);
        $count = mysqli_num_rows($res_last_row);
        if($count > 0){
            $sql_reservations_count_moto = "UPDATE moto_krastev.tbl_motorcycle SET
                                            reservations_count = reservations_count + 1
                                            WHERE id_motorcycle = $id_motorcycle";
                                            
            $res_reservations_count_moto = mysqli_query($conn, $sql_reservations_count_moto);
            $row = mysqli_fetch_assoc($res_last_row);
            $id_order_rent = $row['id_order_rent'];
        }
        
        $sql_tbl_order_rent_details = "INSERT INTO moto_krastev.tbl_order_rent_details SET
                                    id_order_rent = $id_order_rent,
                                    id_motorcycle = $id_motorcycle,
                                    days = '$days',
                                    paid = '$paid',
                                    afterpay = '$afterpay',
                                    delivery = '$delivery',
                                    bring_back = '$bring_back',
                                    equipment = '$equipment_option',
                                    helmet = '$helmet_option',
                                    tank = '$tank_option',
                                    date_from = '$date_from',
                                    date_to = '$date_to'
        ";

        //execute the query and save in database
        $res_tbl_order_rent_details = mysqli_query($conn, $sql_tbl_order_rent_details);

        //check whether the query executed or not and data added or not
        if($res_tbl_order_rent == true && $res_tbl_order_rent_details == true){
            
            $_SESSION['error-date'] = "";
            
            //send mail
            $send_mail = new sendMail;
            $send_mail->recipient_email = $email; //to email

            $title = 'Вашата заявка за мотоциклет е приета №'.$id_order_rent;
            $send_mail->img_logo = "images/logo.png"; //from php/phpmailer/send.php

            $mail_text = "
            <h1>Вашата заявка за мотоциклет е приета № $id_order_rent </h1>
            Здравейте,
            <br><br>
            Благодарим Ви, че избрахте нашите мотоциклетни услуги.
            <br>
            Радостни сме да ви уведомим, че вашата заявката за наем на мотоциклет с номер <b>№ $id_order_rent </b> е регистрирана успешно.
            <br>
            Очаквайте да бъдете уведомени по имейл или телефон за окончателното потвърждение и състоянието за вашата заявка.
            <br>
            Благодарим ви за търпението и разбирането. Ако имате някакви въпроси или се нуждаете от допълнителна информация, не се колебайте да се свържете с нас.
            <br>
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
        }
        
    }else if(isset($_SESSION['order_tour'])){
        $id_tour = $_SESSION['order_tour']['id_tour'];
        $first_name = $_SESSION['order_tour']['first_name'];
        $second_name = $_SESSION['order_tour']['second_name'];
        $client_telephone = $_SESSION['order_tour']['client_telephone'];
        $email = $_SESSION['order_tour']['email'];
        $license = $_SESSION['order_tour']['license'];
        $birthday =  $_SESSION['order_tour']['birthday'];
        $date_from = $_SESSION['order_tour']['date_from'];
        $price = $_SESSION['order_tour']['price'];
        $days = $_SESSION['order_tour']['days'];
        $paid =  $_SESSION['order_tour']['paid'];
        $equipment_pax = $_SESSION['order_tour']['equipment_pax'];
        $helmet_pax = $_SESSION['order_tour']['helmet_pax'];
        $single_room = $_SESSION['order_tour']['single_room'];
        $passenger = $_SESSION['order_tour']['passenger'];
        $motorcycle_data = $_SESSION['order_tour']['motorcycle_data'];
        $date_order = $_SESSION['order_tour']['date_order'];
        $subscribe_submit = $_SESSION['order_tour']['subscribe_submit'];

        //sql query
        $sql_tbl_order_tour = "INSERT INTO moto_krastev.tbl_order_tour SET
        first_name = '$first_name',
        second_name = '$second_name',
        client_telephone = '$client_telephone',
        email = '$email',
        license = '$license',
        birthday = '$birthday',
        id_tour = $id_tour,
        price = '$price',
        date_from = '$date_from',
        date_order = '$date_order',
        status = 'изчакваща потвърждение'
        ";

        //execute the query and save in database
        $res_tbl_order_tour = mysqli_query($conn, $sql_tbl_order_tour);

        //last row in tbl_order_tour
        $sql_last_row = "SELECT id_order_tour FROM moto_krastev.tbl_order_tour WHERE id_order_tour =(SELECT MAX(id_order_tour ) FROM moto_krastev.tbl_order_tour)";
        $res_last_row = mysqli_query($conn, $sql_last_row);
        $count = mysqli_num_rows($res_last_row);
        if($count > 0){
        $row = mysqli_fetch_assoc($res_last_row);
        $id_order_tour = $row['id_order_tour'];
        }

        //sql query for tbl_order_tour_passenger
        if($passenger == 'Yes'){
        $first_name_pax = $_SESSION['order_tour_pax']['first_name_pax'];
        $second_name_pax = $_SESSION['order_tour_pax']['second_name_pax'];
        $telephone_pax = $_SESSION['order_tour_pax']['telephone_pax'];
        $email_pax = $_SESSION['order_tour_pax']['email_pax'];

        $sql_tbl_order_passenger = "INSERT INTO tbl_order_tour_passenger SET
                        id_order_tour = $id_order_tour,
                        first_name_pax = '$first_name_pax',
                        second_name_pax = '$second_name_pax',
                        telephone_pax = '$telephone_pax',
                        email_pax = '$email_pax'
                        ";
        $res_tbl_order_passenger = mysqli_query($conn, $sql_tbl_order_passenger);
        }

        //array for motorcycle (0 - > motorcycle, 1 -> price)
        $motorcycle_data_array = explode(',', $motorcycle_data);
        $json_data_moto = json_encode($motorcycle_data_array, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        //query for insert tbl_order_tour_details
        $sql_tbl_order_tour_details = "INSERT INTO moto_krastev.tbl_order_tour_details SET
                        id_order_tour = $id_order_tour,
                        days = '$days',
                        motorcycle_data = '$json_data_moto',
                        paid = '$paid',
                        single_room = '$single_room',
                        passenger = '$passenger',
                        equipment_pax = '$equipment_pax',
                        helmet_pax = '$helmet_pax'
                        ";

        //execute the query and save in database
        $res_tbl_order_tour_details = mysqli_query($conn, $sql_tbl_order_tour_details);

        //check whether the query executed or not and data added or not
        if($res_tbl_order_tour == true && $res_tbl_order_tour_details == true){
        //sql query for reservation count
        $sql_reservation_count= "UPDATE moto_krastev.tbl_tour 
                    SET reservations_count = reservations_count + 1
                    WHERE id_tour = $id_tour";
        mysqli_query($conn, $sql_reservation_count);
        //send mail

        $send_mail = new sendMail;
        $send_mail->recipient_email = $email; //to email

        $title = 'Вашата заявка №'.$id_order_tour.' за мото тур е приета ';
        $send_mail->img_logo = "images/logo.png"; //from php/phpmailer/send.php

        $mail_text = "
        <h1>Вашата заявка №$id_order_tour за мото тур е приета </h1>
        Здравейте,
        <br><br>
        Благодарим Ви, че избрахте нашите мото турове.
        <br>
        Радостни сме да ви уведомим, че вашата заявката за мото тур с номер <b>№ $id_order_tour</b> е регистрирана успешно.
        <br>
        Очаквайте да бъдете уведомени по имейл или телефон за окончателното потвърждение и състоянието за вашата заявка.
        <br>
        Благодарим ви за търпението и разбирането. Ако имате някакви въпроси или се нуждаете от допълнителна информация, не се колебайте да се свържете с нас.
        <br>
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
        }

    //subscribe email
    }
    if ($subscribe_submit === 'Yes') {
        $email_sub = mysqli_real_escape_string($conn, $email);
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

        }else{

            $sql_status_check = "SELECT id_subscriber, status FROM moto_krastev.tbl_subscribers WHERE email = '$email_sub'";
            $res_status_check = mysqli_query($conn, $sql_status_check);
            $count_status_check = mysqli_num_rows($res_status_check);

            if($count_status_check === 1){
                $row_status = mysqli_fetch_assoc($res_status_check);
                $id_subscriber = $row_status['id_subscriber'];
                $current_status = $row_status['status'];

                if($current_status === 'неактивен'){
                    
                    $sql_status_active = "UPDATE moto_krastev.tbl_subscribers SET
                                            unsubscribe_date = NULL,
                                            status = 'активен'
                                            WHERE id_subscriber = $id_subscriber
                                            ";
                    $res_status_active = mysqli_query($conn, $sql_status_active);
                }
            }
        }
    }

                ?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Успешно Плащане</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
        .container h1 {
            color: #4CAF50;
            margin-bottom: 20px;
        }
        .container p {
            font-size: 18px;
            margin-bottom: 20px;
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
        .container .button:hover {
            background-color: #45a049;
        }
    </style>

    <script>
        
        let timeleft = 15;
        let downloadTimer = setInterval(function(){
        if(timeleft <= 0){
            clearInterval(downloadTimer);
            window.location.href = "<?php echo SITEURL; ?>"
        } else {
            document.getElementById("js-countdown-seconds").innerHTML = timeleft + " секунди";
        }
        timeleft -= 1;
        }, 1000);

    </script>
</head>
<body>
    <div class="container">
        <h1>Плащането е успешно!</h1>
        <p>Благодарим ви за вашата заявка. Моля, изчакайте да получите имейл с допълнителни инструкции.</p>

        <p>
            <?php 
                if(isset($_SESSION['order_rent_moto'])){
                    echo "<div class='success'>Заявка №".$id_order_rent."</div>";
                }else if(isset($_SESSION['order_tour'])){
                    echo "<div class='success'>Заявка №".$id_order_tour."</div>";
                }
            ?>
        </p>
        <p>
            <?php 
                if(isset($_SESSION['order_rent_moto'])){
                    echo "<div class='success'>E-mail: ".$email."</div>";
                    unset($_SESSION['order_rent_moto']);
                }else if(isset($_SESSION['order_tour'])){
                    echo "<div class='success'>E-mail: ".$email."</div>";
                    unset($_SESSION['order_tour']);
                }
            ?>
        </p>
        <p>Ще бъдете пренасочени обратно към началната страница след <span id="js-countdown-seconds">8 секунди</span>.</p>
        <a href="<?php echo SITEURL; ?>" class="button">Върнете се към началната страница</a>
    </div>

   
</body>
</html>