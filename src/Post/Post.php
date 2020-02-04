<?php

namespace Lyco\Post;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
class Post extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Post";



    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $postId;
    public $acronym;
    public $title;
    public $text;


    public function findLatest()
    {
        $this->checkDb();
        return $this->db->connect()
                        ->select()
                        ->from($this->tableName)
                        ->orderBy("post.postId DESC")
                        ->limit("2")
                        ->execute()
                        ->fetchAllClass(get_class($this));
    }
}
