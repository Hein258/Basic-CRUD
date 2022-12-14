<?php 

namespace GlobalFunctions;

use Exception;

class Main {

	public $mysqli;

    function __construct($mysqli){
        $this->mysqli = $mysqli;
    }

	/**
	 * User Login
	 * @param array $data [email, password]
	 * @return array [status, msg]
	 */
	public function login($data){
        
		$verify = false;

        $response = array(
            'status' => false,
            'msg' => 'Invalid User Credentials'
        );
		
		try{

			$mysqli = $this->mysqli;
        
			$checkUser = $mysqli->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");

			if($checkUser){

				$checkUser->bind_param('s', $data['email']);
				$checkUser->execute();

				$result = $checkUser->get_result();
				
				if($result->num_rows == 1) {

					$row = $result->fetch_assoc();

					if($row['status'] == TRUE){

						$verify = $this->checkPass($row['password'], $data['password']);
						
						if($verify){

							$token = bin2hex(random_bytes(32));

							$_SESSION['CSRF_TOKEN'] = hash_hmac('sha256', $token, SECURITY_KEY);
							
							$_SESSION['fullname'] = $row['first_name'].' '.$row['surname'];
							$_SESSION['access'] = $row['access_level'];
							$_SESSION['user_id'] = $row['id'];
							$_SESSION['user_email'] = $row['email'];

							$_SESSION['user_email'] = $row['email'];

							$response['status'] = true;
							$response['msg'] = 'Logged In, Welcome.';
						}

					}
					else{
						throw new \Exception("Account has been suspended");
					}

				}
				else{
					throw new \Exception("Invalid user credentials");
				}

			}
			else{
					
				throw new \Exception("An error has occurred while making the request. Please try again.");

			}

		}
		catch(\Throwable $exception ) {

			$response['status'] = false;
			$response['msg'] = $exception->getMessage();

        }
        
        return $response;

    }

	/**
     * Database Query functions (Update | Delete | Insert)
     * @param string $type; UPDATE | DELETE | INSERT
     * @param string $table; table in database to be affected
     * @param array $data; array of info to be affected, can be blank on `DELETE`, key = column name | val = value of column in table
     * @param string $where; default empty, UPDATE a specifi row in table
	 * @throws Exception
     * @return bool
     */
    public function database($type, $table, $data, $where = []){

		$mysqli = $this->mysqli;

		$values = "";
		$cols = "";
		$vals = "";

		$i = 0;

		$wKey = "";
		$wVal = "";

		if($where != "" && is_array($where)){
			foreach($where as $whereKey=>$whereVal){
				$wKey = $whereKey;
				$wVal = $whereVal;
			}
		}

		$dbQuery = false;

		try {

			switch($type){

				case "INSERT" :	

				foreach($data as $key=>$val){

					if($i < count($data)-1){
						$cols .= $mysqli->real_escape_string($key).", ";
						$vals .= "'".$mysqli->real_escape_string($val)."', ";
					}
					else{
						$cols .= $mysqli->real_escape_string($key)." ";
						$vals .= "'".$mysqli->real_escape_string($val)."' ";
					}
					$i++;
				}

				$mysqli->query($type." INTO ".$table." (".$cols.") VALUES (".$vals.")") or throw new \Exception("MySQL error $mysqli->error"); 

				break;

				case "UPDATE" :

				foreach($data as $key=>$val){

					if($i < count($data)-1){
						$values .= $mysqli->real_escape_string($key)."= '".$mysqli->real_escape_string($val)."', ";
					}
					else{
						$values .= $mysqli->real_escape_string($key)."= '".$mysqli->real_escape_string($val)."' ";
					}

					$i++;
				}

				$mysqli->query($type." ".$table." SET ".$values." WHERE ".$wKey." = ".$wVal) or throw new \Exception("MySQL error $mysqli->error"); 

				break;

				case "DELETE" :
					$mysqli->query($type." FROM ".$table." WHERE ".$wKey." = ".$wVal) or throw new \Exception("MySQL error $mysqli->error"); 
				break;

			}
			$dbQuery = true;

		} 
		catch(\Exception $e ) {
			
			$mysqli->rollback();

			throw new \Exception($e->getMessage());

		}

		if($dbQuery){
			return true;
		}
		else{
			return false;
		}

	}

	/**
	 * Create Customer
	 * @param array $userData
	 * @return array [type, title, msg, url]
	*/
	public function createCustomer($customerData){

		$mysqli = $this->mysqli;
		$mysqli->begin_transaction();

		try {

			$cEmail = $mysqli->real_escape_string($customerData['email']);

			$checkEmail = $mysqli->query('SELECT id FROM customers WHERE email = "'.$cEmail.'"') or throw new Exception($mysqli->error);

			if($checkEmail->num_rows == 0){

				$insert = $this->database('INSERT', 'customers', $customerData);

				if($insert){

					$response = array(
						'type' => 'success',
						'title' => 'Customer Created',
						'msg' => 'Customer has successfully been created',
						'url' => './'
					);

					$mysqli->commit();

				}

			}
			else{
				throw new Exception('Customer with this email already exists');
			}

		}
		catch (\Throwable $e) {

			$mysqli->rollback();
			
			$response = array(
                'type' => 'error',
                'title' => 'An Error has Occurred',
                'msg' => $e->getMessage(),
                'url' => false
            );
		}

		return $response;

	}

	/**
	 * Create Customer
	 * @param array $userData
	 * @return array [type, title, msg, url]
	*/
	public function updateCustomer($customerID, $customerData){

		$mysqli = $this->mysqli;
		$mysqli->begin_transaction();

		try {

			$ID = $mysqli->real_escape_string($customerID);

			$checkCustomer = $mysqli->query('SELECT id FROM customers WHERE id = "'.$ID.'"') or throw new Exception($mysqli->error);

			if($checkCustomer->num_rows != 0){

				$insert = $this->database('UPDATE', 'customers', $customerData, ['id' => $ID]);

				if($insert){

					$response = array(
						'type' => 'success',
						'title' => 'Customer Created',
						'msg' => 'Customer has successfully been created',
						'url' => true
					);

					$mysqli->commit();

				}

			}
			else{
				throw new Exception('Customer could not be found in the database');
			}

		}
		catch (\Throwable $e) {

			$mysqli->rollback();
			
			$response = array(
                'type' => 'error',
                'title' => 'An Error has Occurred',
                'msg' => $e->getMessage(),
                'url' => false
            );
		}

		return $response;

	}

    /**
	 * Generate Encoded/Encrypted User Password
	 * @param  string $pass Password provided by user
	 * @return string base64 encoded hash
	 */
    public function genSecurity($pass){
        
        $newPass = $pass;
        
        $key = bin2hex(openssl_random_pseudo_bytes(32));

        $hashPass = password_hash($newPass, PASSWORD_ARGON2I);
        $encPass = $this->encryptSSL($hashPass, $key);

        $securityData = $encPass.'.'.$key;
        
        return base64_encode($securityData);
    }

    /**
	 * Validate User Login Password
	 * @param string $dbPass Password save in database
	 * @param string $pass Password provided by user
	 * @return bool
	 */
	function checkPass($dbPass, $pass){
        
		$data = base64_decode($dbPass);

		$splitData = explode('.', $data);

    	$decData = $this->decryptSSL($splitData[0], $splitData[1]);

		return password_verify($pass, $decData);
		
    }

    /**
	 * Custom SSL Encryption
	 * @param string $data to be encrypted
	 * @param string $key bin2hex(openssl_random_pseudo_bytes(32))
	 * @return string base64
	 */
	public function encryptSSL($data, $key){

		$method = 'AES-256-GCM';

		$key = base64_decode( $key );
		$iv = openssl_random_pseudo_bytes( openssl_cipher_iv_length( $method ) );
		$tag = ""; // openssl_encrypt will fill this
		$result = openssl_encrypt( $data , $method , $key , OPENSSL_RAW_DATA , $iv , $tag , "" , 16 );

		return base64_encode( $iv.$tag.$result );
	}

	/**
	 * Custom SSL Decryption
	 * @param string $data to be Decrypted
	 * @param string $key bin2hex(openssl_random_pseudo_bytes(32))
	 * @return bool
	 */
	public function decryptSSL( $data, $key ){

		$method = 'AES-256-GCM';

		$data = base64_decode( $data );
		$key = base64_decode( $key );
		$ivLength = openssl_cipher_iv_length( $method );
		$iv = substr( $data , 0 , $ivLength );
		$tag = substr( $data , $ivLength , 16 );
		$text = substr( $data , $ivLength+16 );

		return openssl_decrypt( $text , $method , $key , OPENSSL_RAW_DATA , $iv , $tag );
	}

    
}
