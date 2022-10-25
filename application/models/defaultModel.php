<?php


class defaultModel extends CI_Model
{
    public function Insert_Data($tbname, $data)
    {
        $this->db->insert($tbname, $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    public function Update_Data($condition, $tbname, $data)
    {
        $this->db->where($condition);
        $this->db->update($tbname, $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    public function Delete_Data($condition, $tbname)
    {
        $this->db->where($condition);
        $this->db->delete($tbname);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    public function Select_Data($field, $tbname)
    {
        $this->db->select($field);
        $query = $this->db->get($tbname);
        return $query->result_array();
    }
    public function Count_Data($field, $condition, $tbname)
    {
        $this->db->select($field);
        $this->db->where($condition);
        $query = $this->db->get($tbname);
        return $query->num_rows();
    }
    public function Select_Where_Data($field, $condition, $tbname)
    {
        $this->db->select($field);
        $this->db->where($condition);
        $query = $this->db->get($tbname);
        return $query->result_array();
    }
    public function Select_Where_Row($field, $condition, $tb)
    {
        // echo $field . $condition. $tb; exit;
        $this->db->select($field);
        $this->db->where($condition);
        $query = $this->db->get($tb, $condition);
        return $query->row_array();
    }
  
    // Custom Operations
    public function Login_User($field, $condition, $tb)
    {
        // echo $field . $condition. $tb; exit;
        $this->db->select($field);
        $this->db->where($condition);
        $query = $this->db->get($tb, $condition);
        $result = $query->num_rows();
        if ($result > 0) {
            $this->session->unset_userdata('userlog');
            $this->session->set_userdata('userlog', $query->row_array());
        }
        return $query->num_rows();
    }
    public function Join_Data($field, $tb1, $tb2, $condition)
    {
        $this->db->select($field);
        $this->db->from($tb1);
        $this->db->join($tb2, $condition);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function Join_Data_Where($field, $clause, $tb1, $tb2, $condition)
    {
        $this->db->select($field);
        $this->db->where($clause);
        $this->db->from($tb1);
        $this->db->join($tb2, $condition);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function Where_Not_In($field, $clause, $condition, $tb1, $tb2)
    {
        $this->db->select($field);
        $this->db->where_not_in('room_id',$clause);
        $this->db->from($tb1);
        $this->db->join($tb2, $condition);
        $query = $this->db->get();
        return $query->result_array();
    }
    // this data insert  into database and return last insert data id  
    public function Insert_Data_Id($tbname, $data)
    {
        $this->db->insert($tbname, $data); 
        $insert_id = $this->db->insert_id();
        return  $insert_id; 
    }
    public function Availability_Room($room_id, $start_time, $end_time)
    {
        $this->db->select('*');
        $this->db->where($room_id);
        $this->db->where('start_time >=', $start_time);
        $this->db->where('start_time <=', $end_time);
        $this->db->from('meeting_table');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function Booked_Rooms_info($condition)
    {
        $this->db->select('*');
        $this->db->from('meeting_table m'); 
        $this->db->join('users u', 'u.id=m.customer_id', 'left');
        $this->db->join('rooms_table r', 'r.room_id=m.room_id', 'left');
        $this->db->where($condition);
        $this->db->order_by('m.booking_id','desc');         
        $query = $this->db->get();
        return $query->result_array();
    }
}
