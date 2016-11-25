<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUserAdd()
    {
        return view('admin.module.user.add');
    }

    public function postUserAdd(UserRequest $request)
    {
        $user = new User();
        $user->username = $request->input('txtUser');
        $user->password = bcrypt($request->input('txtPass'));
        $user->level = $request->input('rdoLevel');
        $user->created_at = new DateTime();
        $user->save();
        return redirect()->route('getUserList')->with(['flash_level' => 'result_msg', 'flash_message' => 'Thêm tài khoản thành công!']);
    }

    public function getUserList()
    {
//        $data = User::select('id', 'username', 'level')->get()->toArray();
//        return view('admin.module.user.list', ['data' => $data]);
        $userCurrentLogin = Auth::user()->id;
        $user = User::find($userCurrentLogin);
        if ($userCurrentLogin == 2) {
            $data = User::select('id', 'username', 'level')->get()->toArray();
            return view('admin.module.user.list', ['data' => $data]);
        } elseif ($user['level'] == 1) {
            $data = User::select('id', 'username', 'level')->where('id', '<>', 2)->get()->toArray();
            return view('admin.module.user.list', ['data' => $data]);
        } else {
            echo "Bạn không có quyền truy cập";
        }
    }

    public function getUserDelete($id)
    {
        $userCurrentLogin = Auth::user()->id;
        $userDelete = User::find($id);
        if ($id == 2 || ($userCurrentLogin != 2 && $userDelete['level'] == 1)) {
            return redirect()->route('getUserList')->with(['flash_level' => 'error_msg', 'flash_message' => 'Bạn không được phép xóa tài khoản này!']);
        } else {
            $userDelete->delete();
            return redirect()->route('getUserList')->with(['flash_level' => 'result_msg', 'flash_message' => 'Xóa tài khoản thành công!']);
        }
    }

    public function getUserEdit($id)
    {
        $userCurr = Auth::user()->id;
        $data = User::find($id);
        if ($userCurr == 2 || ($userCurr != 2 && ($userCurr == $data['id']) && ($data['level'] == 1)) || ($userCurr != $data['id'] && $data['level'] == 2)) {
            return view('admin.module.user.edit', ['data' => $data]);
        } else {
            return redirect()->route('getUserList')->with(['flash_level' => 'error_msg', 'flash_message' => 'Bạn không được phép sửa tài khoản này!']);
        }
    }

    public function postUserEdit(UserEditRequest $request, $id)
    {
        $user = User::find($id);
        $user->password = $request->input('txtPass');
        $user->level = $request->input('rdoLevel');
        $user->updated_at = new DateTime();
        $user->save();
        return redirect()->route('getUserList')->with(['flash_level' => 'result_msg', 'flash_message' => 'Sửa tài khoản thành công!']);
    }
}
