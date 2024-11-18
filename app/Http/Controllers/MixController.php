<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\EmployeeService;
use App\Services\KafedraService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class MixController extends Controller
{
    public function insertDepartment(Request $request){
        $user = Auth::user();
        $data = json_decode($user->data);
        $department = $request->department;
        if ($user->selected_role != "teacher"){
            return redirect()->back()->with('error', "Buni bajarish mumkin emas");
        }

        $kafedra = KafedraService::getKafedraForMudir($data->employee_id_number);

        if ($data->type == "employee" && in_array($department, $kafedra)){
            $userDB = User::find($user->id);
            $userDB->selected_department = $department;
            $userDB->save();
            return redirect()->route('first-page');
        }
        else abort(404);
    }

    public function insertRole(Request $request){
        $user = Auth::user();
        $data = json_decode($user->data);
        if ($data->type == "employee" && in_array($request->role, array_column($data->roles,"code"))){
            $userDB = User::find($user->id);
            $userDB->selected_role = $request->role;
            $userDB->save();
            return redirect()->route('first-page');
        }
        else abort(404);
    }

    public function showQuiz() {
        return view('home');
    }

    public function firstPage(){
        $user = Auth::user();
        $selection_role = $user->selected_role;
        if (isset($user)){
            if ($selection_role == "department")
                return redirect()->route('mudir-themes', ['status' => 'new']);
            elseif ($selection_role == "academic_board")
                return redirect()->route('sifat-bolimi-statistika');
            elseif ($selection_role == "teacher")
                return redirect()->route('themes.index', ['status' => 'new']);
            elseif ($selection_role == "student")
                return redirect()->route('student-themes', ['status' => 'new']);
            else
                return view("admin.master");
        }
        else
            return redirect()->route('login-page');
    }
    public function examples():View{
        return view('admin.examples');
    }
    public function profile():View{
        $user=auth()->user();
        return view('admin.all_profile',compact('user'));
    }
    public function updateProfile(Request $request,User $user):RedirectResponse{
        $request->validate([
            'name'=>'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->save();
        return redirect()->back()->with('msg','Muvaffaqiyatli yangilandi');
    }
    public function updatePassword(Request $request,User $user):RedirectResponse{
        $request->validate([
            'password'=>'required|string',
            'password_confirmation'=>'required|string|same:password',
        ]);
        $user->password=Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('msg','Muvaffaqiyatli yangilandi');
    }

}

