<?php include('partials-front/menu.php'); ?>

<!-- Start Filter section-->
<?php
      if(isset($_SESSION['mailing'])){
        echo $_SESSION['mailing'];
        unset($_SESSION['mailing']);
    }

    if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
    
?>
<section class="filter">
    <div class="container">
        <h2 class="text-center">Наем на мотоциклети</h2>
        <h3 class="text-center"><i>Започни приключението от тук</i></h3>
        <br><br>
            <div class="filter-buttons">
                <form action="" method="GET">
                    <input type="submit" class="filter-box" name='' value='Всички'>
                    <input type="submit" class="filter-box" name='brand' value='Honda'>
                    <input type="submit" class="filter-box" name='brand' value="Yamaha">
                    <input type="submit" class="filter-box" name='brand'value='Suzuki'>
                    <input type="submit" class="filter-box" name='brand' value='BMW'>
                </form>
            </div>
    </div>
</section>
<div class="clearfix"></div>
<hr class="filter-hr">

<!-- End Filter section-->

<!-- Start Most frequently rented moto section-->
<section class="rent-moto">
        <div class="container">

        <?php
        error_reporting(0);
            //setting the start from, value
            $start = 0;

            //setting the number of rows to display in a page
            $rows_per_page = 3;

            //get the total nr of rows
            $moto_brand="all";
            if($_GET['brand'] == 'Honda'){
                $moto_brand = "Honda";
                $sql_nr = "SELECT * FROM tbl_motorcycle WHERE brand='$moto_brand' AND active = 'Yes'";
            }
            elseif($_GET['brand'] == 'Yamaha'){
                $moto_brand = "Yamaha";
                $sql_nr = "SELECT * FROM tbl_motorcycle WHERE brand='$moto_brand' AND active = 'Yes'";
            }
            elseif($_GET['brand'] == 'Suzuki'){
                $moto_brand = "Suzuki";
                $sql_nr = "SELECT * FROM tbl_motorcycle WHERE brand='$moto_brand' AND active = 'Yes'";
            }
            elseif($_GET['brand'] == 'BMW'){
                $moto_brand = "BMW";
                $sql_nr = "SELECT * FROM tbl_motorcycle WHERE brand='$moto_brand' AND active = 'Yes'";
            }
            else{
                //if not select a filter
                $sql_nr = "SELECT * FROM tbl_motorcycle WHERE active = 'Yes'";
            }

            $res_nr = mysqli_query($conn, $sql_nr);
            $nr_of_rows = $res_nr->num_rows;

            //calculatin for number rows of pages
            $pages = ceil($nr_of_rows / $rows_per_page);

            //if the user clicks on the pagination buttons, set a new starting point
            if(isset($_GET['page-nr'])){
                $page = $_GET['page-nr'] - 1;
                $start = $page * $rows_per_page;
            }

            include('php/moto-krastev/Queries.php');
            $query = new Queries;
            $sql = $query->rentFilterMotorcycle($moto_brand, $start, $rows_per_page);
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

                        ?>
                        <a href="<?php echo SITEURL; ?>rent/motorcycle.php?id=<?php echo $id; ?>">
                            <div class="frequently-box-3 float-container">
                                <?php
                                    if($image_name!=""){?>
                                        <img src="<?php echo SITEURL;?>administrator/images/motorcycle/<?php echo $image_name; ?>" alt="" width="80px">
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/image_not_found.png" alt="" width="80px">
                                        <?php
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
            else{
                //we do not have data, we will display the message
                echo "<h2 class='error'>Няма открити мотоциклети.</h2>";
            }
        ?>

                <div class="clearfix"></div>
                <!-- pagination menu -->
                    <div class="text-center">
                        <br>
                        <?php
                        if(!isset($_GET['page-nr'])){
                            $page = 1;
                        }else{
                            $page = $_GET['page-nr'];
                        }
                        ?>
                        <div>Страница <?php echo $page; ?> от <?php echo $pages; ?></div>
                        <br>
                        <?php 
                        //for previuosly button
                            if(isset($_GET['page-nr']) && $_GET['page-nr'] > 1){
                                ?>
                                <a href="?brand=<?php echo $moto_brand; ?>&page-nr=<?php echo $_GET['page-nr'] - 1; ?>" class="btn btn-primary"><</a>
                                <?php
                            }else{
                                ?>
                                <a href="" class="btn btn-primary"><</a>
                                <?php
                            }
                        ?>

                        <?php
                        //for pages number
                            for($i = 1; $i <= $pages; $i++){
                                ?>
                                <a href="?brand=<?php echo $moto_brand; ?>&page-nr=<?php echo $i; ?>" class="btn btn-secondary"><?php echo $i; ?></a>
                                <?php
                            }
                        ?>
                        
                        <?php
                        //for next button
                            if(!isset($_GET['page-nr']) && $pages > 1){
       
                                ?>
                                <a href="?brand=<?php echo $moto_brand; ?>&page-nr=2" class="btn btn-primary">></a>
                                <?php
                                
                            }else{
                                if($_GET['page-nr'] >= $pages){
                                    ?>
                                    <a href="" class="btn btn-primary">></a>
                                    <?php
                                }else{
                                    ?>
                                    <a href="?brand=<?php echo $moto_brand; ?>&page-nr=<?php echo $_GET['page-nr'] + 1; ?>" class="btn btn-primary">></a>
                                    <?php
                                }
                        }
                            
                        ?>
                        
                <!--STOP pagination menu -->
                    </div>
            <div class="clearfix"></div>
        </div>
</section>
<!-- End Most frequently rented moto section-->

<?php include('partials-front/footer.php'); ?>