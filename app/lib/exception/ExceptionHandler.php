<?php
/**
 * Created by : Miracle Liu
 * Author: 小刘励志秃头
 * Date: 2023/10/17
 * Time: 1:20
 */

namespace app\lib\exception;

use Exception;
use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;

    // 向客户端返回当前请求路径
    public function render(\Exception $e)
    {
        if ($e instanceof BaseException) {
            //如果是自定义的异常
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        } else {
//            Config::get('app_debug');
            if (config('app_debug')) {
                return parent::render($e);
            } else {
                $this->code = 500;
                $this->msg = '服务器内部错误，不想告诉你';
                $this->errorCode = 504;
                $this->recordErrorLog($e);
            }
        }
        $request = Request::instance();
        $result = [
            'msg'         => $this->msg,
            'error_code'  => $this->errorCode,
            'request_url' => $request->url()
        ];
        return json($result, $this->code);
    }

    private function recordErrorLog(Exception $e)
    {
        Log::init([
                'type'  => 'File',
                'path'  => LOG_PATH,
                'level' => ['error']]
        );
        Log::record($e->getMessage(), 'error');
    }
}