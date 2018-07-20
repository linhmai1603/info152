<html>
<head>
<title> The Employment Database</title>

<style type = "text/css">
/*CSS style*/

/*table style*/
table, td, th {
    border: 1px solid black;
	align: center;
}

table {
	text-align: center;
    border-collapse: collapse;
    width: 30%;
	margin: 0px auto;
}

th {
    height: 50px;
}
</style>
</head>
<?php
	class Database{
		var $db;
		public function __construct($dbname){
			$dsn = 'mysql:host=localhost;dbname=' .$dbname;
			$username='root';
			$password='password';
			
			try{
				$this->db = new PDO($dsn,$username, $password);
			}catch(PDOException $e){
				echo '<br>The<b> ' .$dbname . ' </b> Database does not exist. Creating it now <b>';
				try{
					$this->db = new PDO('mysql:host=localhost', $username, $password);	
					$sql = "create database twitter;
							use twitter;
							create table tweets(
							id VARCHAR(30) NOT NULL,
							date DateTime,
							from_user_id INT,
							from_user_name VARCHAR(30),
							to_user_id INT,
							to_user_name VARCHAR(30),
							geo VARCHAR(30),
							profile_image_url VARCHAR(200),
							text VARCHAR(150),
							PRIMARY KEY(id, date, from_user_id))";
					$this->db->exec($sql);
					echo 'Done!<br>';
					
				}catch(PDOException $e){
					echo $e-getMessage();
					exit();
				}
			}
		}
		public function close(){
			try{
				$this->db =null;
			}catch(PDOException $e){
					echo $e-getMessage();
					exit();
			}
		}
		
		public function insertTweets($tweets){
			$sql = "INSERT INTO tweets (id, date, from_user_id, from_user_name, profile_image_url, text) VALUES (:id, :date, :from_user_id, :from_user_name, :profile_image_url, :text)";	
		
			try{
				$x = $this->db->prepare($sql);
				foreach($tweets as $t){
					$parameters = array(
						':id' => $t->id,
						':date' => date('Y-m-d H:i:s', strtotime($t->date)),
						':from_user_id' => $t->from_user_id,
						':from_user_name' => $t ->from_user_name,
						':profile_image_url' => $t->profile_image_url,
						':text' => $t->text
					);
					
					$x->execute($parameters);
				}
			}catch(PDOException $e){
				die('Insert attempt failed' .$e-getMessage());
			}
		}	
		public function search($query){
			try{
				$x = $this->db->prepare($query);
				$x->execute();
			}catch(PDOException $e){
				die('Query failed:' .$e->getMessage());
			}
			
			echo '<table border=1>';
			
			$heading = true;
			while(($row = $x->fetch(PDO::FETCH_ASSOC))){
				echo '<tr>';
				
				if($heading){
					$keys = array_keys($row);
					foreach($keys as $k){
						echo'<th>' .$k. '</th>';
					}
					echo '</tr><tr>';
					$heading = false;
				}
				 foreach($row as $r => $v){
					 echo '<td>' .$v .'</td>';
				 }
				 echo '</tr>';
			}
			echo'</table>';
		}
	}
?>