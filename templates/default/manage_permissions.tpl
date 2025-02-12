<form action="" method="post">
<table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="formtitlebg">Roles</td>
                            </tr> 
                             
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
                
                <tr>
                  <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="secondformhead"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td align="left" class="formtext"> 	Manage Role: {rolename}</td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr class="glassyhead">
                                    
                                    <td class="columnborder">Permissions</td>
                                    <td class="columnborder">Allow</td>
                                    <td class="columnborder">Deny</td>
                                    <td class="columnborder">Ignore</td>
                                 {perms} 
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
					  <tr>
                        <td class="formboot"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                            <tr>
                              <td width="49%" align="right" valign="top"><label>
                                <input name="button" type="submit" class="formbutton" id="button" value=" Submit " />
                              </label></td>
                              <td width="51%" align="left" valign="top">
							<input name="button2" type="button" class="formbutton" id="button2" value=" Cancel " onclick="redirect('list_roles.php')" /></td>
                            </tr>
                        </table></td>
                      </tr>
					  
                    </table>
                       </td>
                </tr>
            </table></td>
          </tr>
        </table>
		<input type="hidden" name="roleName" id="roleName" value="{rolename}" />
		<input type="hidden" name="roleID" value="{rid}" />
</form>