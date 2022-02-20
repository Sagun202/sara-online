<?php

namespace Bsdev\Theme\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Bsdev\Theme\DataTables\UsersDataTable;
use Bsdev\Theme\Requests\StoreUserRequest;
use Bsdev\Theme\Requests\UpdateUserRequest;
use Bsdev\Theme\Traits\FileUpload;
use Spatie\Permission\Models\Role;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use FileUpload;
    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('user_view'), 403);

        return $dataTable->render('theme::user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('user_create'), 403);

        return view('theme::user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        abort_if(!auth()->user()->can('user_create'), 403);

        try {

            $data = $request->except('password');
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }
            $user = User::create($data);
            $user->assignRole($request->roles);

            return redirect()->route('users.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

            return redirect()->route('users.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_if(!auth()->user()->can('user_edit'), 403);

        return view('theme::user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        abort_if(!auth()->user()->can('user_update'), 403);

        try {

            $data = $request->except('password');
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }
            $data['featured'] = ($request->featured) ? 1 : 0;   
            $user->update($data);
            $user->syncRoles($request->roles);
            return redirect()->route('users.index')->with('success', 'Successfully Updated!!');
        } catch (\Exception $ex) {

            return redirect()->route('users.index')->with('error', 'Something went wrong!!');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_if(!auth()->user()->can('user_delete'), 403);

        try {

            $user->permissions()->delete();

            $user->delete();

            return redirect()->route('users.index')->with('success', 'Successfully Updated!!');
        } catch (\Exception $ex) {

            return redirect()->route('users.index')->with('error', 'Something went wrong!!' . $ex->getMessage());

        }

    }

    public function editProfile()
    {

        return view('theme::user.profile');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        if ($request->profile) {
            $data['profile'] = $this->uploadFile('user', $request->profile);
        }
        auth()->user()->update($data);
        return redirect()->back()->with('success', 'Successfully Updated..');
    }
}
