<ZONE groupentry enabled>
<form action="" method="post" name="group" id="group">
  <input type="hidden" name="useridval" id="useridval" />
  <table width="100%" border="0" cellspacing="20" cellpadding="0">
    <tr>
      <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="middle" class="formtitlebg">{action} Group</td>
                </tr>
                <tr>
                  <td class="sland">&nbsp;</td>
                </tr>
                <tr>
                  <td class="error" id="errormsg">Required field missing:<br />
                    <br />
                  </td>
                </tr>
                <tr>
                  <td class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                      <tr>
                        <td align="center"><table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                            <tr>
                              <td align="right" class="formtext">Group Name :</td>
                              <td align="left"><input type="text" name="name" value="{name}" class="formtextfileds" id="name"/>
                                <span class="required">*</span> </td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="2" align="center" class="formtext">Choose users to this group</td>
                            </tr>
                             <tr>
                              <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="2" align="center"><table border="0" align="center" valign="center">
                                  <tr>
                                    <td class="formtext">Users List</td>
                                    <td></td>
                                    <td class="formtext">Assigned user(s)</td>
                                  </tr>
                                  <tr>
                                    <td><select id="allusers" multiple size="7"  name="allusers">
                                        
								{options}
								
                                      </select>
                                    </td>
                                    <td><table>
                                        <tr>
                                          <td><input type="button" value=" >> " onclick="moveoutid()" class="formbutton"></td>
                                        </tr>
                                        <tr>
                                          <td><input type="button" value=" << " onclick="moveinid()" class="formbutton"></td>
                                        </tr>
                                      </table></td>
                                    <td><select id="groupusers" multiple size="7"  style="min-width:250px;" name="groupusers">
                                        
								{usernames}
								
                                      </select>
                                    </td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td class="formboot"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                      <tr>
                        <td width="49%" align="right" valign="top"><label>
                          <input name="addgroup" type="button" class="formbutton" id="addgroup" value=" Submit " />
                          </label></td>
                        <td width="51%" align="left" valign="top"><input name="button2" type="button" class="formbutton" id="button2" value=" Cancel " onclick="redirect('group.php')" /></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
  <input type="hidden" name="action" value="{action}" />
</form>
</ZONE groupentry enabled>
<ZONE grouplist enabled>
<table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                  <tr>
                    <td><tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="formtitlebg">Groups</td>
                            </tr>
                             
                             
                        </table></td>
                      </tr></td>
                  </tr>
                </table></td>
              </tr>
               
              <tr>
                <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" class="secondformhead"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                            <tr><td class="successmessage">{message}</td>
                              <td align="right">
							 <input name="button4" type="submit" class="formbutton" id="button5" value=" Add New " onclick="redirect('group.php?action=add')" /></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class="glassyhead">
							 <td class="columnborder" width="5%">Sl No</td>
                              <td class="columnborder" width="40%">Group Name</td>    
                               <td class="columnborder" width="10%" align="center">Action</td>
                            </tr>
							<zone groupavilable enabled>
							 <LOOP groups>
							 
                            <tr class="columnrow{class}">
                             <td class="columnborder" ><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext">{slno}</td>
                                </tr>
                              </table></td> 
                              <td class="columnborder" ><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext">{name}</td>
                                </tr>
                              </table></td> 						  
							  <td class="columnborder" align="center"> <a href="group.php?id={id}&action=edit"> <img src="{theme}images/edit.png" alt="" width="26" height="26" border="0" /></a>
							  <a href="group.php?delete={id}" class="deleteaction" style="text-decoration:none"><img src="{theme}images/close.png" alt="" width="26" height="26" border="0" /></a></td>						 
                            </tr>
							
							 </LOOP groups>
							 </zones groupavilable enabled>
							 <zone nogroups enabled>
                             <tr class="columnrowone">
                            
                              <td class="columnborder" colspan="8" ><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext" align="center">No results available</td>
                                </tr>
                              </table></td></tr>
							</zone nogroups enabled>
                             
                             
                          </table></td>
                        </tr>

                    </table></td>
                  </tr>
                </table>
                  <table width="907" border="0" cellspacing="5" cellpadding="0">
                    <tr><td width="60%" class="whitetext" align="left">{total} Result(s)</td>
                      <td align="right" class="whitetext">{split_results}</td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          </tr>
        </table>
</ZONE grouplist enabled>