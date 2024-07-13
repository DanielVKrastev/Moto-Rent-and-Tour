<?php include("../partials-front/menu.php"); ?>

<head>
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>/css/motorcycle-routes.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>/css/comment-policy-options.css" media="screen" />
</head>

<body>

    <?php
    if (isset($_GET['id'])) {
        //get the tour ID
        $id_tour = $_GET['id'];

        //get the details 
        $sql = "SELECT * FROM tbl_tour t
                INNER JOIN tbl_tour_motorcycle m ON t.id_motorcycle_group = m.id_motorcycle_group
                WHERE id_tour = $id_tour";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //count the rows
        $count = mysqli_num_rows($res);
        //check whether the data is available or not
        if ($count == 1) {
            //get the data form database
            $row = mysqli_fetch_assoc($res);

            $country = $row['country'];
            $cities = $row['cities'];
            $price = $row['price'];
            $distance = $row['distance'];
            $days = $row['days'];
            $description = $row['description'];
            $limit_people = $row['limit_people'];
            $languages = $row['languages'];
            $motorcycle1 = $row['motorcycle1'];
            $motorcycle1_price = $row['motorcycle1_price'];
            $motorcycle2 = $row['motorcycle2'];
            $motorcycle2_price = $row['motorcycle2_price'];
            $motorcycle3 = $row['motorcycle3'];
            $motorcycle3_price = $row['motorcycle3_price'];
            $map = $row['map'];
            $image = $row['image'];
            $date[0] = $row['date1'];
            $date[1] = $row['date2'];
            $date[2] = $row['date3'];
            $date[3] = $row['date4'];
        }
    }
    ?>

    <div class="img-header" id="img-header" style="background-image: url(<?php echo SITEURL; ?>administrator/images/tour/<?php echo $image; ?>);"></div>
   <!-- target='_blank'  new page -->
    <div class="page-2-boxs">
        <form id="form-reservation" method="POST" target="" action="<?php echo SITEURL; ?>routes/checkout/reservation.php?id=<?php echo $id_tour; ?>"></form>
            <div class="page-box-left" id="page-box-left">

                <div class="route-title">
                    <h2><?php echo $country; ?></h2>
                </div>

                <div class="route-city">
                    <h3><?php echo $cities; ?></h3>
                </div>
                <!-- Start section for ROUTE SPECS -->
                <section class="route-specs">

                    <div class="route-specs-box">
                        <div class="route-specs-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-road-60.png" alt="">
                        </div>
                        <div class="route-specs-text"> <?php echo $distance; ?> км.</div>
                    </div>

                    <div class="route-specs-box">
                        <div class="route-specs-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-people-50.png" alt="">
                        </div>
                        <div class="route-specs-text"> до <?php echo $limit_people; ?> души</div>
                    </div>

                    <div class="route-specs-box">
                        <div class="route-specs-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-price-50.png" alt="">
                        </div>
                        <div class="route-specs-text"> от <?php echo $price; ?> лв.</div>
                    </div>

                    <div class="route-specs-box">
                        <div class="route-specs-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-calendar-50.png" alt="">
                        </div>
                        <div class="route-specs-text"> <?php echo $days; ?> дни, <?php echo $days - 1; ?> нощувки, <?php if ($days <= 2) {
                                                                                                                        echo $days;
                                                                                                                    } else {
                                                                                                                        echo $days - 2;
                                                                                                                    } ?> мото дни</div>
                    </div>

                    <div class="route-specs-box">
                        <div class="route-specs-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-language-50.png" alt="">
                        </div>
                        <div class="route-specs-text"><?php echo $languages; ?></div>
                    </div>

                </section>
                <!-- End section for ROUTE SPECS -->
                <hr>
                <!-- Start section for DESCRIPTION FOR RENT -->
                <section class="desc-rent">

                    <div class="subtitle">
                        <h2>Детайли за мото тура</h2>
                        <h3>ВСИЧКО ЗА ВАШИЯ НЕЗАБРАВИМ МОТО ТУР</h3>
                    </div>

                    <div class="description">
                        <?php echo $description; ?>
                    </div>

                    <div class="subtitle">
                        <h3>МАРШРУТ НА МОТО ТУРА</h3>
                    </div>

                    <div class="map">
                        <img src="<?php echo SITEURL; ?>administrator/images/tour/maps/<?php echo $map; ?>" alt="">
                    </div>

                </section>
                <!-- End section for DESCRIPTION FOR RENT -->

                <!-- Start section for INCLUDE IN PRICE -->
                <section class="include-price">
                    <div class="subtitle">
                        <h2>Включено в цената</h2>
                        <h3>ВСИЧКИ ОБИЧАТ БЕЗПЛАТНИТЕ НЕЩА!</h3>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-jacket-64.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            Включена екипировка
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-petrol-full-64.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            Гориво през целия тур
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-suitcase-64.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            Куфар за моторциклета
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-shake-phone-64.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            Държач за мобилен телефон
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-ticket-50.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            Билети за ферибот
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-roadway-50.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            Включени пътни такси
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-dinner-50.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            Осигурена закуска и вечеря
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-man-50.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            Профисионален екскурзовод
                        </div>
                    </div>

                    <div class="clearfix"></div>

                </section>
                <hr>
                <!-- End section for INCLUDE IN PRICE -->

                <!-- Start section for motorcycle option -->
                <section class="add-option">
                    <div class="subtitle">
                        <h2>Мотори под наем</h2>
                        <h3>НЯМАШ СОБСТВЕН МОТОР, НАЕМИ ОТ НАС</h3>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-motorcycle-50-v2.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            <input form="form-reservation" type="radio" name="add-options-motorcycle" value="СОБСТВЕН МОТОР, 0.00" data-amount="0" onclick="checkBoxSum()" checked>
                            СОБСТВЕН МОТОР <b>+ 0 лв.</b>
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-motorcycle-50-v2.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            <input form="form-reservation" type="radio" name="add-options-motorcycle" value="<?php echo $motorcycle1 . ", " . number_format($motorcycle1_price, 2) ?>" data-amount="<?php echo $motorcycle1_price; ?>" onclick="checkBoxSum()">
                            <?php echo $motorcycle1; ?> <b>+ <?php echo $motorcycle1_price; ?> лв.</b>
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-motorcycle-50-v2.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            <input form="form-reservation" type="radio" name="add-options-motorcycle" value="<?php echo $motorcycle2 . ", " . number_format($motorcycle2_price, 2) ?>" data-amount="<?php echo $motorcycle2_price; ?>" onclick="checkBoxSum()">
                            <?php echo $motorcycle2; ?> <b>+ <?php echo $motorcycle2_price; ?> лв.</b>
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-motorcycle-50-v2.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            <input form="form-reservation" type="radio" name="add-options-motorcycle" value="<?php echo $motorcycle3 . ", " . number_format($motorcycle3_price, 2) ?>" data-amount="<?php echo $motorcycle3_price; ?>" onclick="checkBoxSum()">
                            <?php echo $motorcycle3; ?> <b>+ <?php echo $motorcycle3_price; ?> лв.</b>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                </section>
                <!-- End section for motorcycle option -->
                <hr>
                <!-- Srart section for add-options -->
                <section class="add-option" id="sumCheckboxes">
                    <div class="subtitle">
                        <h2>Налични добавки</h2>
                        <h3>ИСКАШ НЯКАКВА ДОПЪЛНИТЕЛНА ЕКСТРА?</h3>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-bedroom-interior-50.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            <input form="form-reservation" type="checkbox" name="add-options-singleroom" value="150.00" data-amount="150" onclick="checkBoxSum()">
                            Самостоятелна стая <b>+ 150 лв.</b>
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-passager-50.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            <input form="form-reservation" type="checkbox" name="add-options-passenger" value="350.00" data-amount="350" onclick="checkBoxSum()">
                            Пасажер <b>+ 350 лв.</b>
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-jacket-passager-64.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            <input form="form-reservation" type="checkbox" name="add-options-equipment" value="25.00" data-amount="25" onclick="checkBoxSum()">
                            Екипировка за пасажер <b>+ 25 лв.</b>
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-helmet-64.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            <input form="form-reservation" type="checkbox" name="add-options-helmet" value="20.00" data-amount="20" onclick="checkBoxSum()">
                            Каска за пасажер <b>+ 20 лв.</b>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </section>
                <!-- End section for add-options -->
                <hr>
                <!-- Start section for policy rental -->
                <section class="policy-rent">
                    <div class="subtitle">
                        <h2>Политика за наемане</h2>
                        <h3>НЕЩА КОИТО ТРЯБВА ДА ЗНАЕТЕ!</h3>
                    </div>

                    <div class="policy-box">
                        <div class="policy-box-icon">
                            <img src="<?php echo SITEURL; ?>images/icons/policy/icons8-dolar-64.png" alt="">
                        </div>
                        <div class="policy-box-text"><b>Платете сега 20% от сумата</b>, а останалото ще платите на място.</div>
                    </div>

                    <div class="policy-box">
                        <div class="policy-box-icon">
                            <img src="<?php echo SITEURL; ?>images/icons/policy/icons8-refund-50.png" alt="">
                        </div>
                        <div class="policy-box-text">Може да анулирате <b>заявката 7 дни преди дата на заявката.</b> Получавате пълната сума.</div>
                    </div>

                    <div class="policy-box">
                        <div class="policy-box-icon">
                            <img src="<?php echo SITEURL; ?>images/icons/policy/icons8-man-50.png" alt="">
                        </div>
                        <div class="policy-box-text">Трябва да сте на поне 21 години и да имате 12 месеца шофьорски стаж.</div>

                    </div>

                    <div class="policy-box">
                        <div class="policy-box-icon">
                            <img src="<?php echo SITEURL; ?>images/icons/policy/icons8-more-50.png" alt="">
                        </div>
                        <div class="policy-box-text">Включеното в цената и платените добавки зависят от наличността.</div>
                    </div>

                    <div class="policy-box">
                        <div class="policy-box-icon">
                            <img src="<?php echo SITEURL; ?>images/icons/policy/icons8-call-50.png" alt="">
                        </div>
                        <div class="policy-box-text">Ако имате въпроси и някакви изисквания, обърнете се към <a href="<?php echo SITEURL; ?>about.php">"Контакти"</a> </div>
                    </div>

                    <div class="clearfix"></div>
                </section>
                <!-- End section for policy rental -->
                 <hr>
                 <!-- Start section for comment -->
                <?php include("../partials-front/comments.php"); ?>
                <!-- End section for comment -->                                                                                                   
                
            </div>

            <div class="page-box-right text-center" id="page-box-right">
                <div class="btn-close-box">
                    <img src="../images/icons/icons8-close-48.png" alt="" onclick="closeForm();">
                </div>
                <div class="rent-for-days js-rent-for-days">Маршрут за<br> <?php echo $days; ?> дни,<br> <?php echo $days - 1; ?> нощувки,<br> <?php if ($days <= 2) {
                                                                                                                                                    echo $days;
                                                                                                                                                } else {
                                                                                                                                                    echo $days - 2;
                                                                                                                                                } ?> мото дни</div>
                <div class="rent-per-day js-rent-per-day"><?php echo $country; ?> (<?php echo $cities; ?>)</div>
                <div class="rent-price-sum js-tour-price-sum"><?php echo $price; ?> лв.</div>
                <input form="form-reservation" type="hidden" value="<?php echo $price; ?>" name="price_from" class="js-tour-price">
                <input form="form-reservation" type="hidden" value="<?php echo $price; ?>" class="js-tour-price-sum-input">

                <br>
                <hr><br>

                <div class="rent-dates" id="">
                    <p>Дати на маршрута </p>
                    <select form="form-reservation" name="start_date" id="" required>
                        <?php
                        for ($i = 0; $i <= 3; $i++) {
                            if ($date[$i] != "0000-00-00") {
                                $date_ord = $date[$i];

                                //query for dates on tbl_order_tour
                                $sql_order_tour_date = "SELECT COUNT(*) AS date_count
                                                        FROM tbl_order_tour
                                                        WHERE id_tour = $id_tour AND date_from = '$date_ord' AND status != 'отказана'
                                                        ";

                                //query for dates on tbl_tour for limit people on tour
                                $sql_tbl_tour_limit = "SELECT limit_people FROM tbl_tour
                                                        WHERE id_tour = $id_tour
                                                        ";
                                //execute
                                $res_order_tour_date = mysqli_query($conn, $sql_order_tour_date);
                                $res_tour_limit = mysqli_query($conn, $sql_tbl_tour_limit);

                                $count_tour_limit = mysqli_num_rows($res_tour_limit);
                                $count_order_tour_date = mysqli_num_rows($res_order_tour_date);

                                if ($count_order_tour_date = 1 && $count_tour_limit = 1) {
                                    $row_date = mysqli_fetch_assoc($res_order_tour_date);
                                    $row_limit = mysqli_fetch_assoc($res_tour_limit);
                                    $date_count = $row_date['date_count'];
                                    $limit_people = $row_limit['limit_people'];
                                }
                                if ($date_count < $limit_people) {
                                ?>
                                <option style="display:none" value="">Избери дата</option>
                                    <option value="<?php echo $date[$i]; ?>"><?php echo date('d.m.Y', strtotime($date[$i])); ?>
                                                    г. - 
                                                    <?php echo date('d.m.Y', strtotime($date[$i] . "+ $days days")); ?>г.</option>
                        <?php
                                } 
                            }
                        }
                        ?>
                        <option style="display:none" value="">Няма налични дати</option>
                    </select>
                </div>


                <div class="check-button">
                    <button form="form-reservation" type="submit" onclick="sender();">Продължи</button>
                </div>

                <hr>

                <div class="more-rent">
                    <img src="../images/icons/icons8-check-48.png" alt="">
                    Гъвкаво анулиране
                    <br>
                    <img src="../images/icons/icons8-check-48.png" alt="">
                    Безплатна корекция
                </div>
            </div>
        <div class="page-box-right-mobile text-center" id="mobile-box">
            <div class="rent-for-days js-rent-for-days-mobile">За <?php echo $days; ?> дни</div>
            <div class="rent-price-sum js-tour-price-sum-mobile"><?php echo $price; ?> лв.</div>

            <div class="next-button-mobile">
                <button onclick="openForm(); ">Напред</button>
            </div>
        </div>
    </div>

    <div id="page-boxs-end"></div>
    <script type="text/javascript" src="../js/sticky-div.js"></script>
    <script type="text/javascript" src="../js/mobile-rent-box.js"></script>
    <script type="text/javascript" src="../js/tour-page/calculation.js"></script>

    <?php include("../partials-front/footer.php"); ?>