<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotificationTemplate;

class NotificationTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    return NotificationTemplate::all();
}

public function store(Request $request)
{
    return NotificationTemplate::create($request->only('title', 'content'));
}

public function update(Request $request, NotificationTemplate $notificationTemplate)
{
    $notificationTemplate->update($request->only('title', 'content'));
    return $notificationTemplate;
}

public function destroy(NotificationTemplate $notificationTemplate)
{
    $notificationTemplate->delete();
    return response()->noContent();
}

}
