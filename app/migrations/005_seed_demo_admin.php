<?php

class Seed_demo_admin
{
    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->database();
    }

    public function up()
    {
        $stmt = $this->_lava->db->raw('SELECT COUNT(*) AS total FROM users');
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ((int)($row['total'] ?? 0) > 0) {
            return;
        }

        $username = getenv('DEFAULT_ADMIN_USERNAME') ?: 'admin';
        $email = getenv('DEFAULT_ADMIN_EMAIL') ?: 'admin@example.com';
        $password = getenv('DEFAULT_ADMIN_PASSWORD') ?: 'admin123';
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $this->_lava->db->raw(
            'INSERT INTO users (username, email, password, role, is_active, created_at) VALUES (?, ?, ?, ?, 1, NOW())',
            [$username, $email, $hash, 'admin']
        );
    }

    public function down()
    {
        $username = getenv('DEFAULT_ADMIN_USERNAME') ?: 'admin';
        $email = getenv('DEFAULT_ADMIN_EMAIL') ?: 'admin@example.com';

        $this->_lava->db->raw(
            'DELETE FROM users WHERE username = ? AND email = ?',
            [$username, $email]
        );
    }
}
