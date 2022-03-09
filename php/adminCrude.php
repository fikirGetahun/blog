<?php
    class adminPhp{

        //insert vacancy post
        function addVacancyPost($appStart, $salaryStatus, $salary, $phone, $type, $positionType, $companyName, $positionTitle, $location, $deadLine, $posterId, $positionNum, $info, $sex   ){
            include("connect.php");
            $postStatus = 'ACTIVE';
            $today = date('Y-m-d H:i:s');
            $q = "INSERT INTO `vacancy`(  `appStart`, `salaryStatus`, `salary`, `phone`, `type`, `positionType`, `companyName`, `title`, `sex`, `address`, `deadLine`, `posterId`, `positionNum`, `info`, `postedDate`, `postStatus`) 
            VALUES ( '$appStart', '$salaryStatus', '$salary', '$phone', '$type', '$positionType', '$companyName', '$positionTitle', '$sex', '$location', '$deadLine', '$posterId', '$positionNum', '$info', '$today', '$postStatus' )";

            $ask = $mysql->query($q);
            return $ask;
        }

        //insert tender post
        function addTenderPost($tenderType, $startingDate, $deadLine, $location, $initialCost, $info, $id, $title, $photo ){
            include('connect.php');
            $postStatus = 'ACTIVE';
            $date = date('Y-m-d H:i:s');
            $q = "INSERT INTO `tender`( `title`,`type`, `startingDate`, `deadLine`, `address`, `initialCost`, `info`, `posterId`, `postedDate`, `postStatus`, `photoPath1`)
             VALUES ( '$title' ,'$tenderType', '$startingDate', '$deadLine', '$location', '$initialCost', '$info ', '$id', '$date', '$postStatus', '$photo' )";

             $ask = $mysql->query($q);
             return $ask;
        }

        //edit vacancy post placeholder method
        function editVacancyPost($postId){
            include "connect.php";
            $q = "SELECT * FROM `vacancy` WHERE `id` LIKE '$postId' ";

            $ask = $mysql->query($q);
            return $ask;
        }

        //vacancy post lister
        function vacancyPostLister(){
            include "connect.php";
            $q = "SELECT * FROM `vacancy` ORDER BY RAND() LIMIT 4";
            $ask = $mysql->query($q);
            return $ask;
        }

        //vacancy post counter shower
        function vacancyPostCounter(){
            include "connect.php";
            $q = "SELECT * FROM `vacancy` WHERE 1";
            $ask = $mysql->query($q);

            return $ask;
        }

        //tender post counter shower
        function tenderPostCounter(){
            include "connect.php";
            $q = "SELECT * FROM `tender` WHERE 1";
            $ask = $mysql->query($q);

            return $ask;
        }

        //vacancy edit
        function updateVacancyPost($phone, $jobType, $positionType, $companyName, $jobTitle, $location, $Deadline, $id , $reqNo, $info){
            include "connect.php";
            $date = date('Y-m-d H:i:s');
            $edited = 'YES';
            $q = "UPDATE `vacancy` SET 
          `type`='$jobType',`positionType`='$positionType', `phone` = '$phone',
            `companyName`='$companyName',`title`='$jobTitle',
            `address`='$location',`deadLine`='$Deadline',
            `positionNum`='$reqNo',`info`='$info',`postedDate`= '$date', `edited` = '$edited' WHERE `vacancy`.`id` = '$id'";

            $ask = $mysql->query($q);
            return $ask;
        }

        //tender post editor lister placeholder method
        function tenderEditLister($postId){
            include "connect.php";
            $q = "SELECT * FROM `tender` WHERE `id` LIKE '$postId' ";

            $ask = $mysql->query($q);
            return $ask;
        }

        // TENDER POST DATA EDITOR
        function updateTenderLister($tenderType, $startingDate, $deadLine, $location, $initialCost, $info, $id2, $title  ){
            include "connect.php";
            $date = date('Y-m-d H:i:s');
            $edited = 'YES';
            $q = "UPDATE `tender` SET `type`='$tenderType',
            `startingDate`='$startingDate',`deadLine`='$deadLine',`address`='$location',
            `initialCost`='$initialCost',`info`='$info',`postedDate`='$date', `title`= '$title', `edited` = '$edited' WHERE `tender`.`id` = '$id2' ";

            $ask = $mysql->query($q);
            return $ask;
        }


        //USER ADDER AS 'ADMIN' OR 'EDITOR'
        function userAdder($recover,$firstName, $lastName, $phone, $username, $password, $auth, $photoPath){
            include "connect.php";
            $date = date('Y-m-d');


            $q ="INSERT INTO `user`( `recover`, `username`, `password`, `firstName`, `lastName`, `phone`, `auth`,`photoPath1`,`lastLogedIn`, `registerdDate` )
             VALUES ('$recover', '$username', '$password', '$firstName', '$lastName', '$phone', '$auth', '$photoPath', '$date', '$date' )";

             $ask = $mysql->query($q);
echo $mysql->error;
             return $ask;

        }



        ///update password
        function password($passx, $id){
            include "connect.php";
            $x = $passx;

            $qz = "UPDATE `user` SET `password` = '$x'   WHERE `user`.`id` = '$id'";
    
            $ask = $mysql->query($qz);
            echo $mysql->error;
    
            return $ask;
        }



        //user auth identifier
        function userDataShower($uid){
            include "connect.php";
            $q = "SELECT * FROM `user` WHERE `id` = '$uid'";

            $ask = $mysql->query($q);
            return $ask;
        }

        //user number count
        function userNumber($auth){
            include "connect.php";
            $q = "SELECT * FROM `user` WHERE `auth` = '$auth'";

            $ask = $mysql->query($q);

            return $ask;
        }

        //to upload profile photo of user
        function uploadPhoto($fileName, $tempName){
            include "connect.php";
            //to count the files uloaded so that to attach the filename.numberofphoto
            $q = "SELECT * FROM `user` WHERE 1";
            $ask = $mysql->query($q);
            $num = md5(microtime());
            $location = "./uploads/adminPhoto/";
            $real = "./uploads/adminPhoto/";
            if(move_uploaded_file($tempName, $location.$num.$fileName)){
                // echo $location.$fileName.$num;
                $location = $real.$num.$fileName;
                return $location;
            }else{
                return 'FILE_NOT_UPLOADED';
            }
        }

        //update users data
        function updateUserData($uid, $password, $firstName, $lastName, $phone){
            include "connect.php";
            // $password = password_hash($password, PASSWORD_DEFAULT);
            $q = "UPDATE `user` SET `password`= '$password',`firstName`= '$firstName',
            `lastName`= '$lastName' ,`phone`= '$phone'   WHERE `user`.`id` = '$uid'";

            $ask = $mysql->query($q);
            echo $mysql->error;
            return $ask;
        }

        //update userphoto path and file
        function updateUserPhoto($fileName, $tempName, $uid){
            include "connect.php";
            $location = "../uploads/adminPhoto/";
            $x = rand(2, 20000);
            $path = $location.'a'.$x.$fileName;
            move_uploaded_file($tempName, $path);
            $real = "./uploads/adminPhoto/";
            $location = $real;
            $path = $location.'a'.$x.$fileName;
            
            $q = "UPDATE `user` SET `photoPath1`= '$path' WHERE `user`.`id` = '$uid'";
            $ask = $mysql->query($q);

            return $path;
        }


        // ad post data inserting function
        function adPostPoster($big, $type, $price, $address, $phone, $for, $title, $posterId, $info, $photoPath1, $ship){
            include "connect.php";
            $postStatus = 'ACTIVE';
            $q = "INSERT INTO `ad`(`bigDiscount`, `type`, `price`, `address`, `phone`, `for`,
             `title`, `posterId`, `info`, `photoPath1`, `postStatus`, `shipping`)
             VALUES ('$big','$type', '$price', '$address', '$phone', '$for', '$title', '$posterId', '$info', '$photoPath1', '$postStatus', '$ship')";
            
            $ask = $mysql->query($q);
            return $ask;
        }


        //ad photos uploader
        function adPhotoUploader($fName1, $fName2, $fName3, $tmpName1, $tmpName2, $tmpName3){
            include "connect.php";
            $location = "..../uploads/adPostsPhoto/";
            $random = rand(1000, 100000);
            $path1 = $location.'ad'.$random.$fName1;
            $path2 = $location.'ad'.$random.$fName2;
            $path3 = $location.'ad'.$random.$fName3;

            $path = array(' ', ' ', ' ');

            if($fName1 != '' || $fName2 != '' || $fName3 != ''){

                if(move_uploaded_file($tmpName1, $path1)){
                    $path[0] = $path1;
                }
                    if(move_uploaded_file($tmpName2, $path2)) {
                        $path[1] = $path2;
                    }
                        if(move_uploaded_file($tmpName3, $path3)){
                            $path[2] = $path3;
                            
                        }

            }

            return $path;
 
            
        }

            //ad posts data shower and counter

        function postAdShower(){
            include "connect.php";
            $q = "SELECT * FROM `ad` ORDER BY RAND() LIMIT 9";

            $ask = $mysql->query($q);
            return $ask;
        }


        // ads category adder
        function adsCategoryAdder($data){
            include "connect.php";
            $q = "INSERT INTO `adCategory`( `category` ,`tableName`) VALUES ('$data', 'ad')";

            $ask = $mysql->query($q);
            return $ask;
        } 

        //ads category lister
        function adsCategoryLister(){
            include "connect.php";
            $q = "SELECT * FROM `adCategory` WHERE `tableName` = 'ad' ";

            $ask = $mysql->query($q);

            return $ask;
        }

        //update ads category
        function updateAdCat($cat, $id){
            include "connect.php";
            $q ="UPDATE `adcategory` SET `category` = '$cat' WHERE `adCategory`.`id` = '$id' ";


            $ask = $mysql->query($q);
            return $ask;
            
        }


        //car post data inserter
        function carPostAdder($title, $type, $status, $fuleKind, $posterId, $fixedOrN,
         $photoPath1,$price,$info,$forRentOrSell,$transmission, $bodyStatus, $km, $ob, $forWho, $rentStatus, $whyRent ){
            include "connect.php";
            $postDate = date('Y-m-d H:i:s');
            $postStatus = 'ACTIVE';
            $q ="INSERT INTO `car`( `title`,`type`, `status`, `fuleKind`, `posterId`, `fixidOrN`,
             `photoPath1`,  `price`, `info`, `forRentOrSell`,
              `postStatus`, `postedDate`, `transmission`, `bodyStatus`, `km`, `ownerBroker` ,`forWho`,`rentStatus`,`whyRent`  )
             VALUES ( '$title','$type', '$status', '$fuleKind', '$posterId', '$fixedOrN', '$photoPath1', 
             '$price','$info','$forRentOrSell', '$postStatus', '$postDate',
             '$transmission', '$bodyStatus', '$km', '$ob', '$forWho', '$rentStatus', '$whyRent' )";

            $ask = $mysql->query($q);

            return $ask;
            
        }

        //car photo uploader
        function carPhotoUploader($fName1, $fName2, $fName3, $tmpName1, $tmpName2, $tmpName3){
            include "connect.php";
            $location = "..../uploads/carPostsPhoto/";
            $random = rand(1000, 100000);
            $path1 = $location.'ad'.$random.$fName1;
            $path2 = $location.'ad'.$random.$fName2;
            $path3 = $location.'ad'.$random.$fName3;

            $path = array(' ', ' ', ' ');

            if($fName1 != '' || $fName2 != '' || $fName3 != ''){

                if(move_uploaded_file($tmpName1, $path1)){
                    $path[0] = $path1;
                }
                    if(move_uploaded_file($tmpName2, $path2)) {
                        $path[1] = $path2;
                    }
                        if(move_uploaded_file($tmpName3, $path3)){
                            $path[2] = $path3;
                            
                        }

            }

            return $path;
 
                
        }



        //house or land selles data adder block
        function addHouseOrLandPost($title,$type,$houseOrLand, $city, $subCity, $wereda,
        $forRentOrSell, $area, $bedRoomNo, $bathRoomNo, $price, $fixidOrN, $info, $posterId, $fName1, $ob){
            include "connect.php";
            $postDate = date('Y-m-d H:i:s');
            $postStatus = 'ACTIVE';
            $q = "INSERT INTO `housesell`(`title`,`type`, `houseOrLand`, `city`, `subCity`, `wereda`, `area`,
             `bedRoomNo`, `bathRoomNo`, `cost`, `fixedOrN`, `forRentOrSell`, `info`, `posterId`,
              `photoPath1`, `postedDate`, `postStatus`, `ownerBroker`)
             VALUES ('$title','$type','$houseOrLand', '$city', '$subCity', '$wereda',
         '$area', '$bedRoomNo', '$bathRoomNo', '$price', '$fixidOrN', '$forRentOrSell',
        '$info', '$posterId', '$fName1', '$postDate', '$postStatus', '$ob')";

        $ask = $mysql->query($q);
        return $ask;
        }


        //house and land photo uploader
        function houseOrLandPhotoUploader($fName1, $fName2, $fName3, $tmpName1, $tmpName2, $tmpName3){
            include "connect.php";
            $location = "..../uploads/houseOrLandPhotos/";
            $random = rand(1000, 100000);
            $path1 = $location.'ad'.$random.$fName1;
            $path2 = $location.'ad'.$random.$fName2;
            $path3 = $location.'ad'.$random.$fName3;

            $path = array(' ', ' ', ' ');

            if($fName1 != '' || $fName2 != '' || $fName3 != ''){

                if(move_uploaded_file($tmpName1, $path1)){
                    $path[0] = $path1;
                }
                    if(move_uploaded_file($tmpName2, $path2)) {
                        $path[1] = $path2;
                    }
                        if(move_uploaded_file($tmpName3, $path3)){
                            $path[2] = $path3;
                            
                        }

            }

            return $path;
 
                
        }

        //cars post viewer
        function carPostLister(){
            include "connect.php";
            $q = "SELECT * FROM `car` WHERE 1 ";
            $ask = $mysql->query($q);

            return $ask;
        }

        //house post viewer
        function houseOrLandPostLister(){
            include "connect.php";
            $q = "SELECT * FROM `housesell` ORDER BY RAND() LIMIT 8 ";
            $ask = $mysql->query($q);

            return $ask;
        }

        //ad edit data lister
        function adEditDataLister($pid){
            include "connect.php";
            $q = "SELECT * FROM `ad` WHERE `id` = '$pid' ";

            $ask = $mysql->query($q);
            return $ask;

        }

        //ad update
        function updateAdPost($type, $price, $address, $phone, $for, $title, $info, $postId){
            include "connect.php";
            $edited = 'YES';
            $q = "UPDATE `ad` SET `type` = '$type',`price`= '$price',`address`= '$address' ,
            `phone` = '$phone',`for`= '$for',`title`= '$title', `info`= '$info', `edited` = '$edited' WHERE `ad`.`id` = '$postId' ";

            $ask = $mysql->query($q);
            return $ask;

        }

        //ad photo change
        function adPhotoChange($dbPath, $fName, $tmpName, $pid ){
            include "connect.php";
            $location = "..../uploads/adPostsPhoto/";
            $random = rand(1000, 100000);
            $path = $location.'ad'.$random.$fName;

            if(move_uploaded_file($tmpName, $path)){
                $q = "UPDATE `ad` SET `$dbPath`='$path' WHERE `ad`.`id` = '$pid'";
                $ask = $mysql->query($q);
            }
            

           
        }


        //a single car post data lister
        function carPostDataLister($pid){
            include "connect.php";
            $q = "SELECT * FROM `car` WHERE `id` = '$pid'";
            $ask = $mysql->query($q);

            return $ask;
        }

        //car post data edit/update
        function updateCarPost($title,$type, $status, $fuleKind, $postId,
         $fixidOrN,$price,$info,$forRentOrSell, $transmission, $bodyStatus, $km, $ob){
            include "connect.php";
            $q = "UPDATE `car` SET `title`= '$title',`type`='$type', `status` = '$status',
             `fuleKind`= '$fuleKind',`fixidOrN`= '$fixidOrN' ,`price`= '$price',`info`= '$info',
             `forRentOrSell`= '$forRentOrSell', `transmission` = '$transmission',
             `bodyStatus` = '$bodyStatus', `km` = '$km' , `ownerBroker` = '$ob'  WHERE `car`.`id` = '$postId'";

             $ask = $mysql->query($q);
        }


        //car post photo change
        function carPhotoChange($dbPath, $fName, $tmpName, $pid ){
            include "connect.php";
            $location = "..../uploads/carPostsPhoto/";
            $random = rand(1000, 100000);
            $path = $location.'ad'.$random.$fName;

            if(move_uploaded_file($tmpName, $path)){
                $q = "UPDATE `car` SET `$dbPath`='$path' WHERE `car`.`id` = '$pid'";
                $ask = $mysql->query($q);
            }
            
        }

        //house update block
        function updateHousePost($title, $type, $houseOrLand, $city, $subCity, $wereda,
        $forRentOrSell, $area, $bedRoomNo, $bathRoomNo, $price, $fixidOrN, $info, $postId, $ob ){
            include "connect.php";
            $edited = 'YES';
            $postDate = date('Y-m-d H:i:s');
            $q = "UPDATE `housesell` SET `title`= '$title',`type`= '$type',`houseOrLand`= '$houseOrLand',
            `city`= '$city' ,`subCity`= '$subCity',`wereda`= '$wereda',`area`= '$area',
            `bedRoomNo`= '$bedRoomNo',`bathRoomNo`= '$bathRoomNo',`cost`= '$price',`fixedOrN`= '$fixidOrN',
            `forRentOrSell`= '$forRentOrSell',`info`= '$info',`postedDate`='$postDate', `edited` = '$edited' , `ownerBroker` = '$ob'  WHERE `housesell`.`id` = '$postId'";

            $ask = $mysql->query($q);

        }

        //house photo changer
        function housePhotoChange($dbPath, $fName, $tmpName, $pid ){
            include "connect.php";
            $location = "..../uploads/houseOrLandPhotos/";
            $random = rand(1000, 100000);
            $path = $location.'ad'.$random.$fName;

            if(move_uploaded_file($tmpName, $path)){
                $q = "UPDATE `housesell` SET `$dbPath`='$path' WHERE `housesell`.`id` = '$pid'";
                $ask = $mysql->query($q);
            }
            
        }

        //a single house post lister
        function singleHousePostLister($pid){
            include "connect.php";
            $q = "SELECT * FROM `housesell` WHERE `id` = '$pid'";

            $ask = $mysql->query($q);
            return $ask;
        }

        //car catagory inserter
        function carCategoryAdder($cat){
            include "connect.php";
            $q = "INSERT INTO `carcategory`(`category`) VALUES ('$cat')";
            $ask = $mysql->query($q);

        }

        //car catagory list
        function carCategoryLister(){
            include "connect.php";
            $q = "SELECT * FROM `carcategory` WHERE 1";

            
            $ask = $mysql->query($q);
            return $ask;
        }

        //car catagory edit
        function carCategoryEdit($id, $data){
            include "connect.php";
            $q =" UPDATE `carcategory` SET `category`= '$data' WHERE `carcategory`.`id` = '$id'";
            $ask = $mysql->query($q);
        }

                //vacancy catagory inserter
                function vacancyCategoryAdder($cat){
                    include "connect.php";
                    $q = "INSERT INTO `vacancycategory`(`category`) VALUES ('$cat')";
                    $ask = $mysql->query($q);
        
                }

                //vacancy catagory list
                function vacancyCategoryLister(){
                    include "connect.php";
                    $q = "SELECT * FROM `vacancycategory` WHERE 1";
        
                    
                    $ask = $mysql->query($q);
                    return $ask;
                }
        
                //vacancy catagory edit
                function vacancyCategoryEdit($id, $data){
                    include "connect.php";
                    $q =" UPDATE `vacancycategory` SET `category`= '$data' WHERE `vacancycategory`.`id` = '$id'";
                    $ask = $mysql->query($q);
                }

                        //house catagory inserter
        function houseCategoryAdder($cat){
            include "connect.php";
            $q = "INSERT INTO `housecategory`(`category`) VALUES ('$cat')";
            $ask = $mysql->query($q);

        }

                        //house catagory list
        function houseCategoryLister(){
            include "connect.php";
            $q = "SELECT * FROM `housecategory` WHERE 1";

            
            $ask = $mysql->query($q);
            return $ask;
        }

        //house catagory edit
        function houseCategoryEdit($id, $data){
            include "connect.php";
            $q =" UPDATE `housecategory` SET `category`= '$data' WHERE `housecategory`.`id` = '$id'";
            $ask = $mysql->query($q);
        }

        //ad category delete
        function adCategoryDelete($id){
            include "connect.php";
            $q = "DELETE FROM `adcategory` WHERE `id` = '$id'";
            $ask = $mysql->query($q);
        }

        //vacancy category delete
        function vacancyCategoryDelete($id){
            include "connect.php";
            $q = "DELETE FROM `vacancycategory` WHERE `id` = '$id'";
            $ask = $mysql->query($q);
        }

        //car category delete
        function carCategoryDelete($id){
            include "connect.php";
            $q = "DELETE FROM `carcategory` WHERE `id` = '$id'";
            $ask = $mysql->query($q);
        }

        //house category delete
        function houseCategoryDelete($id){
            include "connect.php";
            $q = "DELETE FROM `housecategory` WHERE `id` = '$id'";
            $ask = $mysql->query($q);
        }

        //ad post status changer
        function adPostStatus($pid){
            include "connect.php";
            $q = "UPDATE `ad` SET `postStatus` = 'SOLD'  WHERE `ad`.`id` = '$pid' ";
            $ask = $mysql->query($q);

        }

        //ad post deleter
        function adPostDelete($pid){
            include "connect.php";
            $q = "DELETE FROM `ad` WHERE `id` = '$pid'";
            $ask = $mysql->query($q);
        }

        //car post status changer
        function carPostStatus($pid){
            include "connect.php";
            $q = "UPDATE `car` SET `postStatus` = 'SOLD'  WHERE `car`.`id` = '$pid' ";
            $ask = $mysql->query($q);

        }

        //car post delter
        function carPostDelete($pid){
            include "connect.php";
            $q = "DELETE FROM `car` WHERE `id` = '$pid'";
            $ask = $mysql->query($q);
        }


                //house post status changer
        function housePostStatus($pid){
            include "connect.php";
            $q = "UPDATE `housesell` SET `postStatus` = 'SOLD'  WHERE `housesell`.`id` = '$pid' ";
            $ask = $mysql->query($q);

        }

        //car post delter
        function housePostDelete($pid){
            include "connect.php";
            $q = "DELETE FROM `housesell` WHERE `id` = '$pid'";
            $ask = $mysql->query($q);
        }


        //electronics post data adder
        function elecPostAdder($type, $status, $posterId, $title, $address, $price,
        $info, $photo1, $ram, $processor, $size, $storage, $core){
            include "connect.php";
            $postStatus = "ACTIVE";
            $postDate = date('Y-m-d H:i:s');
            $q = "INSERT INTO `electronics`( `type`, `status`, `postStatus`, `postedDate`, `posterId`, `title`, `address`, `price`, `info`, `photoPath1`, `ram`, `processor`, `size`, `storage`, `core`)
             VALUES ('$type', '$status', '$postStatus', '$postDate', '$posterId', '$title', '$address', '$price',
              '$info', '$photo1', '$ram', '$processor', '$size', '$storage', '$core')";

            $ask = $mysql->query($q);
        }



        //electronics update block
        function updateElectronicsPost($type, $status, $title, $address, $price,
        $info, $ram, $processor, $size, $storage, $core, $pid ){
            include "connect.php";
            $edited = 'YES';
            $q = "UPDATE `electronics` SET `type`= '$type',`status`= '$status',
            `title`= '$title',`address`= '$address',`price`= '$price' ,`info`= '$info' 
            ,`ram`= '$ram' ,`processor`= '$processor' ,`size`= '$size',`storage`= '$storage',
            `core`= '$core',`edited`= '$edited' WHERE `electronics`.`id` = '$pid'";

            $ask = $mysql->query($q);

        }

        //house photo changer
        function electronicsPhotoChange($dbPath, $fName, $tmpName, $pid ){
            include "connect.php";
            $location = "..../uploads/electronicsPhoto/";
            $random = rand(1000, 100000);
            $path = $location.'ad'.$random.$fName;

            if(move_uploaded_file($tmpName, $path)){
                $q = "UPDATE `electronics` SET `$dbPath`='$path' WHERE `electronics`.`id` = '$pid'";
                $ask = $mysql->query($q);
            }
            
        }




        //electronics photo uploader
        function electronicsPhotoUploader($fName1, $fName2, $fName3, $tmpName1, $tmpName2, $tmpName3){
            include "connect.php";
            $location = "..../uploads/electronicsPhoto/";
            $random = rand(1000, 100000);
            $path1 = $location.'elc'.$random.$fName1;
            $path2 = $location.'elc'.$random.$fName2;
            $path3 = $location.'elc'.$random.$fName3;

            $path = array(' ', ' ', ' ');

            if($fName1 != '' || $fName2 != '' || $fName3 != ''){

                if(move_uploaded_file($tmpName1, $path1)){
                    $path[0] = $path1;
                }
                    if(move_uploaded_file($tmpName2, $path2)) {
                        $path[1] = $path2;
                    }
                        if(move_uploaded_file($tmpName3, $path3)){
                            $path[2] = $path3;
                            
                        }

            }

            return $path;
 
                
        }

        //electonics post view lister
        function electronicsViewLister(){
            include "connect.php";
            $q = "SELECT * FROM `electronics` ORDER BY RAND() LIMIT 8";

            $ask = $mysql->query($q);

            return $ask;

        }

        //electronics single post view
        function elecSinglePostViewer($pid){
            include "connect.php";
            $q = "SELECT * FROM `electronics` WHERE `id` = '$pid'";

            $ask = $mysql->query($q);

            return $ask;
        }


        //all category adder
        function allCategoryAdder($cat, $table){
            include "connect.php";
            $q = "INSERT INTO `adcategory`(`category`, `tableName`) VALUES ('$cat','$table')";
            $ask = $mysql->query($q);

            return $ask;  
        }

        //all category lister
        function allCategoryLister($tableName){
            include "connect.php";
            $q = "SELECT * FROM `adcategory` WHERE `tableName` = '$tableName'";

            $ask = $mysql->query($q);

            return $ask;  
        }


        //all category updater
        function allCategoryUpdater($cat, $table, $id){
            include "connect.php";

            $q3 = "SELECT `category` FROM `adcategory` WHERE `id` = '$id'";
            $ask3 = $mysql->query($q3);
            $row = $ask3->fetch_assoc();
            $tobeupdated = $row['category'];

            $q2 ="UPDATE `$tableName` SET `type` =" ;
            $q = "UPDATE `adcategory` SET `category`= '$cat' WHERE  `adCategory`.`id` = '$id' ";

       
            
            $ask = $mysql->query($q);

            return $ask;  
        }


        //users post collecter
        function userPostCollecter($uid){
            include "connect.php";
            $q = "";
        }



        //upload all photos
        function uploadPhotos($tableName, $fileVar ){
            require_once "auth.php";
            //  echo 'idddddddddd'.$fileVar['name'];
            $dbPath = '';
            $allowedType = array('jpeg', 'png', 'jpg');
            $error = array();
            $count = count($fileVar['name']);
            $amount = 3;
            if($tableName == 'blog'){
                $amount = 6;
            }
            if($count <= $amount ){
                for($i=0;$i<=$count-1;$i++){
                    $fileName = explode('.',$fileVar['name'][$i]);
                    $fileExt = $fileName[1];
                    $mimeArr = explode('/', $fileVar['type'][$i]);
                    $mimeType = $mimeArr[0];
                    $mimeExt = $mimeArr[1];
                    $tmpLoc[] = $fileVar['tmp_name'][$i];
                    $fileSize[] = $fileVar['size'][$i];
                    $uploadName = md5(microtime()).'.'.$fileExt;

                    if($tableName == 'blog'){
                        $uploadPath[] = './uploads/blogPhoto/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }
                        $dbPath .= './uploads/blogPhoto/'.$uploadName;
                    }


                    if(!in_array($fileExt, $allowedType)){
                        $error[] = 'File Extention must be png, jpg, jpeg';
                    }

                    if($mimeType != 'image'){
                        $error[] = 'File must be an Image';
                    }

                    if($mimeType != $fileExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')){
                        $error[] = 'File extention does not match file';
                    }

                    if($fileSize[$i] > 150000000){
                        $error[] = 'File size exided the limited size.';
                    }
                }
                $total = array();

                if(!empty($error)){
                    $error[4] = 'error';
                    return $error;
                }else{
                    for($i=0;$i<=$count-1;$i++){
                        $up = $auth->compress($tmpLoc[$i], $uploadPath[$i], 75 );
                    }
                    $total[0] = $dbPath;
                    $total[4] = 'work';
                    return $total;
                
            }

            }else{
                echo 'You can only post '.$amount.' images';
            }

        }

        //upload single photos
        function uploadSinglePhoto($tableName, $fileVar ){
            require_once "auth.php";
            //  echo 'idddddddddd'.$fileVar['name'];
            $dbPath = '';
            $allowedType = array('jpeg', 'png', 'jpg');
            $error = array();
                    $fileName = explode('.',$fileVar['name']);
                    $fileExt = pathinfo($fileVar['name'], PATHINFO_EXTENSION);
                    
                    $mimeArr = explode('/', $fileVar['type']);
                    $tmpLoc = $fileVar['tmp_name'];
                    $fileSize = $fileVar['size'];
                    $uploadName = md5(microtime()).'.'.$fileExt;

                    if($tableName == 'ad'){
                        $uploadPath = '../uploads/adPostsPhoto/'.$uploadName;
                        $dbPath .= './uploads/adPostsPhoto/'.$uploadName;
                    }
                    
                    if($tableName == 'electronics'){
                        $uploadPath = '../uploads/electronicsPhoto/'.$uploadName;
                        $dbPath .= './uploads/vacancyPhoto/'.$uploadName;
                    }
                    

                    if($tableName == 'car'){
                        $uploadPath = '../uploads/CarPostsPhoto/'.$uploadName;

                        $dbPath .= './uploads/CarPostsPhoto/'.$uploadName;
                    }

                    if($tableName == 'housesell'){
                        $uploadPath = '../uploads/houseOrLandPhotos/'.$uploadName;

                        $dbPath .= './uploads/houseOrLandPhotos/'.$uploadName;
                    }

                    if($tableName == 'tender'){
                        $uploadPath = '../uploads/tenderPhotos/'.$uploadName;

                        $dbPath .= './uploads/tenderPhotos/'.$uploadName;
                    }

                    if($tableName == 'charity'){
                        $uploadPath= '../uploads/charityPhoto/'.$uploadName;

                        $dbPath .= './uploads/charityPhoto/'.$uploadName;
                    }

                    if($tableName == 'hotelHouse'){
                        $uploadPath= '../uploads/homeWorker/'.$uploadName;

                        $dbPath .= './uploads/homeWorker/'.$uploadName;
                    }

                    
                    if($tableName == 'jobhometutor'){
                        $uploadPath= '../uploads/homeTutor/'.$uploadName;

                        $dbPath .= './uploads/homeTutor/'.$uploadName;
                    }

                    if($tableName == 'zebegna'){
                        $uploadPath= '../uploads/zebegnaPhoto/'.$uploadName;

                        $dbPath .= './uploads/zebegnaPhoto/'.$uploadName;
                    }




                    if(!in_array($fileExt, $allowedType)){
                        $error[] = 'File Extention must be png, jpg, jpeg';
                    }




                    if($fileSize > 15000000){
                        $error[] = 'File size exided the limited size.';
                    }
                
                $total = array();

                if(!empty($error)){
                    $error[4] = 'error';
                    return $error;
                }else{
                        $up = $auth->compress($tmpLoc, $uploadPath, 75 );
                    
                    $total[0] = $dbPath;
                    $total[4] = 'work';
                    return $total;
                
            }

    

        }
    

        //photo updater
        function photoUpdater($tableName, $pid, $fileVar){
            require_once "auth.php";
            include "connect.php";
            //  echo 'idddddddddd'.$fileVar['name'];
            $dbPath = '';
            $allowedType = array('jpeg', 'png', 'jpg');
            $error = array();
            $count = count($fileVar['name']);
            $amount = $count;
            if($tableName == 'blog'){
                $amount = 6;
            }
            if($count <= $amount ){
                for($i=0;$i<=$count-1;$i++){
                    $fileName = explode('.',$fileVar['name'][$i]);
                    $fileExt = $fileName[1];
                    $mimeArr = explode('/', $fileVar['type'][$i]);
                    $mimeType = $mimeArr[0];
                    $mimeExt = $mimeArr[1];
                    $tmpLoc[] = $fileVar['tmp_name'][$i];
                    $fileSize[] = $fileVar['size'][$i];
                    $uploadName = md5(microtime()).'.'.$fileExt;
                    if($tableName == 'ad'){
                        $uploadPath[] = '../uploads/adPostsPhoto/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }
                        $dbPath .= './uploads/adPostsPhoto/'.$uploadName;
                    }
                    
                    if($tableName == 'electronics'){
                        $uploadPath[] = '../uploads/electronicsPhoto/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }
                        $dbPath .= './uploads/vacancyPhoto/'.$uploadName;
                    }

                    if($tableName == 'car'){
                        $uploadPath[] = '../uploads/CarPostsPhoto/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }
                        $dbPath .= './uploads/CarPostsPhoto/'.$uploadName;
                    }

                    if($tableName == 'housesell'){
                        $uploadPath[] = '../uploads/houseOrLandPhotos/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }
                        $dbPath .= './uploads/houseOrLandPhotos/'.$uploadName;
                    }

                    if($tableName == 'tender'){
                        $uploadPath[] = '../uploads/tenderPhotos/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }
                        $dbPath .= './uploads/tenderPhotos/'.$uploadName;
                    }

                    if($tableName == 'charity'){
                        $uploadPath[] = '../uploads/charityPhoto/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }
                        $dbPath .= './uploads/charityPhoto/'.$uploadName;
                    }

                    if($tableName == 'jobhometutor'){
                        $uploadPath[]= '../uploads/homeTutor/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }

                        $dbPath .= './uploads/homeTutor/'.$uploadName;
                    }

                    if($tableName == 'hotelhouse'){
                        $uploadPath[]= '../uploads/homeWorker/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }

                        $dbPath .= './uploads/homeWorker/'.$uploadName;
                    }

                    if($tableName == 'zebegna'){
                        $uploadPath[]= '../uploads/zebegnaPhoto/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }

                        $dbPath .= './uploads/zebegnaPhoto/'.$uploadName;
                    }

                    
                    if($tableName == 'blog'){
                        $uploadPath[]= '../uploads/blogPhoto/'.$uploadName;
                        if($i != 0){
                            $dbPath .= ',';
                        }

                        $dbPath .= './uploads/blogPhoto/'.$uploadName;
                    }

                    

                    if(!in_array($fileExt, $allowedType)){
                        $error[] = 'File Extention must be png, jpg, jpeg';
                    }

                    if($mimeType != 'image'){
                        $error[] = 'File must be an Image';
                    }

                    if($mimeType != $fileExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')){
                        $error[] = 'File extention does not match file';
                    }

                    if($fileSize[$i] > 150000000){
                        $error[] = 'File size exided the limited size.';
                    }
                }
                $total = array();

                if(!empty($error)){
                    $total[0]= $error[0].''.$error[1].''.$error[2].''.$error[3];
                    $total[1] = 'error';
                    return $total;
                }else{
                    for($i=0;$i<=$count-1;$i++){
                        $up = $auth->compress($tmpLoc[$i], $uploadPath[$i], 75 );
                        $q = "UPDATE `$tableName` SET `photoPath1` = '$dbPath' WHERE  `$tableName`.`id` = '$pid'  ";
                        $ask = $mysql->query($q);
                        if($ask){
                            echo 'Photo Updated!';
                        }else{
                            echo 'Db Error';
                        }
                    }
                    $total[0] = $dbPath;
                    $total[1] = 'work';
                    return $total;
                }

            }else{
                echo 'You can only post '.$amount.' images';
            }
        }


        function singlePhotoUpdater($tableName, $pid, $fileVar){
            require_once "auth.php";
            include "connect.php";
            //  echo 'idddddddddd'.$fileVar['name'];
            $dbPath = '';
            $allowedType = array('jpeg', 'png', 'jpg');
            $error = array();
            $fileName = explode('.',$fileVar['name']);
            $fileExt = $fileName[1];
            $mimeArr = explode('/', $fileVar['type']);
            $mimeType = $mimeArr[0];
            $mimeExt = $mimeArr[1];
            $tmpLoc = $fileVar['tmp_name'];
            $fileSize = $fileVar['size'];
            $uploadName = md5(microtime()).'.'.$fileExt;
            if($tableName == 'ad'){
                $uploadPath = '../uploads/adPostsPhoto/'.$uploadName;
                if($i != 0){
                    $dbPath .= ',';
                }
                $dbPath .= './uploads/adPostsPhoto/'.$uploadName;
            }
            
            if($tableName == 'electronics'){
                $uploadPath = '../uploads/electronicsPhoto/'.$uploadName;
                if($i != 0){
                    $dbPath .= ',';
                }
                $dbPath .= './uploads/vacancyPhoto/'.$uploadName;
            }

            if($tableName == 'car'){
                $uploadPath = '../uploads/CarPostsPhoto/'.$uploadName;
                if($i != 0){
                    $dbPath .= ',';
                }
                $dbPath .= './uploads/CarPostsPhoto/'.$uploadName;
            }

            if($tableName == 'housesell'){
                $uploadPath = '../uploads/houseOrLandPhotos/'.$uploadName;
                if($i != 0){
                    $dbPath .= ',';
                }
                $dbPath .= './uploads/houseOrLandPhotos/'.$uploadName;
            }

            if($tableName == 'tender'){
                $uploadPath = '../uploads/tenderPhotos/'.$uploadName;
                if($i != 0){
                    $dbPath .= ',';
                }
                $dbPath .= './uploads/tenderPhotos/'.$uploadName;
            }

            if($tableName == 'charity'){
                $uploadPath = '../uploads/charityPhoto/'.$uploadName;
                if($i != 0){
                    $dbPath .= ',';
                }
                $dbPath .= './uploads/charityPhoto/'.$uploadName;
            }

            if($tableName == 'jobhometutor'){
                $uploadPath= '../uploads/homeTutor/'.$uploadName;
                if($i != 0){
                    $dbPath .= ',';
                }

                $dbPath .= './uploads/homeTutor/'.$uploadName;
            }


            if($tableName == 'hotelhouse'){
                $uploadPath= '../uploads/homeTutor/'.$uploadName;
                if($i != 0){
                    $dbPath .= ',';
                }

                $dbPath .= './uploads/homeTutor/'.$uploadName;
            }



            if(!in_array($fileExt, $allowedType)){
                $error[] = 'File Extention must be png, jpg, jpeg';
            }

            if($mimeType != 'image'){
                $error[] = 'File must be an Image';
            }

            if($mimeType != $fileExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')){
                $error[] = 'File extention does not match file';
            }

            if($fileSize[$i] > 150000000){
                $error[] = 'File size exided the limited size.';
            }
        
        $total = array();

        if(!empty($error)){
            $total[0]= $error[0].''.$error[1].''.$error[2].''.$error[3];
            $total[1] = 'error';
            return $total;
        }else{
            for($i=0;$i<=$count-1;$i++){
            
                $up = $auth->compress($tmpLoc, $uploadPath, 75 );
                $q = "UPDATE `$tableName` SET `photoPath1` = '$dbPath' WHERE  `$tableName`.`id` = '$pid'  ";
                $ask = $mysql->query($q);
                if($ask){
                    echo 'Photo Updated!';
                }else{
                    echo 'Db Error';
                }
            }
            $total[0] = $dbPath;
            $total[1] = 'work';
            return $total;
        }
    }
        
    

        //to split all the photos from db photo path
        function photoSplit($dbPath){
            $path = explode(',', $dbPath);
            return $path;
        }




       ////blog uploader
       function blogAdder($title, $content, $posterId, $photo){
           include "connect.php";
           $postedDate = date('Y-m-d H:i:s');
           $content = addslashes($content);
           $title = addslashes($title);
           $q = "INSERT INTO `blogPost` (`title`, `postedDate`, `content`, `posterId`, `photoPath1`)
            VALUES ('$title', '$postedDate', '$content', '$posterId', '$photo' )";

            $ask = $mysql->query($q);
        echo $mysql->error;
            return $ask;
       }


       ////blog update
       function blogUpdater($title, $frontLabel, $content, $pid){
        include "connect.php";
        $e = 'EDITED';
        $q = "UPDATE `blog` SET `title`= '$title', `frontLabel`= '$frontLabel', `content`= '$content',
         `edited` = '$e'  WHERE `blog`.`id` = '$pid' ";

         $ask = $mysql->query($q);

         return $ask;
    }
    
    


    
    }



    

    $admin = new adminPhp;

?>