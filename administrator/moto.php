<?php include('partials-admin/menu.php');?>

<!-- Start section data table -->
<section class="container-admin">
    <div class="wrapper">
        <div class="header-filters">
            <h1 class="text-center"><i>Мотоциклети</i></h1>
            <br>

            <!-- table for filter
            <table class="tbl-filter">
                <tr class="text-center">
                    <th>S.N</th>
                    <th>Марка</th>
                    <th>Модел</th>
                    <th>Тип</th>
                    <th>Двигател /куб./</th>
                    <th>Мощ /кн./</th>
                    <th>Макс. скорост</th>
                    <th>Тегло</th>
                    <th>Категория</th>
                    <th>Година</th>
                    <th>Резервоар</th>
                    <th>Active</th>
                    <th></th>
                </tr>

                <tr class="text-center">
                    <td>
                        <input type="number" name="" id="">
                    </td>

                    <td>
                        <input type="text" name="" id="">
                    </td>

                    <td>
                        <input type="text" name="" id="">
                    </td>

                    <td>
                            <select name="type">
                                <option style="display:none" value="none">тип</option>
                                <option value="спортен">спортен</option>
                                <option value="турър">турър</option>
                                <option value="чопър">чопър</option>
                            </select>
                    </td>

                    <td>
                        <input type="number"> до <input type="number" name="" id="">
                    </td>

                    <td>
                        <input type="number"> до <input type="number" name="" id="">
                    </td>

                    <td>
                        <input type="number"> до <input type="number" name="" id="">
                    </td>

                    <td>
                        <input type="number"> до <input type="number" name="" id="">
                    </td>

                    <td>
                            <select name="category">
                                <option style="display:none" value="none">категория</option>
                                <option value="A">A</option>
                                <option value="A1">A1</option>
                                <option value="A2">A2</option>
                            </select>
                    </td>

                    <td>
                        <input type="number"> до <input type="number" name="" id="">
                    </td>

                    <td>
                        <input type="number"> до <input type="number" name="" id="">
                    </td>

                    <td>
                            <select name="active">
                                <option style="display:none" value="none">Активен</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                    </td>

                    <td>
                        <input type="submit" value="Филтър" id="" class="btn">
                    </td>
                    
                </tr>
            </table>
            -->
            <?php 
                $id_motorcycle = '';
                $brand = '';
                $model = '';
                $type = '';
                $from_engine = '';
                $to_engine = '';
                $from_power = '';
                $to_power = '';
                $from_max_speed = '';
                $to_max_speed = '';
                $from_weight = '';
                $to_weight = '';
                $category = '';
                $from_year = '';
                $to_year = '';
                $from_tank = '';
                $to_tank = '';
                $active = '';

                if(isset($_GET['id_motorcycle'])){
                    $id_motorcycle = $_GET['id_motorcycle'];
                }
                if(isset($_GET['brand'])){
                    $brand = $_GET['brand'];
                }
                if(isset($_GET['model'])){
                    $model = $_GET['model'];
                }
                if(isset($_GET['type'])){
                    $type = $_GET['type'];
                }
                if(isset($_GET['from_engine'])){
                    $from_engine = $_GET['from_engine'];
                }
                if(isset($_GET['to_engine'])){
                    $to_engine = $_GET['to_engine'];
                }
                if(isset($_GET['from_power'])){
                    $from_power = $_GET['from_power'];
                }
                if(isset($_GET['to_power'])){
                    $to_power = $_GET['to_power'];
                }
                if(isset($_GET['from_max_speed'])){
                    $from_max_speed = $_GET['from_max_speed'];
                }
                if(isset($_GET['to_max_speed'])){
                    $to_max_speed = $_GET['to_max_speed'];
                }
                if(isset($_GET['from_weight'])){
                    $from_weight = $_GET['from_weight'];
                }
                if(isset($_GET['to_weight'])){
                    $to_weight = $_GET['to_weight'];
                }
                if(isset($_GET['category'])){
                    $category = $_GET['category'];
                }
                if(isset($_GET['from_year'])){
                    $from_year = $_GET['from_year'];
                }
                if(isset($_GET['to_year'])){
                    $to_year = $_GET['to_year'];
                }
                if(isset($_GET['from_tank'])){
                    $from_tank = $_GET['from_tank'];
                }
                if(isset($_GET['to_tank'])){
                    $to_tank = $_GET['to_tank'];
                }
                if(isset($_GET['active'])){
                    $active = $_GET['active'];
                }
            ?>

            <!-- Filter boxs -->
            <h4>Филтри</h4>
            <form action="" method="GET">
                <section class="filter-admin-boxes">

                    <div class="filter-admin-box">
                        <h4 class="text-center">S.N</h4>
                        <input type="number" name="id_motorcycle" min="1" value="<?php echo $id_motorcycle; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Марка</h4>
                        <input type="text" name="brand" value="<?php echo $brand; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Модел</h4>
                        <input type="text" name="model" value="<?php echo $model; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Тип</h4>
                        <select name="type">
                            <option style="display:none" value="">тип</option>

                            <option <?php if($type === 'спортен'){echo 'selected';} ?> value="спортен">спортен</option>
                            <option <?php if($type === 'турър'){echo 'selected';} ?> value="турър">турър</option>
                            <option <?php if($type === 'чопър'){echo 'selected';} ?> value="чопър">чопър</option>
                        </select>
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Двигател</h4>
                        <input type="number" name="from_engine" min="1" value="<?php echo $from_engine; ?>"> <span>до</span> <input type="number" name="to_engine" min="1" value="<?php echo $to_engine; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Мощност</h4>
                        <input type="number" name="from_power" min="1" value="<?php echo $from_power; ?>"> <span>до</span> <input type="number" min="1" name="to_power" value="<?php echo $to_power; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Макс. скорост</h4>
                        <input type="number" min="1" name="from_max_speed" value="<?php echo $from_max_speed; ?>"> <span>до</span> <input type="number" min="1" name="to_max_speed" value="<?php echo $to_max_speed; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Тегло</h4>
                        <input type="number" min="1" name="from_weight" value="<?php echo $from_weight; ?>"> <span>до</span> <input type="number" min="1" name="to_weight" value="<?php echo $to_weight; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Категория</h4>
                        <select name="category">
                            <option style="display:none" value="">категория</option>

                            <option <?php if($category === 'A'){echo 'selected';} ?> value="A">A</option>
                            <option <?php if($category === 'A1'){echo 'selected';} ?> value="A1">A1</option>
                            <option <?php if($category === 'A2'){echo 'selected';} ?> value="A2">A2</option>
                        </select>
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Година</h4>
                        <input type="number" min="1899" name="from_year" value="<?php echo $from_year; ?>"> <span>до</span> <input type="number" min="1899" name="to_year" value="<?php echo $to_year; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Резервоар</h4>
                        <input type="number" min="1" name="from_tank" value="<?php echo $from_tank; ?>"> <span>до</span> <input type="number" min="1" name="to_tank" value="<?php echo $to_tank; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Активност</h4>
                        <select name="active">
                            <option style="display:none" value="">Активен</option>
                            <option <?php if($active === 'Yes'){echo 'selected';} ?> value="Yes">Yes</option>
                            <option <?php if($active === 'No'){echo 'selected';} ?> value="No">No</option>
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
            $sql_filter = "SELECT * FROM tbl_motorcycle";
            if(isset($_GET['submit_clear_filter'])){
                header("location:".SITEURL."administrator/moto.php");
            }

            if(isset($_GET['submit_filter'])){
                $id_motorcycle = $_GET['id_motorcycle'];
                $brand = $_GET['brand'];
                $model = $_GET['model'];
                $type = $_GET['type'];
                $from_engine = $_GET['from_engine'];
                $to_engine = $_GET['to_engine'];
                $from_power = $_GET['from_power'];
                $to_power = $_GET['to_power'];
                $from_max_speed = $_GET['from_max_speed'];
                $to_max_speed = $_GET['to_max_speed'];
                $from_weight = $_GET['from_weight'];
                $to_weight = $_GET['to_weight'];
                $category = $_GET['category'];
                $from_year = $_GET['from_year'];
                $to_year = $_GET['to_year'];
                $from_tank = $_GET['from_tank'];
                $to_tank = $_GET['to_tank'];
                $active = $_GET['active'];

                $filters[] = [];
                $show_filter[] = [];
                $count_filters = 0;
                if($id_motorcycle !== ''){
                    $filters[] .= " id_motorcycle = $id_motorcycle";
                    $show_filter[] = "<h5>ID</h5><i>$id_motorcycle</i>";
                    $count_filters++;
                }

                if($brand !== ''){
                    $filters[] .= " brand LIKE '%$brand%'";
                    $show_filter[] = "<h5>марка</h5><i>$brand</i>";
                    $url = "?brand=$brand";
                    $count_filters++;
                }

                if($model !== ''){
                    $filters[] .= " model LIKE '%$model%'";
                    $show_filter[] = "<h5>модел</h5><i>$model</i>";
                    $count_filters++;
                }

                if($type !== ''){
                    $filters[] .= " type LIKE '%$type%'";
                    $show_filter[] = "<h5>тип</h5><i>$type</i>";
                    $count_filters++;
                }

                if($from_engine !== '' && $to_engine !== ''){
                    $filters[] .= " engine BETWEEN '$from_engine' AND '$to_engine'";
                    $show_filter[] = "<h5>двигател</h5><i>от $from_engine до $to_engine куб</i>";
                    $count_filters++;
                }elseif($from_engine !== ''){
                    $filters[] .= " engine BETWEEN '$from_engine' AND '".$from_engine * 1000 ."'";
                    $show_filter[] = "<h5>двигател</h5><i>от $from_engine куб</i>";
                    $count_filters++;
                }elseif($to_engine !== ''){
                    $filters[] .= " engine BETWEEN '0' AND '$to_engine'";
                    $show_filter[] = "<h5>двигател</h5><i>до $to_engine куб</i>";
                    $count_filters++;
                }

                if($from_power !== '' && $to_power !== ''){
                    $filters[] .= " power BETWEEN '$from_power' AND '$to_power'";
                    $show_filter[] = "<h5>мощност</h5><i>от $from_power до $to_power к.н</i>";
                    $count_filters++;
                }elseif($from_power !== ''){
                    $filters[] .= " power BETWEEN '$from_power' AND '".$from_power * 1000 ."'";
                    $show_filter[] = "<h5>мощност</h5><i>от $from_power к.н</i>";
                    $count_filters++;
                }elseif($to_power !== ''){
                    $filters[] .= " power BETWEEN '0' AND '$to_power'";
                    $show_filter[] = "<h5>мощност</h5><i>до $to_power к.н</i>";
                    $count_filters++;
                }

                if($from_max_speed !== '' && $to_max_speed !== ''){
                    $filters[] .= " max_speed BETWEEN '$from_max_speed' AND '$to_max_speed'";
                    $show_filter[] = "<h5>макс. ск</h5><i>от $from_max_speed до $to_max_speed км/ч</i>";
                    $count_filters++;
                }elseif($from_max_speed !== ''){
                    $filters[] .= " max_speed BETWEEN '$from_max_speed' AND '".$from_max_speed * 1000 ."'";
                    $show_filter[] = "<h5>макс. ск</h5><i>от $from_max_speed км/ч</i>";
                    $count_filters++;
                }elseif($to_max_speed !== ''){
                    $filters[] .= " max_speed BETWEEN '0' AND '$to_max_speed'";
                    $show_filter[] = "<h5>макс. ск</h5><i>до $to_max_speed км/ч</i>";
                    $count_filters++;
                }

                if($from_weight !== '' && $to_weight !== ''){
                    $filters[] .= " weight BETWEEN '$from_weight' AND '$to_weight'";
                    $show_filter[] = "<h5>тегло</h5><i>от $from_weight до $to_weight кг.</i>";
                    $count_filters++;
                }elseif($from_weight !== ''){
                    $filters[] .= " weight BETWEEN '$from_weight' AND '".$from_weight * 1000 ."'";
                    $show_filter[] = "<h5>тегло</h5><i>от $from_weight кг.</i>";
                    $count_filters++;
                }elseif($to_weight !== ''){
                    $filters[] .= " weight BETWEEN '0' AND '$to_weight'";
                    $show_filter[] = "<h5>тегло</h5><i>до $to_weight кг.</i>";
                    $count_filters++;
                }

                if($category !== ''){
                    $filters[] .= " category LIKE '%$category%'";
                    $show_filter[] = "<h5>катег.</h5><i>$category</i>";
                    $count_filters++;
                }

                if($from_year !== '' && $to_year !== ''){
                    $filters[] .= " year BETWEEN '$from_year' AND '$to_year'";
                    $show_filter[] = "<h5>година</h5><i>от $from_year до $to_year г.</i>";
                    $count_filters++;
                }elseif($from_year !== ''){
                    $filters[] .= " year BETWEEN '$from_year' AND '".$from_year * 1000 ."'";
                    $show_filter[] = "<h5>година</h5><i>от $from_year г.</i>";
                    $count_filters++;
                }elseif($to_year !== ''){
                    $filters[] .= " year BETWEEN '0' AND '$to_year'";
                    $show_filter[] = "<h5>година</h5><i>до $to_year г.</i>";
                    $count_filters++;
                }

                if($from_tank !== '' && $to_tank !== ''){
                    $filters[] .= " tank BETWEEN '$from_tank' AND '$to_tank'";
                    $show_filter[] = "<h5>резервоар</h5><i>от $from_tank до $to_tank л.</i>";
                    $count_filters++;
                }elseif($from_tank !== ''){
                    $filters[] .= " tank BETWEEN '$from_tank' AND '".$from_tank * 1000 ."'";
                    $show_filter[] = "<h5>резервоар</h5><i>от $from_tank л.</i>";
                    $count_filters++;
                }elseif($to_tank !== ''){
                    $filters[] .= " tank BETWEEN '0' AND '$to_tank'";
                    $show_filter[] = "<h5>резервоар</h5><i>до $to_tank л.</i>";
                    $count_filters++;
                }

                if($active !== ''){
                    $filters[] .= " active = '$active'";
                    $show_filter[] = "<h5>активност</h5><i>$active</i>";
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

    <section class="table-buttons">
            <div class="insert">
                <a href="#popup-insert">
                    <img src="../images/icons/icons8-plus-green-64.png" alt="">
                    <span>Добави мотор</span>
                </a>
            </div>
            
            <div class="another-table">
                <a href="<?php echo SITEURL; ?>administrator/moto-price/moto-price.php">
                    <img src="../images/icons/icons8-price-tag-usd-50.png" alt="">
                    <span>Цени мотори</span>
                </a>
            </div>

            <div class="clearfix"></div>
    </section>

        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload_image'])){
            echo $_SESSION['upload_image'];
            unset($_SESSION['upload_image']);
        }

        if(isset($_SESSION['remove_image'])){
            echo $_SESSION['remove_image'];
            unset($_SESSION['remove_image']);
        }

        if(isset($_SESSION['delete_data'])){
            echo $_SESSION['delete_data'];
            unset($_SESSION['delete_data']);
        }

        if(isset($_SESSION['update-message-error'])){
            echo $_SESSION['update-message-error'];
            unset($_SESSION['update-message-error']);
        }

        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        
        ?>
    <div class="overflow">
        <div class="clearfix"></div>
        <table class="tbl">
            <tr class="text-center">
                <th>S.N</th>
                <th>Марка</th>
                <th>Модел</th>
                <th>Тип</th>
                <th>Двигател /куб./</th>
                <th>Мощ /кн./</th>
                <th>Макс. скорост</th>
                <th>Тегло /кг./</th>
                <th>Кат.</th>
                <th>Година</th>
                <th>Резервоар /л./</th>
                <th>Снимка</th>
                <th>Бр. наемания</th>
                <th>Active</th>
                <th>Операция</th>
            </tr>

            <?php
            // $search = mysqli_real_escape_string($conn, $_POST['search']);
                //query to get all data from database
                if(isset($_GET['submit_filter'])){
                    $sql = $sql_filter;
                }else{
                   $sql = "SELECT * FROM tbl_motorcycle";
                }
                

                //execute query
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check whether we have data in database or not
                if($count>0){
                    //we have data in database
                    //get the data and display
                    while($row=mysqli_fetch_assoc($res)){
                        $id = $row['id_motorcycle'];
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
                        $reservations_count = $row['reservations_count'];
                        $active = $row['active'];
                        
                ?>


                <tr class="text-center">
                    <td><?php echo $id;?></td>
                    <td><?php echo $brand;?></td>
                    <td><?php echo $model;?></td>
                    <td><?php echo $type;?></td>
                    <td><?php echo $engine;?></td>
                    <td><?php echo $power;?></td>
                    <td><?php echo $max_speed;?></td>
                    <td><?php echo $weight;?></td>
                    <td><?php echo $category;?></td>
                    <td><?php echo $year;?></td>
                    <td><?php echo $tank;?></td>
                    <td>
                        <?php
                            if($image_name!=""){?>
                                <img src="<?php echo SITEURL;?>administrator/images/motorcycle/<?php echo $image_name; ?>" alt="" width="80px">
                                <?php
                            }
                            else{
                                echo "<div class='error'>Image not found.</div>";
                            }?>
                    </td>
                    <td><?php echo $reservations_count; ?></td>
                    <td><?php echo $active; ?></td>
                    <td>
                        <a href="<?php
                                if(isset($_GET['submit_filter'])){
                                    echo $_SERVER['REQUEST_URI'];
                                }else{
                                    echo SITEURL.'administrator/moto.php';
                                }
                         ?>?id=<?php echo $id;?>#popup-update" class="action"><img class="action" width="32" height="32" src="https://img.icons8.com/ios-filled/50/00A414/settings.png" alt="settings"/></a>
                        <a href="<?php echo SITEURL;?>administrator/moto-partials/delete-moto.php?id=<?php echo $id;  ?>&image_name=<?php echo $image_name;?>" class="action"><img width="32" height="32" src="https://img.icons8.com/ios-filled/50/ff3f4d/delete-forever.png" alt="delete-forever"/></a>
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
                            <td colspan="15"><div class="error">Няма добавени мотоциклети.</div></td>
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
include('moto-partials/insert-moto.php');
include('moto-partials/update-moto.php');
include('partials-admin/footer.php');
?>