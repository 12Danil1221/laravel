<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Post;
use App\Models\Registration;
use App\Models\Registration2;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Categories $category)
    {
        $post = Post::with('category')->findOrFail($category);
        $posts = Post::all();

        return view('welcome', compact('posts', 'post'));
    }

    public function register2(Request $request, $postId)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        Registration::create([
            'user_id' => auth()->id(),
            'post_id' => $postId,
        ]);



        return redirect()->route('home')->with('success', 'Вы записались на мероприятие!');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],

        ]);

        $post = Post::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->id()
        ]);

        $post->categories()->attach($request->categories_id);

        return redirect()->route('home')->with('success', 'Мероприятие добавлено');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $category, Post $post)
    {
        return view('admin.editcategory', compact('category'));


    }
    public function edit2(Post $post)
    {

        return view('user.editpost', compact('post'));

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Данные категории обновлены!');
    }
    public function update2(Request $request, Post $post)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $post->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Данные категории обновлены!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyAdminPost(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Мероприятие удалено!');
    }

    public function destroyUserPost(Post $post)
    {
        $post->delete();

        return redirect()->route('home')->with('success', 'Мероприятие удалено!');
    }

    public function destroyAdminCategory(Categories $category)
    {
        $category->delete();

        return redirect()->route('home')->with('success', 'Категория удалена!');
    }
}