<?php

/**
 * Implements a singleton object that is used to setup global-level settings for PHPDraft to operate, including a database connection.
 * NOTE: DO NOT edit anything in this class, if you edit you do so at your own risk. Open global_setup.php to edit settings.
 */
class PHPDRAFT {
	// <editor-fold defaultstate="collapsed" desc="Constants">
	/**
	 * Timezone for GMT-00:00, Greenwich Mean
	 */
	const TIMEZONE_GMT = "Europe/London";
	/**
	 * Timezone for GMT-05:00, Eastern Standard
	 */
	const TIMEZONE_EST = "America/New_York";
	/**
	 * Timezone for GMT-06:00, Central Standard
	 */
	const TIMEZONE_CST = "America/Chicago";
	/**
	 * Timezone for GMT-07:00, Mountain Standard
	 */
	const TIMEZONE_MTN = "America/Denver";
	/**
	 * Timezone for GMT-08:00, Pacific Standard
	 */
	const TIMEZONE_PCF = "America/Los_Angeles";
	// </editor-fold>
	
	private $_db_username;
	private $_db_pwd;
	private $_db_host;
	private $_db_name;
	
	public function __construct() {
		$this->_db_host = "localhost";
	}
	
	// <editor-fold defaultstate="collapsed" desc="Setters">
	/**
	 * Set the database username PHPDraft will connect to the database server with.
	 * @param string $username 
	 */
	public function setDatabaseUsername($username) {
		$this->_db_username = $username;
	}
	
	/**
	 * Set the password PHPDraft will use to connect to the database server.
	 * @param string $password 
	 */
	public function setDatabasePassword($password) {
		$this->_db_pwd = $password;
	}

	/**
	 * Set the hostname of the database server PHPDraft's data is on. By default this is "localhost", so setting this is optional in most cases.
	 * @param string $hostname 
	 */
	public function setDatabaseHostname($hostname) {
		$this->_db_host = $hostname;
	}
	
	/**
	 * Set the name of the database stored within the database server that PHPDraft will use.
	 * NOTE: Most shared hosting providers enforce a database naming scheme that automatically prepends your username with an underscore
	 * to every database name (such as "youraccount_phpdraft"), so be sure to double-check the database name if have issues.
	 * @param string $database_name
	 */
	public function setDatabaseName($database_name) {
		$this->_db_name = $database_name;
	}
	
	/**
	 * Using one of this class' defined timezone constants, tell the application which date timezone to use.
	 * @param type $timezone_constant 
	 */
	public function setLocalTimezone($timezone_constant) {
		date_default_timezone_set($timezone_constant);
	}
	// </editor-fold>
	
	public function setupPDOHandle() {
		try {
			$dbh = new PDO('mysql:host=' . $this->_db_host . ';dbname=' . $this->_db_name, $this->_db_username, $this->_db_pwd);
		}catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
			die();
		}
		
		return $dbh;
	}
}
?>