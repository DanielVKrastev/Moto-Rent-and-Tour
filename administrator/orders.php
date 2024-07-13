<?php include('partials-admin/menu.php');?>

<!-- Start section data table -->
<section class="container-admin">
    <div class="wrapper">
        <h1 class="text-center">Заявки</h1>
        <div class="container">
        
            <a href="<?php echo SITEURL; ?>administrator/orders/orders-moto.php">
            
                <div class="box-2">
                    <div class="box-header text-center">
                        <h4>Мотоциклети</h4>
                    </div>

                    <div class="box-content">
                        <img src="../images/icons/icons8-list-60.png" alt="icons8-list-60.png">
                        <?php 
                        //query for count order rent-moto
                        $sql_count_order_moto = "SELECT COUNT(*) FROM tbl_order_rent";
                        $res_count_order_moto = mysqli_query($conn, $sql_count_order_moto);
                        $row_order_moto = mysqli_fetch_assoc($res_count_order_moto);
                        $count_order_moto = $row_order_moto['COUNT(*)'];
                        ?>
                        <span>брой заявки: <?php echo $count_order_moto; ?></span>
                        <div class="clearfix"></div>
                    </div>

                    <div class="box-content">
                        <img src="../images/icons/icons8-rent-60.png" alt="list.png">
                        <?php
                        //query for sum price rent
                        $sql_sum_rent = "SELECT price FROM tbl_order_rent";
                        $res_sum_rent = mysqli_query($conn, $sql_sum_rent);
                        $count_sum_rent = mysqli_num_rows($res_sum_rent);

                        $sum_price_rent = 0;
                        if($count_sum_rent > 0){
                            while($row_sum_rent=mysqli_fetch_assoc($res_sum_rent)){
                                $price_rent = $row_sum_rent['price'];
                                $sum_price_rent += $price_rent;
                            }
                        }
                        ?>
                        <span>приходи от наем: <?php echo number_format($sum_price_rent, 2); ?>лв.</span>
                        <div class="clearfix"></div>
                    </div>

                    <div class="box-footer text-center">
                    <?php 
                        //query for count order rent-moto
                        $sql_count_order_status_moto = "SELECT COUNT(*) FROM tbl_order_rent WHERE status = 'изчакваща потвърждение'";
                        $res_count_order_status_moto = mysqli_query($conn, $sql_count_order_status_moto);
                        $row_order_status_moto = mysqli_fetch_assoc($res_count_order_status_moto);
                        $count_order_status_moto = $row_order_status_moto['COUNT(*)'];
                        ?>
                        <?php echo $count_order_status_moto; ?> заявки в изчакване
                    </div>
                </div>

            </a>

            <a href="<?php echo SITEURL; ?>administrator/orders/orders-tour.php">
            
            <div class="box-2">
                    <div class="box-header text-center">
                        <h4>Турове</h4>
                    </div>

                    <div class="box-content">
                        <img src="../images/icons/icons8-list-60.png" alt="icons8-list-60.png">
                        <?php 
                        //query for count order tours
                        $sql_count_order_tour = "SELECT COUNT(*) FROM tbl_order_tour";
                        $res_count_order_tour = mysqli_query($conn, $sql_count_order_tour);
                        $row_order_tour = mysqli_fetch_assoc($res_count_order_tour);
                        $count_order_tour = $row_order_tour['COUNT(*)'];
                        ?>
                        <span>брой заявки: <?php echo $count_order_tour; ?></span>
                        <div class="clearfix"></div>
                    </div>

                    <div class="box-content">
                        <img src="../images/icons/icons8-rent-60.png" alt="list.png">
                        <?php
                        //query for sum price rent
                        $sql_sum_tour = "SELECT price FROM tbl_order_tour";
                        $res_sum_tour = mysqli_query($conn, $sql_sum_tour);
                        $count_sum_tour = mysqli_num_rows($res_sum_tour);

                        $sum_price_tour = 0;
                        if($count_sum_tour > 0){
                            while($row_sum_tour=mysqli_fetch_assoc($res_sum_tour)){
                                $price_tour = $row_sum_tour['price'];
                                $sum_price_tour += $price_tour;
                            }
                        }
                        ?>
                        <span>приходи от турове: <?php echo number_format($sum_price_tour, 2); ?>лв.</span>
                        <div class="clearfix"></div>
                    </div>

                    <div class="box-footer text-center">
                    <?php 
                        //query for count order tours
                        $sql_count_order_status_tour = "SELECT COUNT(*) FROM tbl_order_tour WHERE status = 'изчакваща потвърждение'";
                        $res_count_order_status_tour = mysqli_query($conn, $sql_count_order_status_tour);
                        $row_order_status_tour = mysqli_fetch_assoc($res_count_order_status_tour);
                        $count_order_status_tour = $row_order_status_tour['COUNT(*)'];
                    ?>
                        <?php echo $count_order_status_tour; ?> заявки в изчакване
                    </div>
                </div>

            </a>
        </div>
        <div class="clearfix"></div>
    </div>
    

</section>
<!-- End section data table -->


<?php
include('partials-admin/footer.php');
?>