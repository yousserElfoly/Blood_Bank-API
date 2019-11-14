<?php

namespace App\Http\Controllers\Dashboard;

use App\Client;
use App\BloodType;
use App\City;
use App\Includes\AlertHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct() {

         //create read update delete
        $this->middleware(['permission:read_clients'])->only('index');
        $this->middleware(['permission:create_clients'])->only('create');
        $this->middleware(['permission:update_clients'])->only('edit');
        $this->middleware(['permission:delete_clients'])->only('destroy');
     }

    public function index()
    {
        $clients = Client::all();
        return view('dashboard.clients.index', compact('clients'));
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
        return view('dashboard.clients.create', compact('bloodTypes','cities'));
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
            'username'                  => 'required',
            'email'                     => 'required|unique:clients|max:255',
            'date_of_birth'             => 'required',
            'blood_type_id'             => 'required',
            'last_donation'             => 'required',
            'city_id'                   => 'required',
            'phone'                     => 'required|unique:clients',
            'password'                  => 'required|confirmed',
            'password_confirmation'     => 'required',
        ]);

        if($validator->fails() != false) {
            AlertHelper::error($validator->errors());
            exit();
        }

        //$request->merge(['password' => bcrypt($request->password)]);
        $client = new Client();
        $client->fill($request->all());
        $client->password  = bcrypt(Request('password'));
        $client->api_token = str_random(60);
        $client->save();

        AlertHelper::done('تمت عمليه الحفظ بنجاح',route('dashboard.clients.index'));
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
        $client = Client::find($id);
        $bloodTypes = BloodType::all();
        $cities = City::all();
        return view('dashboard.clients.edit', compact('client','bloodTypes','cities'));
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
        $validator = Validator::make($request->all(), [
            'username'                  => 'required',
            'email'                     =>  [
                                            'required',
                                            'email',
                                            Rule::unique('clients', 'email')->ignore($id)
                                            ],
            'date_of_birth'             => 'required',
            'blood_type_id'             => 'required',
            'last_donation'             => 'required',
            'city_id'                   => 'required',
            'phone'                     => [
                                            'required',
                                            Rule::unique('clients', 'phone')->ignore($id)
                                            ],
        ]);

        if($validator->fails() != false) {
            AlertHelper::error($validator->errors());
            exit();
        }

        $client =  Client::find($id);
        $client->fill($request->all());
        $client->save();

        AlertHelper::done('تمت عمليه التعديل بنجاح',route('dashboard.clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Client::findOrFail($id);
        if (!$record) {
            return response()->json([
                'status'  => 0,
                'message' => 'تعذر الحصول على البيانات'
            ]);
        }
        $record->delete();
        return response()->json([
            'status'  => 1,
            'message' => 'تم الحذف بنجاح',
            'id'      => $id
        ]);
        // session()->flash('success', trans('site.deleted_successfully'));
    }
}
