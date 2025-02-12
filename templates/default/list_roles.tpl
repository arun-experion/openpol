  <ZONE showrolelist enabled> 
  <table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">                
                <tr>
                  <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                      <tr>
                    <td><tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="formtitlebg">Roles</td>
                            </tr>
                             
                             
                        </table></td>
                      </tr></td>
                  </tr>
				  
				  <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="secondformhead"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                 <tr><td class="successmessage">{message}</td>
                                    <td align="right">
									<input name="button4" type="submit" class="formbutton" id="button5" value=" Add New " onclick="redirect('role.php')"  /></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr class="glassyhead">
                                    <td class="columnborder" width="10%">Sl No</td>
                                    <td class="columnborder">Role Name</td>
                                    <td class="columnborder">Action</td>                                    
                                  </tr>
								   <LOOP roles>  
                                  <tr class="columnrow{class}">
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{slno}</td>
                                        </tr>
                                    </table></td>
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{roleName}</td>
                                        </tr>
                                    </table></td>
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext"><a href="role.php?rid={ID}">Edit</a></td>
										   <td class="formtext"><a href="manage_permissions.php?rid={ID}">Permissions</a></td>
                                        </tr>
                                    </table></td>                                     
                                  </tr> 
                                    </LOOP roles> 
									 <zone noroles enabled>
                             <tr class="columnrowone">
                            
                              <td class="columnborder" colspan="8" ><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext" align="center">No results available</td>
                                </tr>
                              </table></td></tr>
							</zone noroles enabled>
									
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                    </table>
                      <table width="907" border="0" cellspacing="5" cellpadding="0">
                         <tr> <td align="left" class="whitetext">{total} Result(s)</td>
                          <td align="right" class="whitetext">{split_results}</td>
                        </tr>
                    </table></td>
                </tr>
            </table></td>
          </tr>
        </table>
  </ZONE showrolelist enabled>
  

    
