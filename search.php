<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                      <?php
                include "config.php";
                 if(isset($_GET['search'])){
                    $search_term = $_GET['search'];
                ?>
                    <h2 class="page-heading"><?php echo $search_term ?></h2>
                  <?php
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
                            WHERE post.description LIKE '%{$search_term}%' OR post.title LIKE '%{$search_term}%' OR user.username LIKE '%{$search_term}%'
                            OR category.category_name LIKE '%{$search_term}%'
                            ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";
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
                                $sql1= "SELECT title FROM post
                                LEFT JOIN category ON post.category= category.category_id
                                LEFT JOIN user ON post.author = user.user_id
                                WHERE post.description LIKE '%{$search_term}%' OR post.title LIKE '%{$search_term}%' OR user.username LIKE '%{$search_term}%'";
                                           
                                $reasult1= mysqli_query($conn,$sql1) or die("Query error: last vala debba");    
                                    
                                if (mysqli_num_rows($reasult1)>0) {
                                    $total_records = mysqli_num_rows($reasult1); 
                                    $total_page =   ceil( $total_records/$limit);
                                    echo " <ul class='pagination admin-pagination'>";
                                    if ($page >1) {
                                        echo " <li><a href='search.php?page=".($page - 1 )."&search=".$search_term."'>Pre</a></li>";
                                    }
                                    
                                    for ($i=1; $i <=$total_page ; $i++) { 
                                        if ($i == $page) {
                                            $active = "active";
                                        }else{
                                            $active = "";
                                        }
                                    echo '<li class='.$active.'><a href="search.php?page='.$i.'&search='.$search_term.'">'.$i.'</a></li>';
                                    }
                                    if ($total_page > $page) {
                                        echo " <li><a href='search.php?page=".($page + 1 )."&search=".$search_term."'>Next</a></li>";
                                    }
                                
                                    echo "</ul>";
                                }
                            }
                                ?>
                </div><!-- /post-container --> 
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
