<?php
class User_model extends CI_Model{

    function insertUser($data){
        $this->db->insert('users',$data);
    }

    function checkUser($email,$password){
        $query = $this->db->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
        if($query->num_rows()==1)
        {
            return $query->row();
        }
        else{
            return false;
        }
    }

    function checkCurrentPassword($currentPassword){
        $userid = $this->session->userdata('LoginSession')['id'];
        $query = $this->db->query("SELECT * FROM users WHERE id = '$userid' AND password = '$currentPassword'");
        if($query->num_rows()==1)
        {
            return true;
        }
        else{
            return false;
        }
    }

    function updatePassword($password){
        $userid = $this->session->userdata('LoginSession')['id'];
        $query = $this->db->query("update users set password = '$password' WHERE id = '$userid'");

    }

    function getUserById($userid){
        $query = $this->db->query("SELECT * FROM users WHERE id = '$userid'");
        return $query->row();
    }
    
    function updateUserProfile($userid, $data) {
        $this->db->where('id', $userid);
        $this->db->update('users', $data);
    }
    
}