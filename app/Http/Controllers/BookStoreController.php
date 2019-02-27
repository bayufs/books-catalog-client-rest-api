<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator ;
use Illuminate\Support\Facades\Input;

class BookStoreController extends Controller
{
    protected $client; 
    protected $curent_page;

    public function __construct()
    {
       $this->client =  new \GuzzleHttp\Client(); 
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
      
        $response_books =  $this->client->request('GET', 'localhost:8080/api/v1/books');
        $response_books = json_decode($response_books->getBody()->getContents());
        
        
        $response_category =  $this->client->request('GET', 'localhost:8080/api/v1/categories');
        $response_category = json_decode($response_category->getBody()->getContents());

       // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
 
        // Create a new Laravel collection from the array data
        $itemCollection = collect($response_books->data);
 
        // Define how many items we want to be visible in each page
        $perPage = 6;
 
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
 
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
 
        // set url path for generted links
        $paginatedItems->setPath($request->url());
        
        //  dd($paginatedItems);

        return view('frontend/components.home', ['results' => $paginatedItems, 'response_category' => $response_category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Responseresults
     */
    public function show($id)
    {
        $response_books =  $this->client->request('GET', 'localhost:8080/api/v1/book/'.$id);
        $response_books = json_decode($response_books->getBody()->getContents());

        $response_category =  $this->client->request('GET', 'localhost:8080/api/v1/categories');
        $response_category = json_decode($response_category->getBody()->getContents());

        $results =  $response_books->data;
       
       // dd($response_books);
        return view('frontend/components.detail', compact('results','response_category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
