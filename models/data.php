<?php
 class Data{

    public function getDataObject(){
        require_once('models/item.php');
        $connection = new Database();
        $data = [];
        $data = $this->getImages($connection);
       
        echo json_encode($data);
    }

    public function deleteItem($id){
        $connection = new Database();

        $sql = "SELECT ID, image_url 
        FROM image_meta 
        WHERE ID=$id";
        $result = $connection->query($sql);
        while($row = $result->fetch_assoc()){
            if(file_exists($row['image_url'])){
                unlink($row['image_url']);
            }
            $sql = "DELETE FROM image_attributes 
            WHERE img_id=$id";
            $connection->query($sql);
            $sql = "DELETE FROM image_meta 
            WHERE ID=$id";
            $connection->query($sql);
        }

    }

    private function getImages($connection){
        $item_model = new Item();
        $sql = "SELECT ID, image_url 
                FROM image_meta 
                ORDER BY ID ASC";
        $result = $connection->query($sql);
        $result_val = [];
        while($row = $result->fetch_assoc()){
        //    if ($row['ID'] == 203){
                $row = (array) $row;
                $row['state'] = $item_model->getState($connection, $row);
                $row['element'] = $item_model->getElement($connection, $row);
                $row['type'] = $this->getAttributes($connection, $row, [1,2] /* type tax id */);
                $row['rarity'] = $this->getAttributes($connection, $row, [5] /* rarity tax id */);
                $result_val[] = $row;   
       //     }         
        }   
        return $result_val;
    }

    private function getAttributes($connection, $row, $taxonomy){
        $id = $row['ID'];
        $test = array();
        $sql = "SELECT attribute_id
                FROM image_attributes 
                WHERE img_id=$id";
        $result = $connection->query($sql);
      //  return $result->fetch_object();
      //  die(json_encode( $result->fetch_assoc())); 
        while($row = $result->fetch_assoc()){
            if ($row == "" || $row == null){
                continue;
            }
            $attribute_id = $row['attribute_id'];
            
            $sql = "SELECT attribute
            FROM gear_attributes 
            WHERE ID=$attribute_id AND taxonomy_id IN (" . implode(',', $taxonomy) . ")";
            $result2 = $connection->query($sql);
            while($row2 = $result2->fetch_row()){
                if ($row2 == "" || $row2 == null){
                    continue;
                 }
                 return $row2;   
            }
            
        }
        return $test;
                 

    }
}

