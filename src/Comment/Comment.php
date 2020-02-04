<?php

namespace Lyco\Comment;

use Anax\DatabaseActiveRecord\ActiveRecordModel;


/**
 * A database driven model using the Active Record design pattern.
 */
class Comment extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Comment";
    protected $tableIdColumn = "commentId";



    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $commentId;
    public $postId;
    public $replyId;
    public $id;
    public $text;

    public function findAllCommentsWhere($where, $value)
    {
        $this->checkDb();
        $params = is_array($value) ? $value : [$value];
        return $this->db->connect()
                        ->select()
                        ->from($this->tableName)
                        ->where($where . " = ?")
                        ->execute($params)
                        ->fetchAllClass(get_class($this));
    }
}
