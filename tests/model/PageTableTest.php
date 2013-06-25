<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-06-18 at 14:49:09.
 */
class PageTest extends PHPUnit_Extensions_Database_TestCase
{
	static public $pdo = null;
	public $conn = null;
	
    /**
     * @var Page
     */
    protected $object;

	public function getConnection() {
		if ($this->conn == null) {
			if (self::$pdo == null) {
				$dsn = sprintf('mysql:dbname=%s;host=%s', TestConfig::$db["dbname"],TestConfig::$db["host"]);
				self::$pdo = new PDO($dsn, TestConfig::$db["username"], TestConfig::$db["password"]);
				self::$pdo->query("set names utf8;");
			}
			$this->conn = $this->createDefaultDBConnection(self::$pdo, TestConfig::$db["dbname"]);
		}
		return $this->conn;
	}
	public function getDataSet() {
		$ds = new PHPUnit_Extensions_Database_DataSet_CompositeDataSet(array());
		$datas = $this->createMySQLXMLDataSet( dirname(__FILE__).'/datas/data.xml' );
		
		//$ds->addDataSet($tables);
		$ds->addDataSet($datas);
		return $ds;
	}

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
//		$conn = $this->getConnection();
//		$data = $this->getDataSet();
/*
		$conn = $this->getConnection();
		$pdo = $conn->getConnection();
		$dataset = $this->getDataSet();
		foreach ($dataset->getTableNames() as $table) {
			echo $table;
		} */
        $this->table = new PageTable;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }
	public function testInsert() {
		$expected = $this->createXMLDataSet(dirname(__FILE__) . '/../datas/expected.xml');
		$expected_page = $expected->getTable("page");
		//print_r($page);
		//return;
	
		$now = date('Y-m-d H:i:s');
		$this->table->insert(array(
			"name" => "phpunit テスト" ,
			"code" => "test" , 
			"action_code" => null , 
			"content_type" => 'text/html; charset=UTF-8',
			"is_close" => 1 , 
			"release_status" => 7 , 
			"release_date" => $now,
			"create_date" => $now,
			
		));
		$this->assertTablesEqual($expected_page , $this->getConnection()->createQueryTable("page","SELECT name,code,content_type FROM page"));	
	}
}
