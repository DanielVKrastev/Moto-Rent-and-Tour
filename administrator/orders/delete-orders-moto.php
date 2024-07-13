<?php
include("../../config/constants.php");

//check whether id and image is set or not
if(isset($_GET['id'])){
    //get value
    $id = $_GET['id'];

        //remove data in database
        //sql query
        $sql_order_details = "DELETE FROM tbl_order_rent_details WHERE id_order_rent=$id";

        //execute the query
        $res_order_details = mysqli_query($conn, $sql_order_details);

        //sql query
        $sql_order = "DELETE FROM tbl_order_rent WHERE id_order_rent=$id";

        //execute the query
        $res_order = mysqli_query($conn, $sql_order);

        //send a message in moto page
        if($res_order == true && $res_order_details == true){
            //success
            $_SESSION['delete_data'] = "<div class='success'>Успешно изтриване.</div>";
            //redirect
            header("location: ".SITEURL."administrator/orders/orders-moto.php");
            die();
        }else{
            //error
            $_SESSION['delete_data'] = "<div class='error'>Неуспешно изтриване.</div>";
            //redirect
            header("location: ".SITEURL."administrator/orders/orders-moto.php");
            die();
        }

    }
else{
    //redirect page or id is incorrect
    header("location: ".SITEURL."administrator/orders/orders-moto.php");
    die();
}

?>