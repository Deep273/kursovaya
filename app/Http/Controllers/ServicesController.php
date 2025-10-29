<?php


namespace App\Http\Controllers;

use App\Models\Service;

class ServicesController extends Controller
{
    public function catering()
    {
        $services = Service::where('category', 'Кейтеринг')->get();
        return view('site.catering_services', compact('services'));
    }
}
