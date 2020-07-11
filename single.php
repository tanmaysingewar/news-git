<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                  <!-- post-container -->
                    <div class="post-container">
                        <div class="post-content single-post">
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
                                <h3><?php echo $row['title'];?></h3>
                                <div class="post-information">
                                    <span>
                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                        <?php echo $row['category_name'];?>
                                    </span>
                                    <span>
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <a href='author.php?aid=<?php echo $row['user_id'];?>'><?php echo $row['username'];?></a>
                                    </span>
                                    <span>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <?php echo $row['post_date'];?>  
                                    </span>
                                </div>
                                <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/>
                                <p class="description">
                                <?php echo $row['description'];?>
                                </p>
                                <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
