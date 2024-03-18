
<?php
    header ('Content-Type: application/json');
    include "backend/connessione.php";

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode( '/', $uri );

    if(isset($uri[3])){
        $type = $uri[3];
        echo $type;
        if(isset($uri[4])){
            $id = $uri[4];
        }
        else{
            $id = null;
        }

        if($type == "directors"){
            $query = "SELECT * FROM Registi";
            if($id != null){
                $query = "SELECT * FROM Registi WHERE id = $id";
            }
        }else if($type == "actors"){
            $query = "SELECT * FROM Attori";
            if($id != null){
                $query = "SELECT * FROM Attori WHERE id = $id";
            }
        }else if($type == "films"){
            $query = "SELECT * FROM Film";
            if($id != null){
                $query = "SELECT * FROM Film WHERE id = $id";
            }
        }else if($type == "profiles"){
            $query = "SELECT * FROM Utenti";
            if($id != null){
                $query = "SELECT * FROM Utenti WHERE id = $id";
            }
        }else if($type == "lists"){
            $query = "SELECT * FROM Liste";
            if($id != null){
                $query = "SELECT * FROM Liste WHERE id = $id";
            }
        }else{
            echo "Error: invalid type parameter";
        }

        if($result = $connessione->query($query)){
            $ret = array();
            while ($row = $result->fetch_assoc()) {
                $ret[] = $row;
            }
            $json = json_encode(array("error" => false, "msg" => "Query succesfull", "data" => $ret));
            echo $json;
        }
        else{
            $json = json_encode(array("error" => true, "msg" => "Query failed", "data" => null));
            echo $json;
        }

    }
    else{
        echo "Error: missing type parameter";
    }

?>