<?
require_once "dbparamsmcextio.inc.php";
require_once "wslib.inc.php";
require_once "settings.php";

abstract class dbextiorestws extends restws {
	// add connect/disconnect to sql database
	function dbexec($query,$errstr){
		$result = mysql_query ($query) or $this->xmlend("$errstr".mysql_error());
		if ($result=="") {$this->xmlend("failure"); exit;}
		return $result;
	}
	//overrides handlews to add db connect/disconnect
	function dbconnect()
	{
		mysql_connect($GLOBALS['DB_Connection'],
		$GLOBALS['DB_User'],
		$GLOBALS['DB_Password']
		) or $this->xmlend ("can not connect to mysql");

		$db = $GLOBALS['DB_Database'];
		mysql_select_db($db) or $this->xmlend ("can not connect to database $db");
	}
	function dbdisconnect()
	{
		mysql_close();
	}
	function handlews($servicetag)
	{
	  global $acApplianceMode;

	  // ssadedin: added to avoid need for email server and email db for
	  // development boxes.  see defn in dbparamsmcextio.inc.php
	  // ttw: clean up by making this a 'settings.php', overriddable in
	  // 'local_settings.php' and editable by the console
	  if ($acApplianceMode) {
	    $this->set_servicetag($servicetag);
	    $this->dbconnect();
	    $this->xmltop();
	    $this->xmlbody();
	    $this->xmlend("success");
	    $this->dbdisconnect();
	  }
	  else {
	    $this->set_servicetag($servicetag);
	    $this->xmltop();
	    $this->xmlend("success");
	  }
	}
}

?>
