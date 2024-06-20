<?php

namespace App\Http\Controllers\Api\Traits;

use Illuminate\Support\Facades\Validator;

/**
 * Tarit for standard Api Response
 * [
 * 'data',
 * 'message',
 * 'status'
 * ]
 */
trait ApiResponseTrait
{
    public $paginateNumber = 10;

    public function ApiResponse($data = [] , $message = null , $code = 200)
    {
            $array =
            [
                'data'    => $data,
                'message' => $message,
                'status'  => in_array($code ,$this->successCode())? true : false
            ];

            return response()->json($array,$code);
    } // end of api response

    public function successCode()
    {

        return [
            200 ,201 ,202
        ];

    } // end of success code

    public function notFoundResponse()
    {

        return $this->ApiResponse(null , __('api.not_found') , 404);

    } // end of not found response

    public function apiValidation($request , $array)
    {

        $validate = Validator::make($request->all() , $array);

        if ($validate->fails())
        {
            return $this->ApiResponse(null , $validate->errors() , 422);
        }

    } // end of api validate

}


