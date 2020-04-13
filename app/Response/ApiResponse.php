<?php
/**
 * ApiResponse.php
 * author lwz
 * time 2020/1/29
 */

namespace App\Response;


use Illuminate\Http\Response;
use Trail\ResponseTrail;

class ApiResponse extends Response
{
    use ResponseTrail;
}
