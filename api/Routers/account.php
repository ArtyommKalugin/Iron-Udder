<?php   
include 'C:\Iron_udder\api\Classes\User.php';

function route($method, $urlData, $formData) {    
    
    global $Link;

    switch ($method) {

        case 'POST':
            switch ($urlData[1]) {
        case 'register':
            $model = new User();
            $model->Name = $formData["Name"];
            $model->SecondName = $formData["SecondName"];
            $model->ThirdName = $formData["ThirdName"];
            $model->Password = hash("sha1", $formData["Password"]);
            $model->Email = $formData["Email"];
            $model->BirthDate = $formData["BirthDate"];

            if (!$model->ModelState()){
               setHTTPStatus("409", "Data not entered");
            }
            else { 
                $user = $Link->query("SELECT id FROM users WHERE email='$model->Email'")->fetch_assoc();

                $userInsertResult = $Link->query("INSERT INTO users(name, secondName, thirdName, email, password, birthDate, roleId) VALUES('$model->Name', '$model->SecondName', '$model->ThirdName', '$model->Email', '$model->Password', '$model->BirthDate', 2)");

                if (!$userInsertResult) {
                    echo json_encode($Link->error);
                    setHTTPStatus("500");
                } else {
                    $user = $Link->query("SELECT id FROM users WHERE email='$model->Email' AND password='$model->Password'")->fetch_assoc();
                    $token = bin2hex(random_bytes(16));
                    $userID = $user["id"];
                    $validTime = time() + (10 * 60);
                    $validUntil = date('Y-m-d H:i:s', $validTime);

                    $userInsertResult = $Link->query("INSERT INTO tokens(value, userID, validUntil) VALUES('$token', '$userID', '$validUntil')");

                    if (!$userInsertResult) {
                        echo json_encode($Link->error);
                    } else {
                        echo json_encode(["token" => $token]);
                    }
                }

            }

            break; 

        case 'login':

            $email = $requestData["Email"];
            $password = hash("sha1", $formData["Password"]);

            $user = $Link->query("SELECT id FROM users WHERE email='$email' AND password='$password'")->fetch_assoc();

            if (!is_null($user)) {
                $token = bin2hex(random_bytes(16));
                $userID = $user["id"];
                $validTime = time() + (10 * 60);
                $validUntil = date('Y-m-d H:i:s', $validTime);

                $userInsertResult = $Link->query("INSERT INTO tokens(value, userID, validUntil) VALUES('$token', '$userID', '$validUntil')");

                if (!$userInsertResult) {
                    setHTTPStatus("500");
                } else {
                    echo json_encode(["token" => $token]);
                }
            } else {
                setHTTPStatus("409");
            }
           
            break;
        

        }
    }
}