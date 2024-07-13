<?php include('../partials-admin/menu.php');?>

<!-- Start section data table -->
<section class="container-admin">
    <div class="wrapper">

        <!--Start Back button -->
        
            <div class="button-back">
                <a href="<?php echo SITEURL; ?>administrator/orders.php">
                    <img src="../../images/icons/icons8-back-60.png" alt="list.png">
                    <span><b>Назад</b></span>
                </a>
                <div class="clearfix"></div>
            </div>
        
        <!--End Back button -->

    <div class="header-filters">
            <h1 class="text-center"><i>Заявки на мото турове</i></h1>
            <br>
            <?php 
                $id_order_tour = '';
                $first_name = '';
                $second_name = '';
                $telephone = '';
                $email = '';
                $tour = '';
                $motorcycle = '';
                $date_order = '';
                $date_from = '';
                $status = '';

                if(isset($_GET['id_order_tour'])){
                    $id_order_tour = $_GET['id_order_tour'];
                }
                if(isset($_GET['first_name'])){
                    $first_name = $_GET['first_name'];
                }
                if(isset($_GET['second_name'])){
                    $second_name = $_GET['second_name'];
                }
                if(isset($_GET['telephone'])){
                    $telephone = $_GET['telephone'];
                }
                if(isset($_GET['email'])){
                    $email = $_GET['email'];
                }
                if(isset($_GET['tour'])){
                    $tour = $_GET['tour'];
                }
                if(isset($_GET['motorcycle'])){
                    $motorcycle = $_GET['motorcycle'];
                }
                if(isset($_GET['date_order'])){
                    $date_order = $_GET['date_order'];
                }
                if(isset($_GET['date_from'])){
                    $date_from = $_GET['date_from'];
                }
                if(isset($_GET['status'])){
                    $status = $_GET['status'];
                }
            ?>

            <!-- Filter boxs -->
            <h4>Филтри</h4>
            <form action="" method="GET">
                <section class="filter-admin-boxes">

                    <div class="filter-admin-box">
                        <h4 class="text-center">S.N</h4>
                        <input type="number" name="id_order_tour" min="1" value="<?php echo $id_order_rent; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Име</h4>
                        <input type="text" name="first_name" value="<?php echo $first_name; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Фамилия</h4>
                        <input type="text" name="second_name" value="<?php echo $second_name; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Телефон</h4>
                        <input type="text" name="telephone" value="<?php echo $telephone; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">E-mail</h4>
                        <input type="text" name="email" value="<?php echo $email; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Маршрут</h4>
                        <input type="text" name="tour" value="<?php echo $tour; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Мотор</h4>
                        <input type="text" name="motorcycle" value="<?php echo $motorcycle; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Дата на заявка</h4>
                        <input type="date" name="date_order" value="<?php echo $date_order; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Дата от</h4>
                        <input type="date" name="date_from" value="<?php echo $date_from; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Статут</h4>
                        <select name="status">
                            <option style="display:none" value="">избери статут</option>
                            <option <?php if($status === 'изчакваща потвърждение') echo 'selected'; ?> value="изчакваща потвърждение">изчакваща потвърждение</option>
                            <option <?php if($status === 'потвърдена') echo 'selected'; ?> value="потвърдена">потвърдена</option>
                            <option <?php if($status === 'обработка') echo 'selected'; ?> value="обработка">обработка</option>
                            <option <?php if($status === 'на път') echo 'selected'; ?> value="на път">на път</option>
                            <option <?php if($status === 'завършена') echo 'selected'; ?> value="завършена">завършена</option>
                            <option <?php if($status === 'отказана') echo 'selected'; ?> value="отказана">отказана</option>
                        </select>
                    </div>


                    <div class="no-border">
                        <div class="filter-admin-box">
                            <input class="submit_filter" type="submit" name="submit_filter" value="Филтър">
                        </div>
                    </div>

                    <div class="no-border">
                        <div class="filter-admin-box">
                            <input class="submit_clear_filter" type="submit" name="submit_clear_filter" value="Изчисти">
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </section>
            </form>

        </div>

        <?php 
            $sql_filter = "SELECT t.id_order_tour, t.first_name, t.second_name, t.client_telephone, t.email, t.date_order, t.price, t.status, t.date_from, d.motorcycle_data, tt.country, tt.cities
                            FROM tbl_order_tour t
                            INNER JOIN tbl_order_tour_details d ON d.id_order_tour = t.id_order_tour
                            INNER JOIN tbl_tour tt ON tt.id_tour = t.id_tour
                            ";
            if(isset($_GET['submit_clear_filter'])){
                unset($_SESSION['url-save']);
                header("location:".SITEURL."administrator/orders/orders-tour.php");
            }

            if(isset($_GET['submit_filter'])){
                $id_order_tour = $_GET['id_order_tour'];
                $first_name = $_GET['first_name'];
                $second_name = $_GET['second_name'];
                $telephone = $_GET['telephone'];
                $email = $_GET['email'];
                $tour = $_GET['tour'];
                $motorcycle = $_GET['motorcycle'];
                $date_order = $_GET['date_order'];
                $date_from = $_GET['date_from'];
                $status = $_GET['status'];

                $filters[] = [];
                $show_filter[] = [];
                $count_filters = 0;
                if($id_order_tour !== ''){
                    $filters[] .= " t.id_order_tour = $id_order_tour";
                    $show_filter[] = "<h5>ID</h5><i>$id_order_tour</i>";
                    $count_filters++;
                }

                if($first_name !== ''){
                    $filters[] .= " first_name LIKE '%$first_name%'";
                    $show_filter[] = "<h5>име</h5><i>$first_name</i>";
                    $url = "?first_name=$first_name";
                    $count_filters++;
                }

                if($second_name !== ''){
                    $filters[] .= " second_name LIKE '%$second_name%'";
                    $show_filter[] = "<h5>фамилия</h5><i>$second_name</i>";
                    $count_filters++;
                }

                if($telephone !== ''){
                    $filters[] .= " client_telephone LIKE '%$telephone%'";
                    $show_filter[] = "<h5>телефон</h5><i>$telephone</i>";
                    $count_filters++;
                }

                if($email !== ''){
                    $filters[] .= " email LIKE '%$email%'";
                    $show_filter[] = "<h5>e-mail</h5><i>$email</i>";
                    $count_filters++;
                }

                if($tour !== ''){
                    $filters[] .= " country LIKE '%$tour%' OR cities LIKE '%$tour%'";
                    $show_filter[] = "<h5>маршут</h5><i>$tour</i>";
                    $count_filters++;
                }

                if($motorcycle !== ''){
                    $filters[] .= " motorcycle_data LIKE '%$motorcycle%'";
                    $show_filter[] = "<h5>мотор</h5><i>$motorcycle</i>";
                    $count_filters++;
                }

                if($date_order !== ''){
                    $filters[] .= " date_order LIKE '%$date_order%'";
                    $show_filter[] = "<h5>дата заявка</h5><i>$date_order</i>";
                    $count_filters++;
                }

                if($date_from !== ''){
                    $filters[] .= " date_from LIKE '%$date_from%'";
                    $show_filter[] = "<h5>наем от</h5><i>$date_from</i>";
                    $count_filters++;
                }

                if($status !== ''){
                    $filters[] .= " status = '$status'";
                    $show_filter[] = "<h5>статут</h5><i>$status</i>";
                    $count_filters++;
                }

                //if count_filters > 0 add atribute WHERE
                if($count_filters > 0){
                    $sql_filter .= " WHERE ";
                }

                //write sql query
                for($i = 1; $i <= $count_filters; $i++){
                    if($count_filters > 1 && $i < $count_filters){
                        $sql_filter .= $filters[$i]." && ";
                    }else{
                        $sql_filter .= $filters[$i];
                    } 
                }
                
            }
           // echo $sql_filter;
           
        ?>

    <br>
    <h4>Приложени филтри</h4>
    <section class="filters-show-boxes">
        <?php
            if(isset($_GET['submit_filter'])){
                //show filters
                if(sizeof($show_filter) > 1){
                    for($i = 1; $i < sizeof($show_filter); $i++){
                        ?>
                            <div class="filter-show-box">
                                <?php echo $show_filter[$i]; ?>
                            </div>
                        <?php
                    }
                }else{
                    ?>
                    <div class="filter-show-box">
                        Няма приложени
                    </div>
                    <?php
                }   

            }else{
                ?>
                    <div class="filter-show-box">
                        Няма приложени
                    </div>
                <?php
            }
        ?>
        <div class="clearfix"></div>
    </section>
    <br>
    
    <?php

    if(isset($_SESSION['delete_data'])){
        echo $_SESSION['delete_data'];
        unset($_SESSION['delete_data']);
    }

    if(isset($_SESSION['update'])){
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }
    
    ?>

<div class="overflow">
        <table class="tbl tbl-full">
            <tr class="text-center">
                <th>S.N</th>
                <th>Име</th>
                <th>Фамилия</th>
                <th class="th-mid">Телефон</th>
                <th class="th-max">E-mail</th>
                <th>Дата на заявка</th>
                <th>Маршрут</th>
                <th>Мотор</th>
                <th>Дата от</th>
                <th class="th-mid">Статут</th>
                <th>Цена</th>
                <th>Детайли</th>
            </tr>

            <?php
                //query to get all data from database
                if(isset($_GET['submit_filter'])){
                    $sql_order_tour = $sql_filter." ORDER BY id_order_tour DESC";
                  //  echo $sql_order_tour;
                  //session for url for back button in orders-tour-details page
                  $_SESSION['url-save'] = $_SERVER['REQUEST_URI'];
                }else{
                    $sql_order_tour = "SELECT t.id_order_tour, t.first_name, t.second_name, t.client_telephone, t.email, t.date_order, t.price, t.status, t.date_from, d.motorcycle_data, tt.country, tt.cities
                                        FROM tbl_order_tour t
                                        INNER JOIN tbl_order_tour_details d ON d.id_order_tour = t.id_order_tour
                                        INNER JOIN tbl_tour tt ON tt.id_tour = t.id_tour
                                        ORDER BY id_order_tour DESC";
                }

                //execute query
                $res_order_tour = mysqli_query($conn, $sql_order_tour);

                //count rows
                $count_order_tour = mysqli_num_rows($res_order_tour);

                //check whether we have data in database or not
                if($count_order_tour > 0){
                    //we have data in database
                    //get the data and display
                    while($row=mysqli_fetch_assoc($res_order_tour)){
                        $id_order_tour = $row['id_order_tour'];
                        $first_name = $row['first_name'];
                        $second_name = $row['second_name'];
                        $client_telephone = $row['client_telephone'];
                        $email = $row['email'];
                        $date_order = $row['date_order'];
                        $price = $row['price'];
                        $status = $row['status'];
                        $date_from = $row['date_from'];
                        $motorcycle_data = json_decode($row['motorcycle_data']);
                        $country = $row['country'];
                        $cities = $row['cities'];

                ?>


                <tr class="text-center">
                    <td><?php echo $id_order_tour;?></td>
                    <td><?php echo $first_name;?></td>
                    <td><?php echo $second_name;?></td>
                    <td><?php echo $client_telephone;?></td>
                    <td><?php echo $email;?></td>
                    <td><?php echo $date_order; ?></td>
                    <td><?php echo $country." ".$cities;?></td>
                    <td><?php echo $motorcycle_data[0];?></td>
                    <td><?php echo $date_from; ?></td>
                    <td>
                        <?php 
                        if($status == 'изчакваща потвърждение'){
                            echo "<b><font color='#ffa502'>".$status."</b>";
                        }
                        elseif($status == 'обработка'){
                            echo "<b><font color='#eccc68'>".$status."</b>";
                        }
                        elseif($status == 'на път'){
                            echo "<b><font color='#ff6b81'>".$status."</b>";
                        }
                        elseif($status == 'потвърдена'){
                            echo "<b><font color='#70a1ff'>".$status."</b>";
                        }
                        elseif($status == 'завършена'){
                            echo "<b><font color='#2ed573'>".$status."</b>";

                        }
                        elseif($status == 'отказана'){
                            echo "<b><font color='#ff4757'>".$status."</b>";

                        }

                        ?>
                    </td>
                    <td><?php echo $price; ?></td>
                    <td>
                        <a href="<?php echo SITEURL;?>administrator/orders/orders-tour-details.php?id=<?php echo $id_order_tour; ?>" class="action"><img class="action" width="32" height="32" src="https://img.icons8.com/ios-filled/50/00A414/settings.png" alt="settings"/></a>
                        <a href="<?php echo SITEURL;?>administrator/orders/delete-orders-tour.php?id=<?php echo $id_order_tour; ?>" class="action"><img width="32" height="32" src="https://img.icons8.com/ios-filled/50/ff3f4d/delete-forever.png" alt="delete-forever"/></a>
                    </td>
                </tr>

                <?php
                    }
                }
                else
                {
                    //we do not have data
                    //we will display the message inside table
                    ?>
                        <tr>
                            <td colspan="15"><div class="error">Няма заявки за мото турове.</div></td>
                        </tr>
                    <?php
                }
            ?>

        </table>
    </div>

    </div>
</section>
<!-- End section data table -->




<?php
include('../partials-admin/footer.php');
?>