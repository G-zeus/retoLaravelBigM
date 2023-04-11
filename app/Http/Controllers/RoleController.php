<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    public function    index()
    {
        $roles = Role::paginate(5);
        return view('roles.index', compact('roles'));
    }


    public function create()
    {
        return view('roles.create');

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
            ]);

            $role = Role::create($request->all());

            return redirect('roles')->with('success','Role creado correctamente');
        } catch (ValidationException $validationException) {
            return redirect('roles')->with('error',$validationException->getMessage());

        } catch (\Exception $exception) {

            return redirect('roles')->with('error',$exception->getMessage());
        }


    }


    public function show(Role $role)
    {
        return view('roles.show',compact('role'));
    }


    public function edit(Role $role)
    {
        return view('roles.edit',compact('role'));

    }

    /**
     * @param Request $request
     * @param Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        try {

            $request->validate([
                'name' => 'required|max:75',
            ]);


            $role->update($request->all());

            return redirect('roles')->with('success','Role actualizado correctamente');
        } catch (ValidationException $validationException) {
            return redirect('roles')->with('error',$validationException->getMessage());


        } catch (\Exception $exception) {

            return redirect('roles')->with('error',$exception->getMessage());
        }
        //
    }


    public function destroy(Role $role)
    {
        try {

            $role->delete();
            return redirect('roles')->with('success','Role eliminado correctamente');
        }catch (\Exception $exception) {

            return redirect('roles')->with('error',$exception->getMessage());
        }
    }
}
