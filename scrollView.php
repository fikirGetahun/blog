<?php

ob_start();
session_start();
$s = $_SESSION['scroll'];
                    require_once "php/fetchApi.php";
                    require_once "php/adminCrude.php";
                    $output = $get->allPostListerOnTableRan('blogPost');
                    


                    while($row = $output->fetch_assoc()){
                        $time = $get->time_elapsed_string($row['postedDate']);
                        $c = date_create($row['postedDate']);
                        $PD = date_format($c, "Y/m/d");
                        $ph = $get->allPostListerOnColumen('user', 'id', $row['posterId'] );
                        $user = $ph->fetch_assoc();

                        if(!in_array($row['id'], $s)){

                        ?>
            <div class="post col-xl-6">
                <div class="post-thumbnail"><a href="blogDescription.php?blog=<?php echo $row['id'] ?>"><img src="<?php $p = $admin->photoSplit($row['photoPath1']); echo $p[0] ;?>" alt="..." class="img-fluid"></a></div>
                <div class="post-details">
                  <div class="post-meta d-flex justify-content-between">
                    <div class="date meta-last"><?php echo $PD ?></div>
                    <!-- <div class="category"><a href="#">Business</a></div> -->
                  </div><a href="post.html">
                    <h3 class="h4"><?php echo $row['title'] ?></h3></a>
                  <!-- <p class="text-muted"><?php echo $row['content'] ?></p> -->
                  <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                      <div class="avatar"><img src="<?php echo $user['photoPath1'] ?>" alt="..." class="img-fluid"></div>
                      <div class="title"><span><?php echo $user['firstName'].' '.$user['lastName'] ?></span></div></a>
                    <div class="date"><i class="icon-clock"></i><?php echo $time ?></div>
                  </footer>
                </div>
            </div>
                        
                        <?php

                    }
                    array_push($s, $row['id']);
                }
                ?>