<?php

function is_admin()
{
    $ci = get_instance();
    $role = $ci->session->userdata('perfil');

    $status = true;

    if ($role != '1') {
        $status = false;
    }

    return $status;
}

function is_superAdmin()
{
    $ci = get_instance();
    $role = $ci->session->userdata('perfil');

    $status = true;

    if ($role != '2') {
        $status = false;
    }

    return $status;
}

function is_denunciante()
{
    $ci = get_instance();
    $role = $ci->session->userdata('perfil');

    $status = true;

    if ($role != '5') {
        $status = false;
    }

    return $status;
}


function set_mensagem($mensagem, $tipo = true)
{
    $ci = get_instance();
    if ($tipo) {
        $ci->session->set_flashdata('mensagem', "<div class='alert alert-success'><strong>SUCCESSO!</strong> {$mensagem} <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
    } else {
        $ci->session->set_flashdata('mensagem', "<div class='alert alert-danger'><strong>ERRO!</strong> {$mensagem} <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
    }
	
}

function userdata()
{
    $ci = get_instance();
    $ci->load->model('login_model', 'login');
    $ci1->load->model('user_model', 'user');

    $userId = $ci->session->userdata('login_user_id');
    return $ci->login->get('tbllogin', ['id_usuario' => $userId]);
}

function output_json($data)
{
    $ci = get_instance();
    $data = json_encode($data);
    $ci->output->set_content_type('application/json')->set_output($data);
}


      


    
      
        