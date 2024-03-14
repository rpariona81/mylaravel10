<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
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

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //

        $data['role_select'] = $request->input('role_select');
        $data['role_Value'] = isset($role_select) ? $role_select : null;

        $data['status_select'] = $request->input('status_select');
        $data['status_Value'] = isset($status_select) ? $status_select : null;

        $data['records'] = User::getUsersRoles(session('user_id'), $data['role_select'], $data['status_select']);

        $data['roles'] = Role::getRoleOpciones(session('role_id'));
        $data['condiciones'] = User::getListStatusUsers();

        //return view('admin.users.index', ['records' => $records,'status_Value' => $status_Value, 'role_Value' => $role_Value, 'roles' => $roles, 'condiciones' => $condiciones ]);
        return view('admin.users.index', $data);

        /*$users = User::getUsersRoles();
        return view('admin.users.index', compact('users'));*/
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('admin.users.add');
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
        $model = User::getUser($id);
        if ($model) {
            try {
                $data['user'] = User::getUser($id);
                $data['roles'] = Role::getRoleOpciones(session('role_id'));
                return view('admin.users.edit', $data);
            } catch (\Throwable $th) {
                redirect('admin.users');
            }
        } else {
            redirect('admin.users');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        //User::updateUser($request);
        $request['updated_by'] = session('user_id');

        $result = User::updateUser($request);

        //redirect('/admin/users');
        if ($result) {
            //$this->session->set_flashdata('message', 'Actualización de ' . $result['username'] . ' exitosa.');
            //return redirect()->back()->with('message', 'User status updated successfully!');
            return redirect()->route('admin.users')
                ->with('success', 'Post updated successfully.');
        } else {
            //$this->session->set_flashdata('error', 'Error en actualización.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function activeUser(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::enableUser($request);
        /*$user->status = '1';
        $user->save();*/
    }

    public function inactiveUser(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::disableUser($request);
        /*$user->status = '1';
        $user->save();*/
    }

    public function banUnban($id, $status)
    {
        //if (auth()->user()->hasRole('Admin')){
        $user = User::findOrFail($id);
        $user->status = $status;
        if ($user->save()) {
            return redirect()->back()->with('message', 'User status updated successfully!');
        }
        return redirect()->back()->with('error', 'User status update fail!');
        //}
        //return redirect(Response::HTTP_FORBIDDEN, '403 Forbidden');
    }
}
