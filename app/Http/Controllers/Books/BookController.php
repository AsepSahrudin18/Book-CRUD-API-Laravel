<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// import models
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        // dd($books);

        if($books){
            // membuat deskripsi/keterangan
        $data = [
            "message" => "Get All Resource",
            "data" => $books
        ];
        return response()->json($data, 200);
        }else{
            $data = [
                "message" => "Resource Not Found"
            ];
            return response()->json($data, 404);
        }
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
        $input = [
            'isbn' => $request->isbn,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'author' => $request->author,
            'published' => $request->published,
            'publisher' => $request->publisher,
            'pages' => $request->pages,
            'description' => $request->description,
            'website' => $request->website,
        ];

        $books = Book::create($input);
        
            $data = [
                "message"=>"Book is Created!",
                "data" => $books,
            ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $books = Book::find($id);
        // dd($books);

        if($books){
            // membuat deskripsi/keterangan
        $data = [
            "message" => "Get Detail Resource",
            "data" => $books
        ];
        return response()->json($data, 200);
        }else{
            $data = [
                "message" => "Resource Not Found"
            ];
            return response()->json($data, 404);
        }
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
        $books = Book::find($id);

        if($books){
            $input = [
                'isbn' => $request->isbn ?? $books->isbn,
                'title' => $request->title ?? $books->title,
                'subtitle' => $request->subtitle ?? $books->subtitle,
                'author' => $request->author ?? $books->author,
                'published' => $request->published ?? $books->published,
                'publisher' => $request->publisher ?? $books->publisher,
                'pages' => $request->pages ?? $books->pages,
                'description' => $request->description ?? $books->description,
                'website' => $request->website ?? $books->website,
                'created_at' => $request->created_at ?? $books->created_at,
                'updated_at' => $request->updated_at ?? $books->updated_at,
            ];

        $books->update($input);

        $data = [
            'message' => 'Resource is update successfully',
            'data' => $books
        ];

        return response($data, 200);
        
        }else{
            $data = [
                'message' => 'Resource not found',
            ];
            return response()->json($data, 404);
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
        $books = Book::find($id);

        if($books){
            
            $books->delete();

            $data = [
                "message" => "Resource is delete successfully",
            ];

        }else{
            $data = [
                'message' => 'Resource not found',
            ];
            
            return response()->json($data, 404);
        }
            return response()->json($data, 200);
        }
}