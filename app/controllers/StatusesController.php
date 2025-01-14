<?php

class StatusesController extends SystemController
{
    public $statusmodel,$usermodel;

    public function __construct()
    {
        if(!authcheck()){
            redirect('users/login');
        }else{
            $this->statusmodel =  $this->model('Status');
            $this->usermodel = $this->model('User');
        }
        
    }

    public function index()
    {
    
        $statuses = $this->statusmodel->allstatuses();

        $datas = [   
            "statuses" => $statuses
        ];

        return $this->view('statuses/index',$datas);

    }

    public function create() {
        return $this->view('statuses/create');
    }

    public function show($id) {
        echo "I am Article Show Page = ID is $id <br/>";
    }

    public function edit($id) {
        echo "I am Article Edit Page = ID is $id <br/>";
    }

    public function update($id) {
        echo "I am Article Update Page = ID is $id <br/>";
    }

    public function destroy($id) {
        echo "I am Article Destory Page = ID is $id <br/>";
    }
}

// new ArticlesController();