<?php
/**
 * SearchService.php
 * author lwz
 * time 2020/1/29
 */

namespace Service;


class SearchService
{
    public function searchByName($name, $page = 1, $count = 20)
    {
        $uri = $this->formatSearchParams($name, $page, $count);
        $body = [];
        $httpService = new HttpService();
        return $httpService->post($uri, $body, [self::class, 'handleSearchResponse']);
    }

    public function formatSearchParams($name, $page, $count)
    {
        $encryptService = new EncryptService();
        $urlService = new UrlService();
        $uri = $urlService->getSearchPath();
        $offset = $this->getOffset($page, $count);
        $params = $this->getParamsFields($name, 1, $count, $offset);
        $params = $encryptService->encryptParams($params);
        $uri .= '&' . http_build_query($params);
        return $uri;
    }

    private function getParamsFields($word, $type = 1, $limit = 20, $offset = 0)
    {
        $params = [
            's' => $word,
            'type' => $type,
            'limit' => $limit,
            'offset' => $offset,
        ];
        return json_encode($params, JSON_UNESCAPED_UNICODE);
    }

    public function handleSearchResponse($data)
    {
        print_r($data);
    }

    public function getOffset($page, $count)
    {
        return ($page - 1) * $count;
    }
}
