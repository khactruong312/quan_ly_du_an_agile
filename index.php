<?php
session_start();

if (!isset($_SESSION['carts']))
    $_SESSION['carts'] = [];

include './global.php';
include './model/pdo.php';
// include './model/billboards.php';
// include './model/categories.php';
// include './model/products.php';
// include './model/variants.php';
// include './model/shipping-types.php';
// include './model/orders.php';
// include './model/brands.php';
include './model/users.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý dự án</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.0.7/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/@tailwindcss/forms@0.2.1/dist/forms.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/index.css">
</head>

<body class="overflow-x-hidden scrollbar-hide">
    <div class="app ">
        <div class="w-screen">
            <?php
            // include './view/header.php';
            ?>
            <main class="mt-[90px]">
                <?php
                if (isset($_GET['act'])) {
                    $act = $_GET['act'];
                    switch ($act) {
                        case 'login':
                            if (isset($_POST['login'])) {
                                $error = array();
                                $email = $_POST['email'];
                                $password = $_POST['password'];
                                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $error['email'] = 'Invalid email address';
                                }
                                if (strlen($password) < 6) {
                                    $error['password'] = 'Password must be at least 6 characters long';
                                }
                                if (strlen($password) < 1) {
                                    $error['password'] = ' You must Enter Password';
                                }
                                $user = checklogin_client($email, $password);

                                if (is_array($user)) {
                                    $_SESSION['user'] = $user;
                                    header('location: index.php');
                                } else {
                                    $login_error = "Email or password invalid!";
                                }
                            }
                            include('./view/auth/login.php');
                            break;
                        case 'sign-up':
                            if (isset($_POST['sign-up'])) {
                                $error = array();
                                $name = $_POST['name'];
                                $email = $_POST['email'];
                                $password = $_POST['password'];

                                if (empty($name)) {
                                    $error['name'] = 'This field is required!';
                                }

                                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $error['email'] = 'Invalid email address';
                                }

                                $user = checksignup_client($email);
                                if (is_array($user)) {
                                    $error['email'] = 'Email already exists';
                                    $registerError = 'Email already exists';
                                }
                                if (strlen($password) < 6) {
                                    $error['password'] = 'Password must be at least 6 characters long';
                                }

                                if (empty($error)) {
                                    // insert into database
                                    insert_user($name, $email, $password);
                                    header('location: index.php?act=login');
                                }
                            }
                            include('./view/auth/sign-up.php');
                            break;
                        case 'sign-out':
                            unset($_SESSION['user']);
                            header('location: index.php?act=login');
                            break;

                        case 'forget-password':
                            if (isset($_POST['sendMail'])) {
                                $error = array();
                                $email_sent = true;
                                $email = $_POST['email'];
                                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    $error['email'] = "Email is invalid";
                                } else {
                                    $error['email'] = "Pass was sent to your mail";
                                }

                                $sendMailMess = sendMail($email);
                            }
                            include('view/auth/fgpass.php');
                            break;
                        
                    }
                } 
                ?>
            </main>
        </div>
        <!-- <?php
        include './view/footer.php';
        ?> -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <script src="./assets/js/index.js"></script>
    <script src="./assets/js/shopping-modal.js"></script>
</body>

</html>