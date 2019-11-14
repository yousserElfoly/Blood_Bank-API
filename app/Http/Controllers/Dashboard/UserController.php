<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use App\Includes\AlertHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');

    }//end of constructor
    public function index()
    {
        $users = User::whereRoleIs('admin')->latest()->get();
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.users.create');
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
            'email'                     => 'required|unique:users|max:255',
            'permissions'             => 'required',
            'password'                  => 'required|confirmed',
            'password_confirmation'     => 'required',
        ]);

        if($validator->fails() != false) {
            AlertHelper::error($validator->errors());
            exit();
        }

        $user = new User();
        $user->fill($request->all());
        $user->password  = bcrypt(Request('password'));
        $user->save();

        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);
        AlertHelper::done('تمت عمليه الحفظ بنجاح',route('dashboard.users.index'));
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
        if($id != 1) {
            $user = User::find($id);
            return view('dashboard.users.edit', compact('user'));
        } else {
            return "Sorry, you are forbidden from accessing this user.";
        }

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
            'email'                     =>  [
                                            'required',
                                            'email',
                                            Rule::unique('users', 'email')->ignore($id)
                                            ],
            'permissions'             => 'required',
        ]);

        if($validator->fails() != false) {
            AlertHelper::error($validator->errors());
            exit();
        }

        $user = User::find($id);
        $user->fill($request->all());
        $user->save();

        $user->syncPermissions($request->permissions);
        AlertHelper::done('تمت عمليه التعديل بنجاح',route('dashboard.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $record = User::findOrFail($id);
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
