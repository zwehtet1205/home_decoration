<?php

class SubscribesController extends SystemController
{
    public $subscribemodel;

    public function __construct()
    {
        if(!authcheck()){
            redirect('users/login');
        }else{
            $this->subscribemodel =  $this->model('Subscribe');
        }
        
    }

    public function index()
    {
    
        $subscirbes = $this->statusmodel->allsubscirbes();

        $datas = [   
            "subscirbes" => $subscirbes
        ];

        return $this->view('subscirbes/index',$datas);

    }



    public function create() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $datas = [
                "name" => textfilter($_post['name'] ?? '') ,
                "email" => textfilter($_post['email'] ?? '') ,
                "nameerr" => '' ,
                "emailerr" => '' ,
            ];

            if($this->subscribemodel->createsubscribe($datas)) {
                flash('success','You are successfully subscribed');
                redirect('welcomes/index');
            } else {
                die('Error Found !!!');
            }
        } else {
            $datas = [
                "name" => '' ,
                "email" => '' ,
                "nameerr" => '' ,
                "emailerr" => '' ,
            ];
            return $this->view('welcomes',$datas);
        }
    }

    
}