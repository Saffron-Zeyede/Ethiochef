<?php

namespace App\Http\Controllers;

use App\Category;
use App\Food;
use App\Http\Requests\MessageRequest;
use App\Message;
use Illuminate\Http\Request;

class EthiochefController extends Controller
{
    public function confirm(Request $request){
        $phone = $request->get('phonenumber');
        $phonenumber = '251'.$phone;
//        dd($phonenumber);
//        $response = $request->post('https://integrityconsultancyservice.com/verifyuser.php?phonenumber='.$phonenumber);
//        dd($response);

//        if ($response === 'wrong input'){
//            $message = 'invalid value for phonebook parameter';
//        }
//        elseif ($response === 'invalid'){
//            $message = 'the user is not our user';
//        }
        // if the response is a four digit number...
//        else{
//            return view('ethiochef.confirmation')->with('phonenumber', $phonenumber)->with('response', $response);
//        }

        return view('ethiochef.confirmation')->with('phonenumber', $phonenumber);

    }

    public function ethiochef(){
        $search_query = request()->query('search');
        if ($search_query){
            $foods = Food::where('name', 'LIKE', "%{$search_query}%")->paginate(6);
        }
        else{
            $foods = Food::paginate(6);
        }

        return view('ethiochef.ethiochef')->with('categories', Category::all())->with('foods', $foods);
    }

    public function detail(Food $food)
    {
        return view('ethiochef.detail')->with('categories', Category::all())->with('food', $food);
    }
    public function category(Category $category){

        // find trashed posts where the id = id;
//        $cat = Category::where('id', $id)->first();
//        $foods = Food::where('category_id', $cat->id)->paginate(1);

        return view('ethiochef.categories')
            ->with('category', $category)
            ->with('foods', $category->foods()->paginate(6))
            ->with('categories', Category::all());
    }

    public function contact(){
        return view('ethiochef.contact')->with('categories', Category::all());
    }

    public function message(MessageRequest $request){

        Message::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message
        ]);

        session()->flash('success', 'Thank you for contacting us, We will get back to you  on it.');

        // redirect ...
        return redirect(route('ethiochef'));
    }
}
