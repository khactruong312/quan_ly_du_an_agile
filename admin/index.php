<?php
ob_start();
session_start();
if (!isset($_SESSION['admin'])) {
    header('location: sign-in.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dự án 1</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/@tailwindcss/forms@0.2.1/dist/forms.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="../assets/css/index.css">
</head>

<body class="styled-scrollbar">
    <div class="w-full overflow-x-hidden">
        <div class="w-full flex items-center ">
            <?php include('./sidebar.php') ?>
            <div class="flex-1 min-h-screen h-full lg:ml-[260px] ml-[80px] p-5">
                <?php
                if (isset($_GET['act'])) {
                    $act = $_GET['act'];
                    switch ($act) {
                        case 'sign-out':
                            unset($_SESSION['admin']);
                            header('location: sign-in.php');
                            break;
                        
                }
                }
                ?>
            </div>
        </div>
    </div>
    </div>
</body>

</html>