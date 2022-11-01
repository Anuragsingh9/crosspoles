<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\UsersData;
use App\Rules\IndiaPhoneNumber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('user.UserForm');
    }

    /**
     * @param CreateUserRequest $request
     * @return JsonResponse
     */
    public function storeUser(CreateUserRequest $request)
    {
        try {
            DB::connection()->beginTransaction();
            $file = $request->file;
            $imagePath = $file ? $file->storeAs('bucket', time() . $file->getClientOriginalName(), 'public') : null;
            $param = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'description' => $request->input('description'),
                'filepath' => $imagePath,
                'role' => $request->input('role'),
                'phone' => $request->input('phone'),
            ];
            $userData = UsersData::create($param);
            DB::connection()->commit();
            return response()->json(['status' => true, 'data' => $userData], 201);
        } catch (Exception $exception) {
            DB::connection()->rollBack();
            return response()->json(['status' => true, 'error' => $exception->getMessage()], 500);
        }
    }
}
