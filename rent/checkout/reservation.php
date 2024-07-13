<?php 
    include ('../../partials-front/menu.php');

    //$days = $_POST['rent-days'];
    //echo $days;
?>

<head>
<link rel="stylesheet" type="text/css" href="<?php echo SITEURL;?>/css/reservation.css" media="screen"/>
</head>
<body>
    <?php
        if(isset($_GET['id'])){
            //get the moto id
            $id_motorcycle = $_GET['id'];

            //get the details 
            $sql = "SELECT * FROM tbl_motorcycle WHERE id_motorcycle=$id_motorcycle";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count the rows
            $count = mysqli_num_rows($res);
            //check whether the data is available or not
            if($count == 1){
                //get the data from database
                $row = mysqli_fetch_assoc($res);

                $brand = $row['brand'];
                $model = $row['model'];
                $image_name = $row['image_name'];

                //get values from motorcycle.php
                $start_rent_date = $_POST['start-rent-date'];
                $end_rent_date = $_POST['end-rent-date'];

                //if date is not date redirect to back page
                if($start_rent_date !== date('Y-m-d',strtotime($start_rent_date)) || $end_rent_date !== date('Y-m-d',strtotime($end_rent_date))){
                    $_SESSION['error-date'] = "<div class='error'>Невалидна дата. Изберете друга.</div>";
                    header('Location:'.SITEURL.'rent/motorcycle.php?id='.$id_motorcycle);
                }

                $rent_days = $_POST['rent-days'];
                $rent_price_sum = $_POST['rent-price-sum'];
                $rent_price_per_day = $_POST['rent-per-day'];

                //add options
                if(isset($_POST['add-options-equipment'])){
                    $add_options_equipment = $_POST['add-options-equipment'];
                    $equipment = 'Yes';
                }else{
                    $add_options_equipment = "0.00";
                    $equipment = 'No';
                }

                if(isset($_POST['add-options-helmet'])){
                    $add_options_helmet = $_POST['add-options-helmet'];
                    $helmet = 'Yes';
                }else{
                    $add_options_helmet = "0.00";
                    $helmet = 'No';
                }

                if(isset($_POST['add-options-tank'])){
                    $add_options_tank = $_POST['add-options-tank'];
                    $tank = 'Yes';
                }else{
                    $add_options_tank = "0.00";
                    $tank = 'No';
                }

                if(isset($_POST['add-options-delivery-airport'])){
                    $add_options_delivery_airport = $_POST['add-options-delivery-airport'];
                }else{
                    $add_options_delivery_airport = "0.00";
                }

                if(isset($_POST['add-options-return-airport'])){
                    $add_options_return_airport = $_POST['add-options-return-airport'];
                }else{
                    $add_options_return_airport = "0.00";
                }

                if(isset($_POST['add-options-delivery-hotel'])){
                    $add_options_delivery_hotel = $_POST['add-options-delivery-hotel'];
                }else{
                    $add_options_delivery_hotel = "0.00";
                }

                if(isset($_POST['add-options-return-hotel'])){
                    $add_options_return_hotel = $_POST['add-options-return-hotel'];
                }else{
                    $add_options_return_hotel = "0.00";
                }

                $sum_add_option = $add_options_equipment + 
                                            $add_options_helmet + 
                                            $add_options_tank + 
                                            $add_options_delivery_airport + 
                                            $add_options_return_airport + 
                                            $add_options_delivery_hotel +
                                            $add_options_return_hotel;
                $total_price = $rent_price_sum + $sum_add_option;
            }


        }else{
            header("location: ../../rent.php");
        }
    ?>
    <div class="reservation-2-boxs">
        <form action="checkout.php" method="POST">
            <div class="reservation-data-left" id="reservation-data-left">
                <!-- Start section for reservation for data driver -->
                <section class="reservation-driver-section">
                    <h1>Детайли за резервацията</h1>
                    <br>
                    <h2>Данни за водача</h2>
                    <h3>Тази информация ще се използва за потвърждение за наем</h3>

                    <div class="input-reservation-box">        
                        <label for="first_name">Име *</label>
                        <br>
                        <input type="text" name="first_name" placeholder="Име" required>
                    </div>

                    <div class="input-reservation-box">        
                        <label for="second_name">Фамилия *</label>
                        <br>
                        <input type="text" name="second_name" placeholder="Фамилия" required>
                    </div>

                    <div class="input-reservation-box">
                        <label for="client_telephone">Телефонен номер *</label>
                        <br>
                        <input type="text" name="client_telephone" value="+359 " required>
                    </div>

                    <div class="input-reservation-box">
                        <label for="email">E-mail *</label>
                        <br>
                        <input type="text" name="email" placeholder="email@email.com" required>
                    </div>

                    <div class="input-reservation-box">
                        <label for="license_category">Категория *</label>
                        <br>
                        <select name="license_category" required>
                            <option value="A">A</option>
                            <option value="A2">A2</option>
                            <option value="A1">A1</option>
                            <option value="AM">AM</option>
                        </select>
                    </div>

                    <div class="input-reservation-box" required>
                        <label for="birthday">Рожденна дата *</label>
                        <br>
                        <input type="date" name="birthday">
                    </div>

                    <div class="clearfix"></div>
                </section>
                <!-- End section for reservation for data driver -->

                <hr>

                <!-- Start section for Terms & Conditions -->
                <section class="terms-section">
                    <h2>Правила и условия</h2>
                    <h3>Приемете условията за да продължите</h3>

                    <div class="terms-box">
                        <div class="terms-checkbox text-center">
                            <input type="checkbox" name="terms" value="Accept" required>
                        </div>
                        <div class="terms-text">
                            Приемам политиката за поверителност на Moto Krastev Rent & Tour, условията за ползване и условия за резервация.
                        </div>
                    </div>  

                    <div class="terms-box">
                        <div class="terms-checkbox text-center">
                            <input type="checkbox" name="subscribe-submit" value="Yes">
                        </div>
                        <div class="terms-text">
                            Абонирайте се за нашия бюлетин и ние ще ви информираме за нашите нови обиколки и услуги.
                        </div>
                    </div>
                    
                </section>
                <!-- End section for Terms & Conditions -->
            </div>

            <div class="reservation-checkout-right text-center" id=reservation-checkout-right>
                <div class="reservation-moto-img">
                    <img src="<?php echo SITEURL;?>administrator/images/motorcycle/<?php echo $image_name; ?>" alt="">
                </div>

                <div class="reservation-moto-title">
                    <b><?php echo $brand ." ". $model; ?></b>
                </div>

                <hr>

                <div class="checkout-2-boxs">
                    <div class="start-date-rent">
                        <h5>Наемане</h5>
                        <div class="date">
                            <img src="<?php echo SITEURL;?>/images/icons/icons8-date-50.png" alt="">
                            <input type="hidden" name="date_from" value="<?php echo $start_rent_date; ?>">
                            <?php echo $start_rent_date; ?>
                        </div>
                        <div class="location">
                            <?php 
                                if($add_options_delivery_airport != "0.00"){
                                    ?> 
                                    <img src="<?php echo SITEURL;?>/images/icons/icons8-airport-64.png" alt="">
                                    от летище
                                    <input type="hidden" name="delivery" value="от летище">
                                    <?php
                                }else if($add_options_delivery_hotel != "0.00"){
                                    ?> 
                                    <img src="<?php echo SITEURL;?>/images/icons/icons8-5-star-hotel-64.png" alt="">
                                    от хотел
                                    <input type="hidden" name="delivery" value="от хотел">
                                    <?php
                                }else{
                                    ?> 
                                    <img src="<?php echo SITEURL;?>/images/icons/icons8-office-50.png" alt="">
                                    от офис
                                    <input type="hidden" name="delivery" value="от офис">
                                    <?php
                                }
                            ?>
                            
                        </div>
                    </div>

                    <div class="end-date-rent">
                        <h5>Отдаване</h5>
                        <div class="date">
                            <img src="<?php echo SITEURL;?>/images/icons/icons8-date-50.png" alt="">
                            <input type="hidden" name="date_to" value="<?php echo $end_rent_date; ?>">
                            <?php echo $end_rent_date; ?>
                        </div>
                        <div class="location">
                            
                            <?php
                                if($add_options_return_airport != "0.00"){
                                    ?> 
                                    <img src="<?php echo SITEURL;?>/images/icons/icons8-airport-64.png" alt="">
                                    от летище
                                    <input type="hidden" name="bring_back" value="от летище">
                                    <?php
                                }else if($add_options_return_hotel != "0.00"){
                                    ?> 
                                    <img src="<?php echo SITEURL;?>/images/icons/icons8-5-star-hotel-64.png" alt="">
                                    от хотел
                                    <input type="hidden" name="bring_back" value="от хотел">
                                    <?php
                                }else{
                                    ?> 
                                    <img src="<?php echo SITEURL;?>/images/icons/icons8-office-50.png" alt="">
                                    от офис
                                    <input type="hidden" name="bring_back" value="от офис">
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="checkout-2-boxs">
                    <div class="description">
                        <input type="hidden" name="id_motorcycle" value="<?php echo $id_motorcycle; ?>">
                        <div class="desc-header">Наем на мотоциклет (<?php echo $rent_days; ?> дни)</div>
                        <input type="hidden" name="days" value="<?php echo $rent_days; ?>">
                        <div class="desc-sub">Наем за ден</div>

                        <div class="desc-header">Добавки</div>
                        <div class="desc-sub">Екипировка</div>
                        <div class="desc-sub">Каска</div>
                        <div class="desc-sub">Празен резервоар</div>
                        <div class="desc-sub">Доставяне/летище/</div>
                        <div class="desc-sub">Връщане/летище/</div>
                        <div class="desc-sub">Доставяне/хотел/</div>
                        <div class="desc-sub">Връщане/хотел/</div>

                        <div class="desc-header"><b>Общо</b></div>
                    </div>

                    <div class="checkout-prices">
                        <div class="price-header"><?php echo number_format($rent_price_sum,2); ?> лв.</div>
                        <div class="price-sub"><?php echo $rent_price_per_day; ?> лв.</div>
                        
                        <div class="price-header">
                        <?php echo number_format($sum_add_option, 2); ?> лв.</div>
                        <div class="price-sub"><?php echo $add_options_equipment; ?> лв. 
                        <input type="hidden" name="equipment" value="<?php echo $equipment; ?>"></div>
                        <div class="price-sub"><?php echo $add_options_helmet; ?> лв. 
                        <input type="hidden" name="helmet" value="<?php echo $helmet; ?>"></div>
                        <div class="price-sub"><?php echo $add_options_tank; ?> лв. 
                        <input type="hidden" name="tank" value="<?php echo $tank; ?>"></div>
                        <div class="price-sub"><?php echo $add_options_delivery_airport; ?> лв.</div>
                        <div class="price-sub"><?php echo $add_options_return_airport; ?> лв.</div>
                        <div class="price-sub"><?php echo $add_options_delivery_hotel; ?> лв.</div>
                        <div class="price-sub"><?php echo $add_options_return_hotel; ?> лв.</div>

                        <div class="price-header"><b><?php echo number_format($total_price,2); ?> лв.</b></div>
                    </div>
                </div>

                <hr>

                <div class="checkout-2-boxs">
                    <div class="pay-now">
                        <b>Плати сега</b>
                        <p><?php echo $total_price * 0.20;?> лв.</p>
                        <input type="hidden" name="paid" value="<?php echo $total_price * 0.20;?>">
                    </div>

                    <div class="pay-onsite">
                        <b>Плати на място</b>
                        <p><?php echo $total_price * 0.80;?> лв.</p>
                        <input type="hidden" name="afterpay" value="<?php echo $total_price * 0.80;?>">
                    </div>
                </div>

                <div class="pay-button text-center">
                    <input type="hidden" name="total_price" value="<?php echo $total_price;?>">
                    <input type="submit" name="submit_pay_rent_moto" value="Плати <?php echo $total_price * 0.20;?> лв">
                </div>

                <div class="close-button text-center">
                    <div class="button" onclick="closeForm();">Затвори</div>
                </div>
            </div>

            <div class="buttons-mobile text-center" id="buttons-mobile">
                    <div class="more-button" onclick="openForm();">
                        Подробности <img src="<?php echo SITEURL; ?>images/icons/icons8-rightward-up-arrow-50.png" alt="">
                    </div>

                    <div class="pay-button-mobile">
                        <button name="submit_pay_rent_moto">Плати <?php echo number_format(($total_price * 0.20) ,0);?> лв</button>
                    </div>
            </div>

            <div class="clearfix"></div>
        </form>
    </div>

    <script type="text/javascript">

        function openForm() {

                console.log("window width < 1080px");
                document.getElementById("buttons-mobile").style.display = "none";
                document.getElementById("reservation-checkout-right").style.display = "block";
                document.getElementById("reservation-checkout-right").style.margin = "0 auto";
                document.getElementById("reservation-data-left").style.filter = "blur(3px)";
            clickOutsideBox();
            }

            function clickOutsideBox(){
            document.addEventListener('mouseup', function(clickOutsideBox) {
                let box = document.getElementById('reservation-checkout-right');
                if (!box.contains(clickOutsideBox.target)) {
                    box.style.display = 'none';
                    console.log('click');
                    document.getElementById("reservation-data-left").style.filter = "blur(0px)";
                    document.getElementById("buttons-mobile").style.display = "inline-block";
                }
            });
        }

        function closeForm() {
            document.getElementById("buttons-mobile").style.display = "inline-block";
            document.getElementById("reservation-checkout-right").style.display = "none";
            document.getElementById("reservation-data-left").style.filter = "blur(0px)";
        }
    
    </script>

    
</body>
<?php
    include("../../partials-front/footer.php");
?>