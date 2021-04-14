<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $articles = Article::with('user')->get();

        foreach($articles as $article){
            $article['Writer'] = $article['user'];
            unset($article['user']);
        }

        return response([ 'articles' => $articles, 'status' =>200]);
      
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'title' => 'min:10',
            'content' => 'min:20',
        ]);
       

        $article = Article::Create([
            'title' => $data['title'],
            'user_id' => auth()->user()->id,
            'content' => $data['content']
        ]);

       
        return response([ 'message' => 'Article successfully created', 'article' => $article, 'status' =>200]);
      
    }

    public function show(Article $article)
    {
        $response = ['message' => 'show function'];
        return response($response, 200);
    }

    public function update(Request $request, Article $article)
    {
        
        if($article->user->id <> auth()->user()->id){
            $response = ['error' => 'You cannot edit other writer article'];

            return response($response, 403);
        }else{
            $article->update($request->all());

            $response = ['message' => 'Article successfully updated', 'article' => $article ];

            return response($response, 200);
        }
    }

    public function destroy(Article $article)
    {
        
        if($article->user->id <> auth()->user()->id){
            $response = ['error' => 'You cannot delete other writer article'];

            return response($response, 403);
        }else{
            $article->delete();

            $response = ['message' => 'Article successfully deleted'];

            return response($response, 200);
        }

      
        

        
        dd($article->user()->id);
    }
}
