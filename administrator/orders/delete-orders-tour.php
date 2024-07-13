<?php
include("../../config/constants.php");

//check whether id and image is set or not
if(isset($_GET['id'])){
    //get value
    $id = $_GET['id'];

        //remove data in database
        //sql query
        $sql_order_details = "DELETE FROM tbl_order_tour_details WHERE id_order_tour=$id";

        //execute the query
        $res_order_details = mysqli_query($conn, $sql_order_details);

        //sql query for passenger
        $sql_passenger = "DELETE FROM tbl_order_tour_passenger WHERE id_order_tour = $id";

        //execute the query
        $res_passenger = mysqli_query($conn, $sql_passenger);

        
        //sql query for -1 reservation count because order is deleted
        $sql_id_tour = "SELECT ot.id_tour, ot.status FROM tbl_order_tour ot WHERE id_order_tour=$id";
        $res_id_tour = mysqli_query($conn, $sql_id_tour);
        $count_id_tour= mysqli_num_rows($res_id_tour);
        if($count_id_tour = 1){
            $row_id_tour = mysqli_fetch_assoc($res_id_tour);
            $id_tour = $row_id_tour['id_tour'];
            $status = $row_id_tour['status'];
        }
        if($status != 'отказана'){
            $sql_reservation_count= "UPDATE moto_krastev.tbl_tour 
                                    SET reservations_count = reservations_count - 1
                                    WHERE id_tour=$id_tour
                                    ";
            $res_resevation_count = mysqli_query($conn, $sql_reservation_count);
        }

        //sql query
        $sql_order = "DELETE FROM tbl_order_tour WHERE id_order_tour=$id";

        //execute the query
        $res_order = mysqli_query($conn, $sql_order);



        //send a message in admin tour page
        if($res_order == true && $res_order_details == true){
            //success
            $_SESSION['delete_data'] = "<div class='success'>Успешно изтриване.</div>";
            //redirect
            header("location: ".SITEURL."administrator/orders/orders-tour.php");
            die();
        }else{
            //error
            $_SESSION['delete_data'] = "<div class='error'>Неуспешно изтриване.</div>";
            //redirect
            header("location: ".SITEURL."administrator/orders/orders-tour.php");
            die();
        }

    }
else{
    //redirect page or id is incorrect
    header("location: ".SITEURL."administrator/orders/orders-moto.php");
    die();
}

?>