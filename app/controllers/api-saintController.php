<?php

require_once './app/models/saintModel.php';
require_once './app/views/apiView.php';
require_once './app/helpers/auth-apiHelper.php';

class apiSaintController
{
    private $model;
    private $view;
    private $authHelper;

    private $data;

    public function __construct()
    {
        $this->model = new saintModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();

        $this->data = file_get_contents("php://input");
    }

    private function getData()
    {
        return json_decode($this->data);
    }
    
    function home($params = null)
    {
        $attribute = strtolower($_GET['sort_by']) ?? null;
        $order = strtolower($_GET['order']) ?? null;
        $filter = strtolower($_GET['filter']) ?? null;
        $data = strtolower($_GET['input']) ?? null;
        $size = $_GET['size'] ?? null;
        $offset = $size*($_GET['page'] - 1) ?? null;

        $message = '';
        
        $columns = $this->model->getColumns();
        if ($attribute != null && $order != null) {

            $attributeSetted = false;

            foreach ($columns as $field) {
                if ($attribute == $field) {
                    $attributeSetted = true;
                }
            }

            if (($attributeSetted == true) && ($order == 'asc' || $order == 'desc')) {

            } else {
                $message .= "Atributo no válido en sort_by y/o en order";
                $this->view->response($message, 400);

            }
        }

        if ($filter != null && $data != null) {

            $filterSetted = false;
            
            foreach ($columns as $field) {
                if ($filter == $field) {
                    $filterSetted = true;
                }
            }

            if ($filterSetted == true) {
                $saints = $this->model->getSaints($attribute, $order, $filter, $data, $size, $offset);

                if (empty($saints)) {

                    $message .= "No hay ningún santo de ese $filter \n";
    
                }
            } else {
                $message .= "El filter ingresado no corresponde a ningún campo de la tabla \n";
                $this->view->response($message, 400);
            }

        }

        if ($size != null && $offset != null) {
            
            $saints = $this->model->getSaints($attribute, $order, $filter, $data, $size, $offset);

            if (empty($saints)) {

                $message .= "No hay más santos en la lista";

            }
        }


        $saints = $this->model->getSaints($attribute, $order, $filter, $data, $size, $offset);

        if (empty($saints)) {
            $this->view->response($message, 400);
        } else {
            $this->view->response($saints);            
        }

    }

    function getCongregations() {
        $congregations = $this->model->getCongregations();
        $this->view->response($congregations);
    }

    function detail($params = null)
    {
        $id = $params[':ID'];
        $saint = $this->model->getSaint($id);

        if ($saint) {
            $this->view->response($saint);
        } else {
            $this->view->response("El santo con el id=$id no existe", 404);
        }
    }

    function addSaint($params = null)
    {
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logeado", 401);
            return;
        }        

        $saint = $this->getData();
        
        if (
            empty($saint->nombre) || empty($saint->pais) || empty($saint->fecha_nacimiento)
            || empty($saint->fecha_muerte) || empty($saint->fecha_canonizacion) || empty($saint->congregacion_fk)
        ) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertSaint(
                $saint->nombre,
                $saint->pais,
                $saint->fecha_nacimiento,
                $saint->fecha_muerte,
                $saint->fecha_canonizacion,
                $saint->congregacion_fk
            );
            $saint = $this->model->getSaint($id);
            $this->view->response($saint, 201);
        }
    }

    function editSaint($params = null)
    {

        $id = $params[':ID'];

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logeado", 401);
            return;
        }

        $saint = $this->model->getSaint($id);
        if ($saint) {
            $saint = $this->getData();
            $this->model->editSaint(
                $saint->id,
                $saint->nombre,
                $saint->pais,
                $saint->fecha_nacimiento,
                $saint->fecha_muerte,
                $saint->fecha_canonizacion,
                $saint->congregacion_fk
            );
            $this->view->response($saint, 201);

        } else {
            $this->view->response('No se encontro un santo con ese ID', 404);
        }

    }

    function delete($params = null)
    {
        $id = $params[':ID'];

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logeado", 401);
            return;
        }

        $saint = $this->model->getSaint($id);
        if ($saint) {
            $this->model->borrarSanto($id);
            $this->view->response($saint);
        } else {
            $this->view->response("El santo con el id=$id no existe", 404);
        }
    }
}
