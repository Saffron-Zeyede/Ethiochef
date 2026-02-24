<?php

namespace App\Http\Controllers;

use App\Category;
use App\Food;
use App\Http\Requests\CreateFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $search_query = request()->query('search');
//        if ($search_query){
//            dd($search_query);
//            dd(Food::where('name', 'LIKE', "%{$search_query}%"));

//            $foods = Food::where('name', 'LIKE', "%{$search_query}%");
//        }
//        else{
//            $foods = Food::all();
//        }
        $foods = Food::all();

        return view('admin.foods')->with('foods', $foods);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create-food')->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFoodRequest $request)
    {
        // upload the image
        $image = $request->image->store('foods');

        // upload the video
        $video = $request->video->store('foods');

        Food::create([
            'name'=>$request->name,
            'image'=>$image,
            'video'=>$video,
            'ingredient'=>$request->ingredient,
            'instruction'=>$request->instruction,
            'category_id' =>$request-> category
        ]);

        // create a flash message after storing a category into the database.
        session()->flash('success', 'Food created successfully');

        // redirect ...
        return redirect(route('foods.index'));

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
    public function edit(Food $food)
    {
        return view('admin.create-food') ->with('food', $food)->with('categories', Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFoodRequest $request, Food $food)
    {
        // request only for the following attributes, nothing more
        $data = $request->only(['name', 'image', 'video', 'ingredient', 'instruction', 'category_id']);
        $data['category_id'] = $request['category'];

        // check if new image is provided
        if ($request->hasFile('image')){

            //upload the image to the 'categories' folder
            $image = $request -> image -> store('foods');

            // delete the old image
            Storage::delete($food -> image);
            //$post -> deleteImage();

            $data['image'] = $image;
        }

        // check if new video is provided
        if ($request->hasFile('video')){

            //upload the video to the 'categories' folder
            $video = $request -> video -> store('foods');

            // delete the old image
            Storage::delete($food -> video);
            //$post -> deleteImage();

            $data['video'] = $video;
        }



        //dd($data);
        $food->update($data);

        // flash a message
        session() -> flash('success', 'Food updated successfully');

        // redirect
        return redirect(route('foods.index'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // fetch the trashed food where id=$id
        $food = Food::withTrashed()->where('id', $id)->firstOrFail();

        // if the food is trashed, delete it permanently. else, trash it first
        if($food -> trashed()){

            // to delete the image
            Storage::delete($food->image);
            //$food -> deleteImage();

            // delete the food permanently
            $food->forceDelete();
        }
        else{
            $food->delete();
        }
        // flash a message
        session() -> flash('success', 'Food Deleted Successfully');

        return redirect(route('foods.index'));
    }


    public function trashed(){
        $trashed = Food::onlyTrashed()->get();
        // then, return the view with the trashed foods
        return view('admin.deleted-foods')->withFoods($trashed);
    }

    public function restore($id){
        // find the trashed food where the id = $id
        $food = Food::withTrashed()->where('id', $id)->firstOrFail();

        $food->restore();

        session() -> flash('success', 'Food restored successfully');
        return redirect() -> back();
    }
}
