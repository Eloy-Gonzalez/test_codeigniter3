<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Directories Controller
 */
class Directories extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->model('crud');
    $this->load->model('mongodirectories');
    $this->load->library("pagination");
    $this->load->helper(['form']);
    $this->load->library('form_validation');
  }

  public function index(){
    $config["base_url"] = base_url() . "directories"; 
    $config["total_rows"] = $this->crud->get_count_all('directories');
    $config["per_page"] = 5;
    $config["uri_segment"] = 2;
    $config['full_tag_open'] = '<ul class="pagination">';        
    $config['full_tag_close'] = '</ul>';        
    $config['first_link'] = 'First';        
    $config['last_link'] = 'Last';        
    $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['first_tag_close'] = '</span></li>';        
    $config['prev_link'] = '&laquo';        
    $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['prev_tag_close'] = '</span></li>';        
    $config['next_link'] = '&raquo';        
    $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['next_tag_close'] = '</span></li>';        
    $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['last_tag_close'] = '</span></li>';        
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';        
    $config['cur_tag_close'] = '</a></li>';        
    $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['num_tag_close'] = '</span></li>';
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
    $data["links"] = $this->pagination->create_links();
    $data['data'] = $this->crud->getRows('directories', $config["per_page"], $page);     
    $this->load->view('directories/list',$data);
  }

  public function create(){
    $this->load->view('directories/create');
  }

  public function store(){
    $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    $this->form_validation->set_rules('nombres', 'Nombres', 'required', ['required' => 'El campo %s es requerido']);
    $this->form_validation->set_rules('apellidos', 'Apellidos', 'required', ['required' => 'El campo %s es requerido']);
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[directories.email]', [
      'required'  => 'El campo %s es requerido',
      'is_unique' => 'El %s ya se encuentra registrado'
    ]);
    $this->form_validation->set_rules('telefono', 'Telefono', 'required|numeric|is_unique[directories.telefono]', [
      'required'  => 'El campo %s es requerido',
      'is_unique' => 'El %s ya se encuentra registrado',
      'numeric'   => 'Solo se aceptan numeros'
    ]);
    $data['nombres'] = $this->input->post('nombres');
    $data['apellidos'] = $this->input->post('apellidos');
    $data['email'] = $this->input->post('email');
    $data['telefono'] = $this->input->post('telefono');
    if ($this->form_validation->run()) {
      $result = $this->crud->insert('directories', $data);
      if($result) {
        $this->session->set_flashdata('message', '<div class="alert alert-success">Directory has been saved successfully.</div>');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Directory cannot saved. please check form data</div>');
      }
      redirect(base_url());
    } else {
      $this->load->view('directories/create');
    }
  }

  public function edit($id){
    $data['data'] = $this->crud->find_record_by_id('directories', $id);
    $this->load->view('directories/edit', $data);
  }

  public function update($id){
    $data['nombres'] = $this->input->post('nombres');
    $data['apellidos'] = $this->input->post('apellidos');
    $data['email'] = $this->input->post('email');
    $data['telefono'] = $this->input->post('telefono');

    $result = $this->crud->update('directories', $data, $id);
    if($result) {
      $this->session->set_flashdata('message', '<div class="alert alert-success">Directory has been updated successfully.</div>');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger">Directory cannot updated. please check form data</div>');
    }
    redirect(base_url());
  }

  public function delete($id){
    $this->crud->delete('directories', $id);
    $this->session->set_flashdata('message', '<div class="alert alert-success">Directory has been deleted successfully.</div>');
    redirect(base_url());
  }

  public function exportCSV(){
		$filename = 'directories_'.date('Ymd').'.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/csv; "); 

		// get data
		$data = $this->crud->getRows('directories', 1000, 0);

		// file creation
		$file = fopen('php://output', 'w');


		$header = array("Id","Nombres","Apellidos","Email", "Telefono");
		fputcsv($file, $header);

		foreach ($data as $key => $line){
		//  fputcsv($file,$line);
     if( is_object($line) )
        $fields = (array) $line;
        fputcsv($file, $fields);
		}

		fclose($file);
		exit;
	}

  public function backup(){
    $config["base_url"] = base_url() . "directories/backup"; 
    $config["total_rows"] = $this->mongodirectories->count();;
    $config["per_page"] = 5;
    $config["uri_segment"] = 2;
    $config['full_tag_open'] = '<ul class="pagination">';        
    $config['full_tag_close'] = '</ul>';        
    $config['first_link'] = 'First';        
    $config['last_link'] = 'Last';        
    $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['first_tag_close'] = '</span></li>';        
    $config['prev_link'] = '&laquo';        
    $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['prev_tag_close'] = '</span></li>';        
    $config['next_link'] = '&raquo';        
    $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['next_tag_close'] = '</span></li>';        
    $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['last_tag_close'] = '</span></li>';        
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';        
    $config['cur_tag_close'] = '</a></li>';        
    $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['num_tag_close'] = '</span></li>';
    $this->pagination->initialize($config);
    $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
    $data['data'] = $this->mongodirectories->getDirectories($page, $config["per_page"]);
    $data["links"] = $this->pagination->create_links();
    $this->load->view('directories/backup', $data);
  }

  public function createbackup(){
		$data = $this->crud->getRows('directories', 1000, 0);
    $result = $this->mongodirectories->insert($data);
    if($result){
      $this->session->set_flashdata('message', '<div class="alert alert-success">Backup generated successfully.</div>');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger">Error creating backup.</div>');
    }
    redirect(base_url());
  }
}
