

<div id="popup-update" class="overlay">
	<div class="popup">
		<h2 class="text-center">Редактиране на мотоциклет</h2>
        <br>
		<a class="close" href="">&times;</a>
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
               $sql = "SELECT * FROM tbl_motorcycle WHERE id_motorcycle=$id";

               //execute the query
               $res = mysqli_query($conn, $sql);

               //count rows
               $count = mysqli_num_rows($res);

               if($count=1){
                $row = mysqli_fetch_assoc($res);
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
                $current_image = $row['image_name'];
                $reservations_count = $row['reservations_count'];
                $active = $row['active'];
               }
               else{
                //redirect to moto page with session message
                $_SESSION['update-message-error'] = "<div class='error'>Несъществуващо ID.</div>";
                header("location: ".SITEURL."administrator/moto.php");
                die();
               }
            }

            //echo $brand, $model, $type, $engine, $power, $max_speed, $weight, $category, $year, $gears, $tank, $image_name, $active, $frequency;
        ?>

			<table>

                <tr>
                    <td class="text-right">
                        Марка:
                    </td>
                    <td>
                        <input type="text" name="brand" value="<?php echo $brand;?>">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Модел:
                    </td>
                    <td>
                        <input type="text" name="model" value="<?php echo $model;?>">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Тип:
                    </td>
                    <td>
                        <select name="type">
                            <option value="<?php echo $type;?>"><?php echo $type;?></option>
                            <?php
                            //check type
                            if($type=='спортен'){
                                ?>
                                <option value="турър">турър</option>
                                <option value="чопър">чопър</option>
                                <?php
                            }
                            elseif($type=='турър'){
                                ?>
                                <option value="спортен">спортен</option>
                                <option value="чопър">чопър</option>
                                <?php
                            }
                            elseif($type=='чопър'){
                                ?>
                                <option value="спортен">спортен</option>
                                <option value="турър">турър</option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Двигател:
                    </td>
                    <td>
                        <input type="number" name="engine"  min="50" step="0.01" value="<?php echo $engine;?>">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Мощност:
                    </td>
                    <td>
                        <input type="number" name="power"  min="1" step="0.01" value="<?php echo $power;?>">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Макс. скорост:
                    </td>
                    <td>
                        <input type="number" name="max_speed"  min="1" step="0.1" value="<?php echo $max_speed;?>">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Тегло:
                    </td>
                    <td>
                        <input type="number" name="weight"  min="1" value="<?php echo $weight;?>">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Категория:
                    </td>
                    <td>
                        <select name="category">
                            <option value="<?php echo $category;?>"><?php echo $category;?></option>
                            <?php
                            //check category
                            if($category=='A'){
                                ?>
                                <option value="A1">A1</option>
                                <option value="A2">A2</option>
                                <?php
                            }
                            elseif($category=='A1'){
                                ?>
                                <option value="A">A</option>
                                <option value="A2">A2</option>
                                <?php
                            }
                            elseif($category=='A2'){
                                ?>
                                <option value="A">A</option>
                                <option value="A1">A1</option>
                                <?php
                            }
                            ?>
                        </select>

                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Година:
                    </td>
                    <td>
                        <input type="number" name="year"  min="2000" value="<?php echo $year;?>">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Резервоар:
                    </td>
                    <td>
                        <input type="number" name="tank"  min="1" max="50" step="0.1" value="<?php echo $tank;?>">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                       Сегашна снимка:
                    </td>
                    <td>
                    <?php
                        if($current_image == ""){
                            //image not available
                            echo "<div class='error'>Image not available.</div>";
                        }else{
                            //image available
                            ?>
                            <img src="<?php echo SITEURL; ?>administrator/images/motorcycle/<?php echo $current_image;?>" alt="<?php echo $brand." ".$model;?>" width="100px">
                            <?php
                        }
                    ?>
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                       Нова снимка:
                    </td>
                    <td>
                    <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Бр. наемания:
                    </td>
                    <td>
                        <input type="number" name="reservations_count"  min="0" step="1" value="<?php echo $reservations_count;?>">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">Active: </td>
                    <td>
                    <input <?php if($active == "Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($active == "No") {echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

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
            $brand = $_POST['brand'];
            $model = $_POST['model'];
            $type = $_POST['type'];
            $engine = $_POST['engine'];
            $power = $_POST['power'];
            $max_speed = $_POST['max_speed'];
            $weight = $_POST['weight'];
            $category = $_POST['category'];
            $year = $_POST['year'];
            $tank = $_POST['tank'];
            $current_image = $_POST['current_image'];
            $reservations_count = $_POST['reservations_count'];
            $active = $_POST['active'];

            if(isset($_FILES['image']['name'])){
                //upload the image
                //To upload image we need image name, source path and destination path
                $image_name = $_FILES['image']['name'];
                if($image_name != ""){
                    //Auto Rename our image
                    //get the extension of our image (jpg, png, gif, etc)
                    $tmp = explode('.', $image_name);
                    $ext = end($tmp);
                    //rename the image
                    $image_name = "motorcycle_".rand(000, 999).'.'.$ext; //e.g motorcycle_834.jpg
        
                    $source_path = $_FILES['image']['tmp_name'];
        
                    $destination_path = "images/motorcycle/".$image_name;
        
                    //finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);
        
                    //check whether the image is uploaded or not
                    //and if the image is not uploaded then we will stop the procces and redirect with error message
                        if($upload==false){
                            //set message
                            $_SESSION['upload_image'] = "<div class='error'>Failed to upload message</div>";
                            //redirect to Add moto page
                            header("location: ".SITEURL."administrator/moto.php#");
                            //stop the process
                            die();
                        }

                        //remove the current image
                        if($current_image!=""){
                            //current image is available
                            //remove the image
                            $file_path = "images/motorcycle/".$current_image;
                            $remove = unlink($file_path);
    
                            //check whether the image is removed or not
                            if($remove == false){
                                //failed to remove current image
                                $_SESSION['remove-failed'] =  "<div class='error'>Failed to remove current image.</div>";
                                //redirec to manage food
                                header("location: ".SITEURL."administrator/moto.php#");
                                //stop the process
                                die();
                            }
                        }
                }else
                    {
                    $image_name = $current_image; //default image when image is not selected
                    }
            }else
            {
                $image_name = $current_image; //default image when image is not selected
            }

        //sql query for update
        $sql2="UPDATE tbl_motorcycle SET
                brand = '$brand',
                model = '$model',
                type = '$type',
                engine = '$engine',
                power = '$power',
                max_speed = '$max_speed',
                weight = '$weight',
                category = '$category',
                year = '$year',
                tank = '$tank',
                image_name = '$image_name',
                reservations_count = '$reservations_count',
                active = '$active'
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
                    header("location: ".SITEURL."administrator/moto.php#");
                     //stop the process
                     die();
                 }else{
                     //send a message for error update redirect
                     $_SESSION['update'] = "<div class='error'>Неуспешно редактиране.</div>";
                     header("location: ".SITEURL."administrator/moto.php#");
                     //stop the process
                     die();
                 }
            } else {
                $_SESSION['update'] = "<div class='error'>Несъществуващо ID.</div>";
                header("location: ".SITEURL."administrator/moto.php#");
                //stop the process
                die();
            }   
    }
        ?>
        </div>
	</div>
</div>