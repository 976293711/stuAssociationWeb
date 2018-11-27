<?php
namespace Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class ControllerBase extends Controller
{

    protected $filter;

    public function onConstruct()
    {
//        $request = $this->request;
//
//        $header = $request->getHeader('authorization');
//
//        if(!empty($header)) {
//            $token = trim(preg_replace('/^(?:\s+)?Bearer\s/', '', $header));
//            $apiKey = @$this->getDI()->get('config')->env->api_key;
//            if (!empty($apiKey) && !empty($token)) {
//                if (hash_equals($token, $apiKey)) {
//                    return;
//                }
//            }else{
//                return $this->failResponse("auth 校验失败");
//            }
//        }
//        return $this->failResponse("auth 校验失败");
    }

    public function responseJson($data)
    {
        $response = new \Phalcon\Http\Response();
        $response->setHeader("Content-Type", "application/json");
        //允许跨域配置
        //$this->response->setHeader('Access-Control-Allow-Origin','*');
        $response->setHeader('Access-Control-Allow-Credentials','true');
        $referer = $this->request->getHTTPReferer();
        if($referer){
            $allowOrigins = $this->config->whitelist;
            foreach($allowOrigins as $allowOrigin){
                if(false!==strpos($referer, $allowOrigin)){
                    $response->setHeader('Access-Control-Allow-Origin',$allowOrigin);
                    break;
                }
            }
        }

        if(! is_string($data))
        {
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        $response->setContent($data);

        $response->send();
    }

    /**
     * 成功返回
     * @param string $msg
     * @param array $data
     * @param int $code
     * @return Response
     */
    public function successResponse($msg='',$data=[],$code=1){
        $response=new Response();
        $response->setContentType('text/json');
        $response->setStatusCode(200);

        $result=[
            'state'=>true,
            'msg'=>$msg,
            'code'=>$code,
            'data'=>$data
        ];
        $response->setJsonContent($result);
        return $response->send();
    }

    /**
     * 失败返回
     * @param string $msg
     * @param array $data
     * @param int $code
     * @return Response
     */
    public function failResponse($msg='',$data=[],$code=-1){
        $response=new Response();
        $response->setContentType('text/json');
        $response->setStatusCode(200);

        $result= [
            'state'=>false,
            'msg'=>$msg,
            'code'=>$code,
            'data'=>$data
        ];
        $response->setJsonContent($result);
        return $response->send();
    }

    public function createRandomStr($length)
    {
        $str="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
        $randomStr=substr(str_shuffle($str),0,$length);
        return $randomStr;
    }

    protected  function getGlobalConfig()
    {
        $config = $this->getDI()->get('config');
        return $config;
    }

}
