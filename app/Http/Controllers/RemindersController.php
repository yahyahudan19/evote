<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;

class RemindersController extends Controller
{
    public function index()
    {
        $election = Election::first();
        return view('apps.reminders', compact('election'));
    }
   
}
