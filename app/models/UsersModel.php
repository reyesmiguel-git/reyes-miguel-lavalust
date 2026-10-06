<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersModel extends Model
{
    protected $table = 'users';

    public function __construct()
    {
        parent::__construct();
        $this->call->database();
    }

    public function all()
    {
        return $this->db->table($this->table)->get_all();
    }

    public function get_user_by_username($username)
    {
        return $this->db->table($this->table)
            ->where('username', $username)
            ->where('is_active', 1)
            ->get();
    }
}
