<!-- Start POPUP Add data in database -->

<div id="popup-insert" class="overlay">
	<div class="popup">
		<h2 class="text-center">Добавяне на група от хора</h2>
        <br>
		<a class="close" href="#">&times;</a>
		<div class="add-box">

        <form action="" method="post" enctype="multipart/form-data">
			<table>

                <tr>
                    <td class="text-right">
                        Група /от-до/:
                    </td>
                    <td>
                        <input type="text" name="count_people" placeholder="Въведи брой от-до">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Добави" class="btn btn-primary">
                    </td> 
                </tr>

            </table>
        </form>

        <?php 
        //check whether the submit button is clicked or not
        if(isset($_POST['submit'])){
            //echo "clicked";
            $count_people = $_POST['count_people'];

       //sql query
        $sql2 = "INSERT INTO moto_krastev.tbl_tour_peoples SET
                count_people = '$count_people'
        ";

        //execute the query and save in database
        $res2 = mysqli_query($conn, $sql2);

        //check whether the query executed or not and data added or not
        if($res2 == true){
            //query executed and motorcycle added
            $_SESSION['add'] = "<div class='success'>Успешно добавяне.</div>";
            //redirect page
            header("location: ".SITEURL."administrator/group-people/group-people.php#");
            die();
        }
        else{
            //failed to add moto
            $_SESSION['add'] = "<div class='error'>Неуспешно добавяне.</div>";
            header("location: ".SITEURL."administrator/group-motorcycles/group-people.php#");
            die();
        }
        }
        ?>
		</div>
	</div>
</div>

<!-- End POPUP Add data in database -->