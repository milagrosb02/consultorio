<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CREO LOS ROLES
        $admin = Role::create(['name' => 'admin']);

        $profesional = Role::create(['name' => 'profesional']);

        $paciente = Role::create(['name' => 'paciente']);




        // CREO LOS PERMISOS
        Permission::create(['name' => 'dashboard completo'])->syncRoles([$admin]);
        Permission::create(['name' => 'ver turno agendado'])->syncRoles([$admin, $profesional, $paciente]);
        Permission::create(['name' => 'iniciar sesion'])->syncRoles([$admin, $profesional, $paciente]);
        Permission::create(['name' => 'cerrar sesion'])->syncRoles([$admin, $profesional, $paciente]);
        Permission::create(['name' => 'visualizar su propio perfil de usuario'])->syncRoles([$admin, $profesional, $paciente]);
        Permission::create(['name' => 'editar contraseña'])->syncRoles([$admin, $profesional, $paciente]);
        Permission::create(['name' => 'solicitar turno de urgencia'])->syncRoles([$paciente]);
        Permission::create(['name' => 'responder a turno de urgencia'])->syncRoles([$admin]);
        Permission::create(['name' => 'ver historial clinico'])->syncRoles([$admin, $profesional, $paciente]);
        Permission::create(['name' => 'alta y modificacion de historial clinico'])->syncRoles([$admin]);
        Permission::create(['name' => 'ver odontograma'])->syncRoles([$admin, $profesional, $paciente]);;
        Permission::create(['name' => 'alta y modificacion de odontograma'])->syncRoles([$admin]);
        Permission::create(['name' => 'lista de pacientes registrados'])->syncRoles([$admin]);
        Permission::create(['name' => 'alta y baja de obras sociales'])->syncRoles([$admin]);
        Permission::create(['name' => 'ver pacientes registrados'])->syncRoles([$admin]);
        Permission::create(['name' => 'buscar pacientes registrados'])->syncRoles([$admin]);
        Permission::create(['name' => 'alta, baja y modificacion de turno'])->syncRoles([$paciente]);
        Permission::create(['name' => 'editar numero de telefono'])->syncRoles([$paciente]);
        Permission::create(['name' => 'editar nombre de usuario'])->syncRoles([$admin, $profesional]);
        Permission::create(['name' => 'editar correo electronico'])->syncRoles([$paciente]);
    }
}
