<?php

//Try to connect to ORACLE using OCI8
//var_dump(get_loaded_extensions());
//if (!extension_loaded("pdo_oci")) {
//	die("Extenstion pdo_oci is not loaded");
//}

$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.99.100)(PORT = 49161)))(CONNECT_DATA=(SID=XE)))";
$username = "system";
$password = "oracle";

if ($vcap_service_env = getenv("VCAP_SERVICES")) {
	$vcap = json_decode($vcap_service_env, true);
	$userProvidedTypes = !empty($vcap['user-provided']) ? $vcap['user-provided'] : array();
	foreach ($userProvidedTypes as $userProvided) {
		if (stripos($userProvided['name'], 'oracle-11-docker') !== false) {
			$credentials = $userProvided['credentials'];
			$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)";
			$db .= "(HOST =" . $credentials['host'] . " )(PORT = " . $credentials['port'] . ")))";
			$db .= "(CONNECT_DATA=(SID=" . $credentials['sid'] . ")))";
			$username = $credentials['username'];
			$password = $credentials['password'];
			break;
		}
	}
}

try {
	$conn = new PDO("oci:dbname=" . $db, $username, $password);
} catch (PDOException $e) {
	die($e->getMessage());
}

echo "Connected to Oracle Using PDO_OCI8" . "<br />";
echo "Server Version: " . var_dump($conn);

?>