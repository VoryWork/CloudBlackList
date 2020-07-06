<?php
	$config = json_decode(file_get_contents("data.db"),true);
	$usertable = $config['user'];
	$found = false;
	foreach ($usertable as $user => $data) {
		if ($user == $_GET['username']) {
				echo htmlspecialchars($user) .','.htmlspecialchars($data['level']).','. htmlspecialchars($data['reason']);
				$found =true;
		}
	};
	if ($found == false){
		echo 'Not Found!';
	}
?>