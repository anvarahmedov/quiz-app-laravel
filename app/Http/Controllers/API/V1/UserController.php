<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Filters\V1\UsersFilter;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\V1\UserCollection;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;


class UserController extends Controller
{
    public function index(Request $request) {
        //dd($request);
        $filter = new UsersFilter();
        $filterItems = $filter->transform($request);
        $includeQuizzes = $request->query('includeQuizzes');
        $users = User::where($filterItems);
        if ($includeQuizzes) {
            $customers = $users->with('quizzes');
        }
        return new UserCollection($users->paginate()->appends($request->query()));
    }

    public function show(User $user)
    {
        $includeQuizzes = request()->query('includeQuizzes');
       // dd('2323');
        if ($includeQuizzes) {
           // dd(auth()->user()->quizzes());
        //  dd('2323');
            return new UserResource($user->loadMissing('quizzes'));
        }
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function store(StoreUserRequest $request)
    {
        return new UserResource(User::create($request->all()));
    }
    }

