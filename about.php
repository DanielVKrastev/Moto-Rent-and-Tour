<?php include('partials-front/menu.php'); ?>

<!--Start About section-->
<section class="about">
    <div class="container">
        <div class="about-text">
            <h2>За нас</h2>
            <br>
            <h3>Добре дошли в Moto Krastev</h3>
            <p>
                Ние сме екип от страстни мотоциклетисти,
                които създадоха "Мото Кръстев" с една цел
                - да предоставят на вас незабравими и аутентични
                мото турове. От родните пътища до далечни
                забележителности, ние вярваме, че пътешествията
                на две колела разкриват света с невиждана
                перспектива.
            </p>
            <br>
            <h3>Нашата история</h3>
            <p>
                Всичко започна с мечтата ни за свобода и приключения,
                които се тъкаха на две колела. Съчетавайки нашия
                опит в мотоциклетния свят и желанието ни да
                споделим това удоволствие с останалите, създадохме
                "Мото Приключенията". От момента на първия ни тур,
                превърнахме страстта си в мисия да създадем уникални и
                незабравими преживявания за всеки един от вас.
            </p>
            <br>
            <h3>Нашата Мисия</h3>
            <p>
                Мисията ни е да предоставим на вас безупречни
                мотоциклетни турове, които ви водят на
                пътешествие извън обичайните пътища.
                Вярваме, че пътуването на две колела е
                повече от просто преминаване от точка А до
                точка Б - то е начин на живот, който създава
                спомени и връзки.
            </p>
            <br>
            <h3>Екипът Ни</h3>
            <p>
                В нашия екип се включват опитни водачи и
                мотоциклетни ентусиасти, които се грижат
                за вашето безопасност и удоволствие. Те са
                тук, за да ви покажат най-красивите пътеки и
                най-скритите кътчета на всяка дестинация.
            </p>
            <br>
            <h3>Контакти</h3>
            <p>
                Свържете се с нас, за да научите повече за
                нашите мото турове и как можем да ви предоставим
                незабравимо мотоциклетно приключение.
                Очакваме с нетърпение да ви посрещнем на пътя!
            </p>
            <br>
            <p>АДРЕС: България, Варна, бул. Владислав Варненчик 68</p>
            <p>ТЕЛЕФОН: +35989 554 6555 / +35988 554 6666</p>
            <p>ИМЕЙЛ: info@motokrastev.bg</p>
        </div>
        <div class="about-contact">
            <form action="" method="POST">

                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                ?>
                
                <h2>Пишете ни</h2>
                <br>
                <p>Име</p>
                <input type="text" name="client_first_name" placeholder="Въведи име" class="about-input" required>
                <p>Фамилия</p>
                <input type="text" name="client_second_name" placeholder="Въведи фамилия" class="about-input" required>
                <p>Телефон</p>
                <input type="text" name="client_tel" placeholder="Въведи телефон" class="about-input" required>
                <p>E-mail</p>
                <input type="text" name="client_email" placeholder="Въведи имейл" class="about-input" required>
                <p>Тема</p>
                <input type="text" name="client_subject" placeholder="Въведи тема" class="about-input" required>
                <p>Съобщение</p>
                <textarea name="client_message" cols="30" rows="10" required></textarea>
                <br>
                <input type="submit" name="submit_request" value="Изпрати" class="btn btn-primary">
                
            </form>

            <?php
            if (isset($_POST['submit_request'])) {
                //mysqli_real_escape_string($conn, $_POST['client_first_name']);
                $first_name = mysqli_real_escape_string($conn, $_POST['client_first_name']);
                $second_name = mysqli_real_escape_string($conn, $_POST['client_second_name']);
                $telephone = mysqli_real_escape_string($conn, $_POST['client_tel']);
                $email = mysqli_real_escape_string($conn, $_POST['client_email']);
                $subject = mysqli_real_escape_string($conn, $_POST['client_subject']);
                $message = mysqli_real_escape_string($conn, $_POST['client_message']);
                $date_message = date("Y-m-d H:i:s");
                //sql query for insert data in table
                $sql_request = "INSERT INTO moto_krastev.tbl_client_requests SET
                                            first_name = '$first_name',
                                            second_name = '$second_name',
                                            telephone = '$telephone',
                                            email = '$email',
                                            subject_client = '$subject',
                                            message_client = '$message',
                                            date_message =  '$date_message',
                                            status = 'в изчакване'
                                            ";
                //execute query
                $res_request = mysqli_query($conn, $sql_request);

                if ($res_request) {
                    //query executed and message added
                    $_SESSION['add'] = "<div class='success'>Вашето запитване е изпратено успешно.</div>";
                    //redirect page
                    header("location: " . SITEURL . "about.php#");
                    die();
                } else {
                    //error
                    $_SESSION['add'] = "<div class='error'>Неуспешно изпращане.</div>";
                    //redirect page
                    header("location: " . SITEURL . "about.php#");
                    die();
                }
            }
            ?>
        </div>


        <div class="about-faq">
            <h3 class="text-center">Често задавани въпроси</h3>
            <details close>
                <summary class="faq-box">Какво е мото туризъмът и какво представляват мото туровете ви?</summary>
                <div class="faq-content">Мото туризмът е уникално пътешествие, което ви позволява да се насладите на красиви пейзажи и културни забележителности, като сте на мотоциклет. Нашите мото турове са създадени, за да предоставят настоящо приключение на две колела, докато разкриваме най-доброто от всяка дестинация.</div>
            </details>

            <details close>
                <summary class="faq-box">Кой може да се присъедини към мото турите ви? Има ли изисквания за опит или възраст?</summary>
                <div class="faq-content">Нашият мото туризъм е предназначен за всички, които обичат мотоциклетни приключения. Няма конкретни изисквания за опит или възраст, но трябва да имате валидно шофьорско удостоверение за мотоциклет.</div>
            </details>

            <details close>
                <summary class="faq-box">Какво включва цената на мото тура? Какви допълнителни разходи могат да възникнат?</summary>
                <div class="faq-content">Цената на мото тура включва наема на мотоциклет, настаняване, храна и предвождане от опитни водачи. Допълнителни разходи могат да включват гориво, лични разходи и всякакви допълнителни активности, които решите да изпълните по време на тура.</div>
            </details>

            <details close>
                <summary class="faq-box">Какви са вашите отказвания и възстановявания при резервации?</summary>
                <div class="faq-content"> Ако се наложи да откажете резервация, моля, свържете се с нас възможно най-скоро. В зависимост от времето за уведомление и условията, може да има такси за отказ или промяна. За повече подробности, моля, прегледайте нашите политики за отказ.</div>
            </details>

            <details close>
                <summary class="faq-box">Какво правите, за да се грижите за здравето и комфорта на клиентите си по време на пътуването?</summary>
                <div class="faq-content">Здравето и комфортът на нашите клиенти са приоритет. Осигуряваме качествена екипировка, редовни почивки и поддържаме нива на хигиена. Професионалните водачи са обучени да реагират в различни ситуации, за да осигурят безопасност и удобство.</div>
            </details>

        </div>

        <div class="clearfix"></div>
    </div>
</section>
<!--End About section-->

<?php include('partials-front/footer.php'); ?>