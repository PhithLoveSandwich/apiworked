<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url'); // โหลด URL Helper
        $this->load->model('User_model'); // โหลด Model
    }

    // แสดงรายการผู้ใช้ทั้งหมด
    public function index() {
        $this->load->model('User_model');
    
        // จำนวนผู้ใช้ที่ต้องการแสดงต่อหน้า
        $limit = 10;
        // รับหมายเลขหน้าปัจจุบันจาก URL
        $current_page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
        $offset = ($current_page - 1) * $limit;
    
        // ดึงผู้ใช้จากฐานข้อมูล
        $data['users'] = $this->User_model->get_users($limit, $offset);
        
        // คำนวณจำนวนผู้ใช้ทั้งหมด
        $total_users = $this->User_model->get_user_count();
        // คำนวณจำนวนหน้าทั้งหมด
        $data['total_pages'] = ceil($total_users / $limit);
        $data['current_page'] = $current_page;
    
        // โหลด View
        $this->load->view('users_list', $data);
    }
    

    // แสดงฟอร์มสำหรับเพิ่มผู้ใช้ใหม่
    public function create() {
        if ($this->input->post()) { // ตรวจสอบว่ามีข้อมูล POST หรือไม่
            $data = array(
                'student_id' => $this->input->post('student_id'),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'branch' => $this->input->post('branch'),
                'faculty' => $this->input->post('faculty'),
            );
    
            $this->load->model('User_model'); // โหลด Model
            if ($this->User_model->insert_user($data)) {
                // ถ้าเพิ่มสำเร็จ Redirect ไปยังหน้ารายการผู้ใช้
                redirect('api/users');
            } else {
                // ถ้าเพิ่มไม่สำเร็จ แจ้งข้อความ
                echo "Error adding user.";
            }
        } else {
            // โหลด View สำหรับฟอร์มเพิ่มผู้ใช้
            $this->load->view('user_form');
        }
    }
    public function delete($id) {
        $this->load->model('User_model'); // โหลด Model
    
        if ($this->User_model->delete_user($id)) {
            // ถ้าลบสำเร็จ Redirect ไปยังหน้ารายการผู้ใช้
            redirect('api/users');
        } else {
            // ถ้าลบไม่สำเร็จ แจ้งข้อความ
            echo "Error deleting user.";
        }
    }

    public function update($id) {
        // โหลด Model
        $this->load->model('User_model');
        
        // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
        if ($this->input->post()) {
            // รับข้อมูลจากฟอร์ม
            $data = array(
                'student_id' => $this->input->post('student_id'),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'branch' => $this->input->post('branch'),
                'faculty' => $this->input->post('faculty')
            );
            
            // เรียกใช้ฟังก์ชัน update_user ใน Model
            if ($this->User_model->update_user($id, $data)) {
                // ถ้าอัปเดตสำเร็จ Redirect ไปยังหน้ารายการผู้ใช้
                redirect('api/users');
            } else {
                echo "Error updating user.";
            }
        } else {
            // ดึงข้อมูลผู้ใช้เพื่อนำไปแสดงในฟอร์ม
            $data['user'] = $this->User_model->get_user_by_id($id);
            // โหลด View สำหรับฟอร์มอัปเดต
            $this->load->view('user_update_form', $data);
        }
    }
    
    
}

