<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 't_users';

    protected $fillable = [
        'username',
        'display_name',
        'mobile',
        'email',
        'password',
        'salt',
        'user_type', //rango 1=admin 2=others users
        'remember_token', //varchar
        'email_verified_at', //datetime
        'api_token',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'salt',
        'user_type'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'lock' => 'boolean',
        'status' => 'boolean',
        'row' => 'integer',
        'id' => 'integer'
    ];

    protected $appends = ['userflag', 'lock', 'pwd'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'updated_at_role'];

    public function getUserflagAttribute()
    {
        //return date_diff(date_create($this->date_vigency), date_create('now'))->d;
        //https://blog.devgenius.io/how-to-find-the-number-of-days-between-two-dates-in-php-1404748b1e84
        //return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');
        if ($this->status > 0) {
            return 'Activo';
        } else {
            return 'Suspendido';
        }
    }

    public static function getListStatusUsers()
    {
        $opcionesStatus = array();
        $opcionesStatus[NULL] = 'Seleccione condición';
        $opcionesStatus[1] = 'Activo';
        $opcionesStatus[0] = 'Suspendido';

        return $opcionesStatus;
    }

    public function getLockAttribute()
    {
        //return date_diff(date_create($this->date_vigency), date_create('now'))->d;
        //https://blog.devgenius.io/how-to-find-the-number-of-days-between-two-dates-in-php-1404748b1e84
        //return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');
        if ($this->user_type == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    //https://stackoverflow.com/questions/62003963/how-to-save-and-retrieve-base64-encoded-data-using-laravel-model
    public function getPwdAttribute()
    {
        if ($this->salt) {
            return base64_decode($this->salt);
        } else {
            return;
        }
    }

    /**
     * Generacion de lista de usuarios y roles con row_number en mariadb y sqlite
     *
     * @param integer $except_id
     * @param integer $role_select
     * @param integer $status_select
     * @return void
     */
    public static function getUsersRoles($except_id = NULL, $role_select = NULL, $status_select = NULL)
    {
        //Para crear row_numer en SQLITE https://stackoverflow.com/questions/16847574/how-to-use-row-number-in-sqlite
        //Esta opción tambien funciona con MariaDB
        //DB::statement(DB::raw('set @row:=0'));
        if ($role_select != NULL && $status_select != NULL) {
            try {
                //DB::statement(DB::raw('set @row:=0'));
                return User::leftjoin('t_role_user', 't_role_user.user_id', '=', 't_users.id')
                    ->leftjoin('t_roles', 't_role_user.role_id', '=', 't_roles.id')
                    ->where('t_users.id', '!=', $except_id)
                    ->where('t_role_user.role_id', '=', $role_select)
                    ->where('t_users.status', '=', $status_select)
                    ->selectRaw('t_users.*, t_role_user.role_id, t_roles.rolename, ROW_NUMBER() OVER(ORDER BY t_users.updated_at DESC) AS row')
                    ->orderBy('row', 'asc')->get();

                /*->selectRaw('t_users.*, t_role_user.role_id,t_roles.rolename, @row:=@row+1 as row')
					->orderBy('t_users.updated_at', 'desc')
					->get();*/

                /*->selectRaw('*, @row:=@row+1 as row')
					->orderBy('t_users.updated_at', 'desc')
					->get(['t_users.*', 't_role_user.role_id', 't_roles.rolename', 't_role_user.updated_at as updated_at_role']);*/
            } catch (\Throwable $th) {
                return FALSE;
            }
        } else if ($role_select != NULL && $status_select == NULL) {
            try {
                //DB::statement(DB::raw('set @row:=0'));
                return User::leftjoin('t_role_user', 't_role_user.user_id', '=', 't_users.id')
                    ->leftjoin('t_roles', 't_role_user.role_id', '=', 't_roles.id')
                    ->where('t_users.id', '!=', $except_id)
                    ->where('t_role_user.role_id', '=', $role_select)
                    ->selectRaw('t_users.*, t_role_user.role_id, t_roles.rolename, ROW_NUMBER() OVER(ORDER BY t_users.updated_at DESC) AS row')
                    ->orderBy('row', 'asc')->get();
                /*
					->selectRaw('t_users.*, t_role_user.role_id,t_roles.rolename, @row:=@row+1 as row')
					->orderBy('t_users.updated_at', 'desc')
					->get();*/

                /*->selectRaw('*, @row:=@row+1 as row')
					->orderBy('t_users.updated_at', 'desc')
					->get(['t_users.*', 't_role_user.role_id', 't_roles.rolename', 't_role_user.updated_at as updated_at_role']);*/
            } catch (\Throwable $th) {
                return FALSE;
            }
        } else if ($role_select == NULL && $status_select != NULL) {
            try {
                //DB::statement(DB::raw('set @row:=0'));
                return User::leftjoin('t_role_user', 't_role_user.user_id', '=', 't_users.id')
                    ->leftjoin('t_roles', 't_role_user.role_id', '=', 't_roles.id')
                    ->where('t_users.id', '!=', $except_id)
                    ->where('t_users.status', '=', $status_select)
                    ->selectRaw('t_users.*, t_role_user.role_id, t_roles.rolename, ROW_NUMBER() OVER(ORDER BY t_users.updated_at DESC) AS row')
                    ->orderBy('row', 'asc')->get();
                /*
					->selectRaw('t_users.*, t_role_user.role_id,t_roles.rolename, @row:=@row+1 as row')
					->orderBy('t_users.updated_at', 'desc')
					->get();*/

                /*->selectRaw('*, @row:=@row+1 as row')
					->orderBy('t_users.updated_at', 'desc')
					->get(['t_users.*', 't_role_user.role_id', 't_roles.rolename', 't_role_user.updated_at as updated_at_role']);*/
            } catch (\Throwable $th) {
                return FALSE;
            }
        } else {
            try {
                //DB::statement(DB::raw('set @row:=0'));
                return User::leftjoin('t_role_user', 't_role_user.user_id', '=', 't_users.id')
                    ->leftjoin('t_roles', 't_role_user.role_id', '=', 't_roles.id')
                    ->where('t_users.id', '!=', $except_id)
                    ->selectRaw('t_users.*, t_role_user.role_id, t_roles.rolename, ROW_NUMBER() OVER(ORDER BY t_users.updated_at DESC) AS row')
                    ->orderBy('row', 'asc')->get();
                /*
					->selectRaw('t_users.*, t_role_user.role_id,t_roles.rolename, @row:=@row+1 as row')
					->orderBy('t_users.updated_at', 'desc')
					->get();*/

                //->get(['t_users.*', 't_role_user.role_id', 't_roles.rolename', 't_role_user.updated_at as updated_at_role']);
            } catch (\Throwable $th) {
                return FALSE;
            }
        }

        /*return User::leftjoin('t_role_user', 't_role_user.user_id', '=', 't_users.id')
			->leftjoin('t_roles', 't_role_user.role_id', '=', 't_roles.id')
			->orderBy('t_users.updated_at', 'desc')
			//->orderBy('t_role_user.updated_at', 'desc')
			->get(['t_users.*', 't_role_user.role_id', 't_roles.rolename', 't_role_user.updated_at as updated_at_role']);
			*/

        /*DB::statement(DB::raw('set @row:=0'));
			return User::leftjoin('t_role_user', 't_role_user.user_id', '=', 't_users.id')
				->leftjoin('t_roles', 't_role_user.role_id', '=', 't_roles.id')
				->where('t_users.id', '!=', $except_id)
				->selectRaw('t_users.*, @row:=@row+1 as row')
				->orderBy('t_users.updated_at', 'desc')
				->get(['t_users.*', 't_role_user.role_id', 't_roles.rolename', 't_role_user.updated_at as updated_at_role']);*/
    }

    /**
     * Selecciona usuario por id con su respectivo rol
     *
     * @param integer $id
     * @return User
     */
    public static function getUser($id)
    {
        return User::leftjoin('t_role_user', 't_role_user.user_id', '=', 't_users.id')
            ->leftjoin('t_roles', 't_role_user.role_id', '=', 't_roles.id')
            ->where('t_users.id', '=', $id)
            ->where('t_users.user_type', '>', 1)
            ->select('t_users.*', 't_role_user.role_id', 't_roles.rolename')
            ->first();
    }

    /**
     * Crea usuario con su respectivo rol
     *
     * @param Array $request
     * @return void
     */
    public static function createUser($request)
    {
        $data = array(
            'username' => $request['username'],
            'email' => $request['email'],
            'user_type' => $request['user_type'],
            'display_name' => $request['display_name'],
            'mobile' => $request['mobile'],
            'email' => $request['email'],
            'password' => password_hash($request['password'], PASSWORD_BCRYPT),
            'salt' => base64_encode($request['password']),
            'created_by' => $request['created_by']
        );

        try {
            $model = new User();

            $role = Role_Eloquent::findOrFail($request['role_id']);    //code...

            /*if ($model) {
				$model->fill($data);
				$model->save($data);
			}*/

            if ($role) {
                $model->fill($data);
                $model->save($data);
                $role_user = RoleUser::where('user_id',  $model->id)->first();

                if ($role_user !== null) {
                    $role_user->update(['role_id' => $request['role_id']]);
                    $model->updated_at = Carbon::now();
                    $model->save();
                    return $model;
                } else {
                    $user = RoleUser::create([
                        'user_id' => $model->id,
                        'role_id' => $request['role_id']
                    ]);
                    $model->updated_at = Carbon::now();
                    $model->save();
                    return $model;
                }
            } else {
                return FALSE;
            }
        } catch (ModelNotFoundException $e) {
            //throw $th;
            return FALSE;
        }
    }

    /**
     * Undocumented function
     *
     * @param Array $request
     * @return User
     */
    public static function updateUser($request)
    {
        $data = array(
            'email' => $request['email'],
            'display_name' => $request['display_name'],
            'mobile' => $request['mobile'],
            'email' => $request['email'],
            'password' => password_hash($request['password'], PASSWORD_BCRYPT),
            'salt' => base64_encode($request['password']),
            'updated_by' => $request['updated_by']
        );

        // $model = User::findOrFail($request['id']);
        // $model->fill($data);
        // $model->save($data);

        try {
            $model = User::findOrFail($request['id']);
            //$model->fill($data);
            //$model->save($data);

            $role = Role_Eloquent::findOrFail($request['role_id']);    //code...

            if ($model) {
                $model->fill($data);
                $model->save($data);
            }

            if ($role) {
                $role_user = RoleUser::where('user_id',  $request['id'])->first();

                if ($role_user !== null) {
                    $role_user->update(['role_id' => $request['role_id']]);
                    $model->updated_at = Carbon::now();
                    $model->save();
                    return $model;
                } else {
                    $user = RoleUser::create([
                        'user_id' => $request['id'],
                        'role_id' => $request['role_id']
                    ]);
                    $model->updated_at = Carbon::now();
                    $model->save();
                    return $model;
                }
            } else {
                return FALSE;
            }
        } catch (ModelNotFoundException $e) {
            //throw $th;
            return FALSE;
        }


        // if ($role) {
        //     $role_user = RoleUser::where('user_id',  $request['id'])->first();

        //     if ($role_user !== null) {
        //         $role_user->update(['role_id' => $request['role_id']]);
        // 		return $role_user;
        //     } else {
        //         $user = RoleUser::create([
        //             'user_id' => $request['id'],
        //             'role_id' => $request['role_id']
        //         ]);
        // 		return $user;
        //     }
        // }else{
        // 	return FALSE;
        // }

        // if($role_user->save()){
        // 	return TRUE;
        // }else{
        // 	return FALSE;
        // }

    }

    /**
     * Selecciona un usuario por algun campo y valor
     *
     * @param string $column
     * @param string|integer $value
     * @return User
     */
    public static function getUserBy($column, $value)
    {
        return User::leftjoin('t_role_user', 't_role_user.user_id', '=', 't_users.id')
            ->leftjoin('t_roles', 't_role_user.role_id', '=', 't_roles.id')
            ->select('t_users.*', 't_role_user.role_id', 't_roles.rolename')
            ->where($column, '=', $value)->first();
    }

    /**
     * Valida acceso del login
     *
     * @param string $user
     * @param string $pass
     * @return User|Boolean
     */
    public static function getLogin($user, $pass)
    {
        $userValidate = User::where('username', '=', $user)->first();
        if (is_null($userValidate)) {
            $arrayLogin = array(
                'error' => 'Usuario no registrado.',
                'isLogged' => FALSE,
            );
            return $arrayLogin;
        } else {
            if ($userValidate->status) {
                if (password_verify($pass, $userValidate['password'])) {
                    $role_user = RoleUser::where('user_id',  $userValidate['id'])->first();
                    //print_r($role_user);
                    $role = Role_Eloquent::findOrFail($role_user['role_id']);
                    if ($role) {
                        if ($role->status) {
                            $arrayLogin = array(
                                'user_login' => $userValidate['username'],
                                'user_nickname' => $userValidate['display_name'],
                                'user_email' => $userValidate['email'],
                                'user_id' => $userValidate['id'],
                                'user_role' => $role['rolename'],
                                'user_guard' => $role['guard_name'],
                                'user_role_id' => $role['id'],
                                'user_level' => $userValidate['user_type'],
                                'isLogged' => TRUE,
                            );
                            //print_r($arrayLogin);
                            return $arrayLogin;
                        } else {
                            $arrayLogin = array(
                                'error' => 'Usuario no tiene rol autorizado',
                                'isLogged' => FALSE,
                            );
                            return $arrayLogin;
                        }
                    } else {
                        $arrayLogin = array(
                            'error' => 'No tiene rol asignado',
                            'isLogged' => FALSE,
                        );
                        return $arrayLogin;
                    }
                } else {
                    $arrayLogin = array(
                        'error' => 'Error de contraseña',
                        'isLogged' => FALSE,
                    );
                    return $arrayLogin;
                }
            } else {
                $arrayLogin = array(
                    'error' => 'Usuario no autorizado.',
                    'isLogged' => FALSE,
                );
                return $arrayLogin;
            }
            return;
        }
    }


    public static function enableUser($request)
    {
        try {
            $model = User::findOrFail($request['id']);
            $model->status = 1;
            $model->updated_at = Carbon::now();
            $model->save();
            return $model;
        } catch (ModelNotFoundException $e) {
            //throw $th;
            return FALSE;
        }
    }

    public static function disableUser($request)
    {
        try {
            $model = User::findOrFail($request['id']);
            $model->status = 0;
            $model->updated_at = Carbon::now();
            $model->save();
            return $model;
        } catch (ModelNotFoundException $e) {
            //throw $th;
            return FALSE;
        }
    }

    public function role(){
        return $this
            ->belongsTo(Role::class);
    }
}
