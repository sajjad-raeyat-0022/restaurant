<?php include "database.php"; ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />

    <link rel="stylesheet" href="./css/style2.css" />

    <title> ثبت نام </title>
</head>

<body>



    <section id="coming2">

        <div class="container-fluid p-0 ">

            <div class="row no-gutters">

                <div class="col-lg-8 text-center text-white align-self-center py-4 ">

                </div>

                <div class="col-lg-4 bg-bluedark text-white p-4 text-center" style="height: 100vh;">

                    <a href="#" class="logo"> <img src="./img/MainLogo.png" alt="fine dining"> </a>

                    <p class="mt-3 text-center"> اطلاعات خود را به درستی برای ثبت نام وارد کنید </p>
                    <hr>
                    <?php
                    try{
                    if(isset($_POST['Register'])){
                        if(!empty($_POST['Name']) && !empty($_POST['PhoneNumber']) && !empty($_POST['Password']) && !empty($_POST['RePassword'])){
                          $Password = $_POST['Password'];
                          $REpassword = $_POST['RePassword'];
                          if($REpassword == $Password){
                            $Name = $_POST['Name'];
                            $PhoneNumber = $_POST['PhoneNumber'];
                            $Date = date("Y-m-d H:m:s");

                            $select = "SELECT * FROM Users WHERE PhoneNumber = '$PhoneNumber'";
                            $selectResult= $pdoObj->query($select);
                            $c = $selectResult->rowCount();
                              if($c >0 ){
                                echo "<b> <font color=\"red\">   شماره تلفن وارد شده قبلا ثبت نام شده است </font> </b>";
                                echo "<a href=\"register.php\"> تلاش مجدد </a>";
                              exit;
                              }else{
                                $Access = 1;
                                $insert = "INSERT INTO Users
                                (Name, PhoneNumber, Password, Access, Date)
                                VALUES (?, ?, ?, ?, ?)";
                                $insertStmnt = $pdoObj->prepare($insert);
                                $insertStmnt->execute([$Name,$PhoneNumber,$Password,$Access,$Date]);
                                if($insertStmnt == true){
                                  echo "<b><font color=\"green\"> اطلاعات به درستی ذخیره شده </font></b>";
                                }else{
                                  echo "<b> <font color=\"red\"> اطلاعات به درستی ذخیره نشده است</font> </b>";
                                  echo "<a href=\"register.php\"> تلاش مجدد </a>";
                                exit;
                                }
                              }
                          }else{
                            echo "<b> <font color=\"red\"> پسوورد ها با هم برابر نیستند</font></b>";
                          }
                        }else{
                          echo "<b> <font color=\"red\">  لطفا تمامی اطلاعات را به درستی وارد کنید</font> </b>";
                        }
            
                      }
                    }catch(PDOException $e){
                        echo "Error: " . $e->getMessage();
                        echo "<a href=\"register.php\"> تلاش مجدد </a>";
                        exit();
                        }
                    ?>
                    <form method="post" action="register.php">

                        <div class="form-group">
                            <input type="name" name="Name" class="form-control form-control-lg" placeholder="نام و نام خانوادگی" />
                        </div>

                        <div class="form-group">
                            <input type="text" maxlength="11" name="PhoneNumber" class="form-control form-control-lg my-3" placeholder="شماره تلفن 09123456789" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="Password" class="form-control form-control-lg" placeholder="رمز عبور" />
                        </div>

                        <div class="form-group">
                            <input type="password" name="RePassword" class="form-control form-control-lg my-3" placeholder="تکرار رمز عبور" />
                        </div>

                        <button type="submit" name="Register" class="btn btn-success btn-lg btn-block"> ثبت نام </button>

                    </form>
                    <br>
                    <a href="login.php"> صفحه ورود </a>
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