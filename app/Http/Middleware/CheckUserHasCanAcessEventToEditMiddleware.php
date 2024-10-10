<?php

namespace App\Http\Middleware;

use App\Models\Event;
use Closure;
use Illuminate\Http\Request;

class CheckUserHasCanAcessEventToEditMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $eventId = null;
        if (is_a($request->route()->parameter('event'), 'App\Models\Event')) {
            $eventId = (string) $request->route()->parameter('event')->id;
        }else{
            $eventId = $request->route()->parameter('event');
        }
        $event = Event::find($eventId);
        if (!auth()->user()->events->contains($event)) {
            abort(403);
        }
        return $next($request);
    }
}
