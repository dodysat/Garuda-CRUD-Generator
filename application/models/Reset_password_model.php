<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reset_password_model extends CI_Model
{

    public $table = 'tbl_user';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('tbl_user.id_users,tbl_user.full_name,tbl_user.email,tbl_user.password,tbl_user.images,tbl_user.id_user_level,is_aktif,

            tbl_user_level.id_user_level,
            tbl_user_level.nama_level

    ');
        $this->datatables->from('tbl_user');
        $this->datatables->join('tbl_user_level', 'tbl_user.id_user_level = tbl_user_level.id_user_level', 'left');

        $this->datatables->add_column('action', '<a href="javascript:;" class="btn btn-primary btn-xs" onclick="resetPassword($1)"><i class="fa fa-key" aria-hidden="true" on></i></a>', 'id_users');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function person($id)
    {
        $this->db->select('*');
        $data = $this->db->from('tbl_user');
        $this->db->where('id_users', $id);
        return $this->db->get();
        // return $this->db->generate();
    }
    public function update()
    {
        $password =  trim($this->input->post('password'));
        $id_users =  trim($this->input->post('id_users'));
        $password       = trim($this->input->post('password'));
        $options        = array("cost" => 4);
        $hashPassword   = password_hash($password, PASSWORD_BCRYPT, $options);

        $data = array('password' => $hashPassword);
        $this->db->where('id_users', $id_users);
        $this->db->update('tbl_user', $data);
        return $id_users;
    }
}
