<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private $perPage = 3;

    public function __construct()
    {
        $this->middleware('permission:user_show', ['only' => 'index']);
        $this->middleware('permission:user_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user_update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user_delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = [];
        if ($request->get('keyword')) {
            // halaman pagination ketika pencarian > 3
            $users = User::search($request->keyword)->paginate($this->perPage);
        } else {
            $users = User::paginate($this->perPage);
        }
        return view('users.index', [
            'users' => $users->appends(['keyword' => $request->keyword]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create', [
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:50|min:3',
                'role' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed'
            ],
            [],
            $this->attributes()
        );

        if ($validator->fails()) {
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            // JIKA BERHASIL
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole($request->role);

            Alert::toast(trans('users.alert.create.message.success', ['name' => $request->name]), 'success');

            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            // JIKA GAGAL atau ERROR
            DB::rollBack();

            Alert::error(
                trans('users.alert.create.title.error'),
                trans('users.alert.create.message.error', ['error' => $th->getMessage()])
            );
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator);


            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roleOld' => $user->roles->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:50|min:3',
                'role' => 'required',
            ],
            [],
            $this->attributes()
        );

        if ($validator->fails()) {
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }

        if ($request->name == $user->name) {
            Alert::toast(trans('users.alert.update.message.warning'), 'warning');

            return redirect()->route('users.index');
        }

        DB::beginTransaction();
        try {
            // JIKA BERHASIL
            $user->update(['name' => $request->name]);
            $user->syncRoles($request->role);

            Alert::toast(trans('users.alert.update.message.success', ['name' => $request->name]), 'success');

            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            // JIKA GAGAL atau ERROR
            DB::rollBack();

            Alert::error(
                trans('users.alert.update.title.error'),
                trans('users.alert.update.message.error', ['error' => $th->getMessage()])
            );
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator);
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            // JIKA BERHASIL
            $user->removeRole($user->roles->first());
            $user->delete();

            Alert::toast(trans('users.alert.delete.message.success', ['name' => $user->name]), 'success');
        } catch (\Throwable $th) {
            // JIKA GAGAL atau ERROR
            DB::rollBack();

            Alert::error(
                trans('users.alert.delete.title.error'),
                trans('users.alert.delete.message.error', ['error' => $th->getMessage()])
            );
        } finally {
            DB::commit();
            return redirect()->back();
        }
    }

    private function attributes()
    {
        return [
            'name' => trans('users.form_control.input.name.attribute'),
            'email' => trans('users.form_control.input.email.attribute'),
            'password' => trans('users.form_control.input.password.attribute'),
            'password_confirmation' => trans('users.form_control.input.password_confirmation.attribute'),
        ];
    }
}
