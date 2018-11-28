<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image as ImageInt;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Story;
use App\Models\Moment;

class PostController extends Controller
{

    public function index(){
        $posts = Post::with(['stories' => function($query){$query->with('moments');}])->orderBy('created_at', 'DESC')->get();
        
        return response()->json($posts);
    }

    public function show($id){
        
        $post = Post::where('id', $id)->with(['stories' => function($query){$query->with('moments');}])->orderBy('created_at', 'DESC')->get();
        
        return response()->json($post);

        
    }

    public function store(Request $request)
    {

        $request->validate([
            'name_author' => 'required|min:2|max:55',
            'title' => 'required|min:2|max:55',
            'description' => 'required|min:5',
            'image' => 'required|image',
            'name' => 'min:2|max:55',
            'date' => 'nullable|date|before:tomorrow'
        ]);

        if ($request->hasFile('image')) {
            $request->file('image')->store('public/images');
        }

        $image = 'images/' . $request->file('image')->hashName();

        $requestPostId = Post::create([
            'name_author' => $request->name_author,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
        ])->id;

        //dd($request->stories);
        if ($request->stories !== "null") {
            $stories = json_decode($request->stories);
            foreach ($stories as $story) {
                $requestStoryId = Story::create([
                    'name' => $story->name,
                    'post_id' => $requestPostId
                ])->id;

                    if($story->moments){
                        foreach ($story->moments as $moment) {
                        Moment::create([
                            'date' => $moment->date?$moment->date:null,
                            'title' => $moment->title,
                            'description' => $moment->description,
                            'story_id' => $requestStoryId
                        ]); 
                        }
                    }
            }
        }
       
        return response()->json(['success' => true]);
    }
}
