<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function insert(Request $request)
    {
        $user = new User();
        
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->status = $request->input('status');
        $user->save();

        return response()->json($user);
    }

    public function appendAttribute(Request $request)
    {
        $attribute = $request->input('attribute');

        $users = User::all();

        $updatedUsers = $users->appendAttribute($attribute);
        return response()->json($users);
    }

    public function containsEmail(Request $request)
    {
        $email = $request->input('email');

        $users = User::all();
        $userContainsEmail = $users->containsEmail($email);
        return response()->json(['contains_email' => $userContainsEmail]);
    }

    public function diffWithAdmins()
    {
        $users = User::all();
        $diffWithAdmins = $users->diffWithAdmins();
        return response()->json($diffWithAdmins);
    }

    public function expectId(Request $request)
    {
        $id = $request->input('id');

        $users = User::all();
        $usersExceptId = $users->expectId($id);
        return response()->json($usersExceptId);
    }

    public function findById(Request $request)
    {
        $id = $request->input('id');

        $users = User::all();
        $user = $users->findById($id);
        return response()->json($user);
    }

    public function findOrFailById(Request $request)
    {
        $id = $request->input('id');

        $users = User::all();
        $user = $users->findOrFailById($id);
        return response()->json($user);
    }

    public function intersectWithAdmins()
    {
        $users = User::all();
        $intersectWithAdmins = $users->intersectWithAdmins();
        return response()->json($intersectWithAdmins);
    }

    public function loadPosts()
    {
        $users = User::all();
        $usersWithPosts = $users->loadPosts();
        return response()->json($usersWithPosts);
    }

    public function loadMissingPosts()
    {
        $users = User::all();
        $usersWithPosts = $users->loadMissingPosts();
        return response()->json($usersWithPosts);
    }

    public function getModelKeys()
    {
        $users = User::all();
        $modelKeys = $users->getModelKeys();
        return response()->json($modelKeys);
    }

    public function makeVisibleEmail()
    {
        $users = User::all();
        $usersWithVisibleEmail = $users->makeVisibleEmail();
        return response()->json($usersWithVisibleEmail);
    }

    public function makeHiddenEmail()
    {
        $users = User::all();
        $usersWithHiddenEmail = $users->makeHiddenEmail();
        return response()->json($usersWithHiddenEmail);
    }

    public function onlyIds()
    {
        $users = User::all();
        $onlyIds = $users->onlyIds();
        return response()->json($onlyIds);
    }

    public function setVisibleAttributes()
    {
        $attributes = ['first_name', 'last_name'];

        $users = User::all();
        $usersWithVisibleAttributes = $users->setVisibleAttributes($attributes);
        return response()->json($usersWithVisibleAttributes);
    }

    public function setHiddenAttributes()
    {
        $attributes = ['first_name', 'last_name'];

        $users = User::all();
        $usersWithHiddenAttributes = $users->setHiddenAttributes($attributes);
        return response()->json($usersWithHiddenAttributes);
    }

    public function toQueryActiveUsers()
    {
        $users = User::all();
        $activeUsers = $users->toQueryActiveUsers();
        return response()->json($activeUsers);
    }

    public function uniqueEmails()
    {
        $users = User::all();
        $uniqueEmails = $users->uniqueEmails();
        return response()->json($uniqueEmails);
    }
    
}