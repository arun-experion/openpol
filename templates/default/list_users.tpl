<ZONE showlist enabled>
  
  <table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                  <tr>
                    <td><form action="" method="get"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" class="formtitlebg">Users</td>
                        </tr>
                        <tr>
                          <td align="left" valign="middle" class="glassyhead">Refine your search</td>
                        </tr>
                        <tr> 
                          <td class="formcolour">  <table width="100%" border="0" cellspacing="10" cellpadding="0">
                              <tr>
                                <td align="center"><table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                                    <tr>
                                      <td align="right" class="formtext">Name :</td>
                                      <td align="left"><label>
                                        <input name="q" type="text" class="formtextfileds" id="textfield" value="{name}" />
                                      </label></td>
                                      <td align="right" class="formtext">Zone :</td>
                                      <td align="left">{select_zones}</td>
                                    </tr>
                                    <tr>
                                      <td align="right" class="formtext">Status :</td>
                                      <td align="left">{select_status}</td>
                                      <td align="right" class="formtext">User Type :</td>
                                      <td align="left">{select_usertype}</td>
                                    </tr>
                                </table></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td class="formboot"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td width="49%" align="right" valign="top"><label>
                                  <input name="submit" type="submit" class="formbutton" id="button" value=" Search " />
                                </label></td>
                                <td width="51%" align="left" valign="top">
								<input name="reset" type="button" class="formbutton" id="button2" value=" Reset " onclick="redirect('list_users.php')" /></td>
                              </tr>
                          </table></td>
                        </tr>
                    </table></form></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" class="secondformhead"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                           <tr><td class="successmessage">{message}</td>
                              <td align="right">
							<input name="button4" type="submit" class="formbutton" id="button5" value=" Add New " onclick="redirect('user.php')"  /></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class="glassyhead">
                              <td class="columnborder">Sl No</td>
                              <td class="columnborder">Name</td>
                              <td class="columnborder">Zone</td>
                              <td class="columnborder">Area</td>
                              <td class="columnborder">User Type</td>
							   <td class="columnborder">Status</td>
                              <td class="columnborder">Actions</td>
                            </tr>
                             <zone usersavail enabled>
                             <LOOP users>   
                            <tr class="columnrow{class}">
                              <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext">{slno}</td>
                                </tr>
                              </table></td>
                              <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext"><a href="list_users.php?uid={id}" style="text-decoration:underline" class="formtext">{first_name} {last_name}</a></td>
                                </tr>
                              </table></td>
                              <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext">{zonename}</td>
                                </tr>
                              </table></td>
                              <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext">{areaname}</td>
                                </tr>
                              </table></td>
                              <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext">{usertype}</td>
                                </tr>
                              </table></td>
							  <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext">{status}</td>
                                </tr>
                              </table></td>
                              <td class="columnborder"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td align="center"><a href="user.php?id={id}"><img src="{theme}images/edit.png" alt="" width="26" height="26" border="0" /></a>&nbsp;&nbsp;</td>
                                </tr>
                              </table></td>
                            </tr>
                           </LOOP users> 
						  </zone usersavail enabled>
						  
						   <zone nouser enabled>
						 <tr class="columnrowone">
						
						  <td class="columnborder" colspan="8" ><table width="100%" border="0" cellspacing="10" cellpadding="0">
							<tr>
							  <td class="formtext" align="center">No results available</td>
							</tr>
						  </table></td></tr>
							</zone nouser enabled>
                          </table></td>
                        </tr>

                    </table></td>
                  </tr>
                </table>
                  <table width="907" border="0" cellspacing="5" cellpadding="0">
                    <tr><td align="left" class="whitetext">{total} Result(s)</td>
                      <td align="right" class="whitetext">{split_results}</td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          </tr>
        </table>
		 
  </ZONE showlist enabled>
  

  <zone showuser enabled>
  <table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td valign="middle" class="formtitlebg">User Information</td>
                      </tr>
                     
					  <tr>
                              <td align="left" valign="middle" class="glassyhead">Personal Information<div style="float:right"> <a href="user.php?id={id}" style="text-decoration:none; color:#FFFFFF">Edit Profile</a></div></td>
                            </tr>
                      <tr>
                        <td class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                            <tr>
                              <td align="center"><table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                               
                                  <tr>
                                    <td align="right" class="formtext" width="25%">Title :</td>
                                    <td align="left" class="formtextblue" width="25%"> {title}</td>
                                    <td align="right" class="formtext">Name :</td>
                                    <td align="left" class="formtextblue">{first_name}&nbsp;{last_name}</td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="formtext">User Name :</td>
                                    <td align="left" class="formtextblue">{username}</td>
                                    <td align="right" class="formtext">Email ID :</td>
                                    <td align="left" class="formtextblue">{email}</td>
                                  </tr>
                                   	
                                  <tr>
                                    <td align="right" class="formtext">Mobile : </td>
                                    <td align="left" class="formtextblue">{mobile}</td>
                                    <td align="right" class="formtext">Phone :</td>
                                    <td align="left" class="formtextblue">{phone}</td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="formtext">Zone :</td>
                                    <td align="left" class="formtextblue"> {zonename}</td>
                                    <td align="right" class="formtext">Area :</td>
                                    <td align="left" class="formtextblue"> {areaname}</td>
                                  </tr>
								   <tr>
                                    <td align="right" class="formtext">Status :</td>
                                    <td align="left" class="formtextblue"> {status}</td>
                                    <td align="right" class="formtext">Registered Date :</td>
                                    <td align="left" class="formtextblue"> {created_date}</td>
                                  </tr>
								   <tr>
                                    <td align="right" class="formtext">Address :</td>
                                    <td align="left" class="formtextblue" colspan="2"> {address}</td>
                                    
                                  </tr>
                                </table>
                                   </td>
                            </tr>
                        </table></td>
                      </tr>
					   <tr>
                              <td align="left" valign="middle" class="glassyhead">Role and permissions</td>
                       </tr>
                      <tr>
                        <td class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                            <tr>
                              <td align="center"><table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                               
                                  
                                  <tr>
                                    <td align="left" class="formtext">Role :   <span class="formtextblue">{utype}</span></td>                                 </tr>
								 
								   <tr><td class="formtext" align="left"><h3><u>Permissions</u>&nbsp;  <a href="user_permission.php?uid={id}" class="formtextblue">(Edit)</a></h3></td></tr>
								   <tr><td class="formtextblue" style="padding-left:15px;" align="left">{userperms}</td></tr>
                                </table>
                                   </td>
                          		  </tr>
								  
                        </table></td>
                      </tr>
                      <tr>
                        <td class="formboot"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                            <tr>
                              <td width="49%" align="right" valign="top"><label>
                             <input name="button" type="button" class="formbutton" id="button" value=" Back to users " onclick="redirect('list_users.php')"  />
                              </label></td>
                              
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
            </table></td>
          </tr>
        </table>
  </zone showuser enabled>
  

    
    