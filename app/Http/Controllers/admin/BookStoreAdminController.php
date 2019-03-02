<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator ;
use Session;
use Crypt;
use Cookie;
use Carbon;
use File;

class BookStoreAdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Session::get('is_login') == false) {
            return redirect('/');
        }
        $client = new \GuzzleHttp\Client();

        $response_books =  $client->request('GET', 'localhost:8080/api/v1/books');
        $response_books = json_decode($response_books->getBody()->getContents());

        $response_category =  $client->request('GET', 'localhost:8080/api/v1/categories');
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
        $paginatedItems= new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
  
        // set url path for generted links
        $paginatedItems->setPath($request->url());

        return view('admin-panel/components.dashboard', compact('paginatedItems', 'response_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Session::get('is_login') == false) {
            return redirect('/');
        }
        $client = new \GuzzleHttp\Client();
        $response_category =  $client->request('GET', 'localhost:8080/api/v1/categories');
        $response_category = json_decode($response_category->getBody()->getContents());

        return view('admin-panel/components.form-new-book', compact('response_category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image_path = $request->file('image')->getPathName();
        $image_mime = $request->file('image')->getmimeType();
        $image_org  = $request->file('image')->getClientOriginalName();
        
        
        $client = new \GuzzleHttp\Client();
        
        $result = $client->post(
            'localhost:8080/api/v1/book/',
            [
                'headers' => [

                    'Authorization' => 'Bearer '.Crypt::decryptString(Cookie::get('token_jwt')),
                   
            ],
          
            'multipart' => [
                [
                    'name'     => 'image',
                    'filename' => $image_org,
                    'Mime-Type'=> $image_mime,
                    'contents' => fopen($image_path, 'r'),
                ],
                [
                    'name'     => 'title',
                    'contents' => $request->input('title'),
                ],
                
                [
                    'name'     => 'author',
                    'contents' => $request->input('author'),
                ],
                
                [
                    'name'     => 'description',
                    'contents' => $request->input('description'),
                ],
                
                [
                    'name'     => 'link',
                    'contents' => $request->input('link'),
                ],
                [
                    'name'     => 'featured',
                    'contents' => $request->input('featured'),
                ],
                [
                    'name'     => 'category_id',
                    'contents' => $request->input('category_id'),
                ]
            ]
            
        ]
        );

        if ($result) {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Session::get('is_login') == false) {
            return redirect('/');
        }
        $client = new \GuzzleHttp\Client();
        
        $result =  $client->request(
            'GET',
            'localhost:8080/api/v1/book/edit/'.$id,
            [

            'headers' => [

                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.Crypt::decryptString(Cookie::get('token_jwt')),
            ]
        ]
        );
        $result = json_decode($result->getBody()->getContents());

        $response_category =  $client->request('GET', 'localhost:8080/api/v1/categories');
        $response_category = json_decode($response_category->getBody()->getContents());

        return view('admin-panel/components.form-edit-book', compact('response_category', 'result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->getPathName();
            $image_mime = $request->file('image')->getmimeType();
            $image_org  = $request->file('image')->getClientOriginalName();
        
        
            $client = new \GuzzleHttp\Client();
        
            $result = $client->post(
            'localhost:8080/api/v1/book/update',
            [
                'headers' => [

                    'Authorization' => 'Bearer '.Crypt::decryptString(Cookie::get('token_jwt')),
                   
            ],
          
            'multipart' => [
                [
                    'name'     => 'image',
                    'filename' => $image_org,
                    'Mime-Type'=> $image_mime,
                    'contents' => fopen($image_path, 'r'),
                ],
                [
                    'name'     => 'title',
                    'contents' => $request->input('title'),
                ],
                
                [
                    'name'     => 'author',
                    'contents' => $request->input('author'),
                ],
                
                [
                    'name'     => 'description',
                    'contents' => $request->input('description'),
                ],
                
                [
                    'name'     => 'link',
                    'contents' => $request->input('link'),
                ],
                [
                    'name'     => 'featured',
                    'contents' => $request->input('featured'),
                ],
                [
                    'name'     => 'category_id',
                    'contents' => $request->input('category_id'),
                ],
                [
                    'name'     => 'book_id',
                    'contents' => $request->input('book_id'),
                ],
                [
                    'name'     => '_method',
                    'contents' => $request->input('_method'),
                ]
            ]
            
        ]
        );
        } else {
            $client = new \GuzzleHttp\Client();
        
            $result = $client->post(
                'localhost:8080/api/v1/book/update',
                [
                    'headers' => [
    
                        'Authorization' => 'Bearer '.Crypt::decryptString(Cookie::get('token_jwt')),
                       
                ],
              
                'form_params' => [
                    
                        'title'       => $request->input('title'),
                        'author'      => $request->input('author'),
                        'description' => $request->input('description'),
                        'link'        => $request->input('link'),
                        'image'       => $request->input('image'),
                        'category_id' => $request->input('category_id') ,
                        'featured'    => $request->input('featured') ,
                        'book_id'     => $request->input('book_id') ,
                        '_method'     => $request->input('_method')
                    
                ]
                
            ]
            );
        }
        

        if ($result) {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = new \GuzzleHttp\Client();
        $result = $client->request('DELETE', 'localhost:8080/api/v1/book/'.$id, [

            'headers' => [

                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.Crypt::decryptString(Cookie::get('token_jwt')),
            ]
        ]);
        if ($result) {
            return redirect()->back();
        }
    }
}
