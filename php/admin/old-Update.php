<?php 

function updateMotorStatus($conn){
    $d=strtotime("yesterday"); 
    $tomorrowDate = date("Y-m-d", $d);
    //$tomorrowDate = '2024-05-05';

    $sql_update_active = "UPDATE tbl_motorcycle m
                        JOIN tbl_order_rent_details d ON m.id_motorcycle = d.id_motorcycle
                        JOIN tbl_order_rent r ON d.id_order_rent = r.id_order_rent
                        SET active = 'Yes'
                        WHERE d.date_to = '$tomorrowDate' AND r.status != 'завършена' AND r.status != 'отказана'
             ";
    $res_update_active = mysqli_query($conn, $sql_update_active);
    if ($res_update_active) {
        echo "Успешно актуализиране на статуса на моторите.";
    } else {
        echo "Грешка при актуализиране на статуса на моторите.";
    }
    echo $tomorrowDate;
}
?>