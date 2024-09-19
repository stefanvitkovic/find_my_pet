<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function index($id)
    {
        $pet = Pet::findOrFail($id);
        return view('qrcode',compact('pet'));
    }
}
