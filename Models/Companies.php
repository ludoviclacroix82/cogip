<?php

namespace App\Models;

class Companies
{

    public int $id;
    public ?string $name;
    public ?string $created_at;
    public ?string $updated_at;

    public function __construct(int $id, ?string $name, ?string $created_at, ?string $updated_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function loadData($postsData)
    {
        $datas = [];

        foreach ($postsData as $post) {
            $datas[] = new self(
                $post['company_id'],
                $post['name'],
                $post['created_at'],
                $post['updated_at']
            );
        }
        return $datas;
    }
    public static function dataBodyInsert()
    {

        $bodydata = [];
        $bodydata = file_get_contents('php://input');
        $bodyDatas = json_decode($bodydata, true);

        $params = [
            ':name' => securityInput($bodyDatas['name']),
            ':created_at' => dates('Y-m-d h:i:s'),
            ':updated_at' => dates('Y-m-d h:i:s')
        ];

        return $params;
    }

    public static function dataBodyUpdate($id)
    {

        $bodydata = [];
        $paramsBody = [];
        $paramsSet = '';
        $bodydata = file_get_contents('php://input');
        $bodyDatas = json_decode($bodydata, true);

        foreach ($bodyDatas as $key => $value) {
            $paramsBody[":{$key}"] = securityInput($value);
        }
        foreach ($bodyDatas as $key => $value) {
            $paramsSet .=  "{$key} = :{$key}, ";
        }
        $paramsSet .= 'updated_at = :updated_at '; // ajout updated sql SET

        $paramsNoBody =  [
            ':id' => securityInput(securityInput(intval($id))),
            ':updated_at' => dates('Y-m-d h:i:s')
        ];

        $params = array_merge($paramsBody, $paramsNoBody);

        return [
            "paramsBody" => $params,
            "paramsSet" => $paramsSet
        ];
    }    
}
