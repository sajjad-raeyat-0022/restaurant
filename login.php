<?php 
include "database.php"; 
function redirect($url)
{
    if (!headers_sent()){
        header("Location: $url");
    }else{
        echo "<script type='text/javascript'>window.location.href='$url'</script>";
        echo "<noscript><meta http-equiv='refresh' content='0;url=$url'/></noscript>";
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />

    <link rel="stylesheet" href="./css/style2.css" />

    <title> ورود </title>
</head>

<body>


    <section id="coming1">

        <div class="container-fluid p-0">

            <div class="row no-gutters">

                <div class="col-lg-0 text-center text-white align-self-center py-5">

                </div>
                <div class="col-lg-4 p-4 text-center bg-bluedark text-white" style="height: 100vh;">

                    <a href="#" class="logo"> <img src="./img/MainLogo.png" alt="fine dining"> </a>

                    <p class="mt-3 text-center"> اطلاعات خود را برای ورود به درستی وارد کنید
                        <hr> (برای سفارش دادن باید حتما در سایت ثبت نام کرده باشید)</p>
         <div class="text-center">
        <?php
        try{
          if(isset($_POST['Login'])){
            if(!empty($_POST['PhoneNumber']) && !empty($_POST['Password'])){
              $PhoneNumber = $_POST['PhoneNumber'];
              $Password = $_POST['Password'];
              $select = "SELECT * FROM Users WHERE PhoneNumber = '$PhoneNumber' AND Password = '$Password'";
              $selectResult= $pdoObj->query($select);
              foreach($selectResult as $Res){
                if($PhoneNumber == $Res['PhoneNumber'] && $Password == $Res['Password']){
                  if($Res['Access'] == 1){
                    $UserID = $Res['ID']; 
					redirect("index.php?UserID=$UserID");
                    exit;
                  }if($Res['Access'] == 2){
                    $UserID = $Res['ID']; 
					redirect("management.php?UserID=$UserID&AddressPage=1");
                    exit;
                  }
                }else{
                  echo "<b> <font color=\"red\">  اطلاعات وارد شده درست نمیباشد</font> </b>";
                }
              }
            }else{
              echo "<b> <font color=\"red\">  لطفا اطلاعات را به درستی وارد کنید</font> </b>";
            }
          }

        }catch(PDOException $e){
          echo "<b> <font color=\"red\">  اطلاعات وارد شده درست نمیباشد</font> </b>";
          }
        ?>
    </div>

                    <form method="post" action="login.php">

                        <div class="form-group">
                            <input type="text" maxlength="11" name="PhoneNumber" class="form-control form-control-lg mt-3" placeholder="شماره تلفن 09123456789" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="Password" class="form-control form-control-lg" placeholder="رمز عبور" />
                        </div>

                        <button type="submit" name="Login" class="btn btn-success btn-lg btn-block"> ورود </button>

                    </form>

                    <br>
                    <a href="register.php" class="mt-3"> ثبت نام کردن </a>
                    <br>
                    <a href="index.php"> صفحه اصلی </a>

                </div>

            </div>

        </div>

    </section>


    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

</body>

</html>