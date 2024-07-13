<!-- Start POPUP Add data in database -->

<div id="popup-insert" class="overlay">
	<div class="popup">
		<h2 class="text-center">Добавяне на мотоциклет</h2>
        <br>
		<a class="close" href="#">&times;</a>
		<div class="add-box">

        <form action="" method="post" enctype="multipart/form-data">
			<table>

                <tr>
                    <td class="text-right">
                        Марка:
                    </td>
                    <td>
                        <input type="text" name="brand" placeholder="Въведи марка">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Модел:
                    </td>
                    <td>
                        <input type="text" name="model" placeholder="Въведи модел">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Тип:
                    </td>
                    <td>
                        <select name="type">
                            <option value="спортен">спортен</option>
                            <option value="турър">турър</option>
                            <option value="чопър">чопър</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Двигател:
                    </td>
                    <td>
                        <input type="number" name="engine"  min="50" step="0.01" placeholder="Въведи двигател /куб.см/" >
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Мощност:
                    </td>
                    <td>
                        <input type="number" name="power"  min="1" step="0.01" placeholder="Въведи мощност /к.н/">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Макс. скорост:
                    </td>
                    <td>
                        <input type="number" name="max_speed"  min="1" step="0.1" placeholder="Въведи скорост /км/ч/">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Тегло:
                    </td>
                    <td>
                        <input type="number" name="weight"  min="1" placeholder="Въведи тегло /кг/">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Категория:
                    </td>
                    <td>
                        <select name="category">
                            <option value="A">A</option>
                            <option value="A1">A1</option>
                            <option value="A2">A2</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Година:
                    </td>
                    <td>
                        <input type="number" name="year"  min="2000" placeholder="Въведи година">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Резервоар:
                    </td>
                    <td>
                        <input type="number" name="tank"  min="1" max="50" step="0.1" placeholder="Въведи резервоар /л/">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Снимка:
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
                        <input type="number" name="reservations_count"  min="0" step="1" placeholder="Въведи брой наемания" value="0">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes" checked> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Добави мотор" class="btn btn-submit">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
        //check whether the submit button is clicked or not
        if(isset($_POST['submit'])){
            //echo "clicked";
            
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
            $reservations_count = $_POST['reservations_count'];

            //for radio input, need to check whether the button is selected
            if(isset($_POST['active'])){
                //if check get the value from FORM
                $active = $_POST['active'];
            }
            else{
                $active = "No";
            }
        
       // echo $brand, $model, $type, $engine, $power, $max_speed, $weight, $category, $year, $gears, $tank, $active, $frequency;
       if(isset($_FILES['image']['name'])){
        //upload the image
        //To upload image we need image name, source path and destination path
        $image_name = $_FILES['image']['name'];
            if($image_name != ""){
                //Auto Rename our image
                //get the extension of our image (jpg, png, gif, etc)
                $ext = end(explode('.', $image_name));

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
                    //redirect to Add category page
                    header("location: ".SITEURL."administrator/moto.php#");
                    //stop the process
                    die();
                }
            }else{
            //don't upload image and set the image_name value as black
            $image_name = "";
            }
        }


       //sql query
        $sql2 = "INSERT INTO moto_krastev.tbl_motorcycle SET
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
        ";

        //execute the query and save in database
        $res2 = mysqli_query($conn, $sql2);

        //check whether the query executed or not and data added or not
        if($res2 == true){
            //query executed and motorcycle added
            $_SESSION['add'] = "<div class='success'>Успешно добавяне.</div>";
            //redirect page
            header("location: ".SITEURL."administrator/moto.php#");
            die();
        }
        else{
            //failed to add moto
            $_SESSION['add'] = "<div class='error'>Неуспешно добавяне.</div>";
            header("location: ".SITEURL."administrator/moto.php#");
            die();
        }
        }
        ?>
		</div>
	</div>
</div>

<!-- End POPUP Add data in database -->