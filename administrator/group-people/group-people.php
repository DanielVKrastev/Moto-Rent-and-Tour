<?php include('../partials-admin/menu.php');?>
<!-- Start section data table -->
<section class="container-admin">
    <div class="wrapper">

    <h1>Група от хора</h1>
    <br>
    <br>
    <a href="#popup-insert" class="btn btn-primary">Добави група от хора</a>
    <a href="<?php echo SITEURL; ?>administrator/tour.php" class="btn btn-primary">Назад</a>
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
                <th>Група от</th>
                <th>Операция</th>
            </tr>

            <?php
                //query to get all data from database
                $sql = "SELECT * FROM tbl_tour_peoples";

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
                        $id = $row['id_people_group'];
                        $count_people = $row['count_people'];

                ?>


                <tr class="text-center">
                    <td><?php echo $sn++;?></td>
                    <td><?php echo $count_people; ?> човека</td>

                    <td>
                        <a href="?id=<?php echo $id;?>#popup-update" class="action"><img class="action" width="32" height="32" src="https://img.icons8.com/ios-filled/50/00A414/settings.png" alt="settings"/></a>
                        <a href="<?php echo SITEURL;?>administrator/group-people/delete-group-people.php?id=<?php echo $id;?>" class="action"><img width="32" height="32" src="https://img.icons8.com/ios-filled/50/ff3f4d/delete-forever.png" alt="delete-forever"/></a>
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
                            <td colspan="15"><div class="error">Няма добавени групи.</div></td>
                        </tr>
                    <?php
                }
            ?>

        </table>
    </div>
    </div>
</section>
<!-- End section data table -->
<?php include('update-group-people.php'); ?>
<?php include('insert-group-people.php'); ?>
<?php include('../partials-admin/footer.php');?>