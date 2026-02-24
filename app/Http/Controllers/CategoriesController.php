<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('admin.categories') ->with('categories', $category);

        // another option of return a view with data
//        return view('admin.categories')->with('categories', Category::all());


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create-categories');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        // upload the image
        $image = $request->image->store('categories');

        // create the category
        Category::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>$image

        ]);

        // create a flash message after storing a category into the database.
        session()->flash('success', 'Category created successfully');

        // redirect ...
        return redirect(route('categories.index'));
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.create-categories')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // request only for the following attributes, nothing more
        $data = $request->only(['name', 'image', 'description']);


        // check if new image is provided
        if ($request->hasFile('image')){

            //upload the image to the 'categories' folder
            $image = $request -> image -> store('categories');

            // delete the old image
            Storage::delete($category -> image);
//            Storage::delete($category -> image);
            //$post -> deleteImage();

            $data['image'] = $image;
        }


        // update attributes
        $category -> update($data);

        // flash a message
        session() -> flash('success', 'Category updated successfully');

        // redirect
        return redirect(route('categories.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // before deleting a category check if there is a post that belongs to that category
        if ($category->foods()->count() > 0){
            session() -> flash('error', 'Category cannot be deleted because it has some posts');
            return redirect()->back();
        }

        $category->delete();
        session()->flash('success', 'Category Deleted Successfully');

        return redirect(route('categories.index'));
    }
}
