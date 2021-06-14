<?php

namespace App\Http\Controllers;

use GroceryCrud\Core\GroceryCrud;
use App\Keluhan;
use App\Perbaikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TamuController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Keluhan";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('keluhan');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Keluhan', 'Keluhan');
        $crud->unsetColumns(['user_id','created_at','updated_at']);
        $crud->unsetFields(['user_id','created_at','updated_at']);
        $crud->requiredFields(['kamar_id','tanggal_keluhan','keluhan']);
        $crud->callbackBeforeInsert(function ($s) {
            $s->data['user_id'] = Auth::id();
            return $s;
        });
        $crud->callbackAfterInsert(function ($s) {
            $data = Keluhan::find($s->insertId);
            $data->created_at = now();
            $data->touch();

            Perbaikan::create([
                'keluhan_id' => $s->insertId,
                'user_id' => 3,
                'status_perbaikan' => '-'
            ]);
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $user = Keluhan::find($s->primaryKeyValue);
            $user->touch();
            return $s;
        });
        $crud->setActionButton('Respon', 'fa fa-comments', function ($row) {
            return route('tamu.respon', $row->id);
        }, false);
        $crud->setTexteditor(['keluhan']);
        $crud->fieldType('tanggal_keluhan','date');
        $crud->where(['user_id' => Auth::id()]);
        $crud->setRelation('kamar_id','kamar','nomor_kamar');
        $crud->displayAs([
            'kamar_id' => 'Nomor Kamar'
        ]);
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }

    public function respon(Keluhan $keluhan)
    {
        $title = "Respon";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('perbaikan');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Respon', 'Respon');
        $crud->unsetColumns(['keluhan_id','created_at','updated_at']);
        $crud->unsetAdd()->unsetEdit()->unsetDelete();
        $crud->setActionButton('Kembali', 'fa fa-arrow-left', function ($row) {
            return route('tamu.index');
        }, false);
        $crud->fieldType('tanggal_perbaikan','date');
        $crud->where(['keluhan_id' => $keluhan->id]);
        $crud->setRelation('user_id','users','{name} {last_name}');
        $crud->displayAs([
            'user_id' => 'Nama Petugas'
        ]);
        $crud->unsetSearchColumns(['user_id']);
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }

}
