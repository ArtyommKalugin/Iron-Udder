<?php
function requestUserID($token) {
    global $Link;

    $userID = $Link->query("SELECT userID FROM tokens WHERE value='$token'")->fetch_assoc();
    if (is_null($userID)) {
        setHTTPStatus("500", "Не найдено");
    } else {
        return $userID;
    }
}

function requestCompany($index) {
    global $Link;
    $company = $Link->query("SELECT * FROM companies WHERE id='$index'")->fetch_assoc();
    if (is_null($company)) {
        setHTTPStatus("500", "Не найдено");
    } else {
        return $company;
    }
}

?>