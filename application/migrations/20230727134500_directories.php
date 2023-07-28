<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Directories extends CI_Migration {

  public function up(){
    $this->dbforge->add_field([
      'id' => [
        'type'            => 'INT',
        'constraint'      => 5,
        'unsigned'        => TRUE,
        'auto_increment'  => TRUE
      ],
      'nombres' => [
        'type'            => 'VARCHAR',
        'constraint'      => '100'
      ],
      'apellidos' => [
        'type'            => 'VARCHAR',
        'constraint'      => '100'
      ],
      'email' => [
        'type'            => 'VARCHAR',
        'constraint'      => '100',
        'unique'          => TRUE
      ],
      'telefono' => [
        'type'            => 'VARCHAR',
        'constraint'      => '100',
        'unique'          => TRUE
      ]
    ]);
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('directories');
  }

  public function down(){
    $this->dbforge->drop_table('directories');
  }
}
