<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Category;


class PostController extends Controller
{
    private $post;

    private $category;


    public function __construct(Post $post, Category $category){
        $this->post     = $post;
        $this->category = $category;
    }

    public function create(){
        $all_categories = $this->category->all();
        return view('users.posts.create')->with('all_categories', $all_categories);
    }

    public function store(Request $request){
        // Validate all the form data
        $request->validate([
            'category' => 'required|array|between:1,3',
            'description' => 'required|min:1|max:1000',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:1048'
        ]);
 
        // Save the post
        $this->post->user_id = Auth::user()->id;
        $this->post->image = 'data:image/' . $request->image->extension(). ';base64,' .
        base64_encode(file_get_contents($request->image));
        $this->post->description = $request->description;
        $this->post->save();

        // save the categories to the category_post table
        foreach($request->category as $category_id){
            $category_post[] = ['category_id' => $category_id];
        }

        $this->post->categoryPost()->createMany($category_post);  // createMany() accepts 2D array
        // Given
        // $this->post->id = 2
        //$request->category = [1,4];

        // After the foreach loop....
        // $category_post = [
        //   ['category_id' => 1],
        //   ['category_id' => 4]
        // ];

        // After the $this->post->categoryPost()
        // $category_post = [
        //    ['category_id' => 1, 'post_id => 2'],
        //    ['category_id' => 4, 'post_id => 2'].
        // ];
        // createMany() accepts 2D array ($category_post) and saves it into category_post table
           
        //back to homepage
        return redirect()->route('index');
        }
        public function show($id){
            $post = $this->post->findOrFail($id);

            return view('users.posts.show')->with('post', $post);
        }

        public function edit($id){
            $post = $this->post->findOrFail($id);

            # if the Auth user is NOT the owner of the post
            if (Auth::user()->id !=$post->user->id) {
                return redirect()->route('index');
            }

            $all_categories = $this->category->all();

            # get all the category IDs of this Post. save in an array
            $selected_categories = [];
            foreach($post->categoryPost as $category_post){
                $selected_categories[] = $category_post->category_id;
            }

            return view('users.posts.edit')
                    ->with ('post', $post)
                    ->with ('all_categories', $all_categories)
                    ->with ('selected_categories', $selected_categories);
        }

        public function update(Request $request, $id){
            // 1. validate the date from the form
            $request->validate([
                'category' => 'required|array|between:1,3',
                'description' => 'required|min:1|max:1000',
                'image' => 'mimes:jpg,jpeg,png,gif|max:1048'
            ]);

            // 2.Update the post
            $post = $this->post->findOrFail($id);
            $post->description = $request->description;

            // if there is a new image
            if($request->image){
                $post->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
            }

            $post->save();

            // 3. Delete all records from the category_post relatd to this post
            $post->categoryPost()->delete();
            // USe the relationship Post::categoryPost() to select the records related to a post
            // Equivalent to : DELETE FROM category_post WHERE post_id = $post

            // 4. save the new categories to category_post table
            foreach($request->category as $category_id){
                $category_post[] = ['category_id' => $category_id];
            }
            $post->categoryPost()->createMany($category_post);  // createMany serves 2d arrays

            // 5.redirect to show post page (to confirm the update records)
            return redirect()->route('post.show', $id);
        }

        public function destroy($id){
            $post = $this->post->findOrFail($id);
            $post->delete();

            return redirect()->route('index');
        }
    }

