<?php include "database.php"; ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css" integrity="sha256-IvM9nJf/b5l2RoebiFno92E5ONttVyaEEsdemDC6iQA=" crossorigin="anonymous" />

    <link rel="stylesheet" href="./css/style2.css" />
    <title> پنل مدیریت </title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark py-0">

        <div class="container">

            <a href="#" class="logo navbar-brand"> <img src="./img/MainLogo.png" alt="fine dining"> </a>

            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">

                <ul class="navbar-nav">
                    
                    <?php
                    
                     if(!empty($_GET['UserID']) && !empty($_GET['AddressPage'])){
                        $UserID = $_GET['UserID'];
                        $Page = $_GET['AddressPage'];
                        echo "<li class=\"nav-item px-2\">";
                        echo "<a href=\"management.php?UserID=$UserID&AddressPage=1\" class=\"nav-link "; 
                        if($Page == "1"){echo " active";} 
                        echo "\"> داشبورد </a>";
                        echo "</li>";
                        echo "<li class=\"nav-item px-2\">";
                        echo "<a href=\"index.php?UserID=$UserID\" class=\"nav-link\"> صفحه اصلی </a>";
                        echo "</li>";
                        echo "<li class=\"nav-item px-2\">";
                        echo "<a href=\"management.php?UserID=$UserID&AddressPage=2\" class=\"nav-link ";
                        if($Page == "2"){echo " active";} 
                        echo "\"> محصولات </a>";
                        echo "</li>";
                        echo "<li class=\"nav-item px-2\">";
                        echo "<a href=\"management.php?UserID=$UserID&AddressPage=3\" class=\"nav-link ";
                        if($Page == "3"){echo " active";} 
                        echo "\"> کاربران </a>";
                        echo "</li>";
                     }else{
                        echo "<li class=\"nav-item px-2\">";
                        echo "<a href=\"index.php\" class=\"nav-link active\"> داشبورد </a>";
                        echo "</li>";
                        echo "<li class=\"nav-item px-2\">";
                        echo "<a href=\"index.php\" class=\"nav-link\"> صفحه اصلی </a>";
                        echo "</li>";
                     }
                    ?>

                </ul>

                <ul class="navbar-nav mr-auto">

                    <li class="nav-item dropdown mr-3">

                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-user"></i> 
                            <?php
                            if(!empty($_GET['UserID'])){
                             $UserID = $_GET['UserID'];
                             $select = "SELECT Name FROM Users WHERE ID = $UserID";
                             $selectResult= $pdoObj->query($select);
                             foreach($selectResult as $Res){
                               echo $Res['Name'];
                             }
                            }else{
                               echo "ورود غیر مجاز";
                            }
                            ?>
                        </a>

                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item text-right">
                                <i class="fas fa-user-circle"></i> پروفایل
                            </a>
                            <a href="#" class="dropdown-item text-right">
                                <i class="fas fa-cog"></i> تنظیمات
                            </a>
                        </div>

                    </li>

                    <li class="nav-item">
                        <a href="index.php" class="nav-link">
                            <i class="fas fa-user-times"></i> خروج
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </nav>


    <!-- ACTIONS -->
    <section id="actions" class="mb-4 mt-4">
        <div class="container ">
            <div class="row text-center">
                <div class="col-md-4 mt-2">
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addPostModal"> اضافه کردن محصول </a>
                </div>
                <div class="col-md-4 mt-2">
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#addCategoryModal"> حذف محصول </a>
                </div>
                <div class="col-md-4 mt-2">
                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addUserModal"> اضافه کردن کاربر </a>
                </div>
            </div>
<?php
echo "<div class=\"text-success text-center\">";
if (isset($_POST['AddFood'])) {

    if(isset($_FILES['ImageURLFood']) && $_FILES['ImageURLFood']['size']>0){
  
      $validMimeTypes = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/PNG');
      $validFileExt = array('.gif','.jpeg','.jpg','.JPG', '.png','.PNG');
      $file_info = new finfo(FILEINFO_MIME_TYPE);
      $binaryFileStr = file_get_contents($_FILES['ImageURLFood']['tmp_name']);
      $mime_type = $file_info->buffer($binaryFileStr);
      $fileExtIndex = array_search(strtolower($mime_type),$validMimeTypes);
      if($fileExtIndex != false){
      $ext = $validFileExt[$fileExtIndex];
      }else{
      echo "<div class=\"text-danger text-center\">";
      echo "<br> فرمت تصویر وارد شده درست نیست <br>";
      echo "</div>";
      }
  
  echo "ok";
  $NameFood = $_POST['NameFood'];
  $Price = $_POST['PriceFood'];
  $Category = $_POST['CategoryFood'];
  $Date = date("Y-m-d H:m:s");
  
  $ImageDir = "img/";
  $imageName = explode('.',$_FILES['ImageURLFood']['name']);
  $tmpImageUrl = $ImageDir.$imageName[0].$ext;
  $moveOperation = move_uploaded_file($_FILES['ImageURLFood']['tmp_name'], $tmpImageUrl);
  
  if($moveOperation == true){  
    try{
        $insert = "INSERT INTO Food
        (Name, Price, ImageURL, Category, FoodDate)
        VALUES (?, ?, ?, ?, ?)";
        $insertStmnt = $pdoObj->prepare($insert);
        $insertStmnt->execute([$NameFood,$Price,$tmpImageUrl,$Category,$Date]);
  
        $ImageFoodId = $pdoObj->lastInsertId();
        $randomName = bin2hex(random_bytes(10));
        $uniqueFileName = $randomName.$ImageFoodId.$ext;
        $imageUrl = "img/" . $uniqueFileName;
        $renameOp = rename($tmpImageUrl, $imageUrl);
    
        if($renameOp == true){
            $update = "UPDATE Food SET ImageURL = '$imageUrl' WHERE FoodID = $ImageFoodId";
            $pdoObj->query($update);
            echo "<b> غذا به درستی اضافه شد </b>";
            } else{
            echo "<div class=\"text-danger text-center\">";
            echo "<br> تغییر نام فایل به درستی انجام نشده است<br>";
            echo "</div>";
            }
        
  
        } catch(PDOException $e){
        echo "<div class=\"text-danger text-center\">";
        echo "Error: " . $e->getMessage();
        echo "</div>";
        }
    
    
    }else{
    echo "<div class=\"text-danger text-center\">";
    echo "<br>File Submission Error1!<br>";
    echo "</div>";
    }
  
  }else{
    echo "<div class=\"text-danger text-center\">";
    echo "<br>Submission Error2!<br>";
    echo "</div>";
    }
  }
  if(isset($_POST['DelFood'])){
      if(!empty($_POST['FoodID'])){
    $id = $_POST['FoodID'];
  
    $delete = "DELETE FROM Food
    WHERE FoodID = $id;";
    $results = $pdoObj->query($delete);
    if($results == TRUE){
    echo "<b> به درستی حذف شد </b>";
    }else{
    echo "<div class=\"text-danger text-center\">";
    echo "<b> به درستی حذف نشده </b>";
    echo "</div>";
    } 
    }else{
        echo "<div class=\"text-danger text-center\">";
        echo "<b> لطفا آی دی محصول را به درستی وارد کنید </b>";
        echo "</div>";
    }
    }
    try{
        if(isset($_POST['Register'])){
            if(!empty($_POST['Name']) && !empty($_POST['PhoneNumber']) && !empty($_POST['Password']) && !empty($_POST['RePassword'])){
              $Password = $_POST['Password'];
              $REpassword = $_POST['RePassword'];
              if($REpassword == $Password){
                $Name = $_POST['Name'];
                $PhoneNumber = $_POST['PhoneNumber'];
                $Date = date("Y-m-d H:m:s");

                $select = "SELECT * FROM Users WHERE PhoneNumber = $PhoneNumber";
                $selectResult= $pdoObj->query($select);
                $c = $selectResult->rowCount();
                  if($c >0 ){
                    echo "<b> <font color=\"red\">    شماره تلفن وارد شده قبلا ثبت نام شده است  </font> </b>";
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
                      echo "<b> <font color=\"red\">   اطلاعات به درستی ذخیره نشده است </font> </b>";
                    }
                  }
              }else{
                echo "<b> <font color=\"red\">  پسوورد ها با هم برابر نیستند </font></b>";
              }
            }else{
              echo "<b> <font color=\"red\">   لطفا تمامی اطلاعات را به درستی وارد کنید </font> </b>";
            }

          }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            }
  echo "</div>";
?>
        </div>
    </section>

    <!-- POSTS -->
    <section id="posts">

        <div class="container text-center">

            <div class="row">
            <?php
            if(!empty($_GET['AddressPage']) && $_GET['AddressPage'] == "1" && !empty($_GET['UserID'])){
                $UserID = $_GET['UserID'];
                echo "<div class=\"col-md-12\">";
                if(!empty($_GET['OrderRequest']) && $_GET['OrderRequest'] == "ok"){
                    $UID = $_GET['UID'];

                    $update1 = "UPDATE Orders SET Reception = 2 WHERE UID = $UID AND Reception = 1";
                    $results = $pdoObj->query($update1);

                    $update2 = "UPDATE Users SET Request = 0 WHERE ID = $UID";
                    $pdoObj->query($update2);

                    echo "<p><b class=\"text-center text-success\"> سفارشات کاربر به درستی به آشپزخانه ارسال شد </b></p>";
                }
                    echo "<h4> سفارشات </h4>";
                    echo "<table class=\"table table-striped mt-4\">";
                    echo "<thead class=\"bg-bluedark text-white\">";
                    echo "<tr>";
                    echo "<th>#</th>";
                    echo "<th> نام کاربری</th>";
                    echo "<th> شماره تلفن </th>";
                    echo "<th> تاریخ </th>";
                    echo "<th> مشاهده </th>";
                    echo "</tr>";
                        echo "</thead>";
                        $select = "SELECT * FROM Users WHERE Request = 1";
                        $selectResult= $pdoObj->query($select);
                      
                       echo "<tbody>";
                       $i=0;
                       foreach($selectResult as $Res){
                         $i++;
                         echo "<tr>";
                         echo "<td>" .$i ."</td>";
                         echo "<td>" .$Res['Name'] ."</td>";
                         echo "<td>" .$Res['PhoneNumber'] ."</td>";
                         $UID = $Res['ID'];
                         $select2 = "SELECT * FROM Orders WHERE UID = $UID";
                         $selectResult2 = $pdoObj->query($select2);
                         foreach($selectResult2 as $Res2){
                           echo "<td>" .$Res2['OrderDate'] ."</td>";
                         break;
                         }
                           echo "<td><a href=\"management.php?UserID=$UserID&UID=$UID&AddressPage=1\" class=\"btn btn-outline-primary\"> نمایش سفارش <i class=\"fas fa-angle-double-left\"></i></a></td>";                  
                           echo "</tr>";
                       }
                       echo "</tbody>";
                       echo "</table>";
                       echo "</div>";
                       if(!empty($_GET['UID'])){
                           $UID = $_GET['UID'];
                           echo "<div class=\"col-md-12 mt-2\">";

                    echo "<h4> اطلاعات سفارش کاربر </h4>";
                    echo "<table class=\"table table-striped mt-4\">";
                    echo "<thead class=\"bg-bluedark text-white\">";
                    echo "<tr>";
                    echo "<th>#</th>";
                    echo "<th> نام محصول </th>";
                    echo "<th> دسته بندی </th>";
                    echo "<th> قیمت </th>";
                    echo "<th> تاریخ ثبت سفارش </th>";
                    echo "<th> عکس </th>";
                    echo "</tr>";
                        echo "</thead>";
                        $select = "SELECT * FROM Orders WHERE Reception = 1 AND UID = $UID";
                        $selectResult= $pdoObj->query($select);
                      
                       echo "<tbody>";
                       $i=0;
                       foreach($selectResult as $Res){
                         $i++;
                         echo "<tr>";
                         echo "<td>" .$i ."</td>";
                         echo "<td>" .$Res['Name'] ."</td>";
                         echo "<td>" .$Res['Category'] ."</td>";
                         echo "<td>" .$Res['Price'] ."</td>";
                         echo "<td>" .$Res['OrderDate'] ."</td>";
                         echo "<td>" ."<img style=\" width:75px; height: 75px;\" src=\"" .$Res['ImageURL'] ."\"alt=\"image\">" ."</td>";
                           echo "</tr>";
                       }
                       echo "</tbody>";
                       echo "</table>";
                       echo "<a href=\"management.php?UserID=$UserID&UID=$UID&AddressPage=1&OrderRequest=ok\" class=\"btn btn-success mt-2\"> تایید سفارشات و ارسال به آشپزخانه </a>";
                       echo "</div>";
                       }
                }elseif(!empty($_GET['AddressPage']) && $_GET['AddressPage'] == "2" && !empty($_GET['UserID'])){
                    echo "<div class=\"col-md-12\">";

                    echo "<h4> محصولات </h4>";
                    echo "<table class=\"table table-striped mt-4\">";
                    echo "<thead class=\"bg-bluedark text-white\">";
                    echo "<tr>";
                    echo "<th>#</th>";
                    echo "<th> نام </th>";
                    echo "<th> قیمت </th>";
                    echo "<th> دسته بندی </th>";
                    echo "<th> تاریخ </th>";
                    echo "<th> تصویر </th>";
                    echo "</tr>";
                        echo "</thead>";
                        $select = "SELECT * FROM Food";
                        $selectResult= $pdoObj->query($select);
                      
                       echo "<tbody>";
                       foreach($selectResult as $Res){
                        $Category = $Res['Category'];
                        switch($Category){
                            case 1:{$string_Category = "غذا"; break;}          
                            case 2:{$string_Category = "نوشیدنی"; break;}   
                            case 3:{$string_Category = "دسر"; break;}   
                            case 4:{$string_Category = "فست فود"; break;}   
                          }
                         echo "<tr>";
                         echo "<td>" .$Res['FoodID'] ."</td>";
                         echo "<td>" .$Res['Name'] ."</td>";
                         echo "<td>" .$Res['Price'] ."</td>";
                         echo "<td>" .$string_Category ."</td>";
                         echo "<td>" .$Res['FoodDate'] ."</td>";
                         echo "<td>" ."<img style=\" width:75px; height: 75px;\" src=\"" .$Res['ImageURL'] ."\"alt=\"image\">" ."</td>";
                           echo "</tr>";
                       }
                       echo "</tbody>";
                       echo "</table>";
                       echo "</div>";
                }elseif(!empty($_GET['AddressPage']) && $_GET['AddressPage'] == "3" && !empty($_GET['UserID'])){
                    echo "<div class=\"col-md-12\">";

                    echo "<h4> کاربران </h4>";
                    echo "<table class=\"table table-striped mt-4\">";
                    echo "<thead class=\"bg-bluedark text-white\">";
                    echo "<tr>";
                    echo "<th>#</th>";
                    echo "<th> نام و نام خانوادگی </th>";
                    echo "<th> شماره تلفن </th>";
                    echo "<th> تاریخ و زمان ثبت نام </th>";
                    echo "<th> نوع دسترسی </th>";
                    echo "</tr>";
                        echo "</thead>";
                        $select = "SELECT * FROM Users";
                        $selectResult= $pdoObj->query($select);
                      
                       echo "<tbody>";
                       foreach($selectResult as $Res){
                        $Access = $Res['Access'];
                        switch($Access){
                            case 1:{$string_Access = "کاربر عادی"; break;}          
                            case 2:{$string_Access = "مدیریت"; break;}   
                          }
                         echo "<tr>";
                         echo "<td>" .$Res['ID'] ."</td>";
                         echo "<td>" .$Res['Name'] ."</td>";
                         echo "<td>" .$Res['PhoneNumber'] ."</td>";
                         echo "<td>" .$Res['Date'] ."</td>";
                         echo "<td>" .$string_Access ."</td>";
                           echo "</tr>";
                       }
                       echo "</tbody>";
                       echo "</table>";
                       echo "</div>";
                }
				echo "</div></div></div></section>";
                ?>

                


    <!-- FOOTER -->
    <footer id="main-footer" class="bg-bluedark text-white mt-3 p-3">

        <div class="container">

            <div class="row">

                <div class="col">

                    <p class="lead text-center">
                        Fine Dining Restauant Admin Panel
                    </p>

                </div>

            </div>

        </div>

    </footer>


    <!-- ADD POST MODAL -->
    <div class="modal fade" id="addPostModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"> افزودن محصول </h5>
                    <button class="close ml-0" data-dismiss="modal">
            <span>&times;</span>
          </button>
                </div>
                <div class="modal-body">
                <?php
                if(!empty($_GET['UserID'])){
                    $UserID = $_GET['UserID'];
                    echo "<form method=\"post\" action=\"management.php?UserID=$UserID&AddressPage=1\" enctype=\"multipart/form-data\">";
                }else{
                    echo "<form method=\"post\" action=\"management.php\" enctype=\"multipart/form-data\">";
                }
                ?>
                        <div class="form-group">
                            <label for="title"> نام </label>
                            <input type="text" name="NameFood" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="category"> دسته بندی </label>
                            <select class="form-control" name="CategoryFood">
                <option value="1"> غذا </option>
                <option value="2"> نوشیدنی  </option>
                <option value="3"> دسر </option>
                <option value="4"> فست فود </option>
              </select>
                        </div>
                        <div class="form-group">
                            <label for="title"> قیمت </label>
                            <input type="number" name="PriceFood" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="image"> آپلود تصویر </label>
                            <div class="custom-file">
                                <input type="file" name="ImageURLFood" class="custom-file-input" id="image">
                                <label for="image" class="custom-file-label text-left"> انتخاب فایل </label>
                            </div>
                            <small class="form-text text-muted"> فقط فرمت های زیر پذیرفته می شود </small>
                            <small class="form-text text-muted"> jpg,jpeg,gif,png </small>
                        </div>
                        <div class="modal-footer justify-content-start">
                        <button type="submit" class="btn btn-primary"  name="AddFood"> افزودن </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Delete Post MODAL -->
    <div class="modal fade" id="addCategoryModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"> حذف محصول </h5>
                    <button class="close ml-0" data-dismiss="modal">
            <span>&times;</span>
          </button>
                </div>
                <div class="modal-body">
                <?php
                if(!empty($_GET['UserID'])){
                    $UserID = $_GET['UserID'];
                    echo "<form method=\"post\" action=\"management.php?UserID=$UserID&AddressPage=1\">";
                }else{
                    echo "<form method=\"post\" action=\"management.php\">";
                }
                ?>
                        <div class="form-group">
                            <label for="title"> آی دی محصول </label>
                            <input type="text" name="FoodID" class="form-control">
                        </div>
                        <div class="modal-footer justify-content-start">
                          <button type="submit" class="btn btn-danger" name="DelFood"> حذف </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <!-- ADD USER MODAL -->
    <div class="modal fade" id="addUserModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title"> ثبت کاربر جدید</h5>
                    <button class="close ml-0" data-dismiss="modal">
            <span>&times;</span>
          </button>
                </div>
                <div class="modal-body">
                <?php
                if(!empty($_GET['UserID'])){
                    $UserID = $_GET['UserID'];
                    echo "<form method=\"post\" action=\"management.php?UserID=$UserID&AddressPage=1\">";
                }else{
                    echo "<form method=\"post\" action=\"management.php\">";
                }
                ?>
                    
                        <div class="form-group">
                            <label for="name"> نام </label>
                            <input type="text" name="Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phonenumber">09123456789 شماره تلفن </label>
                            <input type="text" maxlength="11" name="PhoneNumber" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password"> پسورد </label>
                            <input type="password" name="Password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password2"> تکرار پسورد </label>
                            <input type="password" name="RePassword" class="form-control">
                        </div>
                        <div class="modal-footer justify-content-start">
                         <button type="submit" class="btn btn-info" name="Register"> ثبت کاربر جدید </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>


    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>

</body>

</html>

</html>