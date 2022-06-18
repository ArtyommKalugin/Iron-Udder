<?php
function requestVacancies() {
    global $Link;
    $vacancies = $Link->query("SELECT * FROM vacancies");
    if (!$vacancies) {
        setHTTPStatus("500", "Не найдено");
    } else {
        return $vacancies;
    }
}

function requestVacancy($index) {
    global $Link;
    $vacancy = $Link->query("SELECT * FROM vacancies WHERE id='$index'")->fetch_assoc();
    if (is_null($vacancy)) {
        setHTTPStatus("500", "Не найдено");
    } else {
        return $vacancy;
    }
}

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

function requestCompanyID($index) {
    global $Link;
    $company = $Link->query("SELECT companyID FROM users WHERE id='$index'")->fetch_assoc();
    if (is_null($company)) {
        setHTTPStatus("500", "Не найдено");
    } else {
        return $company;
    }
}

function outputApplicants($index) {
    global $Link;                
    $vacancyUsers = $Link->query("SELECT userID FROM vacanciesusers WHERE vacancyID=$index");

    $applicants = [];

    while ($vacancyUserRow = $vacancyUsers->fetch_assoc()) {
        $userID = $vacancyUserRow["userID"];
        $userInfo = $Link->query("SELECT * FROM users WHERE id=$userID");

        while ($userRow = $userInfo->fetch_assoc()) {
            $applicant["id"] = $userRow["id"];
            $applicant["name"] = $userRow["name"];
            $applicant["secondName"] = $userRow["secondName"];
            $applicant["email"] = $userRow["email"];
        }
        array_push($applicants, $applicant);
    }
    return $applicants;
}

?>