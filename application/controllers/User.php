<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('User_model');
    }

    // แสดงรายการผู้ใช้ทั้งหมดเป็น JSON
    public function index() {
        $limit = 10;
        $current_page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
        $offset = ($current_page - 1) * $limit;

        $users = $this->User_model->get_users($limit, $offset);
        $total_users = $this->User_model->get_user_count();
        $total_pages = ceil($total_users / $limit);

        // ส่งออกข้อมูลเป็น JSON
        echo json_encode([
            'users' => $users,
            'total_pages' => $total_pages,
            'current_page' => $current_page
        ]);
    }

    // เพิ่มผู้ใช้ใหม่
    public function create() {
        if ($this->input->post()) {
            $data = array(
                'student_id' => $this->input->post('student_id'),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'branch' => $this->input->post('branch'),
                'faculty' => $this->input->post('faculty'),
            );

            if ($this->User_model->insert_user($data)) {
                echo json_encode(['status' => 'success', 'message' => 'User added successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error adding user.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data provided.']);
        }
    }

    public function delete($id) {
        if ($this->User_model->delete_user($id)) {
            echo json_encode(['status' => 'success', 'message' => 'User deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error deleting user.']);
        }
    }

    public function update($id) {
        if ($this->input->post()) {
            $data = array(
                'student_id' => $this->input->post('student_id'),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'branch' => $this->input->post('branch'),
                'faculty' => $this->input->post('faculty'),
            );

            if ($this->User_model->update_user($id, $data)) {
                echo json_encode(['status' => 'success', 'message' => 'User updated successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error updating user.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data provided.']);
        }
    }

    public function view($id) {
        $user = $this->User_model->get_user_by_id($id);

        if ($user) {
            echo json_encode(['status' => 'success', 'user' => $user]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found.']);
        }
    }
    
}
