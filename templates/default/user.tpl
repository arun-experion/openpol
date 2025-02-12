<form action="" method="post">
<input type="hidden" name="passhiden" value="{password}" />
<input type="hidden" name="zoneval" id="zoneval" value='{zoneval}' />
<input type="hidden" name="areaselected" id="areaselected" value='{selectedarea}' />
 
<table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="middle" class="formtitlebg">{pagename} User</td>
                  </tr>
                  <tr>
                    <td class="sland">&nbsp;</td>
                  </tr>
				  <ZONE error enabled>
				    <tr>
                    <td class="error">Required field missing:<br /><br />
									  {error.title}
									  {error.firstname}
									  {error.lastname}
									  {error.username}
									  {error.password}
									  {error.passwordnotmatch}
									  {error.emailid}
									  {error.notvalidemail}
									  {error.mobile}
									  {error.validmobile}
									  {error.phone} 
									  {error.validphone}
									  {error.address} 
                    {error.validerpnumber}
                    {error.duplicate_erp}
                    {error.emptyerpnumber}
					</td>
                  </tr>
				 </ZONE error enabled> 
                  <tr>
                    <td class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                      <tr>
                        <td align="center"><table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                          <tr>
                            <td align="right" class="formtext">User Type :</td>
                            <td align="left"><label>
							                {select_role}
                            </label></td>

                            {* New Field Integration Changes Added By Abilash ON FEB16-22 *}
                            
                              <td id="erpblock" align="right" class="formtext">Customer ERP Number :</td>
                              <td id="erpblock_field" align="left">
                                <label>
                                  <input name="erp_number" type="text" class="formtextfileds" id="erp_number" value="{erp_number}" /><span class="required">*</span>
                                </label>
                              </td>
                            {* END *}
                              
                            </tr>
                          <tr>
                            <td align="right" class="formtext">Title :</td>
                            <td align="left">{select_title}<span class="required">*</span></td>
                          </tr>
                          <tr>
                            <td align="right" class="formtext">First Name :</td>
                            <td align="left"><label>
                              <input name="firstname" type="text" class="formtextfileds" id="first_name" value="{firstname}" /><span class="required">*</span>
                            </label></td>
                            <td align="right" class="formtext">Last Name :</td>
                            <td align="left"><input name="lastname" type="text" class="formtextfileds" id="lastname" value="{lastname}" /></td>
                          </tr>
                          <tr>
                            <td align="right" class="formtext">User Name :</td>
                            <td align="left"><input name="username" type="text" class="formtextfileds" id="username" value="{username}" /><span class="required">*</span></td>
                            <td align="right" class="formtext">Email ID :</td>
                            <td align="left"><input name="emailid" type="text" class="formtextfileds" id="emailid" value="{emailid}" /><span class="required">*</span></td>
                          </tr>
                          <tr>
                            <td align="right" class="formtext">Password :</td>
                            <td align="left"><input name="password" type="password" class="formtextfileds" id="password" /><span class="required">*</span></td>
                            <td align="right" class="formtext">Confirm Password :</td>
                            <td align="left"><input name="confirmpassword" type="password" class="formtextfileds" id="confirmpassword" /><span class="required">*</span></td>
                          </tr>
                          <tr>
                            <td align="right" class="formtext">Mobile : </td>
                            <td align="left"><input name="mobile" type="text" class="formtextfileds" id="mobile" value="{mobile}" /></td>
                            <td align="right" class="formtext">Phone :</td>
                            <td align="left"><input name="phone" type="text" class="formtextfileds" id="phone" value="{phone}" /></td>
                          </tr>
                          <tr>
                            <td align="right" class="formtext">Zone :</td>
                            <td align="left">
                               <div style="background-color: white;width: 75%; padding: 5px;"> 
                                {select_zone}
                              </div>
                            </td>
                            <td align="right" class="formtext">Area :</td>
                            <td align="left">
                             <div id="selectarea" style="height: 145px;overflow: auto;background-color: white;width: 80%; padding: 5px;"> 
                                {select_areas}
                              </div>
                             </td>
                          </tr>
                        </table>
                          <table width="700" border="0" align="center" cellpadding="0" cellspacing="5">

                            <tr>
                              <td width="93" align="right" class="formtext">Address :</td>
                              <td width="592" align="left"><label>
                                <textarea name="address" cols="45" rows="5" class="textareabig" id="address">{address}</textarea>
                              <span class="required">*</span></label></td>
                              </tr>
                          </table>
						  <zone status enabled>
						   <table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                            <tr>
                              <td width="93" align="right" class="formtext">Status :</td>
                              <td width="592" align="left">{select_status} </td>
                              </tr>
                          </table> 
						  </zone status enabled>
						  </td>
                      </tr>
                    </table></td>
                  </tr>
				  
                  <tr>
                    <td class="formboot"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                      <tr>
                        <td width="49%" align="right" valign="top"><label>
                          <input name="submit" type="submit" class="formbutton" id="button" value=" Submit " />
                        </label></td>
                        <td width="51%" align="left" valign="top">
						<input name="button2" type="button" class="formbutton" id="button2" value=" Cancel " onclick="redirect('list_users.php')" /></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table>
		<input type="hidden" value="{action}" name="action" />
		</form> 