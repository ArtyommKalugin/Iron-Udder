<?php

    function route($method, $urlList, $formData) {
        global $Link;
        switch ($method) {

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
