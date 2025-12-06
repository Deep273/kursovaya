<?php


namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function category($category)
    {
        $titles = [
            'catering' => 'Кейтеринг',
            'ceremony' => 'Церемонии',
            'stylists' => 'Стилисты и визажисты',
            'organisation' => 'Организация',
            'photo' => 'Фотограф и фотозоны',
        ];

        if (!array_key_exists($category, $titles)) {
            abort(404);
        }

        $services = Service::where('category', $titles[$category])
            ->where('archived', false)
            ->get();

        return view('site.category_service', [
            'services' => $services,
            'title' => $titles[$category]
        ]);
    }


}
