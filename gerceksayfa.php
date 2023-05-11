<?php
session_set_cookie_params(null,'/',"localhost",false,true);
session_start();

if($_SESSION['loginin'] == false){
    header("Location:index.php");
}
$username = $_SESSION["giris"];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>MakeTeam</title>
    <link rel="icon" type="image/x-icon" href="resimler/icon.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>


    <div class="container-fluid p-2 border border-end bg-light">
        <div class="row">
            <div class="col-4 text-center">
            <i class="fa-brands fa-square-instagram pt-3 ms-3"></i>
            <i class="fa-brands fa-discord pt-3"></i>
            <i class="fa-brands fa-facebook pt-3"></i>
            </div>
            <div class="col-4">
                <a href="gerceksayfa.php" class="text-decoration-none"><p class="text-primary text-center fs-5 pt-2">Make Team</p></a>
            </div>
            <div class="col-4">
                <a href="kullanici.php" class="text-decoration-none"><p class="text-center"style="margin-top:0.7rem;"><?php echo"$username";?></p></a>
            </div>
        </div>
    </div>
    


</body>
</html>