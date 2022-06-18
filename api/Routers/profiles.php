<?php   
include 'C:\Iron_udder\api\helpers\check.php';

function route($method, $urlData, $formData) {    
    
    global $Link;

    switch ($method) {

        case 'GET':
            switch (count($urlData[1]) {
        case '1':

            $users = $Link->query("SELECT * FROM users");
            if (!$users) {
                setHTTPStatus("500");
                return;
            } else {
                $message = [];
                while ($row = $users->fetch_assoc()) {
                    $message[] = [
                        "id" => $row["id"],
                        "name" => $row["name"],
                        "secondName" => $row["secondName"],
                        "thirdName" => $row["thirdName"],
                        "email" => $row["email"],
                        "birthDate" => $row["birthDate"]
                    ];
                }
                echo json_encode($message);
            }

            break; 
        }
    }
}