<?php

namespace App\Http\Controllers\Dashboard;

use App\Order;
use App\City;
use App\BloodType;
use App\Client;
use App\Notification;
use App\Token;
use App\Includes\AlertHelper;
use App\Includes\Helpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function __construct() {

        //create read update delete
       $this->middleware(['permission:read_orders'])->only('index');
       $this->middleware(['permission:create_orders'])->only('create');
       $this->middleware(['permission:update_orders'])->only('edit');
       $this->middleware(['permission:delete_orders'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('dashboard.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bloodTypes = BloodType::all();
        $cities = City::all();
        $clients = Client::all();
        return view('dashboard.orders.create', compact('bloodTypes','cities','clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            'client_id'           => 'required',
        ]);

        if($validator->fails() != false) {
            AlertHelper::error($validator->errors());
            exit();
        }

        // create order
        $order = new Order();
        $order->fill($request->all());
        $order->save();

        // get clients for this order
        $clientsIds = $order->city->governorate->clients()
        ->whereHas('blood_types', function ($query) use ($request, $order){
            $query->where('blood_types.id', $order->blood_type_id);
        })->pluck('clients.id')->toArray();

        if(count($clientsIds)) {

            // create notifications
            $notifications = $order->notifications()->create([
                'title' => 'لديك اشعار طلب داش ',
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

        AlertHelper::done('تمت عمليه الحفظ بنجاح',route('dashboard.orders.index'));

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
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
       // $order->notifications()->delete();
        $order->delete();
        return redirect('dashboard/orders');
    }
}
