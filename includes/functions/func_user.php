<?php

function roles() {
			$roles = '';
			$iVal ='';
			$userACL = new ACL($_GET['uid']);
            $rPerms = $userACL->perms;
            $aPerms = $userACL->getAllPerms('full');
			$i=0;
            foreach ($aPerms as $k => $v)
            {	
				if($i%2 ==0) {
					$class ='two';
				}else {
					$class ='one';
				}
				
                $roles .=  "<tr class=\"columnrow".$class."\"><td style=\"padding:10px 10px 10px 10px;\" width=\"20%\">" . $v['Name'] . "</td>";
				 $roles .= "<td><select name=\"perm_" . $v['ID'] . "\">";
				 $roles .= "<option value=\"1\"";
				if ($userACL->hasPermission($v['Key']) && $rPerms[$v['Key']]['inheritted'] != true) {  $roles .= " selected=\"selected\""; }
				 $roles .= ">Allow</option>";
				 $roles .= "<option value=\"0\"";
				if ($rPerms[$v['Key']]['value'] === false && $rPerms[$v['Key']]['inheritted'] != true) {  $roles .= " selected=\"selected\""; }
				 $roles .= ">Deny</option>";
				 $roles .= "<option value=\"x\"";
				if ($rPerms[$v['Key']]['inheritted'] == true || !array_key_exists($v['Key'],$rPerms))
				{
					 $roles .= " selected=\"selected\"";
					if ($rPerms[$v['Key']]['value'] === true )
					{
						$iVal = '(Allow)';
					} else {
						$iVal = '(Deny)';
					}
				}
				 $roles .= ">Inherit $iVal</option>";
                 $roles .= "</select></td></tr>";
				 $i++;
            }
			
		return $roles;
}


function userperms()
{		
		$uperms = '';
		$userACL = new ACL($_GET['uid']);
		$perms = $userACL->perms;
		foreach ($perms as $k => $v)
		{
			if ($v['value'] === false) { continue; }
			$uperms .=  "<li>" . $v['Name'];
			if ($v['inheritted']) { $uperms .= "  (inheritted)"; }
			$uperms .= "</li>";
		}
		return $uperms;
}

function forgotpass($email) {
	
		if (email($email)) {
			if (dupData("personal", "email", $email)) {
			
				//mail template
				$mail = new template;
				$mail -> Load("templates/default/forgotpassword.tpl");
				
				//fetch personal data
				$r = Fetch(Query("SELECT * FROM personal WHERE email='{$email}' LIMIT 0, 1"));
				
				//assign values
				$mail -> AssignArray(array(	"sitename" => SITE_NAME,
											"url"	=> HTTP_SERVER . "resetpass.php?id={$r['user_name']}&code=" . md5($r['f_name'] . $r['user_name'] . $r['user_id']),
											"f_name" => $r['f_name'],
											"l_name" => $r['l_name'],
											"username" => $r['user_name']
									));
				
				//break into subject and mail body
				$mailContent = explode("\n", $mail->Flush(1), 2);
				
				//send mail
				$mail = new SendMail;
				$mail -> From 		= SITE_NAME . " <" . STIE_EMAIL . ">";
				$mail -> To 			=	$email;
				$mail -> Subject 	= $mailContent[0];
				$mail -> Body 		= $mailContent[1];
				$mail -> Send();
				
				//return success
				return "We've sent instructions to your email<br />$email|1";
				
			}	else return "Email not found|0";
			
		} else return 'Invalid email address|0';
	}	
?>