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

        $this->data = file_get_contents("php://input");
    }

    private function getData()
    {
        return json_decode($this->data);
    }

    //preguntar por arreglo asociativo
    
    function home($params = null)
    {
        $attribute = $_GET['sort_by'];
        $order = $_GET['order'];
        $filter = $_GET['filter'];
        $data = $_GET['input'];
        $size = $_GET['size'];
        $offset = $size*($_GET['page'] - 1);

        $message = '';

        if (isset($attribute) && isset($order)) {

            if (($attribute == 'nombre' || $attribute == 'pais' || $attribute == 'fecha_nacimiento'
            || $attribute == 'fecha_muerte' || $attribute == 'fecha_canonizacion') && 
            ($order == 'asc' || $order == 'desc')) {

            } else {
                $message .= "Atributo no válido en sort_by y/o en order";
                $this->view->response($message, 400);

            }
        }

        if (isset($filter) && isset($data)) {
            
            $santos = $this->model->getSantos($attribute, $order, $filter, $data, $size, $offset);

            if (empty($santos)) {

                $message .= "No hay ningún santo de ese $filter \n";

            }
        
        }

        if (isset($size) && isset($offset)) {
            
            $santos = $this->model->getSantos($attribute, $order, $filter, $data, $size, $offset);

            if (empty($santos)) {

                $message .= "No hay más santos en la lista";

            }
        }


        $santos = $this->model->getSantos($attribute, $order, $filter, $data, $size, $offset);

        if (empty($santos)) {
            $this->view->response($message, 400);
        } else {
            $this->view->response($santos);            
        }

    }

    function detalle($params = null)
    {
        $id = $params[':ID'];
        $santo = $this->model->getSanto($id);

        if ($santo) {
            $this->view->response($santo);
        } else {
            $this->view->response("El santo con el id=$id no existe", 404);
        }
    }

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

        } else {
            $this->view->response('No se encontro un santo con ese ID', 404);
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
