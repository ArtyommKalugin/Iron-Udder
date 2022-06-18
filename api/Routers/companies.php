<?php   

function route($method, $urlData, $formData) {    
    
    global $Link;

    switch ($method) {

        case 'GET':

        // api/companies
        switch (count($urlData)) {
            case '1':

            $companies = $Link->query("SELECT * FROM companies");
            if (!$companies) {
                setHTTPStatus("500");
                return;
            } else {
                $message = [];
                while ($row = $companies->fetch_assoc()) {
                    $message[] = [
                        "id" => $row["id"],
                        "name" => $row["name"]
                    ];
                }
                echo json_encode($message);
            }


            break;

            case '2':

            break;
        }

        break;

        //  api/companies
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
