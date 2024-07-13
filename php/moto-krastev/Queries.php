<?php
    error_reporting(0);
class Queries{

    //function for rent.php
    //for filter motorcycle
    public function rentFilterMotorcycle($moto_brand, $start, $rows_per_page){
        //filter for all/honda/yamaha/suzuki/bmw
        //query to get all data from database, table tbl_motorcycle
        if($_GET['brand'] == 'Honda'){
            $sql = "SELECT * FROM tbl_motorcycle WHERE brand='$moto_brand' AND active = 'Yes' LIMIT $start, $rows_per_page";
        }
        elseif($_GET['brand'] == 'Yamaha'){
            $sql = "SELECT * FROM tbl_motorcycle WHERE brand='$moto_brand' AND active = 'Yes' LIMIT $start, $rows_per_page";
        }
        elseif($_GET['brand'] == 'Suzuki'){
            $sql = "SELECT * FROM tbl_motorcycle WHERE brand='$moto_brand' AND active = 'Yes' LIMIT $start, $rows_per_page";
        }
        elseif($_GET['brand'] == 'BMW'){
            $sql = "SELECT * FROM tbl_motorcycle WHERE brand='$moto_brand' AND active = 'Yes' LIMIT $start, $rows_per_page";
        }
        else{
           //if not select a filter
            $sql = "SELECT * FROM tbl_motorcycle WHERE active = 'Yes' LIMIT $start, $rows_per_page";
        }
        return $sql;
    }

    //function for routes.php
    //for filter country
    public function routesFilterCountry(){
        if(isset($_GET['country'])){
            if($_GET['country'] == 'България'){
                $sql = "SELECT * FROM tbl_tour WHERE country = 'България' AND active = 'Yes'";
            }elseif($_GET['country'] == 'Румъния'){
                $sql = "SELECT * FROM tbl_tour WHERE country = 'Румъния' AND active = 'Yes'";
            }elseif($_GET['country'] == 'Турция'){
                $sql = "SELECT * FROM tbl_tour WHERE country = 'Турция' AND active = 'Yes'";
            }elseif($_GET['country'] == 'Гърция'){
                $sql = "SELECT * FROM tbl_tour WHERE country = 'Гърция' AND active = 'Yes'";
            }
        }
        else{
            $sql = "SELECT * FROM tbl_tour WHERE active = 'Yes'";
        }

        return $sql;
    }

    //function for rent/motorcycle.php
    public function motorcycleRent($id_motorcycle){
        //get the details 
        $sql = "SELECT * FROM tbl_motorcycle
                NATURAL JOIN tbl_motorcycle_price
                WHERE id_motorcycle=$id_motorcycle AND active='Yes'";
        return $sql;
    }
}