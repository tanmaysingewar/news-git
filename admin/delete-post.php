<?php
    include "config.php";

    $post_id = $_GET['id'];
    $cat_id= $_GET['catid'];

    $sql = "DELETE FROM post WHERE post_id= {$post_id};";
    $sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$cat_id}";
    
    if (mysqli_multi_query($conn,$sql)) {
        header("location: {$hostname}/admin/post.php");
    }else{
        echo "<div class='alert alert-danger'>Query Failed1</div>";
    }
?>