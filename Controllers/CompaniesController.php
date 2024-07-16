<?php

namespace App\Controllers;

use App\config\Database;
use App\Core\Controller;
use App\Models\Companies;


class CompaniesController extends Controller {


    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }


    public function getCompanies(){

        try {
            
            $compagniesDatas = $this->database->query('SELECT * FROM companies');   
            $datas = Companies::loadData($compagniesDatas); 
            $response = [
                'status' => 202,
                'message' =>'OK',
                'params' => $datas 
            ];

            $dataJson = createJson($response);
            echo $dataJson;

        } catch (\Throwable $th) {
            //throw $th;
            $response = [
                'status' => 404,
                'message' =>'No found',
            ];
            $dataJson = createJson($response);
            echo $dataJson;
        }

    }

    public function getCompanie($id){

        try {

            $params = [
                ':id' => $id
            ];
            
            $datas = $this->database->query('SELECT * FROM companies Where company_id = :id',$params);           
            
            if($datas){
                $response = [
                    'status' => 202,
                    'message' =>'OK',
                    'params' => $datas 
                ];
            }else{
                $response = [
                    'status' => 404,
                    'message' =>'No found Companie',
                ];
            }


            $dataJson = createJson($response);
            echo $dataJson;

        } catch (\Throwable $th) {
            throw $th;
            $response = [
                'status' => 404,
                'message' =>'No found Companies',
            ];

            $dataJson = createJson($response);
            echo $dataJson;
        }

    }
}