<?php
 class Item{

    public function potentialImages(){
        $connection = new Database();
        $item_ids = $this->getItemsByType($connection);

        $item_ids = $this->getItemsByAttributes($connection, $item_ids);
        if (isset($item_ids) && count($item_ids) != 0){
            
            $image_data = $this->chooseItem($connection, $item_ids );

            $elements = $this->getElement($connection, $image_data );
            $image_data['elements'] = $elements;

            $states = $this->getState($connection, $image_data );
            $image_data['states'] = $states;

            $stats = $this->getStats($connection);
            $image_data['stats'] = $stats;

            $stats = $this->getNames($connection, $image_data);
            $image_data['name'] = $stats;
            echo json_encode( $image_data);
        }else{
            echo 0;
        }
        
        
        //print_r( $image_data);
       // echo "<script>console.log(".json_encode($temp_image_datas).");</script>";
    }

    private function getNames($connection, $image_data){
        $item_names = array();
        // shortlist potential names a little
        $item_rarity = (int)$_POST['gen--rarity'];
        $sql = "SELECT weapon_names.name, weapon_names.stat_type 
                FROM weapon_names 
                INNER JOIN gear_attributes ON weapon_names.stat_rarity=gear_attributes.ID
                WHERE weapon_names.stat_rarity=$item_rarity";
        $result = $connection->query($sql);
        while($row = $result->fetch_assoc()){
            $result_val[] = $row;
        }   
        return $result_val;
    }

    private function getStats($connection){
        $result_val = array();
        $sql = "SELECT statkey, statvalue FROM stats WHERE type=0";
        $result = $connection->query($sql);
        while($row = $result->fetch_assoc()){
            $result_val[] = $row;
       }   
        return $result_val;
    }

    public function getState($connection, $image_data ){
        $item_states = array();
        $img_id = $image_data['ID'];
   
        $sql = "SELECT attribute_id FROM image_attributes WHERE img_id=$img_id";
        $result = $connection->query($sql);   
        while($row = $result->fetch_assoc()){ // each attribute by img id
            $id = $row['attribute_id'];
            $sql = "SELECT ID FROM gear_attributes WHERE ID=$id AND taxonomy_id=4";/* state */
            $result2 = $connection->query($sql);     
            while($row2 = $result2->fetch_assoc()){
                $item_states[] = $row2['ID'];
           }
        }
        if (!isset($item_states)){
            return "";
        }
        return $item_states;
    }

    public function getElement($connection, $image_data ){
        $item_elements = array();

        $img_id = $image_data['ID'];
   
        $sql = "SELECT attribute_id FROM image_attributes WHERE img_id=$img_id";
        $result = $connection->query($sql);    
        while($row = $result->fetch_assoc()){ // each attribute by img id
            $id = $row['attribute_id'];
            $sql = "SELECT ID FROM gear_attributes WHERE ID=$id AND taxonomy_id=3";/* element*/
            $result2 = $connection->query($sql);    
            while($row2 = $result2->fetch_assoc()){
                $item_elements[] = $row2['ID'];
           }
        }
        if (!isset($item_elements)){
            return "";
        }
        return $item_elements;
    }

    private function chooseItem($connection, $item_ids ){

        $random_index = rand(0, count($item_ids) - 1); 
        $item_ids = $item_ids[$random_index];
        $image_data = array();
        
        $sql = "SELECT ID, image_url FROM image_meta WHERE ID=$item_ids";
        $result = $connection->query($sql);

        while($row = $result->fetch_assoc()){

            $image_data['ID'] = $row["ID"]; 
            $image_data['img_url'] = $row["image_url"]; 
        }

        return $image_data;       
    }

    private function getItemsByAttributes($connection, $item_ids){
       
        if ($_POST['gen--attributes'] == "")
        // print_r( $item_ids);
            return $item_ids;  

        $gen_attributes = $_POST['gen--attributes'];
        
        $gen_attributes = explode(',',$gen_attributes);
        
        foreach($item_ids as $item_id){ // each image
            foreach($gen_attributes as $attribute){ // each attribute
                $sql = "SELECT img_ID FROM image_attributes WHERE img_ID=$item_id AND attribute_id=$attribute";
                $result = $connection->query($sql);
                if($result == ""){
                    continue;
                }   
                $copy_ids = array(); 
                while($row = $result->fetch_assoc()){
                    if (in_array($row["img_ID"], $copy_ids)){
                        continue;
                    }
                    $copy_ids[] = $row["img_ID"]; 
                   
                   // print_r($copy_ids);
                    return $copy_ids;
                }
                
            }            
        }
    }

    private function getItemsByType($connection){
        $gen_type = $_POST['gen--type'];

        $gen_sub_type = "";
        $img_ids_return = array();
        $img_ids_ = array();
        if (isset($_POST['gen--sub_type'])){$gen_sub_type = $_POST['gen--sub_type'];}
        // get by type and subtype
        $sql = "SELECT img_ID FROM image_attributes WHERE attribute_id=$gen_type";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            $index = 0;  
            while($row = $result->fetch_assoc()){
                $img_ids[] = $row['img_ID'];
                if ($gen_sub_type != ""){
                    // subtype
                    $img_id = $img_ids[$index];
                    $sql = "SELECT img_ID FROM image_attributes WHERE img_ID=$img_id AND attribute_id=$gen_sub_type";
                    $sub_result = $connection->query($sql);
                    if ($sub_result->num_rows > 0) {
                        while($row2 = $sub_result->fetch_assoc()){
                            $img_ids_[] = $row2['img_ID'];
                        }
                    }
                    $index++;  
                }else{
                    $img_ids_[] = $row['img_ID'];
                }   
            }
        }

        // rarity
        $rarity = $_POST['gen--rarity'];
        foreach($img_ids_ as $img_id_rarity){
            $sql = "SELECT img_ID FROM image_attributes WHERE img_ID=$img_id_rarity AND attribute_id=$rarity";
            $result = $connection->query($sql);
            while($row = $result->fetch_assoc()){
                $img_ids_return[] = $row['img_ID'];
            }
        }
        return $img_ids_return;
    }

 }
?>