<?php
/**
 * TestLink Open Source Project - http://testlink.sourceforge.net/ 
 * This script is distributed under the GNU General Public License 2 or later. 
 *
 * Get infrastructure data
 * 
 * @package 	TestLink
 * @author 		Martin Havlat
 * @copyright 	2009, TestLink community 
 * @version    	CVS: $Id: getInfrastructure.php,v 1.1 2010/02/12 00:20:12 havlat Exp $
 *
 * @internal Revisions:
 * None
 *
 **/

require_once('../../config.inc.php');
require_once('common.php');
testlinkInitPage($db);

$tlIs = new tlInfrastructure($_SESSION['testprojectID'], $db);
$data = $tlIs->getAll();

$tlUser = new tlUser($_SESSION['userID']);
$users = $tlUser->getNames($db);

// fill login instead of user ID
foreach($data as $k => $v) 
{
	if ($v['owner_id'] != '0')
	{
		$data[$k]['owner'] = $users[$v['owner_id']]['login'];
	}
	else
	{
		$data[$k]['owner'] = '';
	}
}

//new dBug($data);
echo json_encode($data);

?>