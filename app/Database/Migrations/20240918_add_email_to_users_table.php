// app/Database/Migrations/20240918_add_email_to_users_table.php

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailToUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique'     => true,
                'after'      => 'username', // place after username column
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'email');
    }
}
