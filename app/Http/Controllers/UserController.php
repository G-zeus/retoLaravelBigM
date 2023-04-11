<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function    index()
    {
        $users = User::paginate(5);
        return view('users.index', compact('users'));
    }


    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|max:75',
                'email' => 'unique:users|email|max:50',
                'role' => 'required',
            ]);

            $user = User::create($request->except('role'));

            $user->roles()->attach([$request->get('role')]);

            return redirect('users')->with('success','Usuario creado correctamente');
        } catch (ValidationException $validationException) {
            return redirect('users')->with('error',$validationException->getMessage());

        } catch (\Exception $exception) {

            return redirect('users')->with('error',$exception->getMessage());
        }


    }


    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }


    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit',compact('user', 'roles'));

    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
        public function update(Request $request, User $user)
    {
        try {

            $request->validate([
                'name' => 'required|max:75',
                'email' => 'unique:users|email|max:50',
                'role' => 'required',

            ]);


            $user->update($request->except('role'));
            $user->roles()->attach([$request->get('role')]);


            return redirect('users')->with('success','Usuario actualizado correctamente');
        } catch (ValidationException $validationException) {
            return redirect('users')->with('error',$validationException->getMessage());


        } catch (\Exception $exception) {

            return redirect('users')->with('error',$exception->getMessage());
        }
        //
    }


    public function destroy(User $user)
    {
        try {

            $user->delete();
            return redirect('users')->with('success','Usuario eliminado correctamente');
        }catch (\Exception $exception) {

            return redirect('users')->with('error',$exception->getMessage());
        }
    }

}
