<?php


namespace App\Core;


use Illuminate\Http\JsonResponse;

class Response
{
    public function __construct()
    {
        return $this;
    }

    private $message = null;
    private $success = true;
    private $data = [];


    public function success($bool = true){
        $this->success = $bool;
        return $this;
    }

    /**
     * @return $this
     */
    public function fail(){
        $this->success = false;
        return $this;
    }

    /**
     * @param $message
     * @return Response
     */
    public function message($message){
        $this->message = $message;
        return $this;
    }

    /**
     * @param $data
     * @return $this
     */

    public function data( $index ,$data)
    {
        $this->data[$index] = $data;
        return $this;
    }

    /**
     * @param string $message
     * @return JsonResponse
     */

    public function build($message = "")  :  JsonResponse {

        return response()->json([
            'message' => $this->message ?? $message,
            'success' => $this->success,
            'body' => $this->data
        ],  200 , []);
    }
}
