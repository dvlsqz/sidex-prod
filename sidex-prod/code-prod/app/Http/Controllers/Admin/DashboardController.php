<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User, App\Http\Models\TelephoneExtension;


class DashboardController extends Controller
{
    public function __Construct(){
        $this->middleware('auth');
        $this->middleware('IsAdmin');
        $this->middleware('Permissions');
        $this->middleware('UserStatus');
        
    }

    public function getDashboard(){
        $users = User::count();
        $telephone_extensions_p = TelephoneExtension::where('status', '1')->count();
        $telephone_extensions_np = TelephoneExtension::where('status', '0')->count();

        $data = [
            'users' => $users,
            'telephone_extensions_p' => $telephone_extensions_p,
            'telephone_extensions_np' => $telephone_extensions_np
        ];

        return view('admin.dashboard',$data);
    }
}
