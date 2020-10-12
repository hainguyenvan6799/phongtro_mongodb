<?php 
	class HomeController extends BaseController
	{
		public function SayHi(){
			// $c = new Controller;

			// $teo = $c->model('SinhVienModel');
			// echo $teo->getSV();
			$teo = $this->model('SinhVienModel');
			$tensinhvien = $teo->getSV();

			$this->view('aodep',
				["tensinhvien" => $tensinhvien,
				 "page" => "news"
				]
			);
		}
		public function Show(){
			echo 'Home - Show';
		}
	}
 ?>