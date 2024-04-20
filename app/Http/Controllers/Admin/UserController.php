<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserTypes;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
//        $users = User::all()
//            ->where('type', UserTypes::USER);
//        $users = UserResource::collection($users);
//        return view('admin.index', ['users' => $users]);


        $users = User::where('type', UserTypes::USER)
            ->paginate(2);  // 10 users per page

        return view('admin.index', ['users' => $users]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
