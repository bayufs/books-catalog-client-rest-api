<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BooksByCategoryController extends Controller
{
    public function getBooksByCategory($id)
    {
        $client = new \GuzzleHttp\Client();
        $response_books =  $client->request('GET', 'localhost:8080/api/v1/books/category/'.$id);
        $response_books = json_decode($response_books->getBody()->getContents());

        $response_category =  $client->request('GET', 'localhost:8080/api/v1/categories');
        $response_category = json_decode($response_category->getBody()->getContents());

        $results = $response_books->data;
        //dd($results);
        return view('frontend/components.page-by-category', ['results' => $results, 'response_category' => $response_category]);
    }
}
