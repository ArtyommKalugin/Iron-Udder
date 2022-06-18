<?php   
include 'C:\Iron_udder\api\helpers\check.php';

function route($method, $urlData, $formData) {    
    
    global $Link;

    switch ($method) {

        case 'GET':
            switch (count($urlData)) {
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

        case '2':

            $index = (int)$urlData[1];
            $user = $Link->query("SELECT * FROM users WHERE id='$index'")->fetch_assoc();

            if (!$user) {
                setHTTPStatus("404");
            } else {
                $message = [
                    "id" => $user["id"],
                    "name" => $user["name"],
                    "secondName" => $user["secondName"],
                    "thirdName" => $user["thirdName"],
                    "email" => $user["email"],
                    "birthDate" => $user["birthDate"]
                ];
                echo json_encode($message);
            }

            break;
        }

        break;

        case "PUT":
            
            $name = $formData["Name"];
            $secondName = $formData["SecondName"];
            $thirdName = $formData["ThirdName"];
            $email = $formData["Email"];
            $birthDate = $formData["BirthDate"];

            $index = (int)$urlList[1];

            $updateUser = $Link->query("UPDATE users SET birthDate = '$birthDate', email = '$email', name = '$name', secondName = '$secondName', thirdName = '$thirdName' WHERE id = $index");
            if (!$updateUser) {
                echo json_encode($updateUser);
                setHTTPStatus("404");
            } else {
                $message = ["message" => "OK"];
                echo json_encode($message);
            }
            break;
    }
}