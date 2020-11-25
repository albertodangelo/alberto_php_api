<?php

class Posts extends Controller {

    public function __construct() {
        if(!isLoggedIn()) {
            redirect('users/login');
        }

        $this->postModel = $this->model('Post');
    }

    public function index() {

        $data = [
            'posts' => $this->postModel->getPosts(),
        ];

        $this->view('posts/index', $data);
    }

    public function add() {

        if($_SERVER['REQUEST_METHOD'] == 'POST' ) {

            // Das Formular wird verarbeitet
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            // Das Formular wird validiert
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => '',
            ];

            // Validiert Titel und Body
            if( empty($data['title'])) {
                $data['title_err'] = "Das Feld Titel darf nicht leer sein.";
            }
            if( empty($data['body'])) {
                $data['body_err'] = "Das Inhaltsfeld darf nicht leer sein.";
            }

            if(  empty($data['title_err']) && empty($data['body_err']) ) {
            
                // Validated
                if($this->postModel->addPost($data)) {

                    flash('post_added','Der Beitrag wurde publiziert');

                    redirect('posts');

                } else {
                    die("Etwas ist schief gelaufen.");
                }
            } else {

            }
        } else {

            $this->view('posts/add');   
        }
    }

    public function edit($id) {

        if($_SERVER['REQUEST_METHOD'] == 'POST' ) {

            // Das Formular wird verarbeitet
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            // Das Formular wird validiert
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'title_err' => '',
                'body_err' => '',
            ];

            // Validiert Titel und Body
            if( empty($data['title'])) {
                $data['title_err'] = "Das Feld Titel darf nicht leer sein.";
            }
            if( empty($data['body'])) {
                $data['body_err'] = "Das Inhaltsfeld darf nicht leer sein.";
            }

            if(  empty($data['title_err']) && empty($data['body_err']) ) {

                // Validated
                if($this->postModel->updatePost($data)) {

                    flash('post_added','Die Änderung wurde vorgenommen');

                    redirect('posts');

                } else {
                    die("Etwas ist schief gelaufen.");
                }
            } else {

            }
        } else {

          
            $post = $this->postModel->getPostById($id);

            if($post->user_id !== $_SESSION['user_id']) {
                redirect('posts');
            }

            $data = [
                'title' => $post->title,
                'body' => $post->body,
                'id' => $id,
            ];

            $this->view('posts/edit', $data);   
        }
    }

    public function show($id) {

      
        $data = $this->postModel->getPostById($id);

        /* $data = [
            "title" => $post->title,
            "body" => $post->body
        ]; */

        $this->view('posts/show', $data);

    }

    public function delete($id) {


        $post = $this->postModel->getPostById($id);

        if($post->user_id !== $_SESSION['user_id']) {
            redirect('posts');
        }
        
        $this->postModel->delete($id);

        flash('post_added','Der Eintrag wurde gelöscht');
        redirect('posts');

    }
}