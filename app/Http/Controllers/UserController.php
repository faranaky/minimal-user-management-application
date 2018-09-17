<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * @return User[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return User::with('groups')->get();
    }

    /**
     * @param $id
     * @return User|User[]|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function show($id)
    {
        $user =  User::with('groups')->find($id);
        return $user;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make($data,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]
        );

        if($validation->fails()){
            return $validation->messages();
        }

        $user = User::addUser($data);

        return $user;
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validation = Validator::make($data,
            [
                'email' => 'email|unique:users,email, '. $id . ',id',
                'password' => 'min:6',
            ]
        );

        if($validation->fails()){
            return $validation->messages();
        }

        $user = User::updateUser($id, $data);
        $user->groups;

        return $user;
    }

    /**
     * @param Request $request
     * @param $id
     * @return int
     */
    public function delete(Request $request, $id)
    {
        User::removeUser($id);

        return response()->json(['message' => 'User has been removed successfully']);
    }
}
