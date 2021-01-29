<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apps;
use App\Models\Categories;
use App\Models\ClientApps;
use Auth;
use File;


class DeveloperAppsController extends Controller
{
    public function create(){
        $categories = Categories::all();
        return view('dev-upload-app', compact('categories'));
    }

    public function post(Request $request){

        $validated = $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|numeric|between:0,100000',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $newApp = new Apps;
        $newApp->name = $request->name;
        $newApp->price = $request->price;
        $newApp->category = $request->category;
        $newApp->developer_id = Auth::id();
        
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);
        $newApp->photo = $imageName;
        
        $newApp->save();
        return redirect()->route('dev.create')
        ->with('status', 'App was uploaded succesfully!');
    }

    public function edit($id){
        $app = Apps::findOrFail($id);
        return view('dev-edit-app', compact('app'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'price' => 'required|numeric|between:0,100000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $app = Apps::findOrFail($id);
        $app->price = $request->price;

        if(File::exists('/images/'.$app->image)) {
            File::delete('/images/'.$app->image);
        }

        $app->app_id = $id;
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);

        $app->photo = $imageName;
        
        
        $app->save();

        return redirect()->route('dev.edit', $id)
        ->with('status', 'App was edited succesfully!');
    }

    public function delete($id){
        Apps::where('app_id', $id)->firstOrFail()->delete();
        ClientApps::where('app_id', $id)->delete();

        return redirect()->route('auth.apps');
    }


}
