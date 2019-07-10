<?php

/**
 * Author S Brinta
 * Email: <brrinta@gmail.com>
 * Web: http://brinta.me
 * Do not edit file without permission of author
 * All right reserved by S Brinta 
 * Created on : Apr 07, 2017, 11:14:10 AM
 */
class Mdb extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @param type $table
     * @param type $where
     * @return int
     */
    function countData($table, $where = 0) {
        $this->db->select('*');
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * 
     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $select
     * @return boolean
     */
    function getDataArray($table, $where = 0, $order = 0, $limit = 0, $select = 0) {
        if ($select) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        if ($order) {
            foreach ($order as $key => $sort) {
                $this->db->order_by($key, $sort);
            }
        }
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        if ($limit) {
            if ($query->num_rows()) {
                return $query->result_array();
            }
            return [];
        }

        if ($query->num_rows()) {
            return $query->result_array();
        }
        return [];
    }

    /**
     * 
     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $select
     * @return boolean
     */
    function getDataLikeArray($table, $where = 0, $order = 0, $limit = 0, $select = 0) {
        if ($select) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table);
        if ($where) {
            $this->db->like($where);
        }
        if ($order) {
            foreach ($order as $key => $sort) {
                $this->db->order_by($key, $sort);
            }
        }
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        if ($limit) {
            if ($query->num_rows()) {
                return $query->result_array();
            }
            return [];
        }

        if ($query->num_rows()) {
            return $query->result_array();
        }
        return [];
    }

    /**
     * 
     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $select
     * @return boolean
     */
    function getData($table, $where = 0, $order = 0, $limit = 0, $select = 0, $groupBy = 0) {
        if ($select) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        if ($order) {
            foreach ($order as $key => $sort) {
                $this->db->order_by($key, $sort);
            }
        }
        if ($groupBy) {
            $this->db->group_by($groupBy);
        }
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        if ($limit) {
            if ($query->num_rows()) {
                return $query->result();
            }
            return [];
        }
        if ($query->num_rows()) {
            return $query->result();
        }
        return [];
    }

    /**
     * 
     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $select
     * @return boolean
     */
    function getDataLike($table, $where = 0, $order = 0, $limit = 0, $select = 0) {
        if ($select) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table);
        if ($where) {
            //foreach ($where as $key => $sort) {
            $this->db->or_like($where);
            //}
        }
        if ($order) {
            foreach ($order as $key => $sort) {
                $this->db->order_by($key, $sort);
            }
        }
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        if ($limit) {
            if ($query->num_rows()) {
                return $query->result();
            }
            return [];
        }
        if ($query->num_rows()) {
            return $query->result();
        }
        return [];
    }

    /**
     * 
     * @param type $table
     * @param type $like
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $select
     * @return boolean
     */
    function getDataLikeWhere($table, $like = 0, $where = 0, $order = 0, $limit = 0, $select = 0, $groupBy = 0) {
        if ($select) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table);
        if ($like) {
            $this->db->or_like($like);
        }
        if ($where) {
            $this->db->where($where);
        }
        if ($order) {
            foreach ($order as $key => $sort) {
                $this->db->order_by($key, $sort);
            }
        }
        if ($groupBy) {
            $this->db->group_by($groupBy);
        }
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        if ($limit) {
            if ($query->num_rows()) {
                return $query->result();
            }
            return [];
        }
        if ($query->num_rows()) {
            return $query->result();
        }
        return [];
    }

    /**
     * 
     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $select
     * @return boolean
     */
    function getSingleData($table, $where = 0, $order = 0, $select = 0) {
        if ($select) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        if ($order) {
            foreach ($order as $key => $sort) {
                $this->db->order_by($key, $sort);
            }
        }

        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows()) {
            return $query->row();
        }
        return false;
    }

    /**
     * 
     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $select
     * @return boolean
     */
    function getSingleDataArray($table, $where = 0, $order = 0, $select = 0) {
        if ($select) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table);
        if ($where) {
            $this->db->where($where);
        }
        if ($order) {
            foreach ($order as $key => $sort) {
                $this->db->order_by($key, $sort);
            }
        }

        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows()) {
            return $query->row_array();
        }
        return false;
    }

    /**
     * 
     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $select
     * @return boolean
     */
    function getSingleDataLikeArray($table, $where = 0, $order = 0, $select = 0) {
        if ($select) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table);
        if ($where) {
            $this->db->like($where);
        }
        if ($order) {
            foreach ($order as $key => $sort) {
                $this->db->order_by($key, $sort);
            }
        }

        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows()) {
            return $query->row_array();
        }
        return false;
    }

    /**
     * 
     * @param type $query
     * @return array
     */
    function executeCustomArray($query) {
        $quy = $this->db->query($query);
        return $quy->result_array();
    }

    /**
     * 
     * @param type $query
     * @return std class
     */
    function executeCustom($query) {
        $quy = $this->db->query($query);
        return $quy->result();
    }

    /**
     * 
     * @param type $table
     * @param type $saveData
     * @return boolean
     */
    function insertData($table, $saveData) {
        if ($this->db->insert($table, $saveData)) {
            return $this->db->insert_id();
        }
        return 0;
    }

    /**
     * 
     * @param type $table
     * @param type $saveArray
     * @return type
     */
    function insertBatchData($table, $saveArray) {
        return $this->db->insert_batch($table, $saveArray);
    }

    /**
     * 
     * @param type $table
     * @param type $data
     * @param type $where
     * @return boolean
     */
    function updateData($table, $data, $where) {
        if ($this->db->update($table, $data, $where)) {
            return 1;
        }
        return 0;
    }

    /**
     * @param type $table
     * @param type $where
     * @return boolean
     */
    function removeData($table, $where) {
        return $this->db->delete($table, $where);
    }

}
