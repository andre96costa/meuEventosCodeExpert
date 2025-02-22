<?php

namespace App\Http\Controllers;

use App\Mail\UserEnrollmentMail;
use App\Models\Event;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EnrollmentController extends Controller
{
    public function start(Event $event)
    {
        session()->put('enrollment', $event->id);

        return redirect()->route('enrollment.confirm');
    }

    public function confirm()
    {
        if (!session()->has('enrollment')) {
            return redirect()->route('home');
        }
        $event = Event::find(session('enrollment'));

        if ($event->enrolleds->contains(auth()->user())) {
            return redirect()->route('event.single', $event->slug);
        }
      
        return view('enrollment-confirm', compact('event'));
    }

    public function process()
    {
        if (!session()->has('enrollment')) {
            return redirect()->route('home');
        }

        $event = Event::find(session('enrollment'));
        $event->enrolleds()->attach([auth()->user()->id => ['reference' => uniqid(), 'status' => 'ACTIVE']]);

        session()->forget('enrollment');

        //Mail::to(auth()->user())->send(new UserEnrollmentMail(auth()->user(), $event));

        MessageService::addFlash('success', 'Inscrição confirmada com sucesso!');
        return redirect()->route('event.single', $event->slug);
    }
}
