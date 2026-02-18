<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriberRequest;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store (StoreSubscriberRequest $request) {
        $data = $request->validated();
        Subscriber::create($data);
        return back()->with('status' , 'Subscribers Successful');
    }
}
