<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Listar rol')->only('index');
        $this->middleware('can:Crear rol')->only('create', 'store');
        $this->middleware('can:Editar rol')->only('edit','update');
        $this->middleware('can:Eliminar rol')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación detallada de los datos
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'exists:permissions,id'
        ], [
            'name.required' => 'El nombre del rol es obligatorio.',
            'name.unique' => 'Este nombre de rol ya está en uso.',
            'permissions.required' => 'Debes asignar al menos un permiso.',
            'permissions.*.exists' => 'Uno de los permisos seleccionados no es válido.'
        ]);

        DB::beginTransaction(); // Inicia una transacción para mayor seguridad

        try {
            // Creación del rol
            $role = Role::create(['name' => $request->name]);

            // Asignación de permisos al rol
            $role->permissions()->sync($request->permissions);

            DB::commit(); // Confirma la transacción

            // Redirección con mensaje de éxito
            return redirect()->route('admin.roles.index')
                ->with('success', 'El rol ha sido creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack(); // Revierte la transacción en caso de error

            // Redirección con mensaje de error
            return redirect()->back()
                ->withErrors(['error' => 'Hubo un problema al crear el rol.'])
                ->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        // Validar los datos de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        // Actualizar el nombre del rol
        $role->update([
            'name' => $request->name
        ]);

        // Sincronizar los permisos seleccionados
        $role->permissions()->sync($request->permissions);

        // Redirigir con mensaje de éxito
        return redirect()->route('admin.roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        // Eliminar el rol
        $role->delete();

        // Redirigir al índice de roles con un mensaje de éxito
        return redirect()->route('admin.roles.index')->with('success', 'Rol eliminado exitosamente.');
    }
}
