<?php

require 'model/Company.php';

class MyCompanyController
{

    // ADD NEW TICKET TO DATABASE
    public function addCompany()
    {
        if (isset($_SESSION['user'])) {
            // if (isset($_SESSION['user']) && $_SESSION["user"]->isAdmin()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["Company_Name"])) {
                $CompanyName =  $_POST["Company_Name"];
                $Owner = $_SESSION['user']->getEmail();
                // INSERT INTO DATABASE
                // Create class instance
                $Company = new Company(null, null, null);
                // Execute method addTicket
                $Company->addCompany(null, $CompanyName,  $Owner);                
                header('Location: ../index.php?action=company');
                exit();
            }            
        }
    }





// REPLACE TICKET LIST AREA IN THE HTML BY ALL AVAILABLE POSTS
public function ReplaceCompanyList($view)
{

    $company_list_final_code = null;
    $Owner = $_SESSION['user']->getEmail();
    if (isset($_SESSION['user'])) {
        $company = new Company(null, null, null, null, null);
        $result = $company->getMyCompany(); // FROM MODEL

        foreach ($result as $current_result) {
            $current_company = null;
            $current_company = file_get_contents('view/backend/company_list_default_code.html');
            $current_company = str_replace("{COMPANY_ID}", $current_result["id"], $current_company, $count);
            $current_company = str_replace("{COMPANY_NAME}", $current_result["company_name"], $current_company);           
            $company_list_final_code .= $current_company;
        }
        $view = str_replace("{COMPANY_LIST}", $company_list_final_code, $view);
    }

    return $view;
}












}
