<?php

namespace Database\Seeders;

use App\Models\Registro;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $rol_admin = Role::create(['name' => 'admin']);
        $rol_tutor = Role::create(['name' => 'tutor']);

        Permission::create(['name' => 'tutorias.home'])->syncRoles([$rol_admin]);
        Permission::create(['name' => 'tutorias.tutores.show'])->syncRoles([$rol_admin]);
        Permission::create(['name' => 'show.date'])->syncRoles([$rol_admin]);
        Permission::create(['name' => 'mes.admin'])->syncRoles([$rol_admin]);
        Permission::create(['name' => 'nuevo_ingreso.home'])->syncRoles([$rol_admin]);
        Permission::create(['name' => 'solo.admin'])->syncRoles([$rol_admin]);
        Permission::create(['name' => 'mes.tutor'])->syncRoles([$rol_tutor]);
        Permission::create(['name' => 'solo.tutor'])->syncRoles([$rol_tutor]);
        Permission::create(['name' => 'admin.tutor'])->syncRoles([$rol_admin, $rol_tutor]);

        /*
NO BORRAR ESTA LINEA NO RECUERDO COMO LA USE, SE USO CUANDO SE AGREGO UN UNEVO ROL Y PERMISO
DESPUES DE HABER TERMINADO
        $role_auditor = Role::create(['name' => 'auditor']);
        $permiso_admin_auditor = Permission::create(['name' => 'auditor.admin']);
        Permission::create(['name' => 'auditor'])->syncRoles([$role_auditor]);
        $role_auditor->givePermissionTo($permiso_admin_auditor);

 */

        $tutor = Tutor::create([
            'id' => 'Admin01',
            'carrera_id' => null,
            'nombre' => 'Admin',
            'ap_paterno' => 'Orientacion',
            'ap_materno' => 'Educativa',
            'telefono' => '7711544280',
            'sexo' => 'm',
            'domicilio' => 'Tantoyuca',
            'foto' => '/tutores/tutor-20211204-203909.png'
        ]);

        $user = User::create([
            'name' => 'Admin',
            'email' => 'orientacion14educativa@gmail.com',
            'password' => Hash::make('newadminpass'),
            'tutor_id' => 'Admin01' //$tutor_b[0]->id
        ])->assignRole('admin');

        Registro::create([
            'status' => 1
        ]);
    }
}
