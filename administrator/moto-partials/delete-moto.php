<?php
include ($_SERVER['DOCUMENT_ROOT'].'/Moto_Krastev_Rent_&_Tour/config/constants.php');
//echo $_GET['id'];
//echo $_GET['image_name'];

//check whether id and image is set or not
if(isset($_GET['id']) AND isset($_GET['image_name'])){
    //get value
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove image in folder
    if($image_name!=""){
        //remove image
        $file_path = "../images/motorcycle/".$image_name;
        $remove = unlink($file_path);

        //error remove
        if($remove == false){
            //send a message in moto page
            $_SESSION['remove_image'] = "<div class='error'>Грешка в изтриването на изобр.</div>";
            //redirect
            header("location: ".SITEURL."administrator/moto.php#");
            die();
        }
    }

        //remove data in database
        //sql query
        $sql_moto_price = "DELETE FROM tbl_motorcycle_price WHERE id_motorcycle=$id";
        $sql_moto = "DELETE FROM tbl_motorcycle WHERE id_motorcycle=$id";
        

        //execute the query
        $res_moto_price = mysqli_query($conn, $sql_moto_price);
        $res_moto = mysqli_query($conn, $sql_moto);
        

        //send a message in moto page
        if($res_moto == true && $res_moto_price == true){
            //success
            $_SESSION['delete_data'] = "<div class='success'>Успешно изтриване.</div>";
            //redirect
            header("location: ".SITEURL."administrator/moto.php#");
            die();
        }else{
            //error
            $_SESSION['delete_data'] = "<div class='error'>Неуспешно изтриване.</div>";
            //redirect
            header("location: ".SITEURL."administrator/moto.php#");
            die();
        }

    }
else{
    //redirect page or id is incorrect
    header("location: ".SITEURL."administrator/moto.php#");
    die();
}

?>