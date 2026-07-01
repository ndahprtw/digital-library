<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view users', only: ['index', 'show']),
        ];
    }

    public function index() {
        $data = User::with('roles', 'permissions')
            ->orderBy('name', 'asc')
            ->paginate(5);
        return view('pages.user.index', compact('data'));
    }
}
