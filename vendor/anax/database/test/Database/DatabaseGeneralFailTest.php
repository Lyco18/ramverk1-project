<?php

namespace Anax\Database;

use PHPUnit\Framework\TestCase;

/**
* Negative test the database class, general tests without using an actual
* database.
*/
class DatabaseGeneralFailTest extends TestCase
{
    /**
     * Connect without a DSN.
     *
     * @expectedException Anax\Database\Exception\Exception
     */
    public function testConnectWithoutDsn()
    {
        $db = new Database();
        $db->connect();
    }



    /**
     * Connect with malformed DSN.
     *
     * @expectedException Anax\Database\Exception\Exception
     */
    public function testConnectWithMalformedDsn()
    {
        $db = new Database([
           "dsn" => "NO DNS"
        ]);
        $db->connect();
    }



    /**
     * Connect with malformed DSN and debug_connect set to true.
     *
     * @expectedException \PDOException
     */
    public function testConnectWithMalformedDsnAndDebugConnect()
    {
        $db = new Database([
           "dsn" => "NO DNS",
           "debug_connect" => true,
        ]);
        $db->connect();
    }



    /**
     * Test execute before connect.
     *
     * @expectedException Anax\Database\Exception\Exception
     */
    public function testExecuteBeforeConnect()
    {
        $db = new Database();
        $db->execute("SELECT 1;");
    }
}
