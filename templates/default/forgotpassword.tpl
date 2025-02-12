 <form action="" method="post">
	<table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="formtitlebg" align="left">Forgot Password</td>
                            </tr>
							<ZONE error enabled>
								<tr>
								<td class="error">Required field missing:<br /><br />
								{error.email}  	
								{error.notvalidemail}  	
								{error.notfound}  	
															
								</td>
								</tr>
							</ZONE error enabled> 
							 
                            <tr>
                              <td class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
							  <tr><td colspan="2" class="glassyhead">Please enter your email to reset your password.</td></tr>
							  <tr>
							    <td class="formtext" align="right">Email ID :</td>
							    <td align="left"><input type="text" name="email" value="{email}" /></td></tr>
							  <tr><td>&nbsp;</td><td align="left"><input type="submit" name="submit" value=" Submit " class="formbutton" />
							<input type="button" name="cancel" value=" Cancel " class="formbutton" onclick="redirect('login.php')"  /></td></tr>  
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