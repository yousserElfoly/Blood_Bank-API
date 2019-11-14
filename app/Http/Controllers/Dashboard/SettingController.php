<?php

namespace App\Http\Controllers\Dashboard;

use App\Includes\AlertHelper;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting =  Setting::find($id);

        return view('dashboard.settings.edit', compact('setting'));
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
        $data = Validator::make($request->all(), [
            'title'             => 'required|string|min:2',
            'about_us'          => 'required|string',
            'logo'              => 'nullable|image|mimes:png,jpg,jpeg',
            'phone'             => 'required',
            'facebook_url'      => 'nullable|url',
            'twitter_url'       => 'nullable|url',
            'instagram_url'     => 'nullable|url',
            'youtube_url'       => 'nullable|url',
        ]);

        if ($data->fails() != false) {
            AlertHelper::error($data->errors());
            exit();
        }

        $setting = Setting::find($id);
        $past_logo = $setting->logo;
        $setting->fill($request->all());
        if(Request('logo')) {
            $past_logo != 'doctor.png'?Storage::delete($past_logo):'';
            $setting->logo = $request->file('logo')->store('logo');
        } else {
            $setting->logo = $past_logo;
        }
        $setting->save();
        AlertHelper::done('تمت عمليه الحفظ بنجاح', route('dashboard.index'));
    }

}
