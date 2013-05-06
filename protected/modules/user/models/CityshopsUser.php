<?

Yii::import("application.modules.user.models.YumUser");

class CityshopsUser extends YumUser {

	public $guid_authentication_url = "https://www.cityshops.eu/api/auth/";
	public $guid_login_url = "https://www.cityshops.eu/midcom-login-/?redirect_auth=http://www.citystream.tv/";
	public $guid;


	public function setGuid($guid) {
	  $this->guid = $guid;
	  
	}

	public function authenticateUser() {


	  if (empty($this->guid)) throw new Exception("No guid provided!");

	  if (!$result = simplexml_load_file($this->guid_authentication_url . "?user={$this->guid}")) {
	    throw new Exception("Error fetching authentication data");
	  }
	  
	  // User exists
	  if ($user = YumUser::model()->findByGuid($this->guid)) return $user;
	  

	  
	  // User does not exist

	  $user["ip"] = (string)$result->person->ip;
	  $user["guid"] = $this->guid;
	  $user["email"] = (string)$result->person->email;
	  $user["username"] = (string)$result->person->username;
	  $user["firstname"] = (string)$result->person->firstname;
	  $user["lastname"] = (string)$result->Person->lastname;
	  





	}

}