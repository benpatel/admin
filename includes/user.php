<?php
class User{


	   

		public function get_avatar($id){
			global $dtb;
			$img='avatar.jpg';
			$sql =  "select * from users where id={$id} limit 1";
			$result_set = $dtb->query($sql);
				while( $result = $result_set->fetch_object()){

					if($result->avatar !=''){
							$img=$result->avatar;
					}
				
				}
			return $img;
		}

		public function review_exists($list_id){
		
			global $dtb;
			if(isset($_SESSION['user_info']['logged_in'])=="YES"){
			$sql_r = "select * from reviews where listing_id={$list_id} and user_id={$_SESSION['user_info']['id']}"; 
			$result_set = $dtb->query($sql_r);
				if($dtb->num_rows($result_set)>=1){
					return "Yes";
				}else{
					return "No";
				}
			}else{
				return "No";
			}
		}

		public function review_old_rating($list_id){
			global $dtb;
				$sql_r = "select * from reviews where listing_id={$list_id} and user_id={$_SESSION['user_info']['id']}"; 
				$result_set = $dtb->query($sql_r);
				while( $result = $result_set->fetch_object()){

					$old_rating = ($result->rating)*10;
				}
				return $old_rating;
		}

		public function get_address_info($id){
			global $dtb;
			$sql =  "select * from addresses where id={$id} limit 1";
			$result_set = $dtb->query($sql);
				while( $result = $result_set->fetch_object()){
					$data = $result;
				}
				return (array) $data;
		}

		public function get_buyer_def_address($id){

			global $dtb;
			$sql =  "select * from addresses where user_id={$id} order by def asc, id desc limit 1";
			$result_set = $dtb->query($sql);
				while( $result = $result_set->fetch_object()){
					$data = $result->id;
				}
			return $data;
		
		}

		public function get_seller_name($id,$c=''){

			global $dtb;
			$sql =  "select * from seller where id={$id}";
			$result_set = $dtb->query($sql);
				while( $result = $result_set->fetch_object()){
					if($c=='c'){
						$data = $result->fname." ".$result->lname." (".$result->company.")";
					}else{
						$data = $result->fname." ".$result->lname;	
					}
					
				}
			return $data;
		
		}

		public function get_buyer_name($id,$c=''){

			global $dtb;
			$sql =  "select * from users where id={$id}";
			$result_set = $dtb->query($sql);
				while( $result = $result_set->fetch_object()){
					if($c=='c'){
						$data = $result->fname." ".$result->lname." (".$result->company.")";
					}else{
						$data = $result->fname." ".$result->lname;	
					}
				}
			return $data;
		
		}

		public function add_subscription($email){
			global $dtb;
			$sql =  "INSERT INTO subscription (email) VALUES ('{$email}')";
			$result_set = $dtb->query($sql);
		}
}

$user = new User;
?>