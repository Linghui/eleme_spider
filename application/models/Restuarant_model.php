<?php

class Restuarant_model extends CI_Model
{
    public function add($obj)
    {
        $this->db->insert('restaurant', $obj);

        return $this->db->insert_id();
    }

    public function get_by_condition($condition = null)
    {
        if ($condition) {
            $this->db->where($condition);
        }

        $query = $this->db->get('restaurant');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return;
        }
    }

    public function get_one_by_condition($condition)
    {
        $chineses = $this->get_by_condition($condition);
        if ($chineses) {
            return $chineses[0];
        }

        return;
    }
}
