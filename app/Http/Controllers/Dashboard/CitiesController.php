<?php

namespace App\Http\Controllers\Dashboard;


use App\City;
use App\Governorate;
use App\Includes\AlertHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_cities'])->only('index');
        $this->middleware(['permission:create_cities'])->only('create');
        $this->middleware(['permission:update_cities'])->only('edit');
        $this->middleware(['permission:delete_cities'])->only('destroy');

    }//end of constructor
    public function index()
    {
        $cities = City::all();
        return view('dashboard.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $governorates = Governorate::all();
        return view('dashboard.cities.create', compact('governorates'));
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
            'name'                  => 'required',
            'governorate_id'        => 'required',
        ]);

        if($validator->fails() != false) {
            AlertHelper::error($validator->errors());
            exit();
        }

        $City = new City();
        $City->fill($request->all());
        $City->save();

        AlertHelper::done('تمت عمليه الحفظ بنجاح',route('dashboard.cities.index'));
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
        $city = City::find($id);
        $governorates = Governorate::all();
        return view('dashboard.cities.edit', compact('city','governorates'));
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
            'name'                  => 'required',
            'governorate_id'        => 'required',
        ]);

        if($validator->fails() != false) {
            AlertHelper::error($validator->errors());
            exit();
        }

        $city = City::find($id);
        $city->fill($request->all());
        $city->save();

        AlertHelper::done('تمت عمليه التعديل بنجاح',route('dashboard.cities.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = City::findOrFail($id);
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
