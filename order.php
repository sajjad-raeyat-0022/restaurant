<?php include "database.php"; ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" />
    <link rel="stylesheet" href="./css/style2.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />
    <title> سفارشات </title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark">

<div class="container">

    <div id="my-nav" class="collapse navbar-collapse">

       <a href="#" class="logo navbar-brand"> <img src="./img/MainLogo.png" alt="fine dining"> </a>

    </div>

    
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
                     echo "<a href=\"reserve.php?UserID=$UserID\" class=\"dropdown-item text-right\"><i class=\"fas fa-user-circle\"></i>رزرو میز</a>";
                     echo "<a href=\"index.php?UserID=$UserID\" class=\"dropdown-item text-right\"><i class=\"fas fa-home\"></i> صفحه اصلی </a>";
                     echo "</div>";
                     echo "</li>";
                     echo "</ul>";

                    }else{
                       echo " ";
                    }
                    ?>


</div>

</nav>

<section class="section">
  <div class="container-fluid mt-4">

      <div class="row">

  <?php
  
  if(!empty($_GET['FoodID'])){
    $FoodID = $_GET['FoodID'];
    $select = "SELECT * FROM Food WHERE FoodID = $FoodID";
    $selectResult= $pdoObj->query($select); 
    foreach($selectResult as $Res){
        $FoodName = $Res['Name'];
        $Price = $Res['Price'];
        $ImageURL = $Res['ImageURL'];
        $Category = $Res['Category'];
        switch($Category){
            case 1:{$string_Category = "غذا"; break;}          
            case 2:{$string_Category = "نوشیدنی"; break;}   
            case 3:{$string_Category = "دسر"; break;}   
            case 4:{$string_Category = "فست فود"; break;}   
          }
    }
    try{
        $Date = date("Y-m-d H:m:s");
        $insert = "INSERT INTO Orders
        (Name, Price, ImageURL, Category, UID, FID, OrderDate)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insertStmnt = $pdoObj->prepare($insert);
        $insertStmnt->execute([$FoodName,$Price,$ImageURL,$string_Category,$UserID,$FoodID,$Date]);
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        exit();
        }

    }
    if(!empty($_GET['UserID'])){
    $UserID = $_GET['UserID'];
    $select = "SELECT * FROM Orders 
    WHERE UID = $UserID AND Reception = 0";
    $selectResult= $pdoObj->query($select); 
    $c = $selectResult->rowCount();

  echo "<tbody>";
   foreach($selectResult as $Res){
    $OrderID = $Res['OrderID'];
    echo "<div class=\"col-lg-3 col-sm-6\"> ";
    echo "<div class=\"text-center\">";
    echo "<img class=\"img-thumbnail\" src=\"" .$Res['ImageURL'] ."\" alt=\"Food\" style=\"height: 150px; width: 150px\"/>";
    echo "<h4 class=\"text-primary my-3\">" .$Res['Name'] ."</h4>";
    echo "<p class=\"text-muted\"> تاریخ سفارش : " .$Res['OrderDate'] ."</p>";
    echo "<p class=\"text-muted\"> تومان " .$Res['Price'] ."</p>";
    if(!empty($_GET['UserID'])){
      echo "<div class=\"text-center\">";
      echo "<a href=\"order.php?FID=$OrderID&UserID=$UserID\" class=\"btn btn-outline-danger\"> حذف </a>";
      echo "</div>";
    }
    echo "</div>";
    echo "</div>";
      
   }
   if(!empty($_GET['FID'])){
    $remove = $_GET['FID'];
      $delete = "DELETE FROM Orders
      WHERE OrderID = $remove";
      $results = $pdoObj->query($delete);
  }
   }

echo "</div>";
if($c == 0){
  echo "<br>";
  echo "<div class=\"text-center mb-3 mt-3\">";
  echo "<img src=\"./img/empty_order.png\" alt=\"empty\" style=\"height: 350px; width: 550px\">";
  echo "</div>";
}else{
      echo "<br><div class=\"text-center mb-3 mt-3\">";
      echo "<a href=\"index.php?UserID=$UserID&OrderOK=true\" class=\"btn btn-success\"> پرداخت و ثبت سفارش </a>";
      echo "</div>";
  }


?>
   </div>
  </section>

     
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

</body>
</html>