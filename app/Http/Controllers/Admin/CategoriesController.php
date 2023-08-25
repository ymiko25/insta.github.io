<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller
{
     private $category;
     private $post;
     private $categories;

     public function __construct(Category $category, Post $post){
        $this->category = $category;
        $this->post = $post;
        $this->categories = $category;
     }

     public function index(){
        $all_categories= $this->category->latest()->paginate(10);

        $uncategorized_count = 0;
        $all_posts = $this->post->all();

        foreach($all_posts as $post){
            if($post->categoryPost->count() == 0){
                 $uncategorized_count++;
            }
        }

        return view('admin.categories.index')->with('all_categories', $all_categories)->with('uncategorized_count', $uncategorized_count);
     }

     public function store(Request $request)
     {
        $request->validate([
            'name' => 'required|min:1|max:50|unique:categories,name'
        ]);

        $this->category->name = ucwords(strtolower($request->name));
        $this->category->save();

        return redirect()->back();
     }

     public function update(Request $request, $id){
        $request->validate([
            'new_name'    => 'required|min:1|max:50|unique:categories,name,' . $id
    
        ]);

        $category = $this->category->findOrFail($id);
        $category->name = ucwords((strtolower($request->new_name)));
        $category->save();

        return redirect()->back();

        }

     public function destroy($id){
        $category = $this->categories->findOrFail($id);
        $category->delete();

         return redirect()->back();
     }
}


