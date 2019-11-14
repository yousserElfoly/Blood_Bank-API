<?php

namespace App\Http\Controllers\Dashboard;

use App\BloodType;
use App\Includes\AlertHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class bloodTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_bloodTypes'])->only('index');
        $this->middleware(['permission:create_bloodTypes'])->only('create');
        $this->middleware(['permission:update_bloodTypes'])->only('edit');
        $this->middleware(['permission:delete_bloodTypes'])->only('destroy');

    }//end of constructor

    public function index()
    {
        $bloodTypes = BloodType::all();
        return view('dashboard.bloodTypes.index', compact('bloodTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.bloodTypes.create');
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
        ]);

        if($validator->fails() != false) {
            AlertHelper::error($validator->errors());
            exit();
        }

        $bloodType = new BloodType();
        $bloodType->fill($request->all());
        $bloodType->save();

        AlertHelper::done('تمت عمليه الحفظ بنجاح',route('dashboard.bloodTypes.index'));
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
        $bloodType = BloodType::find($id);
        return view('dashboard.bloodTypes.edit', compact('bloodType'));
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
        ]);

        if($validator->fails() != false) {
            AlertHelper::error($validator->errors());
            exit();
        }

        $bloodType = BloodType::find($id);
        $bloodType->fill($request->all());
        $bloodType->save();

        AlertHelper::done('تمت عمليه التعديل بنجاح',route('dashboard.bloodTypes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $record = BloodType::findOrFail($id);
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
