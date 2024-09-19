<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivateRequest;
use App\Http\Requests\QuestionsRequest;
use App\Http\Requests\UserPasswordRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('questions', 'complete', 'activate');
    }

    public function index()
    {
        $users = Auth::user()->getUsers();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserStoreRequest $request)
    {
        $validation = UserService::validate($request);

        $user = new User($validation);
        $user->password = Hash::make('password');
        $user->save();

        return redirect('/users')->with('status', 'User created!');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $validation = UserService::validate($request);

        $user->update($validation);
        $user->save();

        return redirect('/users')->with('status', 'User updated!');
    }

    public function changePassword()
    {
        return view('users.change_password');
    }

    public function updatePassword(UserPasswordRequest $request)
    {
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with("status", "Password changed successfully!");
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->superadmin) {
            return redirect()->back()->with('status', 'This is superadmin!');
        }

        $user->delete();

        return redirect()->back()->with('status', 'User deleted!');
    }

    public function questions(QuestionsRequest $request)
    {
        $validation = $request->validated();

        $html = "<html>" . $validation['message'] . "</html>";

        Mail::raw($validation['email'] . ' => ' . $validation['message'], function ($message) use ($validation, $html) {
            $message
                ->from($validation['email'], $validation['name'])
                ->to('pametnesape@gmail.com')
                ->subject($validation['subject']);
        });

        return redirect()->back();

    }

    public function complete()
    {
        $user = Auth::user();

        return view('users.complete', compact('user'));
    }

    public function activate(ActivateRequest $request)
    {
        $user = User::find($request->user_id);
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->status = 1;
        $user->save();

        return redirect('/login');
    }
}
