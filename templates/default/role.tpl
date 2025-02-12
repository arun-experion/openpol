<form action="" method="post" name="role" id="role" >
	<table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="formtitlebg">Enter Role</td>
                            </tr>
							<ZONE error enabled>
								<tr>
								<td class="error">Required field missing:<br /><br />
								{error.role_name}
								{error.duplicaterole}								
								</td>
								</tr>
							</ZONE error enabled>
                            <tr>
                              <td class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td align="center"><table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                                        <tr>
                                          <td align="right" class="formtext">Role Name :</td>
                                          <td align="left"><label>
                                           <input name="role_name" type="text" id="role_name" value="{role_name}"  /><span class="required">*</span>
                                          </label></td>  
                                        </tr>
                                         
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
									<input name="button2" type="button" class="formbutton" id="button2" value=" Cancel " onclick="redirect('list_roles.php')"  /></td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
              
                 
            </table></td>
          </tr>
        </table>
		 <input type="hidden" name="role_id" value="{role_id}" />
    </form>