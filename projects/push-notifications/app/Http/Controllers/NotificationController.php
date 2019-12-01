<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\NotificationCollection;
use App\Device;
use Illuminate\Support\Facades\Log;
use App\Notification;
use App\Events\NewNotification;
class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new NotificationCollection(Notification::orderBy('updated_at', 'desc')->get());
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'badge' => 'required',
            'locale' => 'required',
            'sound' => 'required',
            'environment' => 'required'
        ]);

        $notification = Notification::create($validated);
        event(new NewNotification($notification));

        return response()->json($notification);
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
    public function destroy($id)
    {
        //
    }
}
