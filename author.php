<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                <?php
                include "config.php";
                
                $cat_id = $_GET['aid'];
                $sql1= "SELECT * FROM post 
                LEFT JOIN category ON post.category= category.category_id
                LEFT JOIN user ON post.author = user.user_id
                WHERE author = {$cat_id}
                ORDER BY post.post_id ";                  
                $reasult1= mysqli_query($conn,$sql1) or die("Query error: pahela dubba");
                $head = mysqli_fetch_assoc($reasult1);
                ?>
                  <h2 class="page-heading"><?php echo $head['username'];?></h2>
                  <?php
                        
                        $cat_id = $_GET['aid'];
                        $limit= 3;
                        if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        }else{
                         $page = 1;
                        }
                            $offset = ($page - 1 )* $limit;
                            $sql = "SELECT * FROM post 
                            LEFT JOIN category ON post.category= category.category_id
                            LEFT JOIN user ON post.author = user.user_id
                            WHERE post.author = {$cat_id}
                            ORDER BY post.post_id DESC 
                            LIMIT {$offset}, {$limit}";
                            $reasult = mysqli_query($conn, $sql) or die("Query Failed: Categery wali");
                            if(mysqli_num_rows($reasult)>0){
                                 while($row = mysqli_fetch_assoc($reasult)){ 
                        ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id'];?>"><img src="admin/upload/<?php echo $row['post_img'];?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id'];?>'><?php echo $row['title'];?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $row['category'];?>'> <?php echo $row['category_name'];?> </a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $row['user_id'];?>'> <?php echo $row['username'];?> </a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date'];?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo substr($row['description'],0,130)."...";?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'];?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                                 }
                                }else{
                                    echo "<h2>NO Record Found.</h2>";
                                }
                       
                                // session_start();
                                     
                                    
                                if (mysqli_num_rows($reasult1)>0) {
                                    $total_records = mysqli_num_rows($reasult1);
                                    $total_page =   ceil( $total_records/$limit);
                                    echo " <ul class='pagination admin-pagination'>";
                                    if ($page >1) {
                                        echo " <li><a href='author.php?page=".($page - 1 )."&aid=".$cat_id."'>Next</a></li>";
                                    }
                                    
                                    for ($i=1; $i <=$total_page ; $i++) { 
                                        if ($i == $page) {
                                            $active = "active";
                                        }else{
                                            $active = "";
                                        }
                                    echo '<li class='.$active.'><a href="author.php?page='.$i.'&aid='.$cat_id.'">'.$i.'</a></li>';
                                    }
                                    if ($total_page > $page) {
                                        echo " <li><a href='author.php?page=".($page + 1 )."&aid=".$cat_id."'>Next</a></li>";
                                    }
                                
                                    echo "</ul>";
                                }
                                ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
