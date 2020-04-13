<?php
/**
 * UrlService.php
 * author lwz
 * time 2020/1/29
 */

namespace Service;


class UrlService
{

    public function getBasePath()
    {
        return 'https://music.163.com';
    }

    public function getSearchPath()
    {
        return $this->getBasePath(). '/' . 'weapi/search/get/web?csrf_token=';
    }

    public function getSearchParams()
    {
        return [
            's' => '{$s}',
            'type' => '{$type}',
            'limit' => '{$limit}',
            'offset' => '{$offset}',
        ];
    }
}
