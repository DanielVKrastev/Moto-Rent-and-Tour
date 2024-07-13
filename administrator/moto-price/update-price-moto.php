<div id="popup-update" class="overlay">
	<div class="popup">
		<h2 class="text-center">Редактиране на цена</h2>
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
               $sql = "SELECT * FROM tbl_motorcycle 
                        NATURAL JOIN tbl_motorcycle_price
                        WHERE id_motorcycle=$id";

               //execute the query
               $res = mysqli_query($conn, $sql);

               //count rows
               $count = mysqli_num_rows($res);

               if($count=1){
                $row = mysqli_fetch_assoc($res);
                $brand = $row['brand'];
                $model = $row['model'];
                $price = $row['price'];
               }
               else{
                //redirect to moto page with session message
                $_SESSION['update-message-error'] = "<div class='error'>Несъществуващо ID.</div>";
                header("location: ".SITEURL."administrator/moto-price/moto-price.php#");
                die();
               }
            }

        ?>

			<table>

                <tr>
                    <td class="text-right">
                        Мотор:
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $brand." ".$model;?>">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Цена:
                    </td>
                    <td>
                    <input type="number" name="price"  min="0" step="5" placeholder="Въведи цена /лв./" value="<?php echo $price;?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

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
            $price = $_POST['price'];

        //sql query for update
        $sql2="UPDATE tbl_motorcycle_price SET
                price = '$price'
                WHERE id_motorcycle = $id
        ";

        //execute query
        $res2 = mysqli_query($conn, $sql2);

        $count = mysqli_num_rows($res);

        //check if query executed success
        
            if ($count > 0) {
                if($res2==true){
                    //send a session message for success update data and redirect
                    $_SESSION['update'] = "<div class='success'>Успешно редактиране.</div>";
                    header("location: ".SITEURL."administrator/moto-price/moto-price.php#");
                     //stop the process
                     die();
                 }else{
                     //send a message for error update redirect
                     $_SESSION['update'] = "<div class='error'>Неуспешно редактиране.</div>";
                     header("location: ".SITEURL."administrator/moto-price/moto-price.php#");
                     //stop the process
                     die();
                 }
            } else {
                $_SESSION['update'] = "<div class='error'>Несъществуващо ID.</div>";
                header("location: ".SITEURL."administrator/moto-price/moto-price.php#");
                //stop the process
                die();
            }   
    }
        ?>
        </div>
	</div>
</div>