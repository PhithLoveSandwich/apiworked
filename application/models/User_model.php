<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_users($limit, $offset) {
        $this->db->limit($limit, $offset); // กำหนด limit และ offset
        $query = $this->db->get('users'); // ดึงข้อมูลจากตาราง users
        return $query->result_array(); // คืนค่าข้อมูลเป็น array
    }
    
    public function get_user_count() {
        return $this->db->count_all('users'); // คืนค่าจำนวนผู้ใช้ทั้งหมด
    }
    

    // ดึงข้อมูลผู้ใช้ทั้งหมด
    public function get_all_users() {
        $query = $this->db->get('users'); // ดึงข้อมูลจากตาราง users
        return $query->result_array(); // คืนค่าเป็น array ของข้อมูลผู้ใช้
    }

    // เพิ่มผู้ใช้ใหม่
    public function insert_user($data) {
        return $this->db->insert('users', $data); // เพิ่มข้อมูลลงตาราง users
    }

    public function delete_user($id) {
        return $this->db->delete('users', array('id' => $id)); // ลบข้อมูลตาม ID
    }

    public function update_user($id, $data) {
        $this->db->where('id', $id); // ระบุ ID ของผู้ใช้ที่ต้องการอัปเดต
        return $this->db->update('users', $data); // อัปเดตข้อมูลในตาราง users
    }
    
    public function get_user_by_id($id) {
        $this->db->where('id', $id); // ระบุ ID ของผู้ใช้
        $query = $this->db->get('users'); // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
        return $query->row_array(); // คืนค่าข้อมูลเป็น array
    }
    
    
}

