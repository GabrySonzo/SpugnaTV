
<?php
    header ('Content-Type: application/json');
    include "../backend/connessione.php";
    require_once '../vendor/autoload.php';
    use \Firebase\JWT\JWT;
    use \Firebase\JWT\JWK;
    use \Firebase\JWT\Key;

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode( '/', $uri );

    if(isset($uri[3])){
        $type = $uri[3];
        echo $type;
        $ok = true;
        echo $_GET["token"];
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
            if(isset($_GET["token"])){
                try {
                    $token = $_GET["token"];
                    $decoded = JWT::decode($token, new key('mysecret', 'HS256'));
                    echo $decoded;
                    $query = "SELECT * FROM Liste";
                    if($id != null){
                        $query = "SELECT * FROM Liste WHERE id = $id";
                    }
                } catch (\Exception $e) {
                    echo json_encode(array("error" => true, "msg" => $e->getMessage()));
                    $ok = false;
                }
            }
        }else{
            echo "Error: invalid type parameter";
            $ok = false;
        }

        if($ok){
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

    }
    else{
        echo "Error: missing type parameter";
    }

?>