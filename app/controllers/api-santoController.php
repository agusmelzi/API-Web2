<?php

require_once './app/models/santoModel.php';
require_once './app/views/apiView.php';

class apiSantoController
{
    private $model;
    private $view;

    private $data;

    public function __construct()
    {
        $this->model = new santoModel();
        $this->view = new ApiView();

        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData()
    {
        return json_decode($this->data);
    }

    function home($params = null)
    {
        $attribute = $_GET['sort_by'];
        $order = $_GET['order'];
        $filter = $_GET['filter'];
        $data = $_GET['input'];
        
        //preguntar por arreglo asociativo

        if (isset($attribute) && isset($order)) {

            if (($attribute == 'nombre' || $attribute == 'pais' || $attribute == 'fecha_nacimiento'
            || $attribute == 'fecha_muerte' || $attribute == 'fecha_canonizacion') && 
            ($order == 'asc' || $order == 'desc')) {

                $santos = $this->model->getSantos($attribute, $order);
                $this->view->response($santos);

            } else {
                
                $this->view->response("Atributo no válido en sort_by y/o en order", 400);
            }
            
        } elseif (isset($filter) && isset($data)) {
            
            $santos = $this->model->getSantos(null, null, $filter, $data);

            if (empty($santos)) {

                $this->view->response("No hay ningún santo de ese $filter", 400);

            } else {

                $this->view->response($santos);
            }
            
        } else {

            $santos = $this->model->getSantos();
            $this->view->response($santos);
        }
    }

    function detalle($params = null)
    {
        $id = $params[':ID'];
        $santo = $this->model->getSanto($id);
        //$congregacion = $this->modelC->getCongregacion($santo['congregacion_fk']);

        if ($santo) {
            $this->view->response($santo); //, $congregacion);
        } else {
            $this->view->response("El santo con el id=$id no existe", 404);
        }
    }


    /*function santosXCategoria()
    {
        $categoria = $_POST['congregacion_fk'];
        $congregaciones = $this->modelC->getCongregaciones();

        $santos = $this->model->getSantosXCategoria($categoria);
        if ($santos == null) {
            $this->view->showList($santos, $congregaciones, 'No hay santos de esta congregación');
        } else {
            $this->view->showList($santos, $congregaciones);
        }
    }*/

    /*function createSaint()
    {
        $congregaciones = $this->modelC->getCongregaciones();
        $this->view->addNewSaint($congregaciones);
    }*/


    function addSaint($params = null)
    {

        $santo = $this->getData();

        if (
            empty($santo->nombre) || empty($santo->pais) || empty($santo->fecha_nacimiento)
            || empty($santo->fecha_muerte) || empty($santo->fecha_canonizacion) || empty($santo->congregacion_fk)
        ) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertSanto(
                $santo->nombre,
                $santo->pais,
                $santo->fecha_nacimiento,
                $santo->fecha_muerte,
                $santo->fecha_canonizacion,
                $santo->congregacion_fk
            );
            $santo = $this->model->getSanto($id);
            $this->view->response($santo, 201);
        }
    }

    /*function editSaint($param)
    {

        $congregaciones = $this->modelC->getCongregaciones();
        $santo = $this->model->editarSantos($param[0]);
        $this->view->editSaint($congregaciones, $santo);
    }*/

    function editarSanto($params = null)
    {

        $id = $params[':ID'];
        $santo = $this->model->getSanto($id);
        if ($santo) {
            $santo = $this->getData();
            $this->model->editSanto(
                $santo->id,
                $santo->nombre,
                $santo->pais,
                $santo->fecha_nacimiento,
                $santo->fecha_muerte,
                $santo->fecha_canonizacion,
                $santo->congregacion_fk
            );
            $this->view->response($santo, 201);

        }

        
    }

    function delete($params = null)
    {
        $id = $params[':ID'];

        $santo = $this->model->getSanto($id);
        if ($santo) {
            $this->model->borrarSanto($id);
            $this->view->response($santo);
        } else {
            $this->view->response("El santo con el id=$id no existe", 404);
        }
    }
}
