<?php

class CategoriesController extends SystemController
{
    public $statusmodel,$usermodel;

    public function __construct()
    {
        if(!authcheck()){
            redirect('users/login');
        }else{
            $this->categorymodel =  $this->model('Category');
            $this->statusmodel =  $this->model('Status');
            $this->usermodel = $this->model('User');
        }
        
    }

    public function index()
    {
    
        $categories = $this->categorymodel->allcategories();

        $datas = [   
            "categories" => $categories
        ];

        return $this->view('categories/index',$datas);

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