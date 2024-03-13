<?php

namespace App\Http\Controllers;

use App\Models\Instituto;
use App\Models\PortalWebLineal;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/login');

        $users = User::where('status',1)->count();
        $institutos = Instituto::where('estado',2)->count();
        $portalesweb = PortalWebLineal::get_cifras();
        $regiones = Region::where('estado',1)->count();
        return view('admin.index',['users' => $users, 'institutos' => $institutos, 'portalesweb' => $portalesweb, 'regiones' => $regiones]);
    }
}
