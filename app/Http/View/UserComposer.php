<?php

namespace App\Http\View;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Class UserComposer{
    public function compose(View $view){

        $view->with('user', Auth::user());
    }
}
