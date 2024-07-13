<!-- Start POPUP Add data in database -->

<div id="popup-insert" class="overlay">
	<div class="popup">
		<h2 class="text-center">Добавяне на група от мотори</h2>
        <br>
		<a class="close" href="#">&times;</a>
		<div class="add-box">

        <form action="" method="post" enctype="multipart/form-data">
			<table>

                <tr>
                    <td class="text-right">
                        Мотор 1:
                    </td>
                    <td>
                        <input type="text" name="motorcycle1" placeholder="Въведи мотор 1">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Цена <i>/мотор 1/</i>:
                    </td>
                    <td>
                        <input type="number" name="motorcycle1_price"  min="0" step="1" placeholder="Въведи цена /лв./">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Мотор 2:
                    </td>
                    <td>
                        <input type="text" name="motorcycle2" placeholder="Въведи мотор 2">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Цена <i>/мотор 2/</i>:
                    </td>
                    <td>
                        <input type="number" name="motorcycle2_price"  min="0" step="1" placeholder="Въведи цена /лв./">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Мотор 3:
                    </td>
                    <td>
                        <input type="text" name="motorcycle3" placeholder="Въведи мотор 3">
                    </td>
                </tr>

                <tr>
                    <td class="text-right">
                        Цена <i>/мотор 3/</i>:
                    </td>
                    <td>
                        <input type="number" name="motorcycle3_price"  min="0" step="1" placeholder="Въведи цена /лв./">
                    </td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Добави група" class="btn btn-submit">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
        //check whether the submit button is clicked or not
        if(isset($_POST['submit'])){
            //echo "clicked";
            $motorcycle1 = $_POST['motorcycle1'];
            $motorcycle1_price = $_POST['motorcycle1_price'];
            $motorcycle2 = $_POST['motorcycle2'];
            $motorcycle2_price = $_POST['motorcycle2_price'];
            $motorcycle3 = $_POST['motorcycle3'];
            $motorcycle3_price = $_POST['motorcycle3_price'];

       //sql query
        $sql2 = "INSERT INTO moto_krastev.tbl_tour_motorcycle SET
                motorcycle1 = '$motorcycle1',
                motorcycle1_price = '$motorcycle1_price',
                motorcycle2 = '$motorcycle2',
                motorcycle2_price = '$motorcycle2_price',
                motorcycle3 = '$motorcycle3',
                motorcycle3_price = '$motorcycle3_price'
        ";

        //execute the query and save in database
        $res2 = mysqli_query($conn, $sql2);

        //check whether the query executed or not and data added or not
        if($res2 == true){
            //query executed and motorcycle added
            $_SESSION['add'] = "<div class='success'>Успешно добавяне.</div>";
            //redirect page
            header("location: ".SITEURL."administrator/group-motorcycles/group-moto.php#");
            die();
        }
        else{
            //failed to add moto
            $_SESSION['add'] = "<div class='error'>Неуспешно добавяне.</div>";
            header("location: ".SITEURL."administrator/group-motorcycles/group-moto.php#");
            die();
        }
        }
        ?>
		</div>
	</div>
</div>

<!-- End POPUP Add data in database -->