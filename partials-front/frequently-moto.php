<!-- Start Most frequently rented moto section-->
<section class="rent-moto">
        <div class="container">
            <h2 class="text-center">Често наемани мотоциклети</h2>
            <h3 class="text-center">Истинско приключение</h3>

            <br>

            <?php
                //query to get all data from database, table tbl_motorcycle
                //filter for all/honda/yamaha/suzuki/bmw
                $sql = "SELECT * FROM tbl_motorcycle WHERE active = 'Yes' ORDER BY reservations_count DESC LIMIT 3";

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
                    echo "<h2 class='error'>Няма добавени мотоциклети.</h2>";
                }
            ?>

                <div class="clearfix"></div>
                    <div class="text-center">
                        <br>
                        <a href="<?php echo SITEURL;?>rent.php" class="btn btn-secondary" name="more_moto">Разгледай още</a>
                    </div>
            <div class="clearfix"></div>
        </div>
    </section>
<!-- End Most frequently rented moto section-->