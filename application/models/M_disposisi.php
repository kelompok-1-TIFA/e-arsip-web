<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_disposisi extends CI_Model
{

    public $table = 'tb_disposisi';
    public $id = 'id_disposisi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->join("tb_surat_masuk","tb_surat_masuk.id_surat_masuk=tb_disposisi.id_surat_masuk");
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
        $this->db->join("tb_bagian","tb_bagian.id_bagian=tb_disposisi.id_bagian");
        $this->db->join("tb_surat_masuk","tb_surat_masuk.id_surat_masuk=tb_disposisi.id_surat_masuk");
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_grafik($tahun){
        return $this->db->query("SELECT MONTH(tgl_disposisi) AS bulan, COUNT(*) AS jumlah FROM tb_disposisi WHERE YEAR(tgl_disposisi)='$tahun' GROUP BY MONTH(tgl_disposisi)")->result();
    }

    function get_jumlah_grafik($tahun){
       return $this->db->query("SELECT YEAR(tgl_disposisi) AS tahun, COUNT(*) AS jumlah FROM tb_disposisi WHERE YEAR(tgl_disposisi)='$tahun' GROUP BY YEAR(tgl_disposisi)")->row();
    }

    function get_jumlah_grafik1($tahun,$bulan){
       return $this->db->query("SELECT MONTH(tgl_disposisi) AS bulan, COUNT(*) AS jumlah FROM tb_disposisi WHERE YEAR(tgl_disposisi)='$tahun' and MONTH(tgl_disposisi)='$bulan' GROUP BY YEAR(tgl_disposisi)")->num_rows();
    }

    function get_grafik_perbagian($tahun,$id){
        return $this->db->query("SELECT MONTH(tgl_disposisi) AS bulan, COUNT(*) AS jumlah FROM tb_disposisi WHERE YEAR(tgl_disposisi)='$tahun' and tb_disposisi.id_bagian='$id' GROUP BY MONTH(tgl_disposisi)")->result();
    }

    function get_jumlah_grafik_perbagian($tahun,$id){
       return $this->db->query("SELECT YEAR(tgl_disposisi) AS tahun, COUNT(*) AS jumlah FROM tb_disposisi WHERE YEAR(tgl_disposisi)='$tahun' and tb_disposisi.id_bagian='$id' GROUP BY YEAR(tgl_disposisi)")->row();
    }

    function get_jumlah_grafik_perbagian1($tahun,$bulan,$id){
       return $this->db->query("SELECT MONTH(tgl_disposisi) AS bulan, COUNT(*) AS jumlah FROM tb_disposisi WHERE YEAR(tgl_disposisi)='$tahun' and MONTH(tgl_disposisi)='$bulan' and tb_disposisi.id_bagian='$id' GROUP BY YEAR(tgl_disposisi)")->num_rows();
    }

    function get_by_bagian($id)
    {
        $this->db->join("tb_surat_masuk","tb_surat_masuk.id_surat_masuk=tb_disposisi.id_surat_masuk");
        $this->db->where('id_bagian', $id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    // get total rows
    function total_rows() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get total rows
    function total_rows_perbagian($id) {
        $this->db->from($this->table);
        $this->db->where('id_bagian', $id);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0) {
        $this->db->join("tb_surat_masuk","tb_surat_masuk.id_surat_masuk=tb_disposisi.id_surat_masuk");
        $this->db->order_by($this->id, $this->order);
	    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    function get_limit_data_perbagian($id,$limit, $start = 0) {
        $this->db->join("tb_surat_masuk","tb_surat_masuk.id_surat_masuk=tb_disposisi.id_surat_masuk");
        $this->db->where('id_bagian', $id);
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