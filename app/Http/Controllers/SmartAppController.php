<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use App\Models\Application;

class SmartAppController extends Controller
{
    public function editApp($id) {
        return Redirect::to(route('smartapp.start', ['id' => $id]));
    }
    public function exportPDF($id) {
        $headers = array(
            'Content-Type: application/pdf',
        );
        return Response::download(public_path('main.css'), $id.'.pdf', $headers);
    }
    public function exportFNM($id) {
        $headers = array(
            'Content-Type: application/octet-stream',
        );
        return Response::download(public_path('main.css'), $id.'.fnm', $headers);
    }
    public function getApps() {
        $apps = Application::all();
        return Response::json(array(
            'data' => $apps
        ));
    }

    public function startApp($id) {
        return view('smartapp.admin');
    }
}
