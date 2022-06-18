<?php
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