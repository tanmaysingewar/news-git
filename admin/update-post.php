 <?php include "header.php";
include "config.php";
if (!isset($_SESSION["username"])){
    header("Location:{$hostname}/admin/");
} ?> 
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
    <?php
    include "config.php";

    $post_id = $_GET['id'];

    $sql = "SELECT * FROM post 
    INNER JOIN category ON post.category= category.category_id
    INNER JOIN user ON post.author = user.user_id
    WHERE post.post_id = {$post_id}";

    $reasult = mysqli_query($conn, $sql) or die("Query Failed1");
    if(mysqli_num_rows($reasult)>0){
    while($row = mysqli_fetch_assoc($reasult)){
    ?>
        <!-- Form for show edit-->
        <form action="saveupdate.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id']?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title']?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                <?php echo $row['description']?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                <option disabled > Select Category</option>
                              <?php
                              
                               $sql1 ="SELECT * FROM category";
 
                             $reasult1 = mysqli_query($conn,$sql1) or die("Query Failed");
                             
                               if(mysqli_num_rows($reasult1)>0){
                             
                                   while ($row1 = mysqli_fetch_assoc($reasult1)) {
                                       if($row['category']==$row1['category_id']){
                                           $selected ="selected";
                                       }else{
                                           $selected= "";
                                       }

                                       echo "<option {$selected} value='{$row1['category_id']}'>{$row1['category_name']}</option>";
                                   }
                               }
                              ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $row['post_img'];?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $row['post_img']?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
        <?php
    }
}else{
    echo "Reasult not found";
}
        ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
