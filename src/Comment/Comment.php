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
}
