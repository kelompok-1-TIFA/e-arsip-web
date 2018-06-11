<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_surat_masuk extends CI_Model
{

    public $table = 'tb_surat_masuk';
    public $id = 'id_surat_masuk';
    public $order = 'DESC';
    public $tahun = 2018;

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

    function get_satu_baru()
    {
        $this->db->limit(1);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->row();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->join('tb_jenis_surat', 'tb_jenis_surat.id_jenis_surat = tb_surat_masuk.id_jenis_surat', 'left');  
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_where($where)
    {
        return $this->db->query('select * from tb_surat_masuk '.$where)->result();
    }

    function get_grafik($tahun){
        return $this->db->query("SELECT MONTH(tgl_arsip) AS bulan, COUNT(*) AS jumlah FROM tb_surat_masuk WHERE YEAR(tgl_arsip)='$tahun' GROUP BY MONTH(tgl_arsip)")->result();
    }

    function get_jumlah_grafik($tahun)
    {
       return $this->db->query("SELECT YEAR(tgl_arsip) AS tahun, COUNT(*) AS jumlah FROM tb_surat_masuk WHERE YEAR(tgl_arsip)='$tahun' GROUP BY YEAR(tgl_arsip)")->row();
    }

    function get_jumlah_grafik1($tahun,$bulan)
    {
       return $this->db->query("SELECT YEAR(tgl_arsip) AS tahun, COUNT(*) AS jumlah FROM tb_surat_masuk WHERE YEAR(tgl_arsip)='$tahun' and MONTH(tgl_arsip)='$bulan' GROUP BY YEAR(tgl_arsip)")->num_rows();
    }
    
    // get total rows
    function total_rows() {
    	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0) {
        $this->db->order_by($this->id, $this->order);
	   $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}