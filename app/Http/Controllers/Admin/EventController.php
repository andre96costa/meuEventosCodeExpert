<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Services\MessageService;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    use UploadTrait;
    
    private $event;

    public function __construct(Event $event) {
        $this->event = $event;
        $this->middleware('user.can.event.edit')->only(['edit', 'update']);
    }

    public function index()
    {
        //$events = Event::paginate(10);
        $events = auth()->user()->events()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function show($event)
    {
        return 'Event ' . $event;
    }

    public function create()
    {
        $categories = Category::all(['id','name']);
        return view('admin.events.create', compact('categories'));
    }

    public function store(EventRequest $request)
    {  
        $event = $request->all();
        if ($banner = $request->file('banner')) {
            $event['banner'] = $this->upload($banner, 'events/banner');
        }
        $e = $this->event->create($event);
        $e->owner()->associate(auth()->user())->save();

        if ($categories = $request->get('categories')) {
            $e->categories()->sync($categories);
        }

        MessageService::addFlash('success', 'Evento criado com sucesso!');
        return redirect()->route('admin.events.index');
    }

    public function edit($event)
    {
        $categories = Category::all(['id','name']);
        $event = $this->event->findOrFail($event);
        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(EventRequest $request, $event)
    {
        $event = $this->event->findOrFail($event);
        $eventData = $request->all();

        if ($banner = $request->file('banner')) {
            if (Storage::disk('public')->exists($event->banner)) {
                Storage::disk('public')->delete($event->banner);
            }
            $eventData['banner'] = $this->upload($banner, 'events/banner');
        }
       
        $event->update($eventData);

        if ($categories = $request->get('categories')) {
            $event->categories()->sync($categories);
        }

        MessageService::addFlash('success', 'Evento atualizado com sucesso!');
        return redirect()->route('admin.events.index');
    }

    public function destroy($event)
    {
        $event = $this->event->findOrFail($event);
        $event->delete();

        MessageService::addFlash('success', 'Evento removido com sucesso!');
        return redirect()->route('admin.events.index');
    }
}
