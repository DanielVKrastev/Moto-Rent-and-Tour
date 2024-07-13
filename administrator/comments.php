<?php include('partials-admin/menu.php');?>
<?php include('../php/mailing/send.php'); ?>

<!-- Start section data table -->
<section class="container-admin">
    <div class="wrapper">

    <div class="header-filters">
            <h1 class="text-center"><i>Отзиви от клиенти</i></h1>
            <br>
            <?php 
                $id_requet = '';
                $name = '';
                $email = '';
                $rating = '';
                $comment_text = '';
                $date_comment = '';

                if(isset($_GET['id_comment'])){
                    $id_comment = $_GET['id_comment'];
                }
                if(isset($_GET['name'])){
                    $name = $_GET['name'];
                }
                if(isset($_GET['email'])){
                    $email = $_GET['email'];
                }
                if(isset($_GET['rating'])){
                    $rating = $_GET['rating'];
                }
                if(isset($_GET['date_comment'])){
                    $date_comment = $_GET['date_comment'];
                }
            ?>

            <!-- Filter boxs -->
            <h4>Филтри</h4>
            <form action="" method="GET">
                <section class="filter-admin-boxes">

                    <div class="filter-admin-box">
                        <h4 class="text-center">S.N</h4>
                        <input type="number" name="id_comment" min="1" value="<?php echo $id_comment; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Име</h4>
                        <input type="text" name="name" value="<?php echo $name; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">E-mail</h4>
                        <input type="text" name="email" value="<?php echo $email; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Рейтинг</h4>
                        <input type="text" name="rating" value="<?php echo $rating; ?>">
                    </div>

                    <div class="filter-admin-box">
                        <h4 class="text-center">Дата</h4>
                        <input type="date" name="date_comment" value="<?php echo $date_comment; ?>">
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
            $sql_filter = "SELECT * FROM tbl_comments";
            if(isset($_GET['submit_clear_filter'])){
                header("location:".SITEURL."administrator/comments.php");
            }

            if(isset($_GET['submit_filter'])){
                $id_comment = $_GET['id_comment'];
                $name = $_GET['name'];
                $email = $_GET['email'];
                $rating = $_GET['rating'];
                $date_comment = $_GET['date_comment'];

                $filters[] = [];
                $show_filter[] = [];
                $count_filters = 0;
                if($id_comment !== ''){
                    $filters[] .= " id_comment = $id_comment";
                    $show_filter[] = "<h5>ID</h5><i>$id_comment</i>";
                    $count_filters++;
                }

                if($name !== ''){
                    $filters[] .= " name LIKE '%$name%'";
                    $show_filter[] = "<h5>име</h5><i>$name</i>";
                    $url = "?name=$name";
                    $count_filters++;
                }

                if($email !== ''){
                    $filters[] .= " email LIKE '%$email%'";
                    $show_filter[] = "<h5>e-mail</h5><i>$email</i>";
                    $count_filters++;
                }

                if($rating !== ''){
                    $filters[] .= " rating LIKE '%$rating%'";
                    $show_filter[] = "<h5>тема</h5><i>$rating</i>";
                    $count_filters++;
                }

                if($date_comment !== ''){
                    $filters[] .= " date_comment LIKE '%$date_comment%'";
                    $show_filter[] = "<h5>дата</h5><i>$date_comment</i>";
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
    if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }

    if(isset($_SESSION['delete_data'])){
        echo $_SESSION['delete_data'];
        unset($_SESSION['delete_data']);
    }

    if(isset($_SESSION['mailing'])){
        echo $_SESSION['mailing'];
        unset($_SESSION['mailing']);
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
                <th  class="th-mid">Имена</th>
                <th class="th-max">E-mail</th>
                <th>Рейтинг</th>
                <th class="th-max">Съобщение</th>
                <th class="th-mid">Дата</th>
                <th>Операция</th>
            </tr>

            <?php
                //query to get all data from database
                if(isset($_GET['submit_filter'])){
                    $sql = $sql_filter.' ORDER BY id_comment DESC';
                }else{
                    $sql = "SELECT * FROM tbl_comments ORDER BY id_comment DESC";
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
                        $id_comment = $row['id_comment'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $rating = $row['rating'];
                        $comment_text = $row['comment_text'];
                        $date_comment = $row['date_comment'];

                ?>


                <tr class="text-center">
                    <td><?php echo $id_comment;?></td>
                    <td><?php echo $name;?></td>
                    <td><?php echo $email;?></td>
                    <td><?php echo $rating;?></td>
                    <td><?php echo mb_strimwidth($comment_text,0,30,'...');?></td>
                    <td><?php echo $date_comment;?></td>
                    <td>
                        <a href="<?php
                                if(isset($_GET['submit_filter'])){
                                    echo $_SERVER['REQUEST_URI'];
                                }else{
                                    echo SITEURL.'administrator/requests-client.php';
                                }
                         ?>?id=<?php echo $id_comment;?>#popup-update" class="action"><img class="action" width="32" height="32" src="https://img.icons8.com/ios-filled/50/00A414/settings.png" alt="settings"/></a>
                        <a href="<?php echo SITEURL;?>administrator/comments/delete-comment.php?id=<?php echo $id_comment; ?>" class="action"><img width="32" height="32" src="https://img.icons8.com/ios-filled/50/ff3f4d/delete-forever.png" alt="delete-forever"/></a>
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
                            <td colspan="15"><div class="error">Няма отзиви.</div></td>
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
//include('comments/update-comments.php');
include('partials-admin/footer.php');
?>