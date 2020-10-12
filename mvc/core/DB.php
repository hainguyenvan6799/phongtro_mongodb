<?php 
	require_once "mvc/core/vendor/autoload.php";
	class DB
	{
		protected $servername = "mongodb://localhost:27017";
		protected $filter = [];
		protected $options = [];
		protected $query;
		public $mongoConnection;

		public function __construct()
		{
			$this->query = new MongoDB\Driver\Query($this->filter, $this->options);
			$this->mongoConnection = new MongoDB\Driver\Manager($this->servername);
		}

	}
 ?>