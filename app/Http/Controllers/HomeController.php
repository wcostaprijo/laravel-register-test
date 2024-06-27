<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(private User $userModel)
    { }

    /**
     * Retorna view da home coms os usuários cadastrados
     *
     * @return View
     */
    public function index(): View
    {
        return view('home', ['users' => UserResource::collection($this->userModel->all())]);
    }
}
