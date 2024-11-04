<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBiayaToEvents extends Migration
{
    public function up()
    {
        $this->forge->addColumn('events', [
            'biaya' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true, // Bisa null jika tidak wajib diisi
                'default'    => 0, // Default biaya adalah 0 (gratis)
            ],
        ]);
    }

    public function down()
    {
        // Hapus kolom 'biaya' jika rollback migrasi
        $this->forge->dropColumn('events', 'biaya');
    }
}
