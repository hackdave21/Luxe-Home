<?php

use App\Models\Post;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('/blog')-> name('blog.') ->group(
    function () {
        Route::get('/', function(Request $request) {

            $post =  Post::all();
           // dd($post);
            return $post;


            //Model Articles et sauvegarde dans la base de données
             $article = new Article();
             $article -> name ="Sofa";
             $article -> description ="Cet article est de qualité";
             $article -> price = 100;
             $article -> save();
             return $article;


            return [
                // "name" => $request ->input("name", "John Smith"),
                // "age" => $request ->input("age", "15"),
                // "article" => "verre",
                "link" => \route('blog.show', ['slug' => 'articles', 'id'=>14])
            ];
        })->name('index');

        Route::get("/{slug}/{id}", function(string $slug, string $id, Request $request){
            return [
                'slug' => $slug,
                'id' => $id,
                'name' => $request->input('name', 'John Doe'),
                'age' => $request->input('age', '25'),

            ];
        })-> where(
            ['slug'=> '[a-zA-Z0-9-_]+',
            'id'=> '[0-9]+']
        )->name('show');

    }
);


