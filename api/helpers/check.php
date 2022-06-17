<?php

function checkPermission($token) {
    global $Link;
    $dbToken = $Link->query("SELECT userID, validUntil FROM tokens WHERE value='$token'")->fetch_assoc();
    if (!is_null($dbToken)) {
        if ($dbToken["validUntil"] > date('Y-m-d H:i:s', time())) {
            return true;
        } else {
            $Link->query("DELETE FROM tokens WHERE value='$token'");
            setHTTPStatus("403");
            return false;
        }
    } else {
        setHTTPStatus("401");
        return false;
    }
}
    
?>