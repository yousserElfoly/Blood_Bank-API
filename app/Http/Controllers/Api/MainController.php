<?php

namespace App\Http\Controllers\Api;


use App\Governorate;
use App\City;
use App\BloodType;
use App\Category;
use App\Setting;
use App\Article;
use App\Order;
use App\Client;
use App\Notification;
use App\Message;
use App\Token;
use Illuminate\Support\Facades\Validator;
use App\Includes\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{

    // list governorates
    public function governorates() {

        $governorates = Governorate::with('cities')->get();;

        return Helpers::responseJson(1, 'success', $governorates);
    }

    // list cities
    public function cities(Request $request) {

        $cities = City::where(function ($query) use ($request) {
            if($request->has('governorate_id')) {
                $query->where('governorate_id', $request->governorate_id);
            }

        })->with('governorate')->get();

        return Helpers::responseJson(1, 'success', $cities);
    }

    // list Blood Types
    public function bloodTypes() {

        $bloodTypes = BloodType::all();;

        return Helpers::responseJson(1, 'success', $bloodTypes);
    }

    // contact us

    public function contact(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email',
            'phone'     => 'required',
            'subject'   => 'required|max:20',
            'content'   => 'required',
        ]);

        if ($validator->fails()) {

            return Helpers::responseJson(0, 'Validator Error', $validator->errors());
        }

        $message = new Message();
        $message->fill($request->all());
        $message->save();
        return Helpers::responseJson(1, 'success', $message);
    }

    // settings

    public function settings() {
        $settings = Setting::first();
        return Helpers::responseJson(1, 'success', $settings);
    }

    // list categories
     public function categories() {
        $categories = Category::paginate(10);
        return Helpers::responseJson(1, 'success', $categories);
    }


    // list articles
    public function articles(Request $request) {

        $articles = Article::where(function($query) use ($request){
            if($request->search) {
                $query->where('title', 'like', '%'.$request->search.'%');
            }

            if($request->category) {
                $query->where('category_id', 'like', '%'.$request->category.'%');
            }
        })->with('category')->paginate(10);

        return Helpers::responseJson(1, 'success', $articles);
    }

    // article view

    public function articleView($id) {
        $article = Article::with('category')->find($id);
        return Helpers::responseJson(1, 'success', $article);
    }

    // toggle favourite Articles

    public function toggleFavourite(Request $request) {

        $validator = Validator::make($request->all(), [
            'article_id' => 'required',
        ]);

        if($validator->fails()) {
            return Helpers::responseJson(0, 'validator error', $validator->errors());
        }

        $toggle = $request->user()->articles()->toggle($request->article_id);

        return Helpers::responseJson(1, 'success', $toggle);

    }

    // my favourite Articles

    public function favouriteArticles(Request $request) {

        $articles = $request->user()->articles()->with('category')->latest()->paginate(10);
        return Helpers::responseJson(1, 'success', $articles);

    }

    // create Order

    public function createOrder(Request $request) {
        $validator = Validator::make($request->all(), [
            'full_name'           => 'required',
            'age'                 => 'required',
            'blood_type_id'       => 'required',
            'quantity'            => 'required',
            'hospital_name'       => 'required',
            'hospital_address'    => 'required',
            'latitude'            => 'nullable',
            'longitude'           => 'nullable',
            'city_id'             => 'required',
            'phone'               => 'required',
            'notes'               => 'required',

        ]);

        if($validator->fails()) {
            return Helpers::responseJson(0, 'validator error', $validator->errors());
        }

        // create order
        $order = new Order();
        $order->fill($request->all());
        $order->client_id = auth()->user()->id;
        $order->save();

        // get clients for this order
        $clientsIds = $order->city->governorate->clients()
        ->whereHas('blood_types', function ($query) use ($request, $order){
            $query->where('blood_types.id', $order->blood_type_id);
        })->pluck('clients.id')->toArray();

        if(count($clientsIds)) {

            // create notifications
            $notifications = $order->notifications()->create([
                'title' => 'لديك اشعار طلب تبرع جديد',
                'content'   => $order,
            ]);

            // attach notifications with clients
            $notifications->clients()->attach($clientsIds);

            $tokens = Token::whereIn('client_id',$clientsIds)->where('token','!=',null)->pluck('token')->toArray();
            //dd($tokens);
            // ["asihdgasjdhlasd", "abskdaskldjasd","aksdansd,mamsnd"]
            if (count($tokens))
            {
                $title = $notifications->title;
                $body = $notifications->content;
                $data = [
                    'order_id' => $order->id
                ];
                $send = Helpers::notifyByFirebase($title, $body, $tokens, $data);
                info("firebase result: " . $send);
//              info("data: " . json_encode($data));
            }

        }
        return Helpers::responseJson(1, 'تم الاضافه بنجاح', compact('order'));
    }

    // view all Orders
    public function orders() {
        $orders = Order::with('blood_type')->paginate('10');
        return Helpers::responseJson(1, 'success', $orders);
    }

    // view Order
    public function orderView($id) {
        $order = Order::with('blood_type')->find($id);
        return Helpers::responseJson(1, 'success', $order);
    }

    // create Settings Notifications

    public function createSttNotifications(Request $request) {

        $validator = validator()->make($request->all(),[
            'governorates.*' => 'exists:governorates,id',
            'bloodtypes.*' => 'exists:blood_types,id',
        ]);
        if($validator->fails())
        {
            return Helpers::responseJson(0, 'Validator Error', $validator->errors());
        }
        if($request->has('governorates'))
        {
            $request->user()->governorates()->sync($request->governorates);
        }
        if($request->has('bloodtypes'))
        {
            $request->user()->blood_types()->sync($request->bloodtypes);
        }
        $data = [
            'governorates' => $request->user()->governorates()->pluck('governorates.id')->toArray(),
            'bloodtypes' => $request->user()->blood_types()->pluck('blood_types.id')->toArray(),
        ];
        return Helpers::responseJson(1, 'تم التحديث',$data);
    }


    // my all notifications

    public function myAllNotifications() {
        $notifications = Notification::whereHas('clients', function ($query) {

            $query->where('clients.id', auth()->user()->id);
        })->get();

        return Helpers::responseJson(1, 'success', $notifications);
    }


}
