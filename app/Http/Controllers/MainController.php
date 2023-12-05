<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use DB;

class MainController extends Controller
{
    public function index ()
    {
        $random_posts = Post::inRandomOrder()->limit(2)->get();
        $posts = Post::orderBy('created_at', 'desc')->paginate(9);
        $oldest_posts = Post::orderBy('created_at', 'asc')->limit(2)->get();
        $most_commented_posts = Post::join('comments', 'posts.id', '=', 'comments.post_id')
                ->select('posts.id', 'posts.title', 'posts.description', 'posts.slug', 'posts.featured_image', DB::raw('count(comments.id) as comments_count'))
                ->groupBy('posts.id', 'posts.title', 'posts.description', 'posts.slug', 'posts.featured_image')
                ->orderBy('comments_count', 'desc')
                ->limit(1)
                ->get();


        return view('blog.home', compact('posts', 'random_posts', 'oldest_posts', 'most_commented_posts'));
    }

    public function singlePost($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $latest_posts = Post::orderBy('created_at', 'desc')->paginate(3);
        $categories = Category::all();
        return view ('blog.single_blog', compact('post', 'categories', 'latest_posts'));
    }

    public function singleCategory($slug)
    {
        $latest_posts = Post::orderBy('created_at', 'desc')->paginate(3);
        $categories = Category::all();
        $category = Category::where('slug', $slug)->first();
        return view('blog.posts_list', compact('category', 'categories', 'latest_posts'));
    }

    public function passwordChecker ()
    {
        return view('tools.password-checker');
    }

    public function passwordGenerator ()
    {
        return view('tools.password-generator');
    }

    public function fileScanner ()
    {
        return view('tools.file-scanner');
    }

    public function urlScanner ()
    {
        return view('tools.url-scanner');
    }


    public function commentStore (Request $request, $post)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required'
        ]);

        Comment::create([
            'post_id' => $post,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'status' => 1
        ]);

        return redirect()->back();
    }
}
