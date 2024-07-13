<?php include('partials-admin/menu.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<section class="container-admin">
    <div class="wrapper">

        <h1 class="text-center">Начално табло</h1>
        <section class="table-buttons">
            <div class="insert">
                    <img src="../images/icons/icons8-user-60.png" alt="">
                    <span>
                    <?php 
                        if (isset($_SESSION['user'])) {
                            echo $_SESSION['user'];
                        }

                    ?>
                    </span>
            </div>
        </section>
        
        <br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        ?>
        <div class="admin-boxs">
            <a href="<?php echo SITEURL; ?>administrator/moto.php">
                <div class="box-4-admin text-center">
                    <?php
                    //query for count moto
                    $sql_count_moto = "SELECT COUNT(*) FROM tbl_motorcycle";
                    $res_count_moto = mysqli_query($conn, $sql_count_moto);
                    $row_moto = mysqli_fetch_assoc($res_count_moto);

                    $count_moto = $row_moto['COUNT(*)'];
                    ?>
                    <div class="box-4-img">
                        <img src="../images/icons/icons8-moto-50.png" alt="icons8-moto-50.png">
                    </div>

                    <div class="box-4-text">
                        <h2><?php echo $count_moto; ?></h2>
                        <br>
                        <p>Мотора</p>
                    </div>

                </div>
            </a>

            <a href="<?php echo SITEURL; ?>administrator/tour.php">
                <div class="box-4-admin text-center">
                    <?php
                    //query for count tours
                    $sql_count_tour = "SELECT COUNT(*) FROM tbl_tour";
                    $res_count_tour = mysqli_query($conn, $sql_count_tour);
                    $row_tour = mysqli_fetch_assoc($res_count_tour);
                    $count_tour = $row_tour['COUNT(*)'];
                    ?>
                    <div class="box-4-img">
                        <img src="../images/icons/icons8-road-60.png" alt="icons8-road-60.pn">
                    </div>

                    <div class="box-4-text">
                        <h2><?php echo $count_tour; ?></h2>
                        <br>
                        <p>Маршрута</p>
                    </div>
                </div>
            </a>

            <a href="<?php echo SITEURL; ?>administrator/orders/orders-moto.php">
                <div class="box-4-admin text-center">
                    <?php
                    //query for count order rent-moto
                    $sql_count_order_moto = "SELECT COUNT(*) FROM tbl_order_rent";
                    $res_count_order_moto = mysqli_query($conn, $sql_count_order_moto);
                    $row_order_moto = mysqli_fetch_assoc($res_count_order_moto);
                    $count_order_moto = $row_order_moto['COUNT(*)'];
                    ?>
                    <div class="box-4-img">
                        <img src="../images/icons/icons8-list-60.png" alt="icons8-list-60.png">
                    </div>

                    <div class="box-4-text">
                        <h2><?php echo $count_order_moto; ?></h2>
                        <br>
                        <p>Брой заявки за мотор</p>
                    </div>
                </div>
            </a>

            <a href="<?php echo SITEURL; ?>administrator/orders/orders-tour.php">
                <div class="box-4-admin text-center">
                    <?php
                    //query for count order tours
                    $sql_count_order_tour = "SELECT COUNT(*) FROM tbl_order_tour";
                    $res_count_order_tour = mysqli_query($conn, $sql_count_order_tour);
                    $row_order_tour = mysqli_fetch_assoc($res_count_order_tour);
                    $count_order_tour = $row_order_tour['COUNT(*)'];
                    ?>
                    <div class="box-4-img">
                        <img src="../images/icons/icons8-list-60.png" alt="icons8-list-60.png">
                    </div>

                    <div class="box-4-text">
                        <h2><?php echo $count_order_tour; ?></h2>
                        <br>
                        <p>Брой заявки турове</p>
                    </div>
                </div>
            </a>

            <div class="box-4-admin text-center">
                <?php
                //query for sum price rent
                $sql_sum_rent = "SELECT price FROM tbl_order_rent WHERE status != 'отказана'";
                $res_sum_rent = mysqli_query($conn, $sql_sum_rent);
                $count_sum_rent = mysqli_num_rows($res_sum_rent);

                $sum_price_rent = 0;
                if ($count_sum_rent > 0) {
                    while ($row_sum_rent = mysqli_fetch_assoc($res_sum_rent)) {
                        $price_rent = $row_sum_rent['price'];
                        $sum_price_rent += $price_rent;
                    }
                }
                ?>
                <div class="box-4-img">
                    <img src="../images/icons/icons8-dollar-60.png" alt="icons8-dollar-60.png">
                </div>

                <div class="box-4-text">
                    <h2><?php echo number_format($sum_price_rent, 2); ?>лв.</h2>
                    <br>
                    <p>Приходи от наеми</p>
                </div>
            </div>

            <div class="box-4-admin text-center">
                <?php
                //query for sum price rent
                $sql_sum_tour = "SELECT price FROM tbl_order_tour WHERE status != 'отказана'";
                $res_sum_tour = mysqli_query($conn, $sql_sum_tour);
                $count_sum_tour = mysqli_num_rows($res_sum_tour);

                $sum_price_tour = 0;
                if ($count_sum_tour > 0) {
                    while ($row_sum_tour = mysqli_fetch_assoc($res_sum_tour)) {
                        $price_tour = $row_sum_tour['price'];
                        $sum_price_tour += $price_tour;
                    }
                }
                ?>
                <div class="box-4-img">
                    <img src="../images/icons/icons8-dollar-60.png" alt="icons8-dollar-60.png">
                </div>

                <div class="box-4-text">
                    <h2><?php echo number_format($sum_price_tour, 2); ?>лв.</h2>
                    <br>
                    <p>Приходи от турове</p>
                </div>
            </div>

            <div class="box-4-admin text-center">

                <div class="box-4-img">
                    <img src="../images/icons/icons8-dollar-60.png" alt="icons8-dollar-60.png">
                </div>

                <div class="box-4-text">
                    <h2><?php echo number_format($sum_price_tour + $sum_price_rent, 2); ?>лв.</h2>
                    <br>
                    <p>Общи приходи</p>
                </div>
            </div>
            <a href="<?php echo SITEURL; ?>administrator/requests-client.php">
                <div class="box-4-admin text-center">
                    <?php
                    //query for count order requests from clients
                    $sql_count_requests = "SELECT COUNT(*) FROM tbl_client_requests";
                    $res_count_requests = mysqli_query($conn, $sql_count_requests);
                    $row_requests = mysqli_fetch_assoc($res_count_requests);
                    $count_requests = $row_requests['COUNT(*)'];
                    ?>
                    <div class="box-4-img">
                        <img src="../images/icons/icons8-language-50.png" alt="icons8-language-50.png">
                    </div>

                    <div class="box-4-text">
                        <h2><?php echo $count_requests; ?></h2>
                        <br>
                        <p>Запитвания / Съобщения</p>
                    </div>
                </div>
            </a>

            

            <div class="clearfix"></div>
        </div>

        <div class="chart-boxs">

            <div class="box-left-admin">
                <?php
                $sql_brand_moto = "SELECT brand, model, reservations_count FROM tbl_motorcycle";
                $res_brand_moto = mysqli_query($conn, $sql_brand_moto);
                //array for motorcycle
                $brand_models_arr = [];
                $reservations_count_arr = [];

                if ($res_brand_moto) {
                    while ($row_brand_moto = mysqli_fetch_assoc($res_brand_moto)) {
                        $brand = $row_brand_moto['brand'];
                        $model = $row_brand_moto['model'];
                        $reservations_count = $row_brand_moto['reservations_count'];
                        array_push($brand_models_arr, $brand . ' ' . $model.' - '.$reservations_count);
                        array_push($reservations_count_arr, $reservations_count);
                    }
                }
                ?>
                <h3>Брой наемания на мотоциклети</h3>
                <canvas id="chart_rental_moto"></canvas>
            </div>

            <div class="box-right-admin">
                <?php
                $sql_month_order_rent = "SELECT DATE_FORMAT(date_order, '%M %Y') AS month, SUM(price) AS total_sales
                                        FROM tbl_order_rent
                                        GROUP BY month
                                        ORDER BY date_order";
                $res_month_order_rent = mysqli_query($conn, $sql_month_order_rent);

                $months_rent_arr = [];
                $total_sales_rent_arr = [];
                if ($res_month_order_rent) {
                    while ($row_month_order = mysqli_fetch_assoc($res_month_order_rent)) {
                        $month = $row_month_order['month'];
                        $total_sales = $row_month_order['total_sales'];
                        array_push($months_rent_arr, $month);
                        array_push($total_sales_rent_arr, $total_sales);
                    }
                }
                ?>
                <h3>Приходи от наеми на мотоциклети по месеци</h3>
                <canvas id="chart_price_rent_moto"></canvas>
            </div>

            <div class="box-left-admin">
                <?php
                $sql_country_count = "SELECT id_tour, country, reservations_count FROM tbl_tour";
                $res_country_count = mysqli_query($conn, $sql_country_count);
                //array for tours
                $county_arr = [];
                $reservations_count_country_arr = [];

                if ($res_country_count) {
                    while ($row_country = mysqli_fetch_assoc($res_country_count)) {
                        $id_tour = $row_country['id_tour'];
                        $country = $row_country['country'];
                        $reservations_count = $row_country['reservations_count'];
                        array_push($county_arr, $id_tour.".".$country." - ".$reservations_count);
                        array_push($reservations_count_country_arr, $reservations_count);
                    }
                }
                ?>

                <h3>Брой резервации на мото турове</h3>
                <canvas id="chart_reservations_tour"></canvas>
            </div>

            <div class="box-right-admin">

                <?php
                $sql_month_order_tour = "SELECT DATE_FORMAT(date_order, '%M %Y') AS month, SUM(price) AS total_sales
                                        FROM tbl_order_tour
                                        GROUP BY month
                                        ORDER BY date_order";
                $res_month_order_tour = mysqli_query($conn, $sql_month_order_tour);

                $months_tour_arr = [];
                $total_sales_tour_arr = [];
                if ($res_month_order_tour) {
                    while ($row_month_order_tour = mysqli_fetch_assoc($res_month_order_tour)) {
                        $month = $row_month_order_tour['month'];
                        $total_sales = $row_month_order_tour['total_sales'];
                        array_push($months_tour_arr, $month);
                        array_push($total_sales_tour_arr, $total_sales);
                    }
                }
                ?>
                <h3>Приходи от мото турове по месеци</h3>
                <canvas id="chart_price_tour"></canvas>
            </div>

            <div class="clearfix"></div>
        </div>


    </div>

</section>

<div class="clearfix"></div>

<script>
    //chart1 diagrame motorcycle rental count
    const ctx = document.getElementById('chart_rental_moto').getContext('2d');

    const motorcycleValues = <?php echo json_encode($brand_models_arr); ?>;
    const reservationsCount = <?php echo json_encode($reservations_count_arr); ?>;
    const barColors = ["red", "green", "blue", "orange", "brown", "purple", "yellow"];
    const data1 = {
        labels: motorcycleValues,
        datasets: [{
            backgroundColor: barColors,
            data: reservationsCount
        }],
    }

    const options1 = {
        legend: {
            display: false
        },
        title: {
            display: true,
        },
        responsive: false,

    }

    const myChart1 = new Chart(ctx, {
        type: "pie",
        data: data1,
        options: options1
    });

    //-----------------------------------------------------------------------------------
    //chart2 diagrame price rent moto
    const ctx2 = document.getElementById('chart_price_rent_moto').getContext('2d');
    const monthsValues = <?php echo json_encode($months_rent_arr); ?>;
    const totalSalesMonth = <?php echo json_encode($total_sales_rent_arr); ?>;

    const yValues2 = totalSalesMonth;
    const barColors2 = ["green", "blue", "orange", "brown"];
    const data2 = {
        labels: monthsValues,
        datasets: [{
            backgroundColor: barColors2,
            data: yValues2,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.2
        }]
    }

    const options2 = {
        plugins: {
            legend: {
                display: false
            }
        },
        title: {
            display: false,
        },
        responsive: false,
        scales: {
            y: {
                ticks: {
                    //includ a лв. sign in the ticks
                    callback: function(value, index, values) {
                        return value + ' лв.';
                    }
                }
            }
        }
    }

    const myChart2 = new Chart(ctx2, {
        type: 'line',
        data: data2,
        options: options2
    })

    //-----------------------------------------------------------------------------------
    //chart3 diagrame reservations tours
    const ctx3 = document.getElementById('chart_reservations_tour').getContext('2d');

    const countryeValues = <?php echo json_encode($county_arr); ?>;
    const reservationsCountCountry = <?php echo json_encode($reservations_count_country_arr); ?>;

    const barColors3 = ["orange", "blue", "red", "yelow", "green"];
    const data3 = {
        labels: countryeValues,
        datasets: [{
            backgroundColor: barColors3,
            data: reservationsCountCountry
        }],
    }

    const options3 = {
        legend: {
            display: false
        },
        title: {
            display: true,
        },
        responsive: false,

    }

    const myChart3 = new Chart(ctx3, {
        type: "pie",
        data: data3,
        options: options3
    });

    //-----------------------------------------------------------------------------------
    //chart4 diagrame reservations tours
    const ctx4 = document.getElementById('chart_price_tour').getContext('2d');

    const monthsTourValues = <?php echo json_encode($months_tour_arr); ?>;
    const totalSalesTourCountry = <?php echo json_encode($total_sales_tour_arr); ?>;

    const barColors4 = ["orange", "red", "yelow"];
    const data4 = {
        labels: monthsTourValues,
        datasets: [{
            backgroundColor: barColors4,
            data: totalSalesTourCountry,
            fill: false,
            borderColor: '#ff868e',
            tension: 0.2
        }]
    }

    const options4 = {
        plugins: {
            legend: {
                display: false
            }
        },
        title: {
            display: false,
        },
        responsive: false,
        scales: {
            y: {
                ticks: {
                    //includ a лв. sign in the ticks
                    callback: function(value, index, values) {
                        return value + ' лв.';
                    }
                }
            }
        }
    }

    const myChart4 = new Chart(ctx4, {
        type: "line",
        data: data4,
        options: options4
    });
</script>
<?php include('partials-admin/footer.php'); ?>