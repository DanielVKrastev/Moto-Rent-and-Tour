<?php 
    include("partials-front/menu.php");
    include("partials-front/search-box.php");

    //get the search keyword
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $radio_select = mysqli_real_escape_string($conn, $_POST['select']);

    if($radio_select === 'motorcycle'){
?>

    <section class="rent-moto">
            
        <div class="container">
            <h2 class="text-center">Вашето търсене <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
            <h3 class="text-center"><i>Резултати от търсенето</i></h3>

            <br>

            <?php
                //query to get all data from database, table tbl_motorcycle
                //filter for all/honda/yamaha/suzuki/bmw
                $sql = "SELECT * FROM tbl_motorcycle WHERE brand LIKE '%$search%' OR model LIKE '%$search%' OR engine LIKE '%$search%'";

                //execute query
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check whether have data in database or not
                if($count>0){
                    //we have data in database, get the data and display
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id_motorcycle'];
                        $brand = $row['brand'];
                        $model = $row['model'];
                        $type = $row['type'];
                        $engine = $row['engine'];
                        $year = $row['year'];
                        $power = $row['power'];
                        $category = $row['category'];
                        $weight = $row['weight'];
                        $image_name = $row['image_name'];
                        $active = $row['active'];

                        //check if motorcycle is active
                        if($active == "Yes"){
                            ?>
                            <a href="<?php echo SITEURL; ?>rent/motorcycle.php?id=<?php echo $id; ?>">
                                <div class="frequently-box-3 float-container">
                                    <?php
                                        if($image_name!=""){?>
                                            <img src="<?php echo SITEURL;?>administrator/images/motorcycle/<?php echo $image_name; ?>" alt="" width="80px">
                                            <?php
                                        }
                                        else{
                                            echo "<div class='error'>Image not found.</div>";
                                    }?>
                                    <div class="moto-info">
                                        <h4 class="text-center"><?php echo $brand." ".$model;?></h4><br>
                                        <p>Тип: <?php echo $type;?></p>
                                        <p>Двигател: <?php echo $engine;?> куб.</p>
                                        <p>Мощност: <?php echo $power;?> кн.</p>
                                        <p>Година: <?php echo $year;?> г.</p>
                                        <p>Тегло: <?php echo $weight;?> кг.</p>
                                        <p>Категория: <?php echo $category;?></p>
                                    </div>
                                        <input type="submit" name="submit" value="Повече детайли">
                                </div>
                            </a>

                        <?php
                        }
                    }
                }
                else{
                    //we do not have data, we will display the message
                    echo "<h2 class='error'>Няма намерени мотоциклети.</h2>";
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>

    <?php
    }
    else if($radio_select === 'routes'){
    ?>

<!-- Start routes  section-->
    <section class="routes-boxs">
        <div class="container">
        <h2 class="text-center">Вашето търсене <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
        <h3 class="text-center"><i>Резултати от търсенето</i></h3>
            <?php

            $sql_routes = "SELECT * FROM tbl_tour WHERE country LIKE '%$search%' OR cities LIKE '%$search%'";

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
    <?php
    }
    ?>

<?php include("partials-front/footer.php"); ?>