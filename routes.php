<?php include('partials-front/menu.php'); ?>

<!-- Start Filter section-->
<?php
    if (isset($_SESSION['mailing'])) {
        echo $_SESSION['mailing'];
        unset($_SESSION['mailing']);
    }

    if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
?>

<section class="filter">
    <div class="container">
        <h2 class="text-center">Избор на маршрут</h2>
        <h3 class="text-center"><i>Започни мото тура си от тук</i></h3>
        <br><br>
        <div class="filter-buttons">
            <form action="" method="GET">
                <input type="submit" class="filter-box" name='' value='Всички'>
                <input type="submit" class="filter-box" name='country' value='България'>
                <input type="submit" class="filter-box" name='country' value='Румъния'>
                <input type="submit" class="filter-box" name='country' value='Турция'>
                <input type="submit" class="filter-box" name='country' value='Гърция'>
            </form>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<hr class="filter-hr">

<!-- End Filter section-->

<!-- Start routes  section-->
<section class="routes-boxs">
    <div class="container">
        <?php
        include('php/moto-krastev/Queries.php');
        $query = new Queries;
        $sql_routes = $query->routesFilterCountry();

        //execute query
        $res_routes = mysqli_query($conn, $sql_routes);
        //count rows
        $count_routes = mysqli_num_rows($res_routes);

        //check whether have data in database or not
        if ($count_routes > 0) {
            //we have data in database, get the data and display
            while ($row = mysqli_fetch_assoc($res_routes)) {
                $id = $row['id_tour'];
                $country = $row['country'];
                $cities = $row['cities'];
                $price = $row['price'];
                $days = $row['days'];
                $image = $row['image'];
                $date[0] = $row['date1'];
                $date[1] = $row['date2'];
                $date[2] = $row['date3'];
                $date[3] = $row['date4'];

        ?>
                <a href="<?php echo SITEURL; ?>routes/tour.php?id=<?php echo $id; ?>">
                    <div class="box-2 text-center" style="background-image: url(<?php echo SITEURL; ?>administrator/images/tour/<?php echo $image; ?>);">
                        <h1><?php echo $country; ?></h1>
                        <p class="cities"><?php echo $cities; ?></p>
                        <p class="days"><?php echo $days; ?> дни</p>
                        <p class="price">Цена от <?php echo $price; ?> лв.</p>
                        <div class="period">
                            <p>Дати на мото тура:</p>
                            <?php
                            for ($i = 0; $i <= 3; $i++) {
                                if ($date[$i] != "0000-00-00") {
                                    echo "<p>" . date('d.m.Y', strtotime($date[$i])) . "г. - ";
                                }
                                if ($date[$i] != "0000-00-00") {
                                    echo date('d.m.Y', strtotime($date[$i] . "+ $days days")) . "г.</p>";
                                }
                            }
                            ?>
                        </div>
                        <div class="button-more">
                            <input type="button" value="Разгледай" class="btn">
                        </div>
                    </div>
                </a>

        <?php

            }
        } else {
            //we do not have data, we will display the message
            echo "<h2 class='error'>Няма открити мото турове.</h2>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- End routes moto section-->

<?php include('partials-front/footer.php'); ?>