<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag extends CI_Controller {

/*
isi :
1. Jadwalkegiatan masjid operasi CRUD
vars:
jkid
jknama
jkpihak
jkwaktu

*/

	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('username') and $this->session->userdata('userpass')){
		}else{
			redirect(base_url(''));
		}
		//load model
		$this->load->model('mpost');
		$this->load->model('mprofiladmin');
	}

	public function index(){
	  $data['page'] = "Tag";
		$data['cmtag'] = $this->mpost->tampiltag()->result();
		$data['padmin']=$this->mprofiladmin->tampilpadmin()->row();
		$data['error']=$this->session->userdata('err')?$this->session->userdata('err'):'';

		$this->load->view('core/core',$data);
		$this->load->view('vtag',$data);
		$this->load->view('core/footer',$data);
		$this->session->set_userdata('err',null);
	}

	public function tambahtag(){
		$data['page'] = "Tambah Tag";
		$this->load->model('mprofiladmin');
		$data['padmin']=$this->mprofiladmin->tampilpadmin()->row();

		$data['error']=$this->session->userdata('err')?$this->session->userdata('err'):'';
		$data['input']=$this->session->userdata('input')?$this->session->userdata('input'):
			array(
				'tag' => '',
			);

		$this->load->view('core/core',$data);
		$this->load->view('vtag',$data);
		$this->load->view('core/footer',$data);

		//bersih session
		$this->session->set_userdata('err',null);
		$this->session->set_userdata('input',null);
	}

	public function dbtambah(){
		$this->form_validation->set_rules('tag','Tag','required|min_length[1]|max_length[20]',
			array(
				'required' => '%s harus diisi',
				'min_length' => '%s harus >=1 karakter',
				'max_length' => '%s harus <=20 karakter'
			)
		);

		$data['tag'] = $this->input->post('tag');

		if (!$this->form_validation->run()) {
			$this->session->set_userdata('err',validation_errors());
			$this->session->set_userdata('input',$data);
			redirect('tag/tambahtag');
		}

		$this->mpost->tambahtag($data);
		redirect(base_url('tag'));
		unset($data);
	}

	public function dbhapus($tagid){
		$data['tagid'] = $tagid;
		$this->mpost->hapustag($data);
		redirect(base_url('tag'));
	}
}
