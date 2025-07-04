<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAuthTokensTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'selector' => ['type' => 'VARCHAR', 'constraint' => 255],
            'hashed_validator' => ['type' => 'VARCHAR', 'constraint' => 255],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'expires' => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('selector'); // For fast lookups, selectors must be unique.
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('auth_tokens');
    }

    public function down()
    {
        $this->forge->dropTable('auth_tokens');
    }
}