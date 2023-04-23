<?php
    class Images{

        protected $elements = array();

        protected $states = array();

        public function __construct(){
            $this->saveImage();
        }

        private function saveImage(){
            $target_dir = "assets/images/items/";
            $target_file = $target_dir . basename($_FILES["ig--fileToUpload"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["ig--fileToUpload"]["tmp_name"]);
                if($check !== false) {
               //     echo "File is an image - " . $check["mime"] . "." . "<br>";
                } else {
                    echo "File is not an image." . "<br>";
                    return;
                }
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists." . "<br>";
                    return;
                }
                if (move_uploaded_file($_FILES["ig--fileToUpload"]["tmp_name"], $target_file)) {
                //    echo "The file ". basename( $_FILES["ig--fileToUpload"]["name"]). " has been uploaded." . "<br>";
                } else {
                    echo "Sorry, there was an error uploading your file." . "<br>";
                }
            } 

            $this->saveImageMeta($target_file);
        }

        private function saveImageMeta($target_file){
            $connection = new Database();
            $temp_image_datas = $_POST;
           // echo "<script>console.log(".json_encode($temp_image_datas).");</script>";
            // insert into image_meta table
            $sql = "INSERT INTO image_meta (image_url) VALUES ('$target_file')";
            if ($connection->query($sql)) {
                $last_id = $connection->insert_id;
            //    echo "New record created successfully. ID is: " . $last_id . "<br>";
            } else {
                echo "Error: " . $sql . "<br>" . $connection->error . "<br>";
            }
             // insert into image_attributes table
             foreach($temp_image_datas as $attribute){
                if($attribute == "undefined" || $attribute == "" || $attribute == null){
                    continue;
                } 
                $sql = "INSERT INTO image_attributes (img_id, attribute_id) VALUES ('$last_id', '$attribute')";
                if ($connection->query($sql) === TRUE) {
                    $current_id = $connection->insert_id;
               //     echo "New record created successfully. ID is: " . $current_id . "<br>";
                } else {
                    echo "Error: " . $sql . "<br>" . $connection->error . "<br>";
                }
            }
            
            $connection->close();
        }

    }
?>