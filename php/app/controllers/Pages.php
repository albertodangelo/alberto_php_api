<?php

class Pages extends Controller {

    public function __construct() {
        // aus dem extended Core Controller
        //$this->postModel = $this->model('Post');
    }

    public function index () {

        //$posts = $this->postModel->getPosts();
        if(isLoggedIn()) {
            redirect('posts');
        }


        $data = [
            'title' => 'AlBook',
            'desc' => 'Ein einfaches soziales Netzwerk basierend auf dem Albertos PHP MVC Framework.',
        //    'posts' => $posts
        ];

        $this->view('pages/index', $data);
    }

    public function about () {

        $data = [
            'title' => 'Über AlBook',
            'desc' => 'AlBook hilft Posts mit anderen Nutzern zu teilen',
        ];

        $this->view('pages/about', $data );
    }
}