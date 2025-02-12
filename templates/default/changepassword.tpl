 <form action="" method="post">
	<table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="formtitlebg" align="left">Change Password</td>
                            </tr>
							<ZONE error enabled>
								<tr>
								<td class="error">  
								{error.newpassword}  	
								{error.confirmpassword}  	
								{error.passwordnotmatch} 														
								</td>
								</tr>
							</ZONE error enabled> 
							 
							 <ZONE passwordreset enabled>
							 <tr><td class="successmessage" style="background-color:#FFFFFF; padding-left:10px;">{success}</td></tr>
							 </ZONE passwordreset enabled> 
                            <tr>
                              <td class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
 							  <tr><td class="formtext" align="right">New password:</td><td align="left"><input type="password" name="newpassword" value="{newpassword}" /></td></tr>
 							  <tr><td class="formtext" align="right">Confirm password:</td><td align="left"><input type="password" name="confirmpassword" value="{confirmpassword}" /></td></tr>

							  <tr><td>&nbsp;</td><td align="left"><input type="submit" name="submit" value=" Submit " class="formbutton" />
							<input type="button" name="cancel" value=" Cancel " class="formbutton" onclick="redirect('dashboard.php')"  /></td></tr>  
                              </table></td>
                            </tr>
                             
                        </table></td>
                      </tr>
                  </table></td>
                </tr>                
            </table></td>
          </tr>
        </table>
	</form>	 