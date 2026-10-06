<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductModel extends Model
{
    protected $table = 'products';

    public function get_all()
    {
        return $this->db->table($this->table)->get_all();
    }

    public function all()
    {
        return $this->get_all();
    }

    public function get_by_id($id)
    {
        return $this->db->table($this->table)->where('id', $id)->get();
    }

    public function find($id)
    {
        return $this->get_by_id($id);
    }

    public function insert($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function create($data)
    {
        return $this->insert($data);
    }

    public function update($id, $data)
    {
        return $this->db->table($this->table)->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->db->table($this->table)->where('id', $id)->delete();
    }
}
