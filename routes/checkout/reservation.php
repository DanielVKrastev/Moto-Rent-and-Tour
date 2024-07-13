<?php
include('../../partials-front/menu.php');
?>

<head>
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>/css/reservation.css" media="screen" />
</head>

<body>
    <?php
    error_reporting(0);
    if (isset($_GET['id'])) {
        //get the moto id
        $id_tour = $_GET['id'];

        //get the details
        $sql = "SELECT * FROM tbl_tour WHERE id_tour=$id_tour";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //count the rows
        $count = mysqli_num_rows($res);
        //check whether the data is available or not
        if ($count == 1) {
            //get the data from database
            $row = mysqli_fetch_assoc($res);
            $country = $row['country'];
            $cities = $row['cities'];
            $days = $row['days'];

            //array for cities
            $city = explode(',', $cities);
            //get values from tour.php
            $start_date = $_POST['start_date'];
            $price_from = $_POST['price_from'];
            $add_options_passenger = $_POST['add-options-passenger'];

            //add options
            if (isset($_POST['add-options-motorcycle'])) {
                $add_options_motorcycle = $_POST['add-options-motorcycle'];
            } else {
                $add_options_motorcycle = "Собствен мотор, 0.00";
            }
            //array for motorcycle (0 - > motorcycle, 1 -> price)
            $motorcycle = explode(',', $add_options_motorcycle);

            if (isset($_POST['add-options-singleroom'])) {
                $add_options_singleroom = $_POST['add-options-singleroom'];
                $single_room = 'Yes';
            } else {
                $add_options_singleroom = "0.00";
                $single_room = 'No';
            }

            if (isset($_POST['add-options-passenger'])) {
                $add_options_passenger = $_POST['add-options-passenger'];
                $passenger = 'Yes';
            } else {
                $add_options_passenger = "0.00";
                $passenger = 'No';
            }

            if (isset($_POST['add-options-equipment'])) {
                $add_options_equipment = $_POST['add-options-equipment'];
                $equipment_pax = 'Yes';
            } else {
                $add_options_equipment = "0.00";
                $equipment_pax = 'No';
            }

            if (isset($_POST['add-options-helmet'])) {
                $add_options_helmet = $_POST['add-options-helmet'];
                $helmet_pax = 'Yes';
            } else {
                $add_options_helmet = "0.00";
                $helmet_pax = 'No';
            }

            $sum_add_options = $motorcycle[1] + $add_options_singleroom + $add_options_passenger + $add_options_equipment + $add_options_helmet;
            $total_price = $sum_add_options + $price_from;
        }
    } else {
        header("location: ../../routes.php");
    }

    ?>
    <div class="reservation-2-boxs">
        <form action="checkout.php" method="POST">
            <div class="reservation-data-left" id="reservation-data-left">
                <!-- Start section for reservation for data driver -->
                <section class="reservation-driver-section">
                    <h1>Детайли за резервацията за мото тур</h1>
                    <br>
                    <h2>Данни за водача</h2>
                    <h3>Тази информация ще се използва за потвърждение за наем</h3>

                    <div class="input-reservation-box">
                        <label for="fname">Име *</label>
                        <br>
                        <input type="text" name="first_name" placeholder="Име" required>
                    </div>

                    <div class="input-reservation-box">
                        <label for="lname">Фамилия *</label>
                        <br>
                        <input type="text" name="second_name" placeholder="Фамилия" required>
                    </div>

                    <div class="input-reservation-box">
                        <label for="telephone">Телефонен номер *</label>
                        <br>
                        <input type="text" name="client_telephone" value="+359 " required>
                    </div>

                    <div class="input-reservation-box">
                        <label for="email">E-mail *</label>
                        <br>
                        <input type="text" name="email" placeholder="email@email.com" required>
                    </div>

                    <div class="input-reservation-box">
                        <label for="license-category">Категория *</label>
                        <br>
                        <select name="license-category" require>
                            <option value="A">A</option>
                            <option value="A2">A2</option>
                            <option value="A1">A1</option>
                            <option value="AM">AM</option>
                        </select>
                    </div>

                    <div class="input-reservation-box" require>
                        <label for="birthday">Рожденна дата *</label>
                        <br>
                        <input type="date" name="birthday">
                    </div>

                    <div class="clearfix"></div>
                </section>
                <!-- End section for reservation for data driver -->
                <hr>
                <!-- Start section for reservation for data passenger  -->
                <?php 
                    if($add_options_passenger != '0.00'){
                        $passenger = 'Yes';
                        ?>
                            <section class="reservation-driver-section">
                                <br>
                                <h2>Данни за пасажер</h2>

                                <div class="input-reservation-box">
                                    <label for="first-name-pax">Име *</label>
                                    <br>
                                    <input type="text" name="first-name-pax" placeholder="Име" required>
                                </div>

                                <div class="input-reservation-box">
                                    <label for="second-name-pax">Фамилия *</label>
                                    <br>
                                    <input type="text" name="second-name-pax" placeholder="Фамилия" required>
                                </div>

                                <div class="input-reservation-box">
                                    <label for="telephone-pax">Телефонен номер *</label>
                                    <br>
                                    <input type="text" name="telephone-pax" value="+359 " required>
                                </div>

                                <div class="input-reservation-box">
                                    <label for="email-pax">E-mail *</label>
                                    <br>
                                    <input type="text" name="email-pax" placeholder="email@email.com" required>
                                </div>
                        <!--
                                <div class="input-reservation-box" require>
                                    <label for="birth-day">Рожденна дата *</label>
                                    <br>
                                    <input type="date" name="birth-day-passenger">
                                </div>
                        -->

                                <div class="clearfix"></div>
                            </section>
                            <hr>
                        <?php
                    }else{
                        $passenger = 'No';
                    }
                ?>
                
                <!-- End section for reservation for data passager -->

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
                    <img src="administrator/images/motorcycle/" alt="">
                </div>

                <div class="reservation-rout-title">
                    <b><?php echo $country; ?></b>
                    <p><?php echo $cities; ?></p>
                    <input type="hidden" name="id_tour" value="<?php echo $id_tour;?>">
                </div>

                <hr>

                <div class="checkout-2-boxs">
                    <div class="start-date-rent">
                        <h5>От</h5>
                        <div class="date">
                            <img src="<?php echo SITEURL; ?>/images/icons/icons8-date-50.png" alt="">
                            <?php echo date('d.m.Y', strtotime($start_date)); ?>г.
                            <input type="hidden" name="date_from" value="<?php echo $start_date; ?>">
                        </div>
                        <div class="location">
                            <?php echo $city[0]; ?>
                        </div>
                    </div>

                    <div class="end-date-rent">
                        <h5>До</h5>
                        <div class="date">
                            <img src="<?php echo SITEURL; ?>/images/icons/icons8-date-50.png" alt="">
                            <?php echo date('d.m.Y', strtotime($start_date . "+ $days days")); ?>г.
                        </div>
                        <div class="location">
                            <?php $count_city = count($city);
                            echo $city[$count_city - 1]; ?>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="checkout-2-boxs">
                    <div class="description">
                        <div class="desc-header">Период на тура (<?php echo $days; ?> дни)</div>
                        <input type="hidden" name="days" value="<?php echo $days; ?>">

                        <div class="desc-header">Добавки</div>
                        <div class="desc-sub"><?php echo $motorcycle[0]; //motorcycle ?></div>
                        <div class="desc-sub">Самостоятелна стая</div>
                        <div class="desc-sub">Пасажер</div>
                        <div class="desc-sub">Екипировка за пасажер</div>
                        <div class="desc-sub">Каска за пасажер</div>

                        <div class="desc-header"><b>Общо</b></div>
                    </div>

                    <div class="checkout-prices">
                        <div class="price-header"><?php echo number_format($price_from, 2); ?> лв.</div>

                        <div class="price-header">
                            <?php echo number_format($sum_add_options, 2); ?> лв.
                        </div>
                        <div class="price-sub"><?php echo number_format($motorcycle[1],2); //price for motorcycle ?> лв.</div>
                        <input type="hidden" name="motorcycle-data" value="<?php echo $add_options_motorcycle;?>">
                        <div class="price-sub"><?php echo number_format($add_options_singleroom,2);?> лв.</div>
                        <input type="hidden" name='single-room' value="<?php echo $single_room; ?>">
                        <div class="price-sub"><?php echo number_format($add_options_passenger,2);?> лв.</div>
                        <input type="hidden" name='passenger' value="<?php echo $passenger; ?>">
                        <div class="price-sub"><?php echo number_format($add_options_equipment,2);?> лв.</div>
                        <input type="hidden" name='equipment-pax' value="<?php echo $equipment_pax; ?>">
                        <div class="price-sub"><?php echo number_format($add_options_helmet,2);?> лв.</div>
                        <input type="hidden" name='helmet-pax' value="<?php echo $helmet_pax; ?>">


                        <div class="price-header"><b><?php echo number_format($sum_add_options + $price_from,2); ?> лв.</b></div>
                    </div>
                </div>

                <hr>

                <div class="checkout-2-boxs">
                    <div class="pay-now">
                        <b>Плати сега</b>
                        <p><?php echo number_format($total_price * 0.2,0); ?> лв.</p>
                        <input type="hidden" name="paid" value="<?php echo $total_price * 0.20;?>">
                    </div>

                    <div class="pay-onsite">
                        <b>Плати на място</b>
                        <p><?php echo number_format($total_price * 0.8,0); ?> лв.</p>
                    </div>
                </div>

                <div class="pay-button text-center">
                <input type="hidden" name="total_price" value="<?php echo $total_price;?>">
                <input type="submit" name="submit_pay_tour" value="Плати  <?php echo number_format($total_price * 0.2,0); ?> лв">
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
                    <button name="submit_pay_tour">Плати <?php echo number_format(($sum_add_options + $price_from) * 0.2,0);?> лв</button>
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

        function clickOutsideBox() {
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