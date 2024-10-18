<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Get the search term from the request
        $searchQuery = $request->query('q', '');
        $limit = $request->query('limit', 10); 
        $skip = $request->query('skip', 0);

        // Determine the correct URL based on the presence of the search query
        $url = $searchQuery
            ? "https://dummyjson.com/products/search"
            : "https://dummyjson.com/products";

        // Set up the query parameters for pagination
        $queryParams = [
            'limit' => $limit,
            'skip' => $skip,
        ];

        // If there's a search term, include it in the request parameters
        if ($searchQuery) {
            $queryParams['q'] = $searchQuery;
        }

        // Fetch the products from DummyJSON API
        $response = Http::get($url, $queryParams);

        // Return the fetched data as a JSON response
        return response()->json($response->json());
    }
}
