<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home_Model extends CI_Model
{
  public function index($fname, $lname, $emailid, $password)
  {
    $data = array(
      'name' => $fname,
      'lastname' => $lname,
      'email' => $emailid,
      'password' => $password
    );
    $query = $this->db->insert('user', $data);
    if ($query) {
      $this->session->set_flashdata('success', 'Registration successfull, Now you can login.');
      redirect('register');
    } else {
      $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
      redirect('register');
    }
  }
  public function signin($email, $password)
  {
    $data = array(
      'email' => $email,
      'password' => $password
    );
    $query = $this->db->where($data);
    $login = $this->db->get('user');
    if ($login != NULL) {
      return $login->row();
    }
  }
  public function get_user($user_id)
  {
    $data = array(
      'user_id' => $user_id
    );
    $query = $this->db->where($data);
    $login = $this->db->get('user_details');
    if ($login != NULL) {
      return $login->row();
    } {
      return false;
    }
  }
  public function get_applied_course($user_id)
  {
    $data = array(
      'user_id' => $user_id
    );
    $query = $this->db->where($data);
    $login = $this->db->get('applied_course');
    if ($login != NULL) {
      return $login->row();
    } {
      return false;
    }
  }
  public function get_course()
  {
    $query = $this->db->query("SELECT * FROM `course_details`");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function get_user_details($user_id)
  {
    $query = $this->db->query("SELECT * FROM `user_details` where user_id=$user_id;");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  public function user_applied_course($user_id)
  {
    $query = $this->db->query("SELECT * FROM `course_details` where id=$user_id;");
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }
  function inser_user_data($data)
  {
    $query = $this->db->insert('user_details', $data);
    if ($query) {
      $this->session->set_flashdata('success', 'User details updated successfully, Now you can choose the course.');
      redirect('user-details');
    } else {
      $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
      redirect('user-details');
    }
  }
  function insert_applied_course($data)
  {
    $query = $this->db->insert('applied_course', $data);
    if ($query) {
      $this->session->set_flashdata('success', 'Your course has been successfully applied');
      redirect('user-view');
    } else {
      $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
      redirect('user-view');
    }
  }
  function update_user_data($id, $data)
  {
    $this->db->where('id', $id);
    $query = $this->db->update('user_details', $data);
    if ($query) {
      $this->session->set_flashdata('success', 'User details updated successfully, Now you can choose the course.');
      redirect('user-details');
    } else {
      $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
      redirect('user-details');
    }
  }
}
