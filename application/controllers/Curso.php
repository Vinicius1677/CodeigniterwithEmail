<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Curso extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->library('email');
    }

    public function salvar() {
        if ($this->session->userdata('usuario')->tipo != 1) {
            redirect('usuario/restricao');
        }
        $this->load->model('Curso_model');
        $this->Curso_model->nome = $_POST["nome"];
        $this->Curso_model->descricao = $_POST["descricao"];
        $this->Curso_model->imagem = $_FILES["imagem"]['tmp_name'];
        $this->Curso_model->inserir();
        redirect('curso/listar');
    }

    public function cadastrar() {
        if ($this->session->userdata('usuario')->tipo != 1) {
            redirect('usuario/restricao');
        }
        $this->load->view('template/cabecalho');
        $this->load->view('template/nav');
        $this->load->view('formcurso');
        $this->load->view('template/rodape');
    }

    public function listar() {
        $this->load->model('Curso_model');
        $dados["cursos"] = $this->Curso_model->recuperar();
        $this->load->view('template/cabecalho');
        $this->load->view('template/nav');
        $this->load->view('listarcursos', $dados);
        $this->load->view('template/rodape');
    }

    public function detalhes($id) {
        $this->load->model('Curso_model', 'cursos');
        $dados["curso"] = $this->cursos->recuperarUm($id);
        $this->load->view('template/cabecalho');
        $this->load->view('template/nav');
        $this->load->view('detalhescurso', $dados);
        $this->load->view('template/rodape');
    }

    public function excluir($id) {
        if ($this->session->userdata('usuario')->tipo != 1) {
            redirect('usuario/restricao');
        }
        $this->load->model('Curso_model');
        $this->Curso_model->remover($id);
        redirect('curso/listar');
    }

    public function editar($id) {
        if ($this->session->userdata('usuario')->tipo != 1) {
            redirect('usuario/restricao');
        }
        $this->load->model('Curso_model');
        $dados["c"] = $this->Curso_model->recuperarUm($id);
        $this->load->view('template/cabecalho');
        $this->load->view('template/nav');
        $this->load->view('editarcurso', $dados);
        $this->load->view('template/rodape');
    }

    public function atualizar($id) {
        if ($this->session->userdata('usuario')->tipo != 1) {
            redirect('usuario/restricao');
        }
        $this->load->model('Curso_model');
        $dados = array("nome" => $_POST["nome"], "descricao" => $_POST["descricao"]);
        $this->Curso_model->id = $id;
        $this->Curso_model->update($dados);
        redirect('curso/listar');
    }

    public function enviarEmail() {

        $this->load->library('email');
        $this->email->from("vaidarvagas@gmail.com", 'para voce');
        $this->email->subject("Assunto do e-mail");
        $this->email->to("viniciusbarros694@gmail.com"); 
        $this->email->message("saulo bola");
        $this->email->send();
        redirect('/');

    }

    public function upar() {

        $this->load->view('template/cabecalho');
        $this->load->view('template/nav');
        $this->load->view('upload');
        $this->load->view('template/rodape');
    }

    public function foto() {

        // $data = array('upload_data' => $this->upload->data());

        $data = "";

        if(isset($_GET['nome'])) {
            $data = array(
                'nome' => $_GET['nome'] . ".png");
        }

        // echo $data;
        $this->load->view('template/cabecalho');
        $this->load->view('template/nav');
        $this->load->view('imagem', $data);
        $this->load->view('template/rodape');
    }

    public function uparArquivo() {
     $nome         = $_POST['name'];
     $curriculo    = $_FILES['curriculo'];
     $configuracao = array(
         'upload_path'   => 'assets/uploads',
         'allowed_types' => 'png',
         'file_name'     => $nome.'.png',
         'max_size'      => '500'
     ); 

     $this->load->library('upload');
     $this->upload->initialize($configuracao);
     if ($this->upload->do_upload('curriculo')) {
        $data = array('upload_data' => $this->upload->data());
        redirect('curso/foto?nome='. $_POST['name']);
        
    }

     else {

         echo $this->upload->display_errors();
    }

    }


}
