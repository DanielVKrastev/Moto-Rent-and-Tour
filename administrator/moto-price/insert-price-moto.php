<!-- Start POPUP Add data in database -->

<div id="popup-insert" class="overlay">
	<div class="popup">
		<h2 class="text-center">Добавяне на цена</h2>
        <br>
		<a class="close" href="#">&times;</a>
		<div class="add-box">

        <form action="" method="post" enctype="multipart/form-data">
			<table>

                <tr>
                    <td class="text-right">
                        Мотор:
                    </td>
                    <td>
                        <select name="id_motorcycle">
                        <?php
                        //query to get all data from database
                        $sql = "SELECT * FROM tbl_motorcycle
                                WHERE id_motorcycle Not In (SELECT id_motorcycle FROM tbl_motorcycle_price);";

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

                                ?>
                            
                                <option value="<?php echo $id; ?>"><?php echo $brand." ".$model; ?></option>
                            
                                <?php
                            }
                        }
                        ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Цена:
                    </td>
                    <td>
                        <input type="number" name="price"  min="0" step="5" placeholder="Въведи цена /лв./">
                    </td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Добави цена" class="btn btn-submit">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
        //check whether the submit button is clicked or not
        if(isset($_POST['submit'])){
            //echo "clicked";
            

            //GET THE VALUE FROM Moto FORM
            $id_motorcycle = $_POST['id_motorcycle'];
            $price = $_POST['price'];

       //sql query
        $sql2 = "INSERT INTO moto_krastev.tbl_motorcycle_price SET
                id_motorcycle = '$id_motorcycle',
                price = '$price'
        ";

        //execute the query and save in database
        $res2 = mysqli_query($conn, $sql2);

        //check whether the query executed or not and data added or not
        if($res2 == true){
            //query executed and motorcycle added
            $_SESSION['add'] = "<div class='success'>Успешно добавяне.</div>";
            //redirect page
            header("location: ".SITEURL."administrator/moto-price/moto-price.php#");
            die();
        }
        else{
            //failed to add moto
            $_SESSION['add'] = "<div class='error'>Неуспешно добавяне.</div>";
            header("location: ".SITEURL."administrator/moto-price/moto-price.php#");
            die();
        }
        }
        ?>
		</div>
	</div>
</div>

<!-- End POPUP Add data in database -->