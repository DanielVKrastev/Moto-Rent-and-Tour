<?php
include("../../config/constants.php");
require $_SERVER['DOCUMENT_ROOT']."/Moto_Krastev_Rent_&_Tour/vendor/autoload.php";

$stripe_secret_key = "sk_test_51PT1p1G9KhEjrpY9tvEA5bIYzCAxxTBCmZQ9V7WtR6XtEOXXx8TQAemM297G9nwJFnKQVTm4VbuhJHMNsBD3JwKF00TMdgcckG";

\Stripe\Stripe::setApiKey($stripe_secret_key);

if(isset($_POST['submit_pay_rent_moto'])){
    $id_motorcycle = $_POST['id_motorcycle'];
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $second_name = mysqli_real_escape_string($conn, $_POST['second_name']);
    $client_telephone = mysqli_real_escape_string($conn, $_POST['client_telephone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $category = $_POST['license_category'];
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $price = $_POST['total_price'];
    $paid = $_POST['paid'];
    $afterpay = $_POST['afterpay'];
    $days = $_POST['days'];
    $equipment_option = $_POST['equipment'];
    $helmet_option = $_POST['helmet'];
    $tank_option = $_POST['tank'];
    $date_from = $_POST['date_from'];
    $date_to = $_POST['date_to'];
    $delivery = $_POST['delivery'];
    $bring_back = $_POST['bring_back'];
    $date_order = date("Y-m-d");

    $subscribe_submit = $_POST['subscribe-submit'];

    $order_rent_moto_data = [
        'id_motorcycle' => $id_motorcycle,
        'first_name' => $first_name,
        'second_name' => $second_name,
        'client_telephone' => $client_telephone,
        'email' => $email,
        'category' => $category,
        'birthday' => $birthday,
        'price' => $price,
        'paid' => $paid,
        'afterpay' => $afterpay,
        'days' => $days,
        'equipment_option' => $equipment_option,
        'helmet_option' => $helmet_option,
        'tank_option' => $tank_option,
        'date_from' => $date_from,
        'date_to' => $date_to,
        'delivery' => $delivery,
        'bring_back' => $bring_back,
        'date_order' => $date_order,
        'subscribe_submit' => $subscribe_submit
    ];

    $_SESSION['order_rent_moto'] = $order_rent_moto_data;

    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => SITEURL."payment-message.php",
        "cancel_url" => SITEURL."rent.php",
        "locale" => "bg",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "bgn",
                    "unit_amount" => $paid * 100,
                    "product_data" => [
                        "name" => "Наем на мотоциклет"
                    ]
                ]
            ],
        ]
        
    ]);
}

http_response_code(303);
header("Location: ".$checkout_session->url);