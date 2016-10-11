<?php

class BooksController extends Controller {

    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Book();
    }

    public function index(){
        $this->data['books'] = $this->model->getList();

    }

    public function view(){
        $params = App::getRouter()->getParams();

        if (isset($params[0])){
            $title = strtolower($params[0]);
            $this->data['book'] = $this->model->getByAlias($title);
        }
    }

    public function admin_add(){
        if ($_POST){
            $result = $this->model->save($_POST);
            if ($result){
                Session::setFlash('Page was saved.');
            }else{
                Session::setFlash('Error of adding page !!!');
            }
            Router::redirect('/admin/books/');
        }
    }

    public function admin_index(){
        $this->data['books'] = $this->model->getList();
    }

    public function admin_edit(){
        if ($_POST){
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $result = $this->model->save($_POST, $id);
            if ($result){
                Session::setFlash('Page was saved.');
            }else{
                Session::setFlash('Error of editing page!!!');
            }
            Router::redirect('/admin/books/');
        }


        if (isset($this->params[0])){
            $this->data['book'] = $this->model->getById($this->params[0]);
        }else{
            Session::setFlash('Wrong page id. !!!');
            Router::redirect('/admin/books/');
        }
    }
    
    public function admin_view(){
        $params = App::getRouter()->getParams();

        if (isset($params[0])){
            $title = strtolower($params[0]);
            $this->data['book'] = $this->model->getByAlias($title);
        }
    }

    public function admin_delete(){
        if (isset($this->params[0])){
            $result = $this->model->delete($this->params[0]);
            if ($result){
                Session::setFlash('Page was deleted.');
            }else{
                Session::setFlash('Error of deleting page !!!');
            }
        }
        Router::redirect('/admin/books/');
    }
}