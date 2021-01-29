<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Models\ClientApps;
use Auth;
use App\Models\User;
use App\Models\Categories;
use App\Models\Apps;



class AuthAppsController extends Controller
{

    public function showAuthApps(){

        // Client Apps
        if(Auth::user()->role == 'client'){

            $totalapps = ClientApps::get()->where('user_id', Auth::id())->where('has_bought', 1);
            $apps = ClientApps::with('apps')->where('user_id', Auth::id())->where('has_bought', 1)->paginate(10);
            $categories = Categories::all();
            $current_category = null;
            
            return view('auth-apps', compact('totalapps', 'apps', 'categories', 'current_category'));
        }

        // Developer Apps
        elseif(Auth::user()->role == 'developer'){

            $totalapps =  Apps::get()->where('developer_id', Auth::id());
            $apps =  Apps::with('clientApps')->where('developer_id', Auth::id())->paginate(10);
            $categories = Categories::all();
            $current_category = null;


            return view('auth-apps', compact('totalapps','apps', 'categories', 'current_category'));
        }
    }

  /*  public function showAuthCategoryApps($category){

        // Client Category Apps
        
        $categoryCol = Categories::where('name',$category);
        if(Auth::user()->role == 'client'){

           $apps = ClientApps::with('user')->where('user_id', Auth::id())->where('has_bought', 1)->get();
           dd($apps);

           $totalapps = ClientApps::get()->where('user_id', Auth::id())->where('has_bought', 1);
           // $apps = ClientApps::with('user')->with('apps')->where('user_id', Auth::id())->where('has_bought', 1)->paginate(10);
            $categories = Categories::all();
            $current_category = $category;
            
            return view('auth-apps', compact('totalapps', 'apps', 'categories', 'current_category'));
        }

        // Developer Category Apps
        elseif(Auth::user()->role == 'developer'){

            




            $totalapps =  Apps::get()->where('developer_id', Auth::id());
            $apps =  Apps::where('developer_id', Auth::id())->where('category', $category);
            $categories = Categories::all();
            $current_category = $category;

            return view('auth-apps', compact('totalapps', 'apps', 'categories', 'current_category'));
        }
    }*/

    public function showAppDetails($id){
        $app = App\Models\Apps::findOrFail($id);

        $clientApps= App\Models\ClientApps::get()->where('app_id', $id)->where('user_id', Auth::id());

        $clientBoughtApp = $clientApps->where('has_bought', 1)->isNotEmpty();
        $clientAddedWishlist = $clientApps->where('has_bought', 0)->isNotEmpty();
        
        return view('app-details', compact('app', 'clientBoughtApp', 'clientAddedWishlist'));
    }
}
