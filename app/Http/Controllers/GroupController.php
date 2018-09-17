<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * @return Group[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Group::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return Group::find($id);
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
            ]
        );

        if($validation->fails())
        {
            return $validation->messages();
        }

        return Group::addGroup($data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $group = Group::updateGroup($id, $data);

        return $group;
    }

    /**
     * @param Request $request
     * @param $id
     * @return int
     */
    public function delete(Request $request, $id)
    {
        $result = Group::removeGroup($id);

        if($result)
        {
            return response()->json(['message' => 'Group has been removed successfully'])->setStatusCode(200);
        }
        else
        {
            return response()->json(['message' => 'Operation is not possible, group has member'])->setStatusCode(403);
        }
    }
}
