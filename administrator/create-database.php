<?php 
    include('partials-admin/menu.php');
?>

<section class="container-admin">
<div class="wrapper">
    <h1>Създаване на база</h1>
    <br><br>

    <form action="<?php echo SITEURL; ?>administrator/create-database.php" method="POST">

        <div class="box-admin text-center">
            <h2>1.</h2>
            <h3>Създаване на база от данни</h3>
            <br><br>
            <input type="submit" name="submit_base" value="Създай" class="btn btn-primary">
        </div>

        <div class="box-admin text-center">
            <h2>2.</h2>
            <h3>Таблици за мотори
                <br><i>tbl_motorcycle</i>
                <br><i>tbl_motorcycle_price</i>
            </h3>
            <br>
            <input type="submit" name="submit_motorcycle" value="Създай" class="btn btn-primary">
        </div>

        <div class="box-admin text-center">
            <h2>3.</h2>
            <h3>Таблици за мото-турове 
                <br><i>tbl_tour</i>
                <br><i>tbl_tour_motorcycle</i>
            </h3>
            <br>
            <input type="submit" name="submit_tour" value="Създай" class="btn btn-primary">
        </div>

        <div class="box-admin text-center">
            <h2>4.</h2>
            <h3>Създаване на връзки между таблици</h3>
            <br><br>
            <input type="submit" name="submit_relations" value="Създай" class="btn btn-primary">
        </div>

        <input type="submit" name="delete_DB" value="Изтриване на БД" class="btn btn-secondary error">
    </form>

</div>
</section>

<div class="clearfix"></div>

<?php 
    //create database moto_krastev
    if(isset($_POST['submit_base'])){
        // echo "<span class='success'>test</span>";
        $sql_base = 'CREATE Database IF NOT EXISTS moto_krastev';
        if($res_base = mysqli_query($conn, $sql_base)){
         $_SESSION['CREATE_DATABASE'] = "Yes";
         echo "<span class='success'>Базата данни е създадена.</span>";
        }
        else
        {
         echo "<span class='success'>Грешка при създаване на базата данни.</span>";
        }
    }
     //create tables for motorcycles /tbl_motorcycle/, /tbl_motorcycle_price/
    if(isset($_POST['submit_motorcycle'])){
        $sql_motorcycle = "CREATE TABLE IF NOT EXISTS moto_krastev.tbl_motorcycle(
                        id_motorcycle INT(11) NOT NULL AUTO_INCREMENT,
                        brand VARCHAR(50) DEFAULT NULL,
                        model VARCHAR(50) DEFAULT NULL,
                        type VARCHAR(50) DEFAULT NULL,
                        engine DECIMAL(10,2) NOT NULL,
                        power DECIMAL(10,2) NOT NULL,
                        max_speed DECIMAL(10,2) NOT NULL,
                        weight INT(11) NOT NULL,
                        category VARCHAR(2) DEFAULT NULL,
                        year INT(4) NOT NULL,
                        tank DECIMAL(10,2) NOT NULL,
                        image_name VARCHAR(255) DEFAULT NULL,
                        active VARCHAR(3) DEFAULT NULL,
                        frequency VARCHAR(3) DEFAULT NULL,
                        PRIMARY KEY (id_motorcycle)
                        ) ENGINE=INNODB DEFAULT CHARSET=utf8";
        $res_motorcycle = mysqli_query($conn, $sql_motorcycle);

        $sql_motorcycle_price = "CREATE TABLE IF NOT EXISTS moto_krastev.tbl_motorcycle_price(
                                id_motorcycle INT(11) NOT NULL AUTO_INCREMENT,
                                price DECIMAL(10,2) NOT NULL,
                                INDEX(id_motorcycle)
                                )ENGINE=INNODB DEFAULT CHARSET=utf8";
        $res_motorcycle_price = mysqli_query($conn, $sql_motorcycle_price);

        if($res_motorcycle && $res_motorcycle_price){
            echo "<span class='success'>Таблиците са създадени!</span>";
        }
        else
        {
            echo "<span class='error'>Грешка при създаване на таблиците.</span>";
            die();
        }
    }

    //create tables for moto tours tbl_tour, tbl_tour_motorcycle, tbl_tour_peoples

    //create tbl_tour
    if(isset($_POST['submit_tour'])){
        $sql_tour = "CREATE TABLE IF NOT EXISTS moto_krastev.tbl_tour(
            id_tour INT(11) NOT NULL AUTO_INCREMENT,
            country VARCHAR(50) DEFAULT NULL,
            cities VARCHAR(50) DEFAULT NULL,
            price DECIMAL(10,0) NOT NULL,
            distance DECIMAL(10,0) NOT NULL,
            days INT(5) NOT NULL,
            description VARCHAR(1500) DEFAULT NULL,
            map VARCHAR(100) DEFAULT NULL,
            limit_people INT(3) NOT NULL,
            languages VARCHAR(50) DEFAULT NULL,
            id_motorcycle_group INT(11) NOT NULL,
            image VARCHAR(255) DEFAULT NULL,
            date1 DATE DEFAULT NULL,
            date2 DATE DEFAULT NULL,
            date3 DATE DEFAULT NULL,
            date4 DATE DEFAULT NULL,
            reservations_count INT(10) NOT NULL,
            active VARCHAR(3) DEFAULT NULL,
            PRIMARY KEY (id_tour)
            ) ENGINE=INNODB DEFAULT CHARSET=utf8";
        $res_tour = mysqli_query($conn, $sql_tour);

        //create tbl_tour_motorcycle
        $sql_tour_motorcycle = "CREATE TABLE IF NOT EXISTS moto_krastev.tbl_tour_motorcycle(
                        id_motorcycle_group INT(11) NOT NULL AUTO_INCREMENT,
                        motorcycle1 VARCHAR(50) DEFAULT NULL,
                        motorcycle1_price DOUBLE NOT NULL,
                        motorcycle2 VARCHAR(50) DEFAULT NULL,
                        motorcycle2_price DOUBLE NOT NULL,
                        motorcycle3 VARCHAR(50) DEFAULT NULL,
                        motorcycle3_price DOUBLE NOT NULL,
                        PRIMARY KEY (id_motorcycle_group)
                        ) ENGINE=INNODB DEFAULT CHARSET=utf8";
        $res_tour_motorcycle = mysqli_query($conn, $sql_tour_motorcycle);


        if($res_tour && $res_tour_motorcycle){
            echo "<span class='success'>Таблиците са създадени!</span>";
        }
        else
        {
            echo "<span class='error'>Грешка при създаване на таблиците.</span>";
            die();
        }
    }

    //create relations between tables
    //relationship between tbl_motorcycle - tbl_motorcycle_price
    if(isset($_POST['submit_relations'])){
    //relationship between tbl_tour - tbl_tour_motorcycle - tbl_peoples
        $sql_tour_relation_motorcycle = "ALTER TABLE moto_krastev.tbl_tour
                                        ADD CONSTRAINT tour_relation_motorcycle FOREIGN KEY (id_motorcycle_group) REFERENCES tbl_tour_motorcycle (id_motorcycle_group) 
                                        ON DELETE CASCADE ON UPDATE CASCADE,
                                        ADD CONSTRAINT tour_relation_people FOREIGN KEY (id_people) REFERENCES tbl_tour_peoples (id_people_group)
                                        ON DELETE CASCADE ON UPDATE CASCADE
                                        ";
        $res_tour_relation_motorcycle = mysqli_query($conn, $sql_tour_relation_motorcycle);

        if($res_tour_relation_motorcycle){
            echo "<span class='success'>Връзките са създадени!</span>";
        }
        else
        {
            echo "<span class='error'>Грешка при създаване на връзки.</span>";
            die();
        }
    }

    //delete database
    if(isset($_POST['delete_DB'])){
        $sql_delete = 'DROP DATABASE `moto_krastev`';
        $res_delete = mysqli_query($conn, $sql_delete);

        if($res_delete){
            $_SESSION['CREATE_DATABASE'] = "No";
            echo "<span class='error'>Успешно изтриване!</span>";
        }
        else
        {
            echo "<span class='error'>Неуспешно изтриване.</span>";
            die();
        }
    }


    include('partials-admin/footer.php')
?>