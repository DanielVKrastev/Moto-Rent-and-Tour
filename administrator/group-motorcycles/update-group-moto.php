<div id="popup-update" class="overlay">
	<div class="popup">
		<h2 class="text-center">Редактиране на група</h2>
        <br>
		<a class="close" href="#">&times;</a>
		<div class="add-box">

        <form action="" method="post" enctype="multipart/form-data">

        <?php
        //To suppress warnings while leaving all other error reporting enabled
            error_reporting(E_ALL ^ E_WARNING); 

            //check if id is set or not
            if(isset($_GET['id'])){
                //get values
               // echo $_GET['id'];
               $id = $_GET['id'];

               //sql query to get all data for current motorcycle
               $sql = "SELECT * FROM tbl_tour_motorcycle WHERE id_motorcycle_group = $id";

               //execute the query
               $res = mysqli_query($conn, $sql);

               //count rows
               $count = mysqli_num_rows($res);

               if($count=1){
                $row = mysqli_fetch_assoc($res);
                $motorcycle1 = $row['motorcycle1'];
                $motorcycle1_price = $row['motorcycle1_price'];
                $motorcycle2 = $row['motorcycle2'];
                $motorcycle2_price = $row['motorcycle2_price'];
                $motorcycle3 = $row['motorcycle3'];
                $motorcycle3_price = $row['motorcycle3_price'];
               }
               else{
                //redirect to moto page with session message
                $_SESSION['update-message-error'] = "<div class='error'>Несъществуващо ID.</div>";
                header("location: ".SITEURL."administrator/group-motorcycles/group-moto.php#");
                die();
               }
            }

        ?>

            <table>

            <tr>
                <td class="text-right">
                    Мотор 1:
                </td>
                <td>
                    <input type="text" name="motorcycle1" value="<?php echo $motorcycle1; ?>">
                </td>
            </tr>

            <tr>
                <td class="text-right">
                    Цена <i>/мотор 1/</i>:
                </td>
                <td>
                    <input type="number" name="motorcycle1_price"  min="0" step="1" value="<?php echo $motorcycle1_price; ?>">
                </td>
            </tr>

            <tr>
                <td class="text-right">
                    Мотор 2:
                </td>
                <td>
                    <input type="text" name="motorcycle2" value="<?php echo $motorcycle2; ?>">
                </td>
            </tr>

            <tr>
                <td class="text-right">
                    Цена <i>/мотор 2/</i>:
                </td>
                <td>
                    <input type="number" name="motorcycle2_price"  min="0" step="1" value="<?php echo $motorcycle2_price; ?>">
                </td>
            </tr>

            <tr>
                <td class="text-right">
                    Мотор 3:
                </td>
                <td>
                    <input type="text" name="motorcycle3" value="<?php echo $motorcycle3; ?>">
                </td>
            </tr>

            <tr>
                <td class="text-right">
                    Цена <i>/мотор 3/</i>:
                </td>
                <td>
                    <input type="number" name="motorcycle3_price"  min="0" step="1" value="<?php echo $motorcycle3_price; ?>">
                </td>
            </tr>


            <tr>
                <td colspan="2">
                    <input type="submit" name="submit-update" value="Редактирай" class="btn btn-submit">
                </td>
            </tr>
            </table>
        </form>

        <?php
        
        if(isset($_POST['submit-update'])){
            //echo "click";
            //get all data from form
            //GET THE VALUE FROM Moto FORM
            $motorcycle1 = $_POST['motorcycle1'];
            $motorcycle1_price = $_POST['motorcycle1_price'];
            $motorcycle2 = $_POST['motorcycle2'];
            $motorcycle2_price = $_POST['motorcycle2_price'];
            $motorcycle3 = $_POST['motorcycle3'];
            $motorcycle3_price = $_POST['motorcycle3_price'];

        //sql query for update
        $sql2="UPDATE tbl_tour_motorcycle SET
                motorcycle1 = '$motorcycle1',
                motorcycle1_price = '$motorcycle1_price',
                motorcycle2 = '$motorcycle2',
                motorcycle2_price = '$motorcycle2_price',
                motorcycle3 = '$motorcycle3',
                motorcycle3_price = '$motorcycle3_price'
                WHERE id_motorcycle_group = $id
        ";

        //execute query
        $res2 = mysqli_query($conn, $sql2);

        $count = mysqli_num_rows($res);

        //check if query executed success
        
            if ($count > 0) {
                if($res2==true){
                    //send a session message for success update data and redirect
                    $_SESSION['update'] = "<div class='success'>Успешно редактиране.</div>";
                    header("location: ".SITEURL."administrator/group-motorcycles/group-moto.php#");
                     //stop the process
                     die();
                 }else{
                     //send a message for error update redirect
                     $_SESSION['update'] = "<div class='error'>Неуспешно редактиране.</div>";
                     header("location: ".SITEURL."administrator/group-motorcycles/group-moto.php#");
                     //stop the process
                     die();
                 }
            } else {
                $_SESSION['update'] = "<div class='error'>Несъществуващо ID.</div>";
                header("location: ".SITEURL."administrator/group-motorcycles/group-moto.php#");
                //stop the process
                die();
            }   
    }
        ?>
        </div>
	</div>
</div>