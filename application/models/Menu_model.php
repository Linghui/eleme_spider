<?php

class Menu_model extends CI_Model
{
    public function add($obj)
    {
        $this->db->insert('menu', $obj);

        return $this->db->insert_id();
    }

    public function get_by_condition($condition = null, $order_column = null, $order = 'desc')
    {
        if ($condition) {
            $this->db->where($condition);
        }

        if ($order_column && $order) {
            $this->db->order_by($order_column, $order);
        }
        $query = $this->db->get('menu');
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
