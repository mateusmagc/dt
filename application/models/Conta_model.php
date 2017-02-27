<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Conta_model extends CI_Model {

	//testa os dados de login do usuário
	public function get_Login($dados=null){
				
		$this->db->select('usuarios.ID, usuarios.Nome, usuarios.Email');
		$this->db->from('usuarios');
		$this->db->where('usuarios.Email',$dados["Email"]);
		$this->db->where("usuarios.Senha",$dados["Senha"]);
		$query = $this->db->get()->result();
		return $query;
		
	}
	
	//seleciona os usuarios
	public function get_Usuarios($dados){
		
		$id = $dados['id'];
		
		$this->db->select("*");
		$this->db->from('usuarios');
		$query = $this->db->get();

		if($query->num_rows()>0):
			return $query->result();
		else:
			return false;
		endif;
	
	}
	
	//exclui usuarios
	public function del_Usuarios($itens,$id){
		$arrItem = explode(",",$itens);
		for($i=0;$i<count($arrItem);$i++){
			$this->db->where('ID', $arrItem[$i]);
			$query = $this->db->delete('usuarios');
		}
		return true;
	}
	
	//seleciona usuarios pelo id
	public function get_Item_ID($campos='*',$id){
	
		$this->db->select($campos);
		$this->db->from('usuarios');
		$this->db->where('ID', $id );
		$query = $this->db->get()->result();
		return $query;
	
	}
	
	//altera um usuario
	public function upd_Usuario($dados=null){
	
		$data = array(
				'Nome'=>$dados['Nome'] ,
				'Email'=>$dados['Email'] ,
				'Senha'=>$dados['Senha'],
		);
	
		$this->db->where('ID', $dados['ID']);
		$this->db->update('usuarios', $data);
	
		return true;
	
	}
	
	//Insere um usuario
	public function ins_Usuario($dados=null){
	
		$data = array(
				'Nome'=>$dados['Nome'] ,
				'Email'=>$dados['Email'] ,
				'Senha'=>$dados['Senha'],
		);
	
		$this->db->insert('usuarios',$data);
		$idItem = $this->db->insert_id();
			
		return $idItem;
	
	
	}
	
	//seleciona as salas
	public function get_Salas($dados){
	
		$id = $dados['id'];
	
		$this->db->select("*");
		$this->db->from('salas');
		$query = $this->db->get();
	
		if($query->num_rows()>0):
			return $query->result();
		else:
			return false;
		endif;
	
	}
	
	//exclui salas
	public function del_Salas($itens,$id){
		$arrItem = explode(",",$itens);
		for($i=0;$i<count($arrItem);$i++){
			$this->db->where('ID', $arrItem[$i]);
			$query = $this->db->delete('salas');
		}
		return true;
	}
		
	//seleciona Sala pelo id
	public function get_Sala_ID($campos='*',$id){
	
		$this->db->select($campos);
		$this->db->from('salas');
		$this->db->where('ID', $id );
		$query = $this->db->get()->result();
		return $query;
	
	}
	
	//altera uma sala
	public function upd_Sala($dados=null){
	
		$data = array(
				'Sala'=>$dados['Sala'] ,
		);
	
		$this->db->where('ID', $dados['ID']);
		$this->db->update('salas', $data);
	
		return true;
	
	}
	
	//Insere uma sala
	public function ins_Sala($dados=null){
	
		$data = array(
				'Sala'=>$dados['Sala'] ,
		);
	
		$this->db->insert('salas',$data);
		$idItem = $this->db->insert_id();
			
		return $idItem;
	
	
	}
	
	//seleciona as reservas
	public function get_Reservas($dados=null){
		$id = $dados['id'];
		$query = $this->db->query("SELECT r.Data, r.ID, u.Nome, u.ID as IDUSuario, s.Sala, s.ID as IDSala, h.Hora, h.ID AS IDHora FROM reservas r
								   INNER JOIN salas s ON s.ID = r.ID_Sala
								   INNER JOIN usuarios u ON u.ID = r.ID_Usuario
								   INNER JOIN horario h ON h.ID = r.ID_Horario
								   ORDER BY s.Sala, h.Hora ASC");
		return $query->result();
	}
	
	
	//seleciona os horários
	public function get_Horario(){
	
		$this->db->select("*");
		$this->db->from('horario');
		$query = $this->db->get();
	
		if($query->num_rows()>0):
			return $query->result();
		else:
			return false;
		endif;
	
	}
	
	//Insere a reserva
	public function ins_Reserva($dados=null){
	
		$this->db->insert('reservas',$dados);
		$idItem = $this->db->insert_id();
		return true;
	
	}
	
	//exclui reserva
	public function del_Reserva($id){
		
		$this->db->where('ID', $id);
		$query = $this->db->delete('reservas');
		return true;
	}
	
		
}