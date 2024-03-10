<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     $users = User::getUsersRoles();

    //     return view('admin.users.index', compact('users'));
    // }

    public function index(Request $request)
    {
        //
        $role_select = $request->input('role_select');
		$role_Value = isset($role_select) ? $role_select : null;

        $status_select = $request->input('status_select');
		$status_Value = isset($status_select) ? $status_select : null;

        $records = User::getUsersRoles(NULL, $role_select, $status_select);

        return view('admin.users.index', ['records' => $records,'status_Value' => $status_Value, 'role_Value' => $role_Value ]);

        /*$users = User::getUsersRoles();
        return view('admin.users.index', compact('users'));*/
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function banUnban($id, $status)
    {
        //if (auth()->user()->hasRole('Admin')){
            $user = User::findOrFail($id);
            $user->status = $status;
            if ($user->save()){
                return redirect()->back()->with('message', 'User status updated successfully!');
            }
            return redirect()->back()->with('error', 'User status update fail!');
        //}
        //return redirect(Response::HTTP_FORBIDDEN, '403 Forbidden');
    }


}
