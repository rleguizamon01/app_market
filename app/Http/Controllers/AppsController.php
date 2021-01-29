<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Schema;
use App\Models\Apps;
use DB;


class AppsController extends Controller
{
    public function showApps(){

        $totalapps = Apps::get();
        $apps = Apps::paginate(10);
        $categories = Categories::all()->sortByDesc('name');
        
        return view('apps', compact('totalapps','apps', 'categories'));
    }

    public function showCategoryApps($category){
        $totalapps = Apps::get();
        $apps = App\Models\Apps::where('category', $category)->paginate(10);
        $categories = App\Models\Categories::all()->sortByDesc('name');
        
        return view('apps', compact('totalapps', 'apps', 'categories'));
    }

    public function showAppDetails($id){
        
        $app = App\Models\Apps::where('app_id',$id)->firstOrFail();
        
        // Client view
        if(Auth::check() && Auth::user()->role == 'client'){
        $clientApps= App\Models\ClientApps::where('app_id', $id)->where('user_id', Auth::id())->get();

        $clientBoughtApp = $clientApps->where('has_bought', 1)->isNotEmpty();
        $clientAddedWishlist = $clientApps->where('has_bought', 0)->isNotEmpty();
        
        return view('app-details', compact('app', 'clientBoughtApp', 'clientAddedWishlist'));
        }

        // Dev view
        else{
            return view('app-details', compact('app'));
        }



    }
}
