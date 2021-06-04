<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Kamar;
use App\Keluhan;
use App\Perbaikan;
use App\StatusKamar;
use Illuminate\Http\Request;
use GroceryCrud\Core\GroceryCrud;
use Illuminate\Support\Facades\Hash;
use Modules\Member\Entities\Role;

class AdminController extends Controller
{
    private function _getDatabaseConnection() {
        $databaseConnection = config('database.default');
        $databaseConfig = config('database.connections.' . $databaseConnection);


        return [
            'adapter' => [
                'driver' => 'Pdo_Mysql',
                'database' => $databaseConfig['database'],
                'username' => $databaseConfig['username'],
                'password' => $databaseConfig['password'],
                'charset' => 'utf8'
            ]
        ];
    }

    private function _getGroceryCrudEnterprise() {
        $database = $this->_getDatabaseConnection();
        $config = config('grocerycrud');

        $crud = new GroceryCrud($config, $database);

        return $crud;
    }

    private function _show_output($output, $title = '') {
        if ($output->isJSONResponse) {
            return response($output->output, 200)
                  ->header('Content-Type', 'application/json')
                  ->header('charset', 'utf-8');
        }

        $css_files = $output->css_files;
        $js_files = $output->js_files;
        $output = $output->output;

        return view('grocery', [
            'output' => $output,
            'css_files' => $css_files,
            'js_files' => $js_files,
            'title' => $title
        ]);
    }

    public function assets()
    {
        $title = "Assets";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('assets');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Asset', 'Assets');
        $crud->unsetColumns(['created_at','updated_at']);
        $crud->unsetFields(['created_at','updated_at']);
        $crud->callbackAfterInsert(function ($s) {
            $data = Asset::find($s->insertId);
            $data->created_at = now();
            $data->touch();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $user = Asset::find($s->primaryKeyValue);
            $user->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }

    public function status_kamar()
    {
        $title = "Status Kamar";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('status_kamar');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Status Kamar', 'Status Kamar');
        $crud->unsetColumns(['created_at','updated_at']);
        $crud->unsetFields(['created_at','updated_at']);
        $crud->callbackAfterInsert(function ($s) {
            $data = StatusKamar::find($s->insertId);
            $data->created_at = now();
            $data->touch();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $user = StatusKamar::find($s->primaryKeyValue);
            $user->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }

    public function roles()
    {
        $title = "Role Pengguna Sistem";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('roles');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Role Pengguna Sistem', 'Role Pengguna Sistem');
        $crud->unsetColumns(['created_at','updated_at']);
        $crud->unsetFields(['created_at','updated_at']);
        $crud->unsetEdit()->unsetDelete()->unsetAdd();
        $crud->callbackAfterInsert(function ($s) {
            $data = Role::find($s->insertId);
            $data->created_at = now();
            $data->touch();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $user = Role::find($s->primaryKeyValue);
            $user->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }

    public function keluhan()
    {
        $title = "Keluhan";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('keluhan');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Keluhan', 'Keluhan');
        $crud->unsetColumns(['created_at','updated_at']);
        $crud->unsetFields(['created_at','updated_at']);
        $crud->unsetEdit()->unsetDelete()->unsetAdd();
        $crud->setRelation('kamar_id', 'kamar', 'nomor_kamar');
        $crud->setRelation('user_id', 'users', '{name} {last_name}');
        $crud->displayAs([
            'kamar_id' => 'Nomor Kamar',
            'user_id' => 'Nama Tamu'
        ]);
        $crud->callbackAfterInsert(function ($s) {
            $data = Keluhan::find($s->insertId);
            $data->created_at = now();
            $data->touch();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $user = Keluhan::find($s->primaryKeyValue);
            $user->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }

    public function perbaikan()
    {
        $title = "Perbaikan";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('perbaikan');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Perbaikan', 'Perbaikan');
        $crud->unsetColumns(['created_at','updated_at']);
        $crud->unsetFields(['created_at','updated_at']);
        $crud->unsetEdit()->unsetDelete()->unsetAdd();
        $crud->setRelation('keluhan_id', 'keluhan', 'keluhan');
        $crud->setRelation('user_id', 'users', '{name} {last_name}');
        $crud->displayAs([
            'keluhan_id' => 'Keluhan',
            'user_id' => 'Nama Petugas'
        ]);
        $crud->callbackAfterInsert(function ($s) {
            $data = Perbaikan::find($s->insertId);
            $data->created_at = now();
            $data->touch();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $user = Perbaikan::find($s->primaryKeyValue);
            $user->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }

    public function kamar()
    {
        $title = "Kamar";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('kamar');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Kamar', 'Kamar');
        $crud->unsetColumns(['created_at','updated_at']);
        $crud->unsetFields(['created_at','updated_at']);
        $crud->callbackAfterInsert(function ($s) {
            $data = Kamar::find($s->insertId);
            $data->created_at = now();
            $data->touch();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $user = Kamar::find($s->primaryKeyValue);
            $user->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }
}
