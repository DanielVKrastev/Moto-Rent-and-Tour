<?php include('../partials-admin/menu.php');?>
<!-- Start section data table -->
<section class="container-admin">
    <div class="wrapper">

    <h1>Цени на мотори</h1>
    <br>
    <br>
    <a href="#popup-insert" class="btn btn-primary">Добави цена</a>
    <a href="<?php echo SITEURL; ?>administrator/moto.php" class="btn btn-primary">Назад</a>
    <br>
    <br>
    
    <?php
    if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
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
        <table class="tbl tbl-full">
            <tr class="text-center">
                <th>S.N</th>
                <th>Марка</th>
                <th>Модел</th>
                <th>Цена</th>
                <th>Операция</th>
            </tr>

            <?php
                //query to get all data from database
                $sql = "SELECT * FROM tbl_motorcycle_price
                        NATURAL JOIN tbl_motorcycle";

                //execute query
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                //create ID/serial number/ variale and assign values as 1
                $sn = 1;

                //check whether we have data in database or not
                if($count>0){
                    //we have data in database
                    //get the data and display
                    while($row=mysqli_fetch_assoc($res)){
                        $id = $row['id_motorcycle'];
                        $brand = $row['brand'];
                        $model = $row['model'];
                        $price = $row['price'];

                ?>


                <tr class="text-center">
                    <td><?php echo $sn++;?></td>
                    <td><?php echo $brand;?></td>
                    <td><?php echo $model;?></td>
                    <td><?php echo number_format($price,2);?> лв.</td>

                    <td>
                        <a href="?id=<?php echo $id;?>#popup-update" class="action"><img class="action" width="32" height="32" src="https://img.icons8.com/ios-filled/50/00A414/settings.png" alt="settings"/></a>
                        <a href="<?php echo SITEURL;?>administrator/moto-price/delete-price-moto.php?id=<?php echo $id;?>" class="action"><img width="32" height="32" src="https://img.icons8.com/ios-filled/50/ff3f4d/delete-forever.png" alt="delete-forever"/></a>
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
<?php include('update-price-moto.php'); ?>
<?php include('insert-price-moto.php'); ?>
<?php include('../partials-admin/footer.php');?>