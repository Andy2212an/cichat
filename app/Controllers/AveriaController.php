<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Averia;

class AveriaController extends BaseController{

  public function index(){
    return view('averias/listar');
  }

  public function registrar(){
    return view('averias/registrar');
  }

  public function agregarRegistro(){
    $averia = new Averia();

    $this->response->setContentType('application/json');
    $data = $this->request->getJSON();

    $newRecord = [
      'cliente'   => $data->cliente,
      'problema'  => $data->problema,
      'fechahora' => $data->fechahora
    ];

    $averia->insert($newRecord);
    return $this->response->setJSON([
      'success' => true,
      'id'      => $averia->getInsertID()
    ]);
  }

  public function listarAverias(){
    $averia = new Averia();

    $this->response->setContentType('application/json');
    $rows = $averia->where('status', 'P')->orderBy('id', 'ASC')->findAll();
    
    return $this->response->setJSON($rows);
  }

  public function solucionado(){
    return view('averias/solucionado');
  }

  public function listarSolucionados(){
    $averia = new Averia();

    $this->response->setContentType('application/json');
    $rows = $averia->where('status', 'S')->orderBy('id', 'DESC')->findAll();
    
    return $this->response->setJSON($rows);
  }

  public function marcarSolucionado($id){
    $averia = new Averia();

    $this->response->setContentType('application/json');
    
    $updated = $averia->update($id, ['status' => 'S']);
    
    return $this->response->setJSON([
      'success' => $updated,
      'id'      => $id
    ]);
  }

}