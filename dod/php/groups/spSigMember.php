<?php
// show all the group stuff
require_once "glib.inc.php";
list($accid,$fn,$ln,$email,$idp,$coookie) = confirm_logged_in (); // does not return if not logged on
$db = connect_db(); // connect to the right database
$id = $_REQUEST['id']; //specifies the group
confirm_admin_access($accid,$id); // does not return if this user is not a group admin

$info = make_group_form_components($id);
$desc = "MedCommons SIG Membership";
$title = 'Special Interest Group Membership';
$startpage='groups/spSigMember.php';
$top = make_group_page_top ($info,$accid,$email,$id,$desc,$title,$startpage);

$middle = <<<XXX
<div>
<p>The following functions are available to you as a member of this SIG</p>
<ul>

<li>coming soon</li>
</ul>
</div>
XXX;

$bottom = make_group_page_bottom ($info);
echo $top.$middle.$bottom;
?>