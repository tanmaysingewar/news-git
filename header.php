<!DOCTYPE html>
<?php
include "config.php";
session_start();
if (!isset($_SESSION["username"])){
    header("Location:{$hostname}/admin/");
}
$title=  explode('.',basename($_SERVER['PHP_SELF']));
$title = ucfirst($title[0]);
$ext = "Page";

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title .' '. $ext ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="http://localhost:8080/newsSite/admin/post.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                 <?php
                include "config.php";
                if(isset($_GET['cid'])){
                    $cat_id =$_GET['cid'];
                }
                
                $sql = "SELECT * FROM category WHERE post > 0";
                $reasult = mysqli_query($conn, $sql) or die("Query Failed: category");
                if(mysqli_num_rows($reasult)>0){
                ?>
                <ul class='menu'>
                <?php while($row = mysqli_fetch_assoc($reasult)){?>;
                    <li ><a href='category.php?cid=<?php echo $row['category_id']?>'><?php echo $row['category_name']?></a></li>
                <?php }?>
                </ul>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
