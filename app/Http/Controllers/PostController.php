<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use SebastianBergmann\Environment\Console;

class PostController extends Controller
{

    function __construct()
    {
        $this->url = "https://jsonplaceholder.typicode.com/posts";
    }

    function global()
    {
        $response = Http::withOptions(['verify' => false])->get($this->url);
        $respon =  $response->json();
        return $respon;
    }

    public function index()
    {
        return $this->global();
    }

    public function show($id)
    {
        $respon = Http::withOptions(['verify' => false])->get($this->url . $id);
        return $respon->json();
    }

    public function update(Request $request, $id)
    {
        $respon = Http::withOptions(['verify' => false])->put($this->url . $id, array(
            "userId" => $request['userId'],
            "id" => $request['id'],
            "title" => $request['title'],
            "body" => $request['body']
        ));
        
        return $respon->json();
    }

    public function destroy($id)
    {
        $respon = Http::withOptions(['verify' => false])->delete('https://jsonplaceholder.typicode.com/posts/' . $id);
        return $respon->json();
    }

    public function store(Request $request)
    {
        $respon = Http::withOptions(['verify' => false])->post($this->url, array(
            "userId" => $request['userId'],
            "id" => $request['id'],
            "title" => $request['title'],
            "body" => $request['body']
        ));
        return $respon->json();
    }
}
