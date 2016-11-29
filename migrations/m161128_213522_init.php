<?php

use yii\db\Migration;

class m161128_213522_init extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255),
        ]);

        $this->createTable('movie', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
        ]);

        $this->createTable('rating', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'movie_id' => $this->integer(),
            'rating' => $this->integer(),
        ]);

        // Adding keys not supported by SQLite
        //$this->addPrimaryKey('rating_pk', 'rating', ['user_id', 'movie_id']);
        //$this->addForeignKey('rating_fk_user', 'rating', 'user_id', 'user', 'id');
        //$this->addForeignKey('rating_fk_movie', 'rating', 'movie_id', 'movie', 'id');

        $this->insert('user', ['username' => 'viewer']);
        $this->insert('user', ['username' => 'critic']);

        $this->insert('movie', ['title' => 'The Data Mapper']);
        $this->insert('movie', ['title' => 'Return of The Data Mapper']);
        $this->insert('movie', ['title' => 'Revenge of Bride of The Data Mapper']);
    }

    public function down()
    {
        //$this->dropForeignKey('rating_fk_movie', 'rating');
        //$this->dropForeignKey('rating_fk_user', 'rating');
        //$this->dropPrimaryKey('rating_pk', 'rating');

        $this->dropTable('user');
        $this->dropTable('movie');
        $this->dropTable('rating');
    }
}
