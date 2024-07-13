<head>
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>../css/comment-policy-options.css" media="screen" />
</head>
<!-- Start section for comments -->
<section class="comment">
    <div class="subtitle">
        <h2>Последни отзиви</h2>
        <h3>ОТ НАШИТЕ КЛИЕНТИ.</h3>
    </div>

    <br>

    <?php 
        $sql_comment_get = "SELECT * FROM moto_krastev.tbl_comments ORDER BY id_comment DESC LIMIT 4";
        $res_comment_get = mysqli_query($conn, $sql_comment_get);
        $count_comments = mysqli_num_rows($res_comment_get);

        if($count_comments > 0){
            while($row = mysqli_fetch_assoc($res_comment_get)){
                $name_row = $row['name'];
                $rating_row = $row['rating'];
                $comment_text_row = $row['comment_text'];
                $date_comment_row = $row['date_comment'];

                ?>
                <div class="comment-box">
                    <div class="comment-name"><?php echo $name_row; ?></div>
                    <div class="comment-date"> - <?php echo $date_comment_row; ?> - </div>
                    <div class="comment-rating">
                        <img src="../images/ratings/rating-<?php echo $rating_row; ?>.png" alt="">
                    </div>

                    <div class="comment-text">
                        <?php echo $comment_text_row; ?>
                    </div>
                    </div>
                <?php

            }
        }
    ?>

    <!-- Form for new comments -->
    <form id="form-comment" action="" method="post"></form>
    <div class="review-form">
    <div class="subtitle">
        <h2>Оставете вашия отзив</h2>
        <h3>НИЕ ЦЕНИМ ВАШЕТО МНЕНИЕ.</h3>
    </div>

        <label for="name">Имена:</label>
        <input form="form-comment" type="text" id="name" name="name" required>
        <br>

        <label for="email">E-mail:</label>
        <input form="form-comment" type="email" id="email" name="email" required>
        <br>

        <label for="rating">Оценка:</label>
            <div class="rating">
                <span onclick="gfg(1)"
                    class="star">★
                </span>
                <span onclick="gfg(2)"
                    class="star">★
                </span>
                <span onclick="gfg(3)"
                    class="star">★
                </span>
                <span onclick="gfg(4)"
                    class="star">★
                </span>
                <span onclick="gfg(5)"
                    class="star">★
                </span>
                <input form="form-comment" type="hidden" value="0" class="rating-input" name="rating" required>
            </div>
        <br>

        <label for="comment">Отзив:</label>
        <textarea form="form-comment" id="comment" name="comment" rows="4" cols="50" required></textarea>
        <br>

        <input form="form-comment" type="submit" value="Изпрати" name="submit-comment" class="btn">

    </div>

    <?php

        if(isset($_SESSION['send-comment'])){
            echo $_SESSION['send-comment'];
            unset($_SESSION['send-comment']);
        }

        if(isset($_POST['submit-comment'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $rating = $_POST['rating'];
            $comment_text = $_POST['comment'];
            $date_comment = date("Y-m-d");
            
            //sql query
            $sql_comment = "INSERT INTO moto_krastev.tbl_comments SET
                            name = '$name',
                            email = '$email',
                            rating = '$rating',
                            comment_text = '$comment_text',
                            date_comment = '$date_comment'
                            ";
            //execute
            $res_comment = mysqli_query($conn, $sql_comment);

            if($res_comment){
                $_SESSION['send-comment'] = "<div class='success'>Успешно изпратен отзив.</div>";
                header("location: ".$_SERVER['REQUEST_URI']);
            }else{
                $_SESSION['send-comment'] = "<div class='error'>Неуспешно изпратен отзив.</div>";
                header("location: ".$_SERVER['REQUEST_URI']);
            }
        }

    ?>

    <div class="clearfix"></div>
</section>
<script type="text/javascript" src="../js/rating-stars.js"></script>

<!-- End section for comments -->