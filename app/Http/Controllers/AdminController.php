<?php

namespace App\Http\Controllers;

use App\Asset;
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
}
