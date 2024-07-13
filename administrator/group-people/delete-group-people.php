<?php
include("../../config/constants.php");

//check whether id and image is set or not
if(isset($_GET['id'])){
    //get value
    $id = $_GET['id'];

        //remove data in database
        //sql query
        $sql = "DELETE FROM tbl_tour_peoples WHERE id_people_group=$id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //send a message in moto page
        if($res == true){
            //success
            $_SESSION['delete_data'] = "<div class='success'>Успешно изтриване.</div>";
            //redirect
            header("location: ".SITEURL."administrator/group-people/group-people.php#");
            die();
        }else{
            //error
            $_SESSION['delete_data'] = "<div class='error'>Неуспешно изтриване.</div>";
            //redirect
            header("location: ".SITEURL."administrator/group-people/group-people.php#");
            die();
        }

    }
else{
    //redirect page or id is incorrect
    header("location: ".SITEURL."administrator/group-people/group-people.php#");
    die();
}

?>