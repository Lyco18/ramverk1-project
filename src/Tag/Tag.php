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
}
