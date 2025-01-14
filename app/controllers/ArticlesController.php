<?php

class ArticlesController extends SystemController
{
    public $mainmodel;

    public function __construct()
    {
        if(!authcheck()){
            redirect('users/login');
        }else{
            $this->mainmodel =  $this->model('Article');
        }
    }

    public function index()
    {
    
        $articles = $this->mainmodel->getarticles();

        $datas = [   
            "articles" => $articles
        ];

        return $this->view('articles/index',$datas);

    }

    public function create() {}

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