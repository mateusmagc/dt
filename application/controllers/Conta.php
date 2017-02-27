<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Conta extends MY_Controller {
	
	//bibliotecas e helpers utilizados na controler
	public function __construct(){
		parent::__construct();
		
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
		
		$this->load->helper(array('form','array','date'));
		$this->load->library(array('form_validation'));
		$this->load->model('Conta_model','conta');
	}
		
	//remove index da url do controler
	function _remap($method) { 
		$param_offset = 2; 
		if ( ! method_exists($this, $method)) { 
			$param_offset = 1; 
			$method = 'index'; 
		} 
		$params = array_slice($this->uri->rsegment_array(), $param_offset); 
		call_user_func_array(array($this, $method), $params); 
	}
	
	//testa para onde direcionar o usuário ao tentar entra na conta login/painel.
	public function index() {
		$login = $this->session->userdata('userLogin');
		if($login==true):
			$userLogin = $this->session->userdata('userDados');
			$id = $userLogin['userID'];
			$campos = "planos.Slang";
			$this->load->view('conta');
		else:
			$this->load->view('login');
		endif;
	}
	
	//login no painel.
	public function login(){
		//validação do formulário de login
		$this->form_validation->set_rules('Email','E-mail','trim|required|valid_email|max_length[255]|mb_strtolower');
		$this->form_validation->set_rules('Senha','Senha','trim|required');
		
		//se validação ok
		if ($this->form_validation->run()==true):
		
			//Chama método de login, retorna os dados do usuário
			$dados = elements(array('Email','Senha','salvar'), $this->input->post());
			$userLogin = $this->conta->get_Login($dados);
			
			if(!empty($userLogin)==1):
			
				//carrega os dados do usuário
				$userDados = array('userID'=>$userLogin[0]->ID,
								   'userNome'=>$userLogin[0]->Nome,
								   'userEmail'=>$userLogin[0]->Email,
				);
				
				//cria session d elogin e dados
				$this->session->set_userdata('userLogin',true);
				$this->session->set_userdata('userDados',$userDados);	
				
				//direciona para o painel
				$this->load->view('conta', $dados);
				
			else:
				
				$dados = array('error'=>'Senha ou e-mail não encontrado');
				$this->load->view('login',$dados);
			
			endif;
			
		else:
			$dados = array('area'=>'conta');
			$this->load->view('login',$dados);
		endif;
	}
	
	//Logoff conta do painel.
	public function Logoff(){
	
		$this->session->set_userdata('userLogin',false);
		$this->session->sess_destroy();
		$dados = array('area'=>'conta');
		$this->load->view('login',$dados);
	
	}
		
	
	
	//view dos usuários
	public function Usuarios(){
		
		$login = $this->session->userdata('userLogin');
		if($login==true):
		
			$userLogin = $this->session->userdata('userDados');
			$id = $userLogin['userID'];
							
			$data["id"] = $id;
			
			$resultado_busca = $this->conta->get_Usuarios($data);
			$pais = "PaiDesc_".$this->uri->segment(1);
			$divisao = "Titulo_".$this->uri->segment(1);
			
			if ($resultado_busca != false):
			
				foreach ($resultado_busca as $result):
					
					$result_busca['resultado'][] = array(
							'ID' => $result->ID,
							'Nome' => $result->Nome,
							'Email' => $result->Email,
					);
					
				endforeach;
				$result = true;
			
			else:
			
				$result = false;
				$result_busca['resultado'] = "Nunhum registro encontrado";
			
			endif;
		
			$dados = array('result' =>$result,
						   'resultado'=>$result_busca['resultado']);
			$this->load->view('conta_usuarios',$dados);
			
		else:
			
			$dados = array('area'=>'conta');
			$this->load->view('login',$dados);
		
		endif;
		
	}
	
	//Delete usuários
	public function Delete_usuarios(){
		
		$login = $this->session->userdata('userLogin');
		if($login==true):
		
			$userLogin = $this->session->userdata('userDados');
			$id = $userLogin['userID'];
			
			$result['sucesse']= $this->conta->del_Usuarios($this->input->post('itens'),$id);
			
			//$result['sucesse']= $this->input->post('itens');
			echo json_encode($result);
			
		else:
			
			$dados = array('area'=>'conta');
			$this->load->view('login',$dados);
		
		endif;
		
	}
	
	//chama view de alteração do usuário
	public function Alterar_usuario(){
		$login = $this->session->userdata('userLogin');
		if($login==true):
		
			$id_item = $this->uri->segment(3);
		
			$userLogin = $this->session->userdata('userDados');
			$id = $userLogin['userID'];
			
			$dados = array('area'=>'conta',
						   'upd'=>true,
						   'update'=>false,
						   'item'=>$this->conta->get_Item_ID('*',$id_item)
			);
			$this->load->view('form_usuario',$dados);
			
		else:
			
			$dados = array('area'=>'conta');
			$this->load->view('login',$dados);
		
		endif;
		
	}
	
	//Update do usuário no db.
	public function Update_Usuario(){
	
		$login = $this->session->userdata('userLogin');
		if($login==true):
			
			$userLogin = $this->session->userdata('userDados');
			$id = $userLogin['userID'];
			$update = false;
				
			//validaÃ§Ã£o do formulÃ¡rio de item
			$this->form_validation->set_rules('Nome','Nome','trim|required|max_length[255]|mb_strtoupper');
			$this->form_validation->set_rules('Email','Email','trim|required|max_length[255]|mb_strtoupper');
			$this->form_validation->set_rules('Senha','Senha','trim|required|max_length[255]');
			$id_item = $this->input->post('ID');
				
			//se validaÃ§Ã£o ok
			if ($this->form_validation->run()==true):
				
			//Chama mÃ©todo de alteraÃ§Ã£o de item
			$dados = elements(array('ID','Nome','Email','Senha'), $this->input->post());
			$update = $this->conta->upd_usuario($dados);
		
			endif;
				
			$dados = array('upd'=>true,
					'update'=>$update,
					'item'=>$this->conta->get_Item_ID('*',$id_item)
			);
			$this->load->view('form_usuario',$dados);
			
			
		else:
			
			$dados = array('area'=>'conta');
			$this->load->view('login',$dados);
	
		endif;
	
	}
	
	//chama view de inclusão do usuário
	public function Incluir_usuario(){
		$login = $this->session->userdata('userLogin');
		if($login==true):
	
			$userLogin = $this->session->userdata('userDados');
			$id = $userLogin['userID'];
				
			$dados = array(
					'upd'=>false,
					'update'=>false,
			);
			$this->load->view('form_usuario',$dados);
			
		else:
			
			$dados = array('area'=>'conta');
			$this->load->view('login',$dados);
	
		endif;
	
	}
	
	//Insert do usuário no db.
	public function Insert_Usuario(){
	
		$login = $this->session->userdata('userLogin');
		if($login==true):
			
			$userLogin = $this->session->userdata('userDados');
			$id = $userLogin['userID'];
			$update = false;
			
			//validaÃ§Ã£o do formulÃ¡rio de item
				
			//validaÃ§Ã£o do formulÃ¡rio de item
			$this->form_validation->set_rules('Nome','Nome','trim|required|max_length[255]|mb_strtoupper');
			$this->form_validation->set_rules('Email','Email','trim|required|max_length[255]|mb_strtoupper');
			$this->form_validation->set_rules('Senha','Senha','trim|required|max_length[255]');
			
			//se validaÃ§Ã£o ok
			if ($this->form_validation->run()==true):
				 
				//Chama mÃ©todo de alteraÃ§Ã£o de item
				$dados = elements(array('ID','Nome','Email','Senha'), $this->input->post());
				
				$id_usuario = $this->conta->ins_Usuario($dados);
				
				if($id_usuario!=false):
					$update =  true;
				else:
					$update =  false;
				endif;
				
			
			
			$dados = array('upd'=>true,
						   'update'=>$update,
						   'item'=>$this->conta->get_Item_ID('*',$id_usuario)
			);
			$this->load->view('form_usuario',$dados);
			else:
			
				$dados = array('area'=>'conta',
						'upd'=>false,
						'update'=>false,
				);
				$this->load->view('form_usuario',$dados);
			
			endif;
		else:
			
			$this->load->view('login');
	
		endif;
	
	}
	
	
	//view das salas
	public function Salas(){
	
		$login = $this->session->userdata('userLogin');
		if($login==true):
	
			$userLogin = $this->session->userdata('userDados');
			$id = $userLogin['userID'];
			
			$data["id"] = $id;
			
			$resultado_busca = $this->conta->get_Salas($data);

			if ($resultado_busca != false):
				
				foreach ($resultado_busca as $result):
					
				$result_busca['resultado'][] = array(
						'ID' => $result->ID,
						'Sala' => $result->Sala,
				);
					
				endforeach;
				$result = true;
				
			else:
				
				$result = false;
				$result_busca['resultado'] = "Nunhum registro encontrado";
				
			endif;
	
			$dados = array('result' =>$result,
					'resultado'=>$result_busca['resultado']);
			$this->load->view('conta_salas',$dados);
			
		else:
			
			$dados = array('area'=>'conta');
			$this->load->view('login',$dados);
	
		endif;
	
	}
	
	//Delete salas
	public function Delete_salas(){
	
		$login = $this->session->userdata('userLogin');
		if($login==true):
	
		$userLogin = $this->session->userdata('userDados');
		$id = $userLogin['userID'];
			
		$result['sucesse']= $this->conta->del_Salas($this->input->post('itens'),$id);
			
		//$result['sucesse']= $this->input->post('itens');
		echo json_encode($result);
			
		else:
			
		$dados = array('area'=>'conta');
		$this->load->view('login',$dados);
	
		endif;
	
	}
	
	//chama view de alteração de salas
	public function Alterar_sala(){
		$login = $this->session->userdata('userLogin');
		if($login==true):
	
		$id_item = $this->uri->segment(3);
	
		$userLogin = $this->session->userdata('userDados');
		$id = $userLogin['userID'];
			
		$dados = array('area'=>'conta',
				'upd'=>true,
				'update'=>false,
				'item'=>$this->conta->get_Sala_ID('*',$id_item)
		);
		$this->load->view('form_sala',$dados);
			
		else:
			
		$dados = array('area'=>'conta');
		$this->load->view('login',$dados);
	
		endif;
	
	}
	
	//Update da sala no db.
	public function Update_Sala(){
	
		$login = $this->session->userdata('userLogin');
		if($login==true):
			
		$userLogin = $this->session->userdata('userDados');
		$id = $userLogin['userID'];
		$update = false;
	
		//validação do formulário da sala
		$this->form_validation->set_rules('Sala','Sala','trim|required|max_length[255]|mb_strtoupper');
		$id_item = $this->input->post('ID');
	
		//se validaÃ§Ã£o ok
		if ($this->form_validation->run()==true):
	
		//Chama método de alteração de sala
		$dados = elements(array('ID','Sala'), $this->input->post());
		$update = $this->conta->upd_sala($dados);
	
		endif;
	
		$dados = array('upd'=>true,
				'update'=>$update,
				'item'=>$this->conta->get_Sala_ID('*',$id_item)
		);
		$this->load->view('form_sala',$dados);
			
			
		else:
			
		$dados = array('area'=>'conta');
		$this->load->view('login',$dados);
	
		endif;
	
	}
	
	//chama view de inclusão de sala
	public function Incluir_sala(){
		$login = $this->session->userdata('userLogin');
		if($login==true):
	
		$userLogin = $this->session->userdata('userDados');
		$id = $userLogin['userID'];
	
		$dados = array(
				'upd'=>false,
				'update'=>false,
		);
		$this->load->view('form_sala',$dados);
			
		else:
			
		$dados = array('area'=>'conta');
		$this->load->view('login',$dados);
	
		endif;
	
	}
	
	//Insert da sala no db.
	public function Insert_Sala(){
	
		$login = $this->session->userdata('userLogin');
		if($login==true):
			
			$userLogin = $this->session->userdata('userDados');
			$id = $userLogin['userID'];
			$update = false;
				
			//validação do formulário de item
			$this->form_validation->set_rules('Sala','Sala','trim|required|max_length[255]|mb_strtoupper');
				
			//se validaÃ§Ã£o ok
			if ($this->form_validation->run()==true):
				
				//Chama método de alteração de item
				$dados = elements(array('ID','Sala'), $this->input->post());
			
				$id_usuario = $this->conta->ins_Sala($dados);
			
				if($id_usuario!=false):
					$update =  true;
				else:
					$update =  false;
				endif;
			
				$dados = array('upd'=>true,
						'update'=>$update,
						'item'=>$this->conta->get_Sala_ID('*',$id_usuario)
				);
				$this->load->view('form_sala',$dados);
			else:
				
			$dados = array('area'=>'conta',
					'upd'=>false,
					'update'=>false,
			);
			$this->load->view('form_sala',$dados);
				
			endif;
		
		else:
			
			$this->load->view('login');
	
		endif;
	
	}
	
	//view das reservas
	public function Reservas(){
	
		$login = $this->session->userdata('userLogin');
		if($login==true):
	
			$userLogin = $this->session->userdata('userDados');
			$id = $userLogin['userID'];
			
			$data["id"] = $id;
			
			$resultado_busca = $this->conta->get_Reservas($data);
			
			if ($resultado_busca != false):
			
				foreach ($resultado_busca as $result):
			
					$dt = new DateTime($result->Data);
					$data = $dt->format('d/m/Y');
					$dataAT = mdate('%d/%m/%Y',time());
					
					
					if($data<$dataAT):
					
						$this->conta->del_Reserva($result->ID);
					
					else:
					
						if($data=$dataAT):
								$h = new DateTime($result->Hora);
								$hora = $h->format('h:m');
								$atual = mdate('%h:%i', time());
								
								if($hora<$atual):
							
									$this->conta->del_Reserva($result->ID);
								
								else:
								
									$result_busca['resultado'][] = array(
											'ID' => $result->ID,
											'Nome' => $result->Nome,
											'Sala' => $result->Sala,
											'Hora' => $result->Hora,
											'Data' => $data,
											'IDUsuario'=>$result->IDUSuario,
									);
								
								endif;
						
						else:
						
							$result_busca['resultado'][] = array(
										'ID' => $result->ID,
										'Nome' => $result->Nome,
										'Sala' => $result->Sala,
										'Hora' => $result->Hora,
										'Data' => $data,
										'IDUsuario'=>$result->IDUSuario,
								);
				
						endif;
					endif;
				endforeach;
				
				$result = true;
			
			else:
			
				$result = false;
				$result_busca['resultado'] = "Nunhuma reserva até o momento.";
			
			endif;
	
			$dados = array('result' =>$result,
			  			   'resultado'=>$result_busca['resultado'],
						   'IDUser' =>$id);
			$this->load->view('conta_reservas',$dados);
			
		else:
			
			$this->load->view('login');
	
		endif;
	
	}
	
	//chama view de inclusão de reserva
	public function Incluir_reserva(){
		
		$login = $this->session->userdata('userLogin');
		if($login==true):
	
			$userLogin = $this->session->userdata('userDados');
			$id = $userLogin['userID'];
			$data["id"]= $id;
			
			$dados = array('Horarios'=>$this->conta->get_Horario(),
						   'Salas'=>$this->conta->get_Salas($data),
						   'Reservas'=>$this->conta->get_Reservas(),
						   'IDUser'=>$id,
						   'upd'=>false,
						   'update'=>false,
			);
			
			$this->load->view('form_reserva',$dados);
			
		else:
			
			$dados = array('area'=>'conta');
			$this->load->view('login',$dados);
	
		endif;
	
	}
	
	//Insert da reserva no db.
	public function Insert_reservas(){
	
		$login = $this->session->userdata('userLogin');
		if($login==true):
			
			$userLogin = $this->session->userdata('userDados');
			$id = $userLogin['userID'];
			$res["ID_Usuario"] = $id;
			$salas = $this->input->post('salas');
			$reservas = $this->input->post('reservas');
			$arrSalas = explode(",", $salas);
			$arrReserva = explode(",", $reservas);
						
			for($r=0;$r<=count($arrSalas)-1;$r++){
				$res["ID_Sala"]=$arrSalas[$r];

				if(trim($arrReserva[$r])!=""){
					$arrVal = explode("-", $arrReserva[$r]);
					for($h=0;$h<=count($arrVal)-1;$h++){
						if(trim($arrVal[$h])!=""){
							$res["ID_Horario"] = $arrVal[$h];
							$this->conta->ins_Reserva($res);
						}
					}
				}
			}
			
			$result['sucesse']= false;
				
			echo json_encode($result);

		else:
			
			$this->load->view('login');
	
		endif;
	
	}
	
	
	//Apaga reserva
	public function Delete_reservas(){
		
		$login = $this->session->userdata('userLogin');
		if($login==true):
			
			$userLogin = $this->session->userdata('userDados');
			$id = $userLogin['userID'];
			$res["ID_Usuario"] = $id;
			$reserva = $this->input->post('reserva');
			$this->conta->del_Reserva($reserva);
			$result['sucesse']= true;
			echo json_encode($result);
			
		else:
				
			$this->load->view('login');
			
		endif;
		
	}
	
	
}