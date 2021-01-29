<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Models\ClientApps;
use Auth;
use App\Models\User;


class ClientAppsController extends Controller
{
    public function buyAppsOrAddToWishlist(Request $request){
        if($request->ajax()){

            ClientApps::where('user_id', Auth::id())->where('app_id', $request->app_id)->delete();

            $clientApp = new ClientApps;
            $clientApp->app_id = $request->app_id;
            $clientApp->user_id = Auth::id();
            
            if($request->actionDone == 'buy'){
                $clientApp->has_bought = true;
            }

            if($request->actionDone == 'wishlist'){
                $clientApp->has_bought = false; 
            }

            $clientApp->save();
        }
    }

    public function deleteApp(Request $request){
        
        if($request->ajax()){
         $clientApp = ClientApps::where('user_id', Auth::id())->where('app_id', $request->app_id)->delete();
        }
    }

    

    public function showWishlist(){
        $clientApps = ClientApps::get()->where('user_id', Auth::id())->where('has_bought', 0);



        return view('client-wishlist', compact('clientApps'));
    }
}
