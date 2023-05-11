<?php

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
                        <label class="form-label mt-4" for="myEmail">Ad-Soyad</label>
                        <input type="text" class="form-control input" id="myEmail" name="registername" require>
                    </div>
                    <div class="mb-3 mt-4">
                        <label class="form-label" for="myEmail">Username</label>
                        <input type="text" class="form-control input" id="myEmail" name="registerusername" require>
                        <div class="form-text" id="PassHelper"><strong>İsim özel karakter içeremez</strong></div>
                    </div>
                    <div class="mb-3 mt-4">
                        <label class="form-label" for="myEmail">E-posta Adresiniz</label>
                        <input type="email" class="form-control input" id="myEmail" name="registereposta" require>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="myPassword">Şifreniz</label>
                        <input type="password" class="form-control input" id="myPassword" name="registerpassword" require>
                        <div class="form-text" id="PassHelper"><strong>Şifre en az 10 karakter uzunluğunda olmalıdır</strong></div>
                    
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success mb-4">Kaydol</button>
                    </div>
                    <?php
                        if($_POST){
                            $kullanıcıdb = new PDO("sqlite:kullanicilar.sqlite");
                            $registername = htmlspecialchars($_POST["registername"]);
                            $registerusername = htmlspecialchars($_POST["registerusername"]);
                            $registereposta = htmlspecialchars($_POST["registereposta"]);
                            $registerpassword = htmlspecialchars($_POST["registerpassword"]);
                            $uyeler = $kullanıcıdb->query("SELECT * FROM users");
                            $alldb = $uyeler->fetchAll(PDO::FETCH_ASSOC);
                            $usernamewrong = False;
                            $emailwrong = False;
                            foreach($alldb as $row => $girisler){
                                
                                $dbmails = $girisler["email"];
                                $dbusernames = $girisler["username"];
        
                                if($registerusername == $dbusernames){
                                    $usernamewrong = True;
                                    break;
                                }
                                if($registereposta == $dbmails){
                                    $emailwrong = True;
                                    break;
                                }
                                
        
                            }
                            if($usernamewrong == False & $emailwrong == False){
                                $kullanıcıdb->exec("INSERT INTO users(name,username,email,password) VALUES('$registername','$registerusername','$registereposta','$registerpassword');");
                                echo '<div class="alert alert-success" role="alert">Başarılıyla kaydoldunuz.Giriş Sayfasına Yönlendiriliyorsunuz.</div>';
                                header("Refresh: 2; url=index.php");
                            }
                            if($usernamewrong == True){
                                echo "<div class='alert alert-danger' role='alert'>Böyle bir kullanıcı zaten bulunmaktadır</div>";
                            }
                            if($emailwrong == True){
                                echo "<div class='alert alert-danger' role='alert'>Bu E-posta'ya kayıtlı bir hesap zaten mevcut</div>";
                            }

                            
    
                           
    }
    
?>
                </form>
                <div class="text-center">
                <p class="">MakeTeam Hesabın var mı? <strong><a href="index.php" class="quicklinks text-black text-decoration-none">Giriş Yap</a></strong></p>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>

