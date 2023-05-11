<?php
session_set_cookie_params(null,'/',"localhost",false,true);
session_start();

if(isset($_SESSION['loginin']) && $_SESSION['loginin'] == true){
    header("Location:gerceksayfa.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href ="css/formlar1.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="resimler/icon.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MakeTeam</title>
</head>
<body>
    
    <div class="container">
        
        <div class="row mt-3">
            <div class="form col-sm-7 col-lg-4 bg-white mx-auto mt-5">
                
                <form method="post" class="mt-4">
                    <div class="logo mx-auto">
                        <img src="resimler/icon.png" class="img-fluid">
                    </div>
                    <div class="mb-3 mt-4">
                        <label class="form-label mt-4" for="myEmail" >E-posta Adresiniz</label>
                        <input type="email" class="form-control input" id="myEmail" name="logineposta">
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="myPassword" >Şifreniz</label>
                        <input type="password" class="form-control input" id="myPassword" name="loginpassword">
                        <div class="form-text" id="PassHelper"><strong><a href="" class="quicklinks text-black text-decoration-none">Şifremi Unuttum</a></strong></div>
                    
                    </div>
                    <div class="text-center">
                        <button name="giris"type="submit" class="btn btn-success mb-4">Giriş Yap</button>
                    </div>
                    <?php

$kullanıcıdb = new PDO("sqlite:kullanicilar.sqlite");
$sayaç = 0;
if(isset($_POST["giris"])){
    
    $logineposta = htmlspecialchars($_POST["logineposta"]);
    $loginpassword = htmlspecialchars($_POST["loginpassword"]);
    $uyeler = $kullanıcıdb->query("SELECT * FROM users");
    $alldb = $uyeler->fetchAll(PDO::FETCH_ASSOC);
    foreach($alldb as $row => $girisler){
        $dbmails = $girisler["email"];
        $dbpasswords = $girisler["password"];
        
        if($dbmails == $logineposta & $dbpasswords == $loginpassword){
            $sayaç = 1;
            $dbusername = $girisler["username"];
            
        }
        
        
    }
    if($sayaç ==1){
        echo '<div class="alert alert-success" role="alert">Başarılı Giriş.Yönlendiriliyorsunuz...</div>';
        session_regenerate_id(true);
        $_SESSION["giris"] = $dbusername;
        $_SESSION["loginin"] = true;
        header("Refresh: 2; url=gerceksayfa.php");
        
    }
    else{
        echo "<div class='alert alert-danger' role='alert'>Böyle Bir Kullanıcı Bulunmamaktadır</div>";
        session_destroy();
        
        
    }
}






?>
                    
                </form>
                <div class="text-center">
                <p class="">MakeTeam hesabın yok mu? <strong><a href="kaydol.php" class="quicklinks text-black text-decoration-none">Kaydol</a></strong></p>
                </div>
            </div>
        </div>
    </div>

    
</body>

</html>