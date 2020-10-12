<?php 
	class SinhVienModel extends DB
	{
		// Thực hiện CRUD dữ liệu
		public function getSV(){
			// lấy dữ liệu sinh viên từ csdl
			// Tạo mới một collection trong db
			$result = $this->dbname->dropCollection("TestCollection");
			var_dump($result);
			return "Nguyen Van Hai - Admin";
		}
	}
 ?>