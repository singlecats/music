<?php
/**
 * ResponseTrail.php
 * author lwz
 * time 2020/1/29
 */

namespace Trail;


trait ResponseTrail
{

    public $contentType = 'application/json';

    public static function withMessage($message = '', $httpStatus, $data = null, $code = 200)
    {
        $response = new static();
        $response->header('Content-Type', $response->getContentType());
        $response->setStatusCode($httpStatus);
        $data = $response->formatData($message, $data, $code);
        $response->setContent($data);
        return $response;

    }

    public static function withJson($data, $message = '', $code = 200)
    {
       return self::withMessage($message, self::HTTP_OK, $data, $code);
    }

    protected function formatData($msg, $data, $code)
    {
        return json_encode([
            'result' => $data,
            'code' => $code,
            'msg' => $msg,
        ], JSON_UNESCAPED_UNICODE);
    }

    protected function getContentType()
    {
        return $this->contentType;
    }

    public static function withError($message)
    {
        return self::withMessage($message, self::HTTP_METHOD_NOT_ALLOWED);
    }

}
