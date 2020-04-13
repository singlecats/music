<?php
/**
 * SearchController.php
 * author lwz
 * time 2020/1/29
 */

namespace App\Http\Controllers\Home;


use App\Response\ApiResponse;
use Illuminate\Http\Request;
use Service\SearchService;

class SearchController
{

    public function searchName(Request $request)
    {
        $word = $request->get('word');
        $page = $request->get('page', 1);
        $count = $request->get('count', 2);
        $data = [];
        $searchService = new SearchService();
        $response = $searchService->searchByName($word, $page, $count);
        if ($response->getStatusCode() == '200') {
            $data = $response->getBody()->getContents();
            if (!empty($data)) {
                return $data;
            }
        }
        return ApiResponse::withJson($data);
    }
}
