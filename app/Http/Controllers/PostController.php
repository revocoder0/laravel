<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Auth;
use App\Category;
use File;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //index function
        /*$post=Post::FindOrFail($id);*/
        $posts=Post::orderby('id', 'DESC')->get();
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create function
        $categories=Category::all();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Store function
        $request->validate([
        'title' => 'required|unique:posts|max:255',
        'description' => 'required|string',
        'category' => 'required|string',
        'image' => 'required|mimes:jpg,jpeg,png|image|max:5000',
    ]);

        if ($request->hasFile('image')) {
            $title=$request->title;
            $description=$request->description;
            $category_id=$request->category; 

            $image=$request->file('image');
            $path=public_path('/storage/uploads/');
            $name=time().".".$image->getClientOriginalExtension();
            $image->move($path, $name);
        }

       
        

         $post= new Post;
         $post->title=$title;
         $post->description=$description;
         $post->user_id=Auth::user()->id;
         $post->category_id=$category_id;
         $post->image=$name;

         if ($post->save()) {
             return redirect('/posts');
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
        
      /* $post=Post::FindOrFail($id);*/
      if ( $post=Post::find($id)) {
          return view('post.show', compact('post'));
      }else{
        return redirect()->back();
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
        $categories=Category::all();
        $post=Post::FindOrFail($id);
        return view('post.edit', compact('post', 'categories'));
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
        $dataValidate=$request->validate([
            'title' => 'required|max:255',
            'description' => 'required|string',
            'category' => 'required|string', 
            'image' => 'required|mimes:jpg,jpeg,png|image|max:5000',
        ]);
        $post=Post::FindOrFail($id);
            if($request->hasFile('image')){
                $image=$request->file('image');
                $path=public_path('/storage/uploads/');
                $name=time().".".$image->getClientOriginalExtension();
                $image->move($path, $name);
                
                /*if(File::exists($post->image)) {
                    $oldname=$post->image;
                File::delete($name.''.$oldname);
             }*/
             if(isset($post->image)){
                    $oldname=$post->image;
                File::delete($path.''.$oldname);
             }

               $post->image=$name;
            }
            

        $title=$request->title;
        $description=$request->description;
        $category_id=$request->category; 
        $post->title=$title;
        $post->description=$description;
        $post->category_id=$category_id;
        

        $post->save();
        return redirect()->back()->with('success', 'Record Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $post=Post::findOrFail($id);
        $path=public_path('/storage/uploads/');
            if(isset($post->image)){
                    $oldname=$post->image;
                File::delete($path.''.$oldname);
        }
        if (Post::where('id', $id)->delete()) {
           return redirect()->back()->with('success', 'Record Delete Successfully!');
        }else{
             return redirect()->back();
        }
    }
}
