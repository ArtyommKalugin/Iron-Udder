<?php

    function route($method, $urlList, $formData) {
        global $Link;
        switch ($method) {
            case "GET":
                switch (count($urlList) {
                
                case '1': 

                    $vacancies = requestVacancies();
                    if (is_null($vacancies)) {
                        return;
                    }

                    $message = [];

                    while ($row = $vacancies->fetch_assoc()) {

                        $message[] = [
                            "id" => $row["id"],
                            "positionID" => $row["positionID"],
                            "companyID" => $row["companyID"]
                        ];
                    }
                    echo json_encode($message);

                    break;

                }


            case "POST":
                $token = substr(getallheaders()["Authorization"], 7);
                if (!checkPermission($token)) {
                    return;
                }

                if (!rolePermission($token, UserStatus::Company)) {
                    return;
                }

                $userID = requestUserID($token)["userID"];

                $positionID = $formData["PositionID"];
                $companyID = requestCompanyID($userID)["companyID"];

                $vacancy = $Link->query("INSERT INTO vacancies (`positionID`, `companyID`) VALUES('$positionID', '$companyID')");

                if (!$vacancy) {
                    setHTTPStatus("500");
                else{
                     echo json_encode(["message" => "OK"]);
                }   
                               
                break;

            default:
                setHTTPStatus("404");
                return;
                break;
        }
    }

?>
