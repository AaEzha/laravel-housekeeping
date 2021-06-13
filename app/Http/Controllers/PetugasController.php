<?php

namespace App\Http\Controllers;

use App\Keluhan;
use App\Perbaikan;
use Illuminate\Http\Request;
use GroceryCrud\Core\GroceryCrud;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
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
        $title = "Perbaikan";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('perbaikan');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Perbaikan', 'Perbaikan');
        $crud->unsetColumns(['user_id','created_at','updated_at']);
        $crud->unsetFields(['keluhan_id','user_id','created_at','updated_at']);
        $crud->requiredFields(['status_perbaikan','tanggal_perbaikan']);
        $crud->unsetDelete()->unsetDeleteMultiple()->unsetAdd();
        $crud->callbackAfterUpdate(function ($s) {
            $user = Perbaikan::find($s->primaryKeyValue);
            $user->touch();
            return $s;
        });
        $crud->setTexteditor(['status_perbaikan']);
        $crud->fieldType('tanggal_keluhan','date');
        $crud->where(['user_id' => Auth::id(),'status_perbaikan' => '-']);
        $crud->setRelation('keluhan_id','keluhan','keluhan');
        $crud->displayAs([
            'keluhan_id' => 'Keluhan'
        ]);
        $crud->callbackColumn('keluhan_id', function ($value, $row) {
            $perbaikan = Perbaikan::find($row->id);
            return "Nomor kamar: " . $perbaikan->keluhan->kamar->nomor_kamar
                   . "<br>Tanggal: " .$perbaikan->keluhan->created_at->format('d F Y, H:i')
                   . $perbaikan->keluhan->keluhan;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }

    public function histori()
    {
        $title = "Perbaikan";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('perbaikan');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Perbaikan', 'Perbaikan');
        $crud->unsetColumns(['user_id','created_at','updated_at']);
        $crud->unsetFields(['keluhan_id','user_id','created_at','updated_at']);
        $crud->requiredFields(['status_perbaikan','tanggal_perbaikan']);
        $crud->unsetOperations();
        $crud->setTexteditor(['status_perbaikan']);
        $crud->fieldType('tanggal_keluhan','date');
        $crud->where(['user_id' => Auth::id()]);
        $crud->setRelation('keluhan_id','keluhan','keluhan');
        $crud->displayAs([
            'keluhan_id' => 'Keluhan'
        ]);
        $crud->callbackColumn('keluhan_id', function ($value, $row) {
            $perbaikan = Perbaikan::find($row->id);
            return "Nomor kamar: " . $perbaikan->keluhan->kamar->nomor_kamar
                   . "<br>Tanggal: " .$perbaikan->keluhan->created_at->format('d F Y, H:i')
                   . $perbaikan->keluhan->keluhan;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }
}
