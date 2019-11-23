<?php

// require 'model/user.php';

class uploadController
{

    public function uploadFile()
    {
        if (isset($_FILES['image'])) {

            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];

            $string = explode('.', $_FILES['image']['name']);
            $date = date("Y-m-d h:i:sa");
            $string[0] = $date . $string[0];
            $string[0] = preg_replace("/[^A-Za-z0-9]/", "", $string[0]);
            $file_ext = strtolower(end($string));
            $extensions = array("jpeg", "jpg", "png");

            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size must be excately 2 MB';
            }

            $rand = rand(0, 1000);

            $fileName = $string[0] . "_" . $rand . "." . $string[1];

            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "public/upload_files/" .  $fileName);

                $Tickets = new Tickets(null, null, null, null, null);
                $Tickets->atachFileNameToTicket($_POST['ticket_id'], $fileName);

                echo "Success";
                header("refresh:2;url=../index.php?action=myactivetickets");
            } else {
                print_r($errors);
            }

            // MODEL - ATACH FILENAME TO TICKET

        }
    }


    public function atachphototouser()
    {
        if (isset($_FILES['image'])) {
            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];

       

            $string = explode('.', $_FILES['image']['name']);
            $date = date("Y-m-d h:i:sa");
            $string[0] = $date . $string[0];
            $string[0] = preg_replace("/[^A-Za-z0-9]/", "", $string[0]);
            $file_ext = strtolower(end($string));
            $extensions = array("jpeg", "jpg", "png");

            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size must be excately 2 MB';
            }

            $rand = rand(0, 1000);

            $fileName = "photo" . $string[0] . "_" . $rand . "." . $string[1];

            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "public/upload_files/" .  $fileName);

                $User = new User(null, null, null, null, null, null, null);
                $User->atachPhotoToUser($_SESSION['user']->getId(), $fileName);

                echo "Success";
                header("refresh:2;url=../index.php?action=myactivetickets");
            } else {
                print_r($errors);
            }
        }
    }
}
