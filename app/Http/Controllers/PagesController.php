<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Apps;

class PagesController extends Controller
{
    

    public function details($id){
        $app = App\Models\Apps::findOrFail($id);
        return view('app_details', compact('app'));
    }

    public function cart(){
        return "ola";
    }
}
