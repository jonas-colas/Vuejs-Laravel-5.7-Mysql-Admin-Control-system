<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $users = User::join('roles','users.idrol','=','roles.id')
        ->select('users.id','users.name','users.usuario','users.password',
        'users.condicion','users.idrol','roles.nombre as role')
        ->orderBy('users.id', 'asc')->paginate(10);

        return [
            'pagination' => [
                'total'        => $users->total(),
                'current_page' => $users->currentPage(),
                'per_page'     => $users->perPage(),
                'last_page'    => $users->lastPage(),
                'from'         => $users->firstItem(),
                'to'           => $users->lastItem(),
            ],
            'users' => $users
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = new User();
        $user->idrol = $request->idrol;          
        $user->name = $request->name;
        $user->usuario = $request->usuario;
        $user->password = bcrypt( $request->password);
        $user->condicion = '1';

        $user->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
   
        $user = User::findOrFail($request->id);

        $user->idrol = $request->idrol;
        $user->name = $request->name;
        $user->usuario = $request->usuario;
        $user->password = bcrypt( $request->password);
        $user->condicion = '1';
        $user->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }
}
