<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceDetailsController extends Controller
{
    public function index($id)
    {
        $service = Service::findOrFail($id); // ищет товар по id
        return view('site.service_details', compact('service'));
    }
}
