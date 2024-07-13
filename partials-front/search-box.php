    <!-- Start Search section-->
     <head>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     </head>
    <section class="search-box text-center">
        
            <div class="bg-search-box"></div>
        
            <form class="search-form" action="<?php echo SITEURL; ?>search.php" method="POST">
                <div>
                    <input type="text" name="search" placeholder="Потърси мотоциклети или дестинации">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </div>

                <div class="wrapper-radio">
                <input type="radio" name="select" id="option-1" value="motorcycle" required>
                <input type="radio" name="select" id="option-2" value="routes" required>
                    <label for="option-1" class="option option-1">
                        <div class="dot"></div>
                        <span><i>Мотоциклети</i></span>
                    </label>
                    
                    <label for="option-2" class="option option-2">
                        <div class="dot"></div>
                        <span><i>Дестинации</i></span>
                    </label>
                </div>
            </form>
    </section>
    <!-- End Search section-->