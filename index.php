<?php include "database.php"; ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" />
    <link rel="stylesheet" href="./css/style2.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />
    <title> رستوران غذا خوری خوب </title>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark">

        <div class="container">

            <div id="my-nav" class="collapse navbar-collapse">

                <ul class="navbar-nav ">

                    <li class="nav-item active ml-3">
                        <a class="nav-link" href="index.php"> خانه </a>
                    </li>

                    <li class="nav-item ml-3">
                        <a class="nav-link" href="#about"> درباره ما </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php"> ورود و ثبت نام </a>
                    </li>


                </ul>

            </div>

            <a href="#" class="logo navbar-brand"> <img src="./img/MainLogo.png" alt="fine dining"> </a>

            
                        <?php
                        
                            if(!empty($_GET['UserID'])){
                             $UserID = $_GET['UserID'];
                             $select = "SELECT Name FROM Users WHERE ID = $UserID";
                             $selectResult= $pdoObj->query($select);

                             echo "<ul class=\"navbar-nav mr-auto\">";
                             echo "<li class=\"nav-item dropdown mr-3\">";
                             echo "<a href=\"#\" class=\"nav-link dropdown-toggle\" data-toggle=\"dropdown\">";
                             echo "<i class=\"fas fa-user\"></i> ";
                             
                             foreach($selectResult as $Res){
                               echo $Res['Name'];
                             }
                             echo "</a>";
                             echo "<div class=\"dropdown-menu\">";
                             echo "<a href=\"#\" class=\"dropdown-item text-right\"><i class=\"fas fa-user-circle\"></i>رزرو میز</a>";
                             echo "<a href=\"order.php?UserID=$UserID\" class=\"dropdown-item text-right\"><i class=\"fas fa-shopping-cart\"></i> سفارشات </a>";
                             echo "</div>";
                             echo "</li>";
                             echo "</ul>";

                            }else{
                               echo " ";
                            }
                            ?>

        </div>

    </nav>

    <section>

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">

            <div class="carousel-item carousel-image-1 active" style="height: 500px">

                    <div class="carousel-caption d-none d-md-block mb-5">

                        <h5><b class="bg-bgray text-danger p-1"> خوش آمدید </b></h5>
                        <p><b class="bg-bgray text-danger p-1"> به امید رضایت شما در رستوران غذا خوری خوب در کنار خانواده </b></p>
                    </div>

                </div>

                <div class="carousel-item carousel-image-2 " style="height: 500px">

                    <div class="carousel-caption d-none d-md-block mb-5">

                        <h5><b class="bg-bgray text-danger p-1"> سفارش دهی </b></h5>
                        <p><b class="bg-bgray text-danger p-1"> برای سفارش دادن محصول حتما ابتدا باید به سایت ورود کنید </b></p>
                    </div>

                </div>

                <div class="carousel-item carousel-image-3" style="height: 500px">

                    <div class="carousel-caption d-none d-md-block mb-5">

                        <h5><b class="bg-bgray text-danger p-1"> رزور میز </b></h5>
                        <p><b class="bg-bgray text-danger p-1"> بعد از ورود با اطلاعات کاربری میتوانید میز رزرو کرده و درخواست های خود را نیز در آن باره ثبت کنید </b></p>
                    </div>

                </div>

                

            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>

    </section>
	<div class="mt-2" id="about">
	</div>
    <section class="py-5">

        <div class="container" >

            <div class="row">

                <div class="col-md-6 mb-4 text-center">

                    <i class="fas fa-phone fa-5x mb-3"></i>

                    <h4 class="font-weight-bold"> تماس با ما </h4>

                    <p>
                        شماره تلفن : 09174268751
                    </p>

                </div>

                <div class="col-md-6 mb-4 text-center">
                    <i class="fas fa-map-marker-alt fa-5x mb-3"></i>
                    <h4 class="font-weight-bold"> آدرس ما </h4>
                    <p>
					مرودشت - خیابان انقلاب - رستوران غذاخوری خوب
                    </p>
                </div>


            </div>

        </div>

    </section>

    <section>
        <div class="container" id="Menu">
            <!-- title -->
            <div class="row my-5">
                <div class="col text-center">
                    <?php
                    if(!empty($_GET['OrderOK']) && $_GET['OrderOK'] == "true"){
                        $OrderOK = $_GET['OrderOK'];
                        $update = "UPDATE Orders
                        SET Reception = 1
                        WHERE UID = $UserID AND Reception = 0";
                        $results = $pdoObj->query($update);
                        $update2 = "UPDATE Users
                        SET Request = 1
                        WHERE ID = $UserID ";
                        $results2 = $pdoObj->query($update2);
                        echo "<b class=\"text-success\"> سفارشات به درستی ذخیره شدند </b>";
                    }elseif(!empty($_GET['OrderOK']) && $_GET['OrderOK'] != "true"){
                        echo "<b class=\"text-danger\"> سفارشات به درستی ذخیره نشده است </b>";
                    }
                    ?>
                    <h1 class="text-primary"> منو غذاها </h1>
                </div>
            </div>
            <!-- end Title -->
            <div class="row">
            <?php
            $select = "SELECT * FROM Food
            WHERE Category = 1 OR Category = 4;";
            $selectResult= $pdoObj->query($select);
            $i=0;
            foreach($selectResult as $Res){
            $i++;
            $FoodID = $Res['FoodID'];
                echo "<div class=\"col-lg-3 col-sm-6 ";
                if($i<5){
                    echo " mt-" .$i;
                }else{
                    $i = 0;
                    echo " mt-" .$i;
                }
                echo "\">";
                    echo "<div class=\"text-center\">";
                    echo "<img class=\"img-thumbnail\" src=\"" .$Res['ImageURL'] ."\" alt=\"Food\" style=\"height: 200px; width: 200px\"/>";
                    echo "<h4 class=\"text-primary my-3\">" .$Res['Name'] ."</h4>";
                    echo "<p class=\"text-muted\"> تومان " .$Res['Price'] ."</p>";
                    if(!empty($_GET['UserID'])){
                    echo "<a href=\"order.php?UserID=$UserID&FoodID=$FoodID\" class=\"btn btn-success\"> سفارش </a>";
                    }
                    echo "</div>";
                echo "</div>";
            }
                ?>
            </div>
        </div>
    </section>


    <section>
        <div class="bg-bgray container-fluid p-5 ">

            <h3 class="text-center mb-5"> دسر و نوشیدنی </h3>

            <div class="row text-center">

                <div class="col">

                    <div id="carouselComment" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner">
                        <?php
                        $select = "SELECT * FROM Food
                        WHERE Category = 2 OR Category = 3;";
                        $selectResult= $pdoObj->query($select);
                        $i=0;
                        $c = $selectResult->rowCount();
                        if($c == 0){
                            echo "<div class=\"text-danger\">";
                            echo "<p> در حال حاضر دسر یا نوشیدنی ای وجود ندارد </p>";
                            echo "</div>";
                        }else{
                        foreach($selectResult as $Res){
                        $i++;
                        $FoodID = $Res['FoodID'];
                        echo "<div class=\"carousel-item ";
                        if($i==1){
                            echo "active";
                        }
                        echo "\" style=\"height: 270px\">";
                        echo "<img class=\"img-fluid rounded-circle mb-3\" width=\"100\" src=\"" .$Res['ImageURL'] ."\" alt=\"\">";
                        echo "<blockquote class=\"blockquote\">";
                        echo "<p class=\"mb-0\">" .$Res['Name'] ."</p>";
                        echo "<footer class=\"blockquote-footer\">" .$Res['Price'] ." تومان </footer>";
                        if(!empty($_GET['UserID'])){
                            echo "<a href=\"order.php?UserID=$UserID&FoodID=$FoodID\" class=\"btn btn-success mt-2\"> سفارش </a>";
                            }
                        echo "</blockquote>";
                        echo "</div>";
                        }
                        }
                        ?>

                        </div>

                        <a class="carousel-control-prev" href="#carouselComment" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>

                        <a class="carousel-control-next" href="#carouselComment" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <footer class="text-center text-white bg-foot py-4">

        <div class="container">

            <div class="row">

                <div class="col">
                    <p class="lead mb-0">کلیه حقوق محتوا این سایت متعلق به رستوران غذا خوری خوب میباشد</p>
                </div>

            </div>

        </div>

    </footer>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

</body>

</html>