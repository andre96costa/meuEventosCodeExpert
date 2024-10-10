<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventPhotoRequest;
use App\Models\Event;
use App\Models\Photo;
use App\Services\MessageService;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventPhotoController extends Controller
{
    use UploadTrait;

    public function __construct() {
        $this->middleware('user.can.event.edit');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        return view('admin.events.photos', compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventPhotoRequest $request, Event $event)
    {
        if (!$request->file('photos')) {
            return redirect()->back();
        }
       
        $uploadedPhotos = $this->multipleFilesUpload($request->file('photos'), 'events/photos', 'photo');
    
        $event->photos()->createMany($uploadedPhotos);

        MessageService::addFlash('success', 'Fotos adicionadas com sucesso!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event, Photo $photo)
    {   
        if (!Storage::disk('public')->exists($photo->photo)) {
            return redirect()->route('admin.events.index');
        }
        Storage::disk('public')->delete($photo->photo);
        $photo->delete();

        MessageService::addFlash('success', 'Foto(s) removida(s) com sucesso!');
        return redirect()->back();
    }
}
