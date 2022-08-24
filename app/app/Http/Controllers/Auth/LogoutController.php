<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * @return \Illuminate\Routing\Redirector
     */
    public function logoutAction()
    {
        Session::flush();
        Auth::logout();

        return redirect('/')
            ->with('success', 'Успешно вышли');
    }
}
