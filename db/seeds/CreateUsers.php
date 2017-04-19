<?php

use Phinx\Seed\AbstractSeed;

class CreateUsers extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
      $data = [
          [
              'name'      => 'afri dermawan ginting',
              'username'  => 'afridermawan',
              'email'     => 'afrimuhsin@gmail.com',
              'password'  => password_hash('afrimuhsin', PASSWORD_DEFAULT)
          ],
          [
              'name'      => 'randy elmana putra',
              'username'  => 'randyelmanaputra',
              'email'     => 'randyelmanaputra@gmail.com',
              'password'  => password_hash('randyelmanaputra', PASSWORD_DEFAULT)
          ],
      ];

      $posts = $this->table('users');
      $posts->insert($data)->save();
    }
}
