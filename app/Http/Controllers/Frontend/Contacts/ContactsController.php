<?php

namespace App\Http\Controllers\Frontend\Contacts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Setting::all();

        $breadcrumbs = [
            ['title' => 'Контакты']
        ];

        return view('frontend.contacts.contacts', compact('contacts', 'breadcrumbs'));
    }
}
