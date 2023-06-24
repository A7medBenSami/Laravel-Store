<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MarkNotificationRead
{
    public function handle($request, Closure $next)
    {
        $notification_id = $request->query('notification_id');

        if ($notification_id) {
            $user = Auth::user();
            $notification = $user->notifications()->find($notification_id);

            if ($notification) {
                $notification->markAsRead();
            }
        }

        return $next($request);
    }
}
