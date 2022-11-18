<?php
class DB
{

	var $DB_HOST;
	var $DB_NAME;
	var $DB_USER;
	var $DB_PASSWORD;


	var $conn;
	var $strict;
	var $SQL;
	var $errorMsg;
	var $successMsg;


	function displayError($stop = 1)
	{

		echo "<p><font color='#FF0000'>" . $this->errorMsg . "</font></p>";
		if ($stop == 1)
			exit();
	}


	function dbconnect()
	{
		$this->conn = mysqli_connect($this->DB_HOST, $this->DB_USER, $this->DB_PASSWORD, $this->DB_NAME);
		if (mysqli_connect_errno()) {
			$this->errorMsg = mysqli_connect_errno();
			$this->displayError();
		}
	}


	function __construct()
	{
		$this->errorMsg = "";
		$this->successMsg = "";


		$this->DB_HOST = DBHOST;
		$this->DB_NAME = DBNAME;
		$this->DB_USER = DBUSER;
		$this->DB_PASSWORD = DBPASSWORD;


		$this->conn = NULL;
		$this->strict = false;

		$this->SQL = "";
		$this->dbconnect();
	}


	public function setQuery($query)
	{
		$this->SQL = $query;
	}

	public function select()
	{
		if ($this->SQL == "")
			return false;

		$this->conn = mysqli_connect($this->DB_HOST, $this->DB_USER, $this->DB_PASSWORD, $this->DB_NAME);
		$rs = mysqli_query($this->conn, $this->SQL);
		if ($rs === false) {
			$this->SQL = "";
			$this->errorMsg = mysqli_connect_error() . ": " . mysqli_error($this->conn);
			$this->displayError();
		}


		$records = array();
		while (($row = mysqli_fetch_array($rs, MYSQLI_ASSOC))) {
			$records[] = $row;
		}

		$this->SQL = "";
		mysqli_free_result($rs);
		return $records;
	}

	public function update()
	{
		if ($this->SQL == "")
			return false;
		$this->conn = mysqli_connect($this->DB_HOST, $this->DB_USER, $this->DB_PASSWORD, $this->DB_NAME);
		$rs = mysqli_query($this->conn, $this->SQL);
		if ($rs === false) {
			$this->SQL = "";
			$this->errorMsg = mysqli_connect_error() . ": " . mysqli_error($this->conn);
			$this->displayError();
		}

		$this->SQL = "";
		return mysqli_affected_rows($this->conn);
	}



	public function execute()
	{

		if ($this->SQL == "")
			return false;
		$this->conn = mysqli_connect($this->DB_HOST, $this->DB_USER, $this->DB_PASSWORD, $this->DB_NAME);
		$rs = mysqli_query($this->conn, $this->SQL);
		if ($rs === false) {
			$this->SQL = "";
			$this->errorMsg = mysqli_connect_error() . ": " . mysqli_error($this->conn);
			$this->displayError();
		}

		$this->SQL = "";
		return mysqli_affected_rows($this->conn);
	}

	public function insert()
	{
		if ($this->SQL == "")
			return false;
		$this->conn = mysqli_connect($this->DB_HOST, $this->DB_USER, $this->DB_PASSWORD, $this->DB_NAME);
		$rs = mysqli_query($this->conn, $this->SQL);
		if ($rs === false) {
			$this->SQL = "";
			$this->errorMsg = mysqli_connect_error() . ": " . mysqli_error($this->conn);
			$this->displayError();
		}


		$this->SQL = "";
		return mysqli_insert_id($this->conn);
	}


	public function close()
	{
		$this->errorMsg = "";
		$this->successMsg = "";


		$this->DB_HOST = "";
		$this->DB_NAME = "";
		$this->DB_USER = "";
		$this->DB_PASSWORD = "";

		if ($this->conn)
			mysqli_close($this->conn);

		$this->SQL = "";
	}
}
