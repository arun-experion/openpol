   <table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">                
                <tr>
                  <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
                              <td valign="middle" class="formtitlebg">Order Status Configurations</td>
                            </tr>
                            <tr>
                              <td valign="middle" class="secondformhead"><table width="100%" border="0" cellspacing="10" cellpadding="0"> 
                                 <tr><td class="successmessage">{message}</td>
                                    
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr class="glassyhead">
                                    <td class="columnborder">Role</td>
                                    <td class="columnborder">Status</td>
                                    <td class="columnborder">Next</td>   
									<td class="columnborder" align="center">Action</td>                                    
                                  </tr>
								   <LOOP workflows>  
                                  <tr class="columnrow{class}">
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{role}</td>
                                        </tr>
                                    </table></td>
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{statusname}</td>
                                        </tr>
                                    </table></td>
									<td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{nextstatus}</td>
                                        </tr>
                                    </table></td>
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                                        <tr>
                                          <td class="formtext" align="center" ><a href="status.php?id={id}"><img src="{theme}images/edit.png" alt="" width="26" height="26" border="0" /></a>  <a href="status.php?delete={id}" class="deleteaction" style="text-decoration:none"><img src="{theme}images/close.png" alt="" width="26" height="26" border="0" /></a></td>
                                        </tr>
                                    </table></td>                                     
                                  </tr> 
                                    </LOOP workflows> 
									<zone noworkflow enabled>
									<tr class="columnrowtwo">
                                    <td class="columnborder" colspan="4" align="center" height="50px">No workflow defined</td></tr>
									</zone noworkflow enabled>
									<form action="" method="post">
									<input type="hidden" value="{action}" name="action" />
                               <tr class="columnrowone">
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{select_usertype}</td>
                                        </tr>
                                    </table></td>
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{select_status}</td>
                                        </tr>
                                    </table></td>
									<td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{select_next}</td>
                                        </tr>
                                    </table></td>    
									<td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
									<tr>
									  <td class="formtext"><input type="submit" class="formbutton" value=" Submit " /></td>
									</tr>
								</table></td>                                                                        
                                  </tr>
								  </form>
 									
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                    </table>
                      <table width="907" border="0" cellspacing="5" cellpadding="0">
                        <tr>
                          <td align="right" class="whitetext">{split_results}</td>
                        </tr>
                    </table></td>
                </tr>
            </table></td>
          </tr>
        </table>
   

    
