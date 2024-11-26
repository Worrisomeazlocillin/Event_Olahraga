// app/Database/Migrations/xxxx-xx-xx_AddBiayaToEvents.php
public function up()
{
    $this->forge->addColumn('events', [
        'biaya' => [
            'type'       => 'INT',
            'constraint' => 11,
            'default'    => 0,
            'null'       => false,
        ],
    ]);
}

    public function down()
    {
        $this->forge->dropColumn('events', 'biaya');
    }
