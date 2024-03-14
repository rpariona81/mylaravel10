<?php

namespace App\Listeners;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;

class UserEventSuscriber
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * Create the event listener.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //
    }

    /**
     * @param \Illuminate\Auth\Events\Login $event
     */
    public function onUserLogin(Login $event)
    {
        //https://laracasts.com/discuss/channels/laravel/find-user-roles
        //https://www.arsys.es/blog/session-laravel#Helper_global_session

        $user = User::findOrFail($event->user->id);
        $user->ip_address = $this->request->getClientIp();
        //dd($user->roles[0]->rolename);//
        $user->logged_in_at = Carbon::now();
        session(['display_name' => $user->display_name]);
        session(['user_id' => $user->id]);
        session(['user_type' => $user->user_type]);
        session(['user_email' => $user->email]);
        session(['rolename' => $user->roles[0]->rolename]);
        session(['role_id' => $user->roles[0]->id]);
        //dd($user);
        $user->save();
    }

    /**
     * @param \Illuminate\Auth\Events\Logout $event
     */
    public function onUserLogout(Logout $event)
    {
        /*$event->user->logged_out_at = Carbon::now();
        $event->user->save();*/

        $user = User::find($event->user->id);
        $user->logged_out_at = Carbon::now();
        $user->save();
    }

    /**
     * @param $events
     */
    public function subscribe($events)
    {
        $events->listen(Login::class, static::class . '@onUserLogin');
        $events->listen(Logout::class, static::class . '@onUserLogout');
    }

}
