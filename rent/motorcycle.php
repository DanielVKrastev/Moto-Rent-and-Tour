<?php
include('../partials-front/menu.php');
?>

<head>
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>/css/motorcycle-routes.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>/css/comment-policy-options.css" media="screen" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>

    <?php
    if (isset($_GET['id'])) {
        //get the moto ID
        $id_motorcycle = $_GET['id'];

        //sql query
        include('../php/moto-krastev/Queries.php');
        $query = new Queries;
        $sql = $query->motorcycleRent($id_motorcycle);


        //execute the query
        $res = mysqli_query($conn, $sql);
        //count the rows
        $count = mysqli_num_rows($res);
        //check whether the data is available or not
        if ($count === 1) {
            //get the data form database
            $row = mysqli_fetch_assoc($res);
            $brand = $row['brand'];
            $model = $row['model'];
            $type = $row['type'];
            $engine = $row['engine'];
            $power = $row['power'];
            $max_speed = $row['max_speed'];
            $weight = $row['weight'];
            $category = $row['category'];
            $year = $row['year'];
            $tank = $row['tank'];
            $image_name = $row['image_name'];
            $active = $row['active'];
            $price = $row['price'];
        } else {
            //header('location:'.SITEURL.'rent.php');
            echo 'error';
            echo $sql;
        }
    }

    ?>

    <!-- <php echo SITEURL; ?>rent/checkout/reservation.php?id=<php echo $id_motorcycle; ?> -->
    <div class="page-2-boxs">
        <form id="form-reservation" method="post" target="" action="<?php echo SITEURL; ?>rent/checkout/reservation.php?id=<?php echo $id_motorcycle; ?>"></form>
            <div class="page-box-left" id="page-box-left">
                <div class="moto-img">
                    <img src="<?php echo SITEURL; ?>administrator/images/motorcycle/<?php echo $image_name; ?>" alt="">
                </div>

                <div class="moto-title">
                    <h2><?php echo $brand . " " . $model; ?> </h2>
                </div>

                <div class="moto-type">
                    <h3><?php echo $type; ?></h3>
                </div>

                <div class="moto-specs">

                    <div class="moto-specs-box">
                        <div class="moto-specs-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-moto-50.png" alt="">
                        </div>
                        <div class="moto-specs-text"><?php echo $engine; ?> куб</div>
                    </div>

                    <div class="moto-specs-box">
                        <div class="moto-specs-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-horse-50.png" alt="">
                        </div>
                        <div class="moto-specs-text"><?php echo $power; ?> кн</div>
                    </div>

                    <div class="moto-specs-box">
                        <div class="moto-specs-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-speed-50.png" alt="">
                        </div>
                        <div class="moto-specs-text"><?php echo $max_speed; ?> км/ч</div>
                    </div>

                    <div class="moto-specs-box">
                        <div class="moto-specs-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-calendar-50.png" alt="">
                        </div>
                        <div class="moto-specs-text"><?php echo $year; ?> г.</div>
                    </div>

                    <div class="moto-specs-box">
                        <div class="moto-specs-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-weight-50.png" alt="">
                        </div>
                        <div class="moto-specs-text"><?php echo $weight; ?> кг.</div>
                    </div>

                    <div class="moto-specs-box">
                        <div class="moto-specs-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-fuel-50.png" alt="">
                        </div>
                        <div class="moto-specs-text"><?php echo $tank; ?> л.</div>
                    </div>

                    <div class="moto-specs-box">
                        <div class="moto-specs-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-certificate-50.png" alt="">
                        </div>
                        <div class="moto-specs-text"><?php echo $category; ?></div>
                    </div>
                </div>

                <hr>

                <!-- Start section for Include in price -->
                <section class="include-price">
                    <div class="subtitle">
                        <h2>Включено в цената</h2>
                        <h3>ВСИЧКИ ОБИЧАТ БЕЗПЛАТНИТЕ НЕЩА!</h3>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-motorcycle-64.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            Гарантиран модел
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-shake-phone-64.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            Държач за телефон
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-odometer-64.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            Без ограничения на пробега
                        </div>
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
                            Пълен резервоар с гориво
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-suitcase-64.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            Куфар за мотор
                        </div>
                    </div>


                    <div class="clearfix"></div>
                </section>
                <!-- End section for include in price -->

                <hr>

                <!-- Start section for add-ons option -->
                <section class="add-option" id="sumCheckboxes">
                    <div class="subtitle">
                        <h2>Налични добавки</h2>
                        <h3>ИСКАШ НЯКАКВА ДОПЪЛНИТЕЛНА ЕКСТРА?</h3>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-jacket-passager-64.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            <input form="form-reservation" type="checkbox" name="add-options-equipment" value="25.00" data-amount="25.00" onclick="checkBoxSum()">
                            Екипировка за пасажер <b>+ 25 лв.</b>
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-helmet-64.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            <input form="form-reservation" type="checkbox" name="add-options-helmet" value="20.00" data-amount="20.00" onclick="checkBoxSum()">
                            Каска за пасажер <b>+ 20 лв.</b>
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-petrol-empty-64.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            <input form="form-reservation" type="checkbox" name="add-options-tank" value="60.00" value="" data-amount="60.00" onclick="checkBoxSum()">
                            Върни с празен резервоар <b>+ 60 лв.</b>
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-airport-64.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            <input form="form-reservation" type="checkbox" name="add-options-delivery-airport" value="25.00" data-amount="25.00" onclick="checkBoxSum()">
                            Доставяне /летище/ <b>+ 25 лв.</b>
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-airport-64.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            <input form="form-reservation" type="checkbox" name="add-options-return-airport" value="25.00" data-amount="25.00" onclick="checkBoxSum()">
                            Връщане /летище/ <b>+ 25 лв.</b>
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-5-star-hotel-64.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            <input form="form-reservation" type="checkbox" name="add-options-delivery-hotel" value="20.00" data-amount="20.00" onclick="checkBoxSum()">
                            Доставяне /хотел/ <b>+ 20 лв.</b>
                        </div>
                    </div>

                    <div class="container-moto-rent">
                        <div class="container-moto-rent-icons">
                            <img src="<?php echo SITEURL; ?>images/icons/icons8-5-star-hotel-64.png" alt="">
                        </div>
                        <div class="container-moto-rent-text">
                            <input form="form-reservation" type="checkbox" name="add-options-return-hotel" value="20.00" data-amount="20.00" onclick="checkBoxSum()">
                            Връщане /хотел/ <b>+ 20 лв.</b>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                </section>
                <!-- End section for add-ons option -->

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
                        <div class="policy-box-text">Може да анулирате <b>заявката 7 дни преди дата на наемане.</b> Получавате пълната сума.</div>
                    </div>

                    <div class="policy-box">
                        <div class="policy-box-icon">
                            <img src="<?php echo SITEURL; ?>images/icons/policy/icons8-road-64.png" alt="">
                        </div>
                        <div class="policy-box-text">Включен е <b>неограничен</b> пробег.</div>
                    </div>

                    <div class="policy-box">
                        <div class="policy-box-icon">
                            <img src="<?php echo SITEURL; ?>images/icons/policy/icons8-man-50.png" alt="">
                        </div>
                        <?php
                        if ($category == "A") {
                        ?>
                            <div class="policy-box-text">Трябва да сте на <b>поне 21 години</b> и да имате 12 месеца шофьорски стаж.</div>
                        <?php
                        } else if ($category == "A2") {
                        ?>
                            <div class="policy-box-text">Трябва да сте на <b>поне 19 години</b> и да имате 12 месеца шофьорски стаж.</div>
                        <?php
                        } else if ($category == "A1") {
                        ?>
                            <div class="policy-box-text">Трябва да сте на <b>поне 17 години</b> и да имате 12 месеца шофьорски стаж.</div>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="policy-box">
                        <div class="policy-box-icon">
                            <img src="<?php echo SITEURL; ?>images/icons/policy/icons8-book-48.png" alt="">
                        </div>
                        <?php
                        if ($category == "A") {
                        ?>
                            <div class="policy-box-text">Този мотоциклет изисква свидетелство - <b>категория А</b>.</div>
                        <?php
                        } else if ($category == "A2") {
                        ?>
                            <div class="policy-box-text">Този мотоциклет изисква свидетелство - <b>категория А2</b>.</div>
                        <?php
                        } else if ($category == "A1") {
                        ?>
                            <div class="policy-box-text">Този мотоциклет изисква свидетелство - <b>категория А1</b>.</div>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="policy-box">
                        <div class="policy-box-icon">
                            <img src="<?php echo SITEURL; ?>images/icons/policy/icons8-delivery-64.png" alt="">
                        </div>
                        <div class="policy-box-text"> Услугите за доставка/прибиране за са <b>района на Варна и по преценка</b>.</div>
                    </div>

                    <div class="policy-box">
                        <div class="policy-box-icon">
                            <img src="<?php echo SITEURL; ?>images/icons/policy/icons8-earth-50.png" alt="">
                        </div>
                        <div class="policy-box-text">Не е позволено преминаване в <b>друга държава</b>.</div>
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

                <!-- Start section for comments -->
                <?php include('../partials-front/comments.php'); ?>
                <!-- End section for comments -->

            </div>

            <!-- Start rent box -->

            <div class="page-box-right text-center" id="page-box-right">
                <div class="btn-close-box">
                    <img src="../images/icons/icons8-close-48.png" alt="" onclick="closeForm();">
                </div>
                <div class="rent-for-days js-rent-for-days">Наем за 1 ден</div>
                <input form="form-reservation" type="hidden" name="rent-days" value="1" class="js-rent-for-days-input">

                <div class="rent-per-day js-rent-per-day">(<?php echo number_format($price, 2); ?> лв. на ден)</div>
                <input form="form-reservation" type="hidden" name="rent-per-day" value="<?php echo $price; ?>" class="js-rent-per-day-input">

                <div class="rent-price-sum js-rent-price-sum"><?php echo $price; ?> лв.</div>
                <input form="form-reservation" type="hidden" name="moto-rent-price" value="<?php echo $price; ?>" class="js-moto-rent-price-input">
                <input form="form-reservation" type="hidden" name="rent-price-sum" value="<?php echo $price; ?>" class="js-rent-price-sum-input">

                <br>
                <hr><br>

                <?php
                $sql_moto_rent_dates = "SELECT date_from, date_to
                FROM tbl_order_rent_details od
                JOIN tbl_order_rent o ON oD.id_order_rent = o.id_order_rent
                WHERE id_motorcycle = $id_motorcycle AND o.status != 'завършена' AND o.status != 'отказана'";
                $res_moto_rent_dates = mysqli_query($conn, $sql_moto_rent_dates);

                $bookedDates = [];
                if (mysqli_num_rows($res_moto_rent_dates) > 0) {
                    while ($row_moto_rent_dates = mysqli_fetch_assoc($res_moto_rent_dates)) {
                        $date_from_range = $row_moto_rent_dates['date_from'];
                        $date_to_range = $row_moto_rent_dates['date_to'];

                        array_push($bookedDates, [$date_from_range, $date_to_range]);
                    }
                } else {
                    $bookedDates = [];
                }
                $bookedDatesJson = json_encode($bookedDates);
                //echo $bookedDatesJson;
                ?>
                <div class="start-rent" id="start-rent">
                    <p>Дата на наемане </p>
                    <input form="form-reservation" type="text" value="<?php echo date('Y-m-d'); ?>" name="start-rent-date" class="js-start-rent-input" id="start-rent-input" required>
                </div>

                <div class="end-rent">
                    <p>Дата на отдаване </p>
                    <input form="form-reservation" type="text" value="<?php $d = strtotime("tomorrow");
                                                echo date("Y-m-d", $d) ?>" name="end-rent-date" class="js-end-rent-input" id="end-rent-input" required>
                </div>

                <?php
                if (isset($_SESSION['error-date'])) {
                    echo $_SESSION['error-date'];
                    unset($_SESSION['error-date']);
                }
                ?>

                <div class="check-button">
                    <button form="form-reservation" type="submit" name="submit_check_button" id="submit_check_button">Продължи</button>
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
            <div class="rent-for-days js-rent-for-days-mobile">Наем за 1 ден</div>
            <div class="rent-price-sum js-rent-price-sum-mobile">70 лв.</div>

            <div class="next-button-mobile">
                <button onclick="openForm(); ">Напред</button>
            </div>
        </div>
        <!-- End rent box -->

    </div>
    <div class="clearfix"></div>
    <div id="page-boxs-end"></div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/bg.js"></script> <!-- Български езиков файл -->


    <script>
        // Заети дати от всички диапазони (примерен масив)
        const bookedDates = <?php echo $bookedDatesJson; ?>;

        console.log(bookedDates);
        let selectedDates = [];
        // Функция за обработка на всички заети дати
        function getAllBookedDates() {
            let allDates = [];
            bookedDates.forEach(function(range) {
                let startDate = new Date(range[0]);
                let endDate = new Date(range[1]);
                let currentDate = startDate;
                while (currentDate <= endDate) {
                    allDates.push(currentDate.toISOString().slice(0, 10));
                    currentDate.setDate(currentDate.getDate() + 1);
                }
            });
            return allDates;
        }

        // Инициализация на Flatpickr за начална дата
        const startDateInput = document.getElementById('start-rent-input');
        const endDateInput = document.getElementById('end-rent-input');

        let startPicker = flatpickr(startDateInput, {
            locale: 'bg', // Използване на български език
            dateFormat: "Y-m-d", // Формат на датата
            minDate: 'today', // Минимална дата - днешна дата
            disable: getAllBookedDates(), // Забрана на заетите дати
            onChange: function(selectedDates) {
                // Премахване на маркирането
                startDateInput.classList.remove('booked-date');
                // Актуализиране на минималната дата за крайния пикер
                endPicker.set('minDate', selectedDates[0]);
                // Задаване на крайната дата на началната дата + 1 ден
                let nextDay = new Date(selectedDates[0]);
                nextDay.setDate(nextDay.getDate());
                // console.log(nextDay);
                endPicker.setDate(nextDay);
            }
        });

        // Инициализация на Flatpickr за крайна дата
        let endPicker = flatpickr(endDateInput, {
            locale: 'bg', // Използване на български език
            dateFormat: "Y-m-d", // Формат на датата
            minDate: 'today', // Минимална дата - днешна дата
            disable: getAllBookedDates(), // Забрана на заетите дати
            onChange: function(selectedDates) {
                // Премахване на маркирането
                endDateInput.classList.remove('booked-date');
            }
        });

        //--------------------------------------------------------------------------------
        //Функции за засичащ се диапазон от дати
        const ranges = [];

        function saveRange() {
            ranges.length = 0;
            const startInput = document.getElementById('start-rent-input');
            const endInput = document.getElementById('end-rent-input');
            const startValue = startInput.value;
            const endValue = endInput.value;
            ranges.push(startValue, endValue);
        }

        function handleInputChange() {
            saveRange();

            let rangeToCheck = ranges;

            const arrayOfRanges = <?php echo $bookedDatesJson; ?>;

            function doesRangeOverlapWithAny(rangeToCheck, arrayOfRanges) {

                for (let i = 0; i < arrayOfRanges.length; i++) {
                    const currentRange = arrayOfRanges[i];
                    const startDateToCheck = new Date(ranges[0]);
                    const endDateToCheck = new Date(ranges[1]);
                    const startDate = new Date(currentRange[0]);
                    const endDate = new Date(currentRange[1]);

                    //console.log(endDateToCheck);

                    if (endDateToCheck >= startDate && startDateToCheck <= endDate) {
                        return true; // Намерили сме засичащ се диапазон
                    }
                }
                return false; // няма засичащ се диапазон

            }

            const overlap = doesRangeOverlapWithAny(rangeToCheck, arrayOfRanges);
            if (overlap) {
                const endInput = document.getElementById('start-rent-input').value = 'Тези дати са заети';
                const startInput = document.getElementById('end-rent-input').value = 'Тези дати са заети';
                console.log(ranges[0]);
                //alert('Някои от тези дати вече са заети. Моля изберете си други.')
            }
            console.log(overlap); // true, защото диапазонът за проверка се засича с поне един от масивите
        }

        handleInputChange();


        document.getElementById('end-rent-input').addEventListener('input', handleInputChange);
    </script>

    <script type="text/javascript" src="../js/sticky-div.js"></script>
    <script type="text/javascript" src="../js/mobile-rent-box.js"></script>
    <script type="text/javascript" src="../js/motorcycle-page/calculation.js"></script>

    <?php
    include("../partials-front/frequently-moto.php");
    include("../partials-front/footer.php");
    ?>