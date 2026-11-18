<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class RegisteredUserController extends Controller
{
    public function create(): View { return view('auth.register'); }
    public function store(Request $request): RedirectResponse
    {
        $data=$request->validate([
            'username'=>['required','string','max:50','unique:users,username'],
            'full_name'=>['required','string','max:100'],
            'email'=>['required','email','max:100','unique:users,email'],
            'password'=>['required','confirmed','min:8'],
        ]);
        $user=User::query()->create($data);
        Auth::login($user); $request->session()->regenerate();
        return redirect()->intended(route('tasks.index'));
    }
}
