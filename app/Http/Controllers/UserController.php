<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Post;
use App\Models\Registration;
use App\Models\User;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {

        $posts = Post::all();//Получаем все Мероприятия
        $categories = Categories::all();//Получаем все категории
        $users = User::all();//Получаем всех пользователей
        $registrations = Registration::with('user', 'post')->get();
        return view('admin.dashboard', compact('posts', 'registrations', 'categories', 'users'));//compact передает возможность взаимодействия в blade-представлении
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);


        $user = User::create($request->all());
        event(new Registered($user));


        Auth::login($user);

        return redirect()->route('verification.notice')->with('success', 'Вы зарегестрировались');
    }

    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,

        ]);

        $user->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Пользовательские данные обновлены!');
    }

    public function login()
    {
        return view('user.login');
    }

    public function loginAuth(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Welcome, ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'Wrong email or password!',
        ]);

    }

    public function dashboard()
    {
        $posts = Post::where('user_id', auth()->id())->get();

        return view('user.dashboard', compact('posts'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Пользователь удален');
    }
}