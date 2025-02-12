<?php

function perms() {
			$perms = '';
			$permACL = new ACL();
            $rPerms = $permACL->getRolePerms($_GET['rid']);
            $aPerms = $permACL->getAllPerms('full');
			$i=0;
            foreach ($aPerms as $k => $v)
            {
				if($i%2 ==0) {
					$class ='one';
				}else {
					$class ='two';
				}
				 
				//echo $v['Key'];
				//echo $rPerms['access_admin']['value'];
				//echo $rPerms[$v['Key']]['value'];
                $perms .= "<tr class=\"columnrow".$class."\"><td class=\"columnborder\" style=\"padding:10px 10px 10px 10px;\"><label>" . $v['Name'] . "</label></td>";
                $perms .= "<td class=\"columnborder\" style=\"padding:10px 10px 10px 10px;\"><input type=\"radio\" name=\"perm_" . $v['ID'] . "\" id=\"perm_" . $v['ID'] . "_1\" value=\"1\"";
				 
                if (array_key_exists($v['Key'],$rPerms) && $rPerms[$v['Key']]['value'] === true && $_GET['rid'] != '') { $perms .= " checked=\"checked\""; }
                $perms .= " /></td>";
                $perms .= "<td class=\"columnborder\" style=\"padding:10px 10px 10px 10px;\"><input type=\"radio\" name=\"perm_" . $v['ID'] . "\" id=\"perm_" . $v['ID'] . "_0\" value=\"0\"";
                if (array_key_exists($v['Key'],$rPerms) && $rPerms[$v['Key']]['value'] != true && $_GET['rid'] != '') { $perms .= " checked=\"checked\""; }
                $perms .= " /></td>"; 
				$perms .= "<td class=\"columnborder\" style=\"padding:10px 10px 10px 10px;\"><input type=\"radio\" name=\"perm_" . $v['ID'] . "\" id=\"perm_" . $v['ID'] . "_X\" value=\"X\"";
                if ($_GET['rid'] == '' || !array_key_exists($v['Key'],$rPerms)) { $perms .= " checked=\"checked\""; }
                $perms .= " /></td>";
                $perms .= "</tr>";
				$i++;
            }
			
		return $perms;
}



?>