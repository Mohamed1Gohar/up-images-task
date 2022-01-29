<?php
require './dbConnection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    // code upload
    if (!empty($_POST['name']) || isset($_FILES['image'])) {

        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf', 'doc', 'ppt'); // valid extensions
        $dirUpload = 'uploads/'; // upload directory

        $img = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        
        // get uploaded file's extension
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $extArray = explode('.', $img);
        $ImageExtension = strtolower(end($extArray));

        // can upload same image using rand function
        $final_image = time() . rand() . '.' . $ImageExtension;

        if (in_array($ImageExtension, $valid_extensions)) {
            $path = $dirUpload . strtolower($final_image);

            if (move_uploaded_file($tmp, '../'.$path)) {

                $name = $_POST['name'];
                
                //insert form data in the database
                $sql = "insert into uploading (name,path) values ('$name','$path')";
                $op = mysqli_query($con, $sql);
                if ($op) {

                    $id = mysqli_insert_id($con);

                    $data = [
                        'id' => $id,
                        'name' => $name,
                        'image' => $final_image,
                        'message' => 'Image Inserted'
                    ];

                    echo json_encode($data);
                    exit;
               
                } else {
                    echo 'error try again '.mysqli_error($con);
                }
            }

            echo 'error in "move_uploaded_file()" try again ';

        } else {
            echo 'invalid';
        }


    }

    // code action
    if (!empty($_POST['id']) || !empty($_POST['actionType'])) {

        $id = intval($_POST['id']);
        $action_type = $_POST['actionType'];

        $sql = "select * from uploading where id = $id";
        $op = mysqli_query($con, $sql);
        $op = mysqli_num_rows($op) == 1 ? true : false;

        if ($action_type == 'approval' && $op) {
            
            $sql = "UPDATE `uploading` SET status='approved' where id= $id";
            $op = mysqli_query($con, $sql);
            if ($op) {
                echo 'Success Image Approved !';
            } else {
                echo 'error try again ' . mysqli_error($con);
            }

        } elseif ($action_type == 'rejection' && $op) {

            $now = date("Y-m-d H:m:s");
            $sql = "UPDATE `uploading` SET status='rejected', deleted_at='$now' where id= $id";
            $op = mysqli_query($con, $sql);

            if ($op) {
                $message = ["message " => "the user is removed"];
                echo 'this Image Is Removed';
            } else {
                echo 'error try again ' . mysqli_error($con);
            }
            
        }

        exit;
    }
    
    exit;
}
