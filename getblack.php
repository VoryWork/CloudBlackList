<?php
    $config = json_decode(file_get_contents("data.db"),true);
    $usertable = $config['user'];
			foreach ($usertable as $user => $data) {
				echo htmlspecialchars($user) .','.htmlspecialchars($data['level']).','. htmlspecialchars($data['reason']) . "\n";
			}
?>