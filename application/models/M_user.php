<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_user extends CI_Model
{

    public $table = 'tb_user';
    public $id = 'id_user';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    function get_where($where)
    {
        $this->db->where($where);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function getwhere($where)
    {
        $this->db->join('tb_pegawai', 'tb_pegawai.nip = tb_user.nip_user', 'left');
        $this->db->where($where);
        return $this->db->get($this->table);
    }

    function get_where_default($where)
    {
        return $this->db->query('select * from tb_user '.$where);
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where('nip_user', $id);
        $this->db->update($this->table, $data);
    }

    function cek_login($where){
        $this->db->join('tb_pegawai', 'tb_pegawai.nip = tb_user.nip_user', 'left');
        $this->db->join('tb_bagian', 'tb_pegawai.id_bagian_pegawai = tb_bagian.id_bagian', 'left');
        $this->db->join('tb_jabatan', 'tb_pegawai.id_jabatan_pegawai = tb_jabatan.id_jabatan', 'left');   
        return $this->db->get_where($this->table,$where);
    }

}