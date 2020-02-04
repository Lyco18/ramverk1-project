<?php

namespace Lyco\Tag;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
class Tag extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
     protected $tableName = "Tag";
     protected $tableIdColumn = "tagId";



    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
     public $tagId;
     public $tag;
     public $postId;

    public function findAllTagsWhere($where, $value)
    {
        $this->checkDb();
        $params = is_array($value) ? $value : [$value];
        return $this->db->connect()
                        ->select()
                        ->from($this->tableName)
                        ->where($where . " = ?")
                        ->join("post", "tag.postId = post.postId")
                        ->execute($params)
                        ->fetchAllClass(get_class($this));
    }

    public function findPopular()
    {
        $this->checkDb();
        return $this->db->connect()
                        ->select("tag")
                        ->from($this->tableName)
                        ->groupBy("tag.tag")
                        ->limit(5)
                        ->execute()
                        ->fetchAllClass(get_class($this));
    }
}
