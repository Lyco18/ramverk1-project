<?php

namespace Anax\DatabaseActiveRecord;

use Anax\DatabaseQueryBuilder\DatabaseQueryBuilder;
use PHPUnit\Framework\TestCase;

/**
* A testclass
*/
class ActiveRecordFailTest extends TestCase
{
    public static $db;



    /**
     * Sets up for all test cases.
     */
    public static function setUpBeforeClass()
    {
        self::$db = new DatabaseQueryBuilder([
            "dsn" => "sqlite::memory:",
            "table_prefix" => "mos_",
            "debug_connect" => true,
        ]);

        self::$db->connect();
        self::$db->createTable(
            "User",
            [
                "id" => ["integer", "primary key", "not null"],
                "acronym" => ["integer"],
                "password" => ["string"],
            ]
        )->execute();
    }



    /**
     * Save an object without injecting the database object.
     *
     * @expectedException \Anax\DatabaseActiveRecord\Exception\ActiveRecordException
     */
    public function testSaveWithoutInjectingDatabase()
    {
        $user1 = new User();
        $user1->save();
    }
}
