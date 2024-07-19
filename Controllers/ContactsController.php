<?php

namespace App\Controllers;

use App\config\Database;
use App\Core\Controller;
use PDOException;

class ContactsController extends Controller{
    
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getContacts(){

        try{

            $contactData =$this->database->query("SELECT * FROM `contacts`");
            echo createJson($contactData);

        } catch(PDOException $e){

            echo "Error: " . $e->getMessage();

        }

    }

    public function getContact($id){

        try{

            $contactData =$this->database->query("SELECT * FROM `contacts` WHERE  `contact_id`= '{$id}'");
            echo createJson($contactData);

        } catch(PDOException $e){

            echo "Error: " . $e->getMessage();

        }

    }

    public function getContactsDashbord($limit)
    {

        try {

            $params = [

                ':limit' => intval($limit)
            ];

            $contactsDatas = $this->database->queryBindParam(
                'SELECT contacts.*, contacts.email
                FROM contacts
                JOIN companies 
                ON contacts.company_id = companies.company_id
                ORDER BY created_at  DESC 
                LIMIT :limit',$params
            );

            
            return $contactsDatas;
        } catch (\Throwable $th) {
            //throw $th;
            $response = [
                'status' => 404,
                'message' => 'No found',
            ];
            echo createJson($response);
            echo $th;
        }
    }

    public function setNewContact(){

        try{
            // Get JSON as a string
            $json_str = file_get_contents('php://input');
            // Get as an object
            $json_obj = json_decode($json_str);
    
            $contactData =$this->database->query("INSERT INTO `contacts`(`company_id`,'name', `phone`, `email`, `created_at`, `updated_at`) 
            VALUES (
                    '{$json_obj->company_id}',
                    '{$json_obj->name}',
                    '{$json_obj->phone}',
                    '{$json_obj->email}',
                    NOW(),
                    NOW()
                    )");
    
            echo createJson($contactData);
    
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }    

    public function updateContact($id){

        try{
            // Get JSON as a string
            $json_str = file_get_contents('php://input');
            // Get as an object
            $json_obj = json_decode($json_str);
    
            $contactData =$this->database->query(
                "UPDATE `contacts` 
                SET 
                `company_id`='{$json_obj->company_id}',
                'name'='{$json_obj->name}',
                `phone`='{$json_obj->phone}',
                `email`='{$json_obj->email}',
                `updated_at`=NOW() 
                WHERE `contact_id`= '{$id}'"
            );
    
            echo createJson($contactData);
    
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
    
    public function deletContact($id){
        
        try{
    
            $this->database->query("DELETE FROM `contacts` WHERE  `contact_id`= '{$id}'" );
    
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
}

