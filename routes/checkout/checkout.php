<?php
include("../../config/constants.php");
require $_SERVER['DOCUMENT_ROOT']."/Moto_Krastev_Rent_&_Tour/vendor/autoload.php";

$stripe_secret_key = "sk_test_51PT1p1G9KhEjrpY9tvEA5bIYzCAxxTBCmZQ9V7WtR6XtEOXXx8TQAemM297G9nwJFnKQVTm4VbuhJHMNsBD3JwKF00TMdgcckG";

\Stripe\Stripe::setApiKey($stripe_secret_key);

if(isset($_POST['submit_pay_tour'])){
    $id_tour = $_POST['id_tour'];
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $second_name = mysqli_real_escape_string($conn, $_POST['second_name']);
    $client_telephone = mysqli_real_escape_string($conn, $_POST['client_telephone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $license = $_POST['license-category'];
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $date_from = $_POST['date_from'];
    $price = $_POST['total_price'];
    $paid = $_POST['paid'];
    $days = $_POST['days'];
    $equipment_pax = $_POST['equipment-pax'];
    $helmet_pax = $_POST['helmet-pax'];
    $single_room = $_POST['single-room'];
    $passenger = $_POST['passenger'];
    $motorcycle_data = $_POST['motorcycle-data'];
    $date_order = date("Y-m-d");

    $subscribe_submit = $_POST['subscribe-submit'];

    $order_tour_data = [
        'id_tour' => $id_tour,
        'first_name' => $first_name,
        'second_name' => $second_name,
        'client_telephone' => $client_telephone,
        'email' => $email,
        'license' => $license,
        'birthday' => $birthday,
        'date_from' => $date_from,
        'price' => $price,
        'paid' => $paid,
        'days' => $days,
        'equipment_pax' => $equipment_pax,
        'helmet_pax' => $helmet_pax,
        'single_room' => $single_room,
        'passenger' => $passenger,
        'motorcycle_data' => $motorcycle_data,
        'date_order' => $date_order,
        'subscribe_submit' => $subscribe_submit
    ];

    if($passenger == 'Yes'){
        $first_name_pax = mysqli_real_escape_string($conn, $_POST['first-name-pax']);
        $second_name_pax = mysqli_real_escape_string($conn, $_POST['second-name-pax']);
        $telephone_pax = mysqli_real_escape_string($conn, $_POST['telephone-pax']);
        $email_pax = mysqli_real_escape_string($conn, $_POST['email-pax']);

        $order_tour_pax_data = [
            'first_name_pax' => $first_name_pax,
            'second_name_pax' => $second_name_pax,
            'telephone_pax' => $telephone_pax,
            'email_pax' => $email_pax
        ];

        $_SESSION['order_tour_pax'] = $order_tour_pax_data;
    }

    $_SESSION['order_tour'] = $order_tour_data;

    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => SITEURL."payment-message.php",
        "cancel_url" => SITEURL."routes.php",
        "locale" => "bg",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "bgn",
                    "unit_amount" => $paid * 100,
                    "product_data" => [
                        "name" => "Мото тур "
                    ]
                ]
            ],
        ]
        
    ]);
}

http_response_code(303);
header("Location: ".$checkout_session->url);