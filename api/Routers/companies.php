<?php   

function route($method, $urlData, $formData) {    
    
    global $Link;

    switch ($method) {

        case 'POST':

        $name = $formData["Name"];
        $company = $Link->query("SELECT id FROM companies WHERE name='$name'")->fetch_assoc();
            
        if (is_null($company)) {
            $companyInsertResult = $Link->query("INSERT INTO companies(name) VALUES('$name')");

            if (!$companyInsertResult) {
                setHTTPStatus("500");
            }
        } else {
            setHTTPStatus("500","This company already exists");
            }
            
        break;

        }
}
