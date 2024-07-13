<?php include('config/constants.php'); 
 $sql_moto_rent_dates = "SELECT date_from, date_to
 FROM tbl_order_rent_details od
 JOIN tbl_order_rent o ON oD.id_order_rent = o.id_order_rent
 WHERE id_motorcycle = 9 AND o.status != 'завършена' AND o.status != 'отказана'";
    $res_moto_rent_dates = mysqli_query($conn, $sql_moto_rent_dates);

    $bookedDates = [];
    if (mysqli_num_rows($res_moto_rent_dates) > 0) {
        while($row_moto_rent_dates = mysqli_fetch_assoc($res_moto_rent_dates)){
            $date_from_range = $row_moto_rent_dates['date_from'];
            $date_to_range = $row_moto_rent_dates['date_to'];
        
            array_push($bookedDates,[$date_from_range, $date_to_range]);
            
        }
    } else {
        $bookedDates = [];
    }
    $bookedDatesJson = json_encode($bookedDates);
    echo $bookedDatesJson;
?>

<!DOCTYPE html>
<html lang="bg">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Наем на мотор</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    </head>

    <body>
        <h1>Резервирайте мотор</h1>
        <form action="submit_order.php" method="POST">
            <label for="start_date">Начална дата:</label>
            <input type="text" id="start_date" name="start_date" required>
            <br>
            <label for="end_date">Крайна дата:</label>
            <input type="text" id="end_date" name="end_date" required>
            <br>
            <label for="name">Име:</label>
            <input type="text" id="name" name="name" required>
            <br>
            <label for="email">Имейл:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <button type="submit">Изпрати</button>
        </form>

        <section class="comment">
            <div class="subtitle">
                <h2>Последни отзиви</h2>
                <h3>ОТ НАШИТЕ КЛИЕНТИ.</h3>
            </div>

            <br>

            <div class="comment-box">
                <div class="comment-name">Даниел K.</div>
                <div class="comment-date"> - 14 ян 2024 - </div>
                <div class="comment-rating">
                    <img src="../images/ratings/rating-50.png" alt="">
                </div>
                <div class="comment-text">
                    Препоръчвам горещо на всеки, който обича свободата на пътуването и 
                    истинските мотоциклетни приключения
                </div>
            </div>

            <div class="comment-box">
                <div class="comment-name">Анна М.</div>
                <div class="comment-date"> - 03 ян 2024 - </div>
                <div class="comment-rating">
                    <img src="../images/ratings/rating-50.png" alt="">
                </div>
                <div class="comment-text">
                    Пътешествието ми с тях не беше просто почивка, беше истинско приключение. Имахме възможността да изживеем красивите дестинации през перспективата на мотоциклета, което направи всичко още по-вълнуващо. 
                </div>
            </div>

            <div class="comment-box">
                <div class="comment-name">Даниел K.</div>
                <div class="comment-date"> - 12 дек 2023 - </div>
                <div class="comment-rating">
                    <img src="../images/ratings/rating-50.png" alt="">
                </div>
                <div class="comment-text">
                    Препоръчвам горещо на всеки, който обича свободата на пътуването и 
                    истинските мотоциклетни приключения
                </div>
            </div>

            <div class="clearfix"></div>

            <!-- Форма за нови отзиви -->
            <div class="review-form">
                <h2>Оставете вашия отзив</h2>
                <form action="process_review.php" method="post">
                    <label for="name">Имена:</label>
                    <input type="text" id="name" name="name" required>
                    <br>

                    <label for="email">Имейл адрес:</label>
                    <input type="email" id="email" name="email" required>
                    <br>

                    <label for="rating">Оценка:</label>
                    <select id="rating" name="rating" required>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <br>

                    <label for="review">Отзив:</label>
                    <textarea id="review" name="review" rows="4" cols="50" required></textarea>
                    <br>

                    <input type="submit" value="Изпрати">
                </form>
            </div>
        </section>



        <div class="card">
            <h1>JavaScript Star Rating</h1>
            <br />
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
            <h3 id="output">
                Rating is: 0/5
            </h3>
        </div>

        <style>
            
            
            .card {
            max-width: 33rem;
            background: #fff;
            margin: 0 1rem;
            padding: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            width: 100%;
            border-radius: 0.5rem;
            }
            
            .star {
            margin: -4px;
            font-size: 30px;
            cursor: pointer;
            }
            
            .one {
            color: rgb(255, 0, 0);
            }
            
            .two {
            color: rgb(255, 106, 0);
            }
            
            .three {
            color: rgb(251, 255, 120);
            }
            
            .four {
            color: rgb(255, 255, 0);
            }
            
            .five {
            color: rgb(24, 159, 14);
            }
        </style>

        <script>
                        // script.js
                
                // To access the stars
                let stars = 
                    document.getElementsByClassName("star");
                let output = 
                    document.getElementById("output");
                
                // Funtion to update rating
                function gfg(n) {
                    remove();
                    for (let i = 0; i < n; i++) {
                        if (n == 1) cls = "one";
                        else if (n == 2) cls = "one";
                        else if (n == 3) cls = "one";
                        else if (n == 4) cls = "one";
                        else if (n == 5) cls = "one";
                        stars[i].className = "star " + cls;
                    }
                    output.innerText = "Rating is: " + n + "/5";
                }
                
                // To remove the pre-applied styling
                function remove() {
                    let i = 0;
                    while (i < 5) {
                        stars[i].className = "star";
                        i++;
                    }
                }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/bg.js"></script> <!-- Български езиков файл -->


        <script>
            // Заети дати от всички диапазони (примерен масив)
            var bookedDates = <?php echo $bookedDatesJson; ?>;

            // Функция за обработка на всички заети дати
            function getAllBookedDates() {
                var allDates = [];
                bookedDates.forEach(function(range) {
                    var startDate = new Date(range[0]);
                    var endDate = new Date(range[1]);
                    var currentDate = startDate;
                    while (currentDate <= endDate) {
                        allDates.push(currentDate.toISOString().slice(0, 10));
                        currentDate.setDate(currentDate.getDate() + 1);
                    }
                });
                return allDates;
            }

            // Инициализация на Flatpickr за начална дата
            var startDateInput = document.getElementById('start_date');
            flatpickr(startDateInput, {
                locale: 'bg', // Използване на български език
                dateFormat: "Y-m-d", // Формат на датата
                disable: getAllBookedDates(), // Забрана на заетите дати
                onChange: function(selectedDates) {
                    // Премахване на маркирането
                    startDateInput.classList.remove('booked-date');
                }
            });

            // Инициализация на Flatpickr за крайна дата
            var endDateInput = document.getElementById('end_date');
            flatpickr(endDateInput, {
                locale: 'bg', // Използване на български език
                dateFormat: "Y-m-d", // Формат на датата
                disable: getAllBookedDates(), // Забрана на заетите дати
                onChange: function(selectedDates) {
                    // Премахване на маркирането
                    endDateInput.classList.remove('booked-date');
                }
            });

            /******************************************************************/
            const ranges = [];

            function saveRange() {
                ranges.length = 0;
                const startInput = document.getElementById('start_date');
                const endInput = document.getElementById('end_date');
                const startValue = startInput.value;
                const endValue = endInput.value;
                ranges.push(startValue, endValue);
            }

            function handleInputChange() {
            saveRange();

                let rangeToCheck = ranges;

                const arrayOfRanges = <?php echo $bookedDatesJson; ?>;

                function doesRangeOverlapWithAny(rangeToCheck, arrayOfRanges) {

                    for (let i = 0; i < arrayOfRanges.length; i++) {
                        const currentRange = arrayOfRanges[i];
                        const startDateToCheck = new Date(ranges[0]);
                        const endDateToCheck = new Date(ranges[1]);
                        const startDate = new Date(currentRange[0]);
                        const endDate = new Date(currentRange[1]);

                    //console.log(endDateToCheck);
                            
                        if (endDateToCheck >= startDate && startDateToCheck <= endDate) {
                            return true; // Намерили сме засичащ се диапазон
                        }
                    } 
                    return false; // няма засичащ се диапазон
                        
                }
                    
                const overlap = doesRangeOverlapWithAny(rangeToCheck, arrayOfRanges);
                if(overlap){
                    const endInput = document.getElementById('end_date').value = '';
                    console.log(ranges[0]);
                    alert('Някои от тези дати вече са заети. Моля изберете си други.')
                }
                console.log(overlap); // true, защото диапазонът за проверка се засича с поне един от масивите
            }

            document.getElementById('end_date').addEventListener('input', handleInputChange);

            /********************************************************* */
        

        </script>


<style>
        .search-container {
            text-align: center;
            padding: 20px;
            background-color: #f2f2f2;
        }
        .search-container input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }
        .search-container button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .search-container button:hover {
            background-color: #45a049;
        }
    </style>
<body>
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Търсене...">
        <button onclick="searchFunction()">Търсене</button>
    </div>


    <?php

// Създайте масив с всички променливи
$name = 'John Doe';
$userData = [
    'user_id' => 123,
    'user_name' => $name,
    'user_email' => 'johndoe@example.com',
    'is_logged_in' => true,
    'last_login_time' => '2024-06-15 10:30:00',
    'preferences' => ['theme' => 'dark', 'language' => 'bg'],
    'cart' => ['item1' => 2, 'item2' => 1, 'item3' => 5],
    'subscription_status' => 'active',
    'newsletter_opt_in' => true,
    'profile_complete' => false
];

// Запишете масива в сесията
$_SESSION['user_data'] = $userData;

// Достъп до променливите от сесията
echo 'User ID: ' . $_SESSION['user_data']['user_id'] . '<br>';
echo 'User Name: ' . $_SESSION['user_data']['user_name'] . '<br>';
echo 'User Email: ' . $_SESSION['user_data']['user_email'] . '<br>';
echo 'Is Logged In: ' . ($_SESSION['user_data']['is_logged_in'] ? 'Yes' : 'No') . '<br>';
echo 'Last Login Time: ' . $_SESSION['user_data']['last_login_time'] . '<br>';
echo 'Theme: ' . $_SESSION['user_data']['preferences']['theme'] . '<br>';
echo 'Language: ' . $_SESSION['user_data']['preferences']['language'] . '<br>';
echo 'Cart: ' . print_r($_SESSION['user_data']['cart'], true) . '<br>';
echo 'Subscription Status: ' . $_SESSION['user_data']['subscription_status'] . '<br>';
echo 'Newsletter Opt-In: ' . ($_SESSION['user_data']['newsletter_opt_in'] ? 'Yes' : 'No') . '<br>';
echo 'Profile Complete: ' . ($_SESSION['user_data']['profile_complete'] ? 'Yes' : 'No') . '<br>';
?>
    <script>
        function searchFunction() {
            var searchText = document.getElementById("searchInput").value.toLowerCase();
            // Логика за търсене и пренасочване към резултатите
            // Пример: window.location.href = "search_results.php?query=" + encodeURIComponent(searchText);
        }
    </script>
    </body>
    </html>

