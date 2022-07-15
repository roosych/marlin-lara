<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {

        $users = User::all();

        return view('user.index', compact('users'));
    }

    public function create()
    {
        $statuses = Status::all();
        return view('user.create', compact('statuses'));
    }

    public static function uploadAvatar(Request $request)
    {
        if($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars');
            return $path;
        }
        return '';
    }

    public function store(Request $request)
    {
        //валидируем поля
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],

            'name' => ['nullable', 'string', 'max:50'],
            'workplace' => ['nullable', 'string', 'max:50'],
            'adress' => ['nullable', 'string', 'max:50'],
            'phone' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:1024'],
            'vk' => ['nullable', 'string', 'max:50'],
            'tg' => ['nullable', 'string', 'max:50'],
            'inst' => ['nullable', 'string', 'max:50'],
        ]);

        //добавляем в массив данных путь
        $validated['avatar'] = self::uploadAvatar($request);

        //хешируем пароль
        $validated['password'] = Hash::make($request->password);

        User::create($validated);
        //dd($validated);
        return redirect()->route('user.index')->with('success', 'Пользователь создан');
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:50'],
            'workplace' => ['nullable', 'string', 'max:50'],
            'adress' => ['nullable', 'string', 'max:50'],
            'phone' => ['nullable', 'string'],
        ]);

        User::where('id', $user->id)->first()->update($validated);

        return redirect()->back()->with('success', 'Изменения сохранены');
    }

    public function status(User $user)
    {
        $statuses = Status::all();

        return view('user.status', compact('statuses', 'user'));
    }

    public function setstatus(Request $request, User $user)
    {
        $validated = $request->validate([
           'status_id' => ['nullable', 'integer'],
        ]);

        User::where('id', $user->id)->first()->update($validated);

        return redirect()->back()->with('success', 'Изменения сохранены');
    }

    public function media(User $user)
    {
        return view('user.media', compact('user'));
    }

    public function setavatar(Request $request, User $user)
    {
        $validated = $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:1024'],
        ]);


        if(Storage::disk('public')->has($user->avatar)) {
            Storage::delete($user->avatar);
        }

        $path = self::uploadAvatar($request);

        User::where('id', $user->id)->first()->update(['avatar' => $path]);

        return redirect()->back()->with('success', 'Аватар обновился');
    }

    public function security(User $user)
    {
        return view('user.security', compact('user'));
    }

    public function editsecurity(Request $request, User $user)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')->ignore($user)],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        //хешируем новый пароль
        $validated['password'] = Hash::make($request->password);

        User::where('id', $user->id)->first()->update($validated);

        return redirect()->back()->with('success', 'Изменения сохранены');
    }

    public function delete(User $user)
    {
        if(Storage::disk('public')->has($user->avatar)) {
            Storage::delete($user->avatar);
        }

        User::where('id', $user->id)->first()->delete();

        return redirect()->back()->with('success', 'Пользователь удален');
    }

}
