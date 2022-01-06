<?php

require_once "auth.php";
if(isset($_POST['bid'])){
    $bid = $_POST['bid'];
    $del = $auth->postDeleter('blogPost', $bid );

    if($del){
        echo 'Post Deleted';

    }else{
        echo 'Error';
    }
}

?>