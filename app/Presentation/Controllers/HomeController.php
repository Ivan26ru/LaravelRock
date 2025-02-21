<?php

namespace App\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use SergiX44\Nutgram\Nutgram;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function home(): Renderable
    {
        return view('page.home');
    }

    public function dashboard()
    {
        return view('page.dashboard');
    }

    public function skills()
    {
        $mySkills = [
            'FrontEnd',
            'BackEnd',
        ];
        return view('page.skills', compact('mySkills'));
    }
}
