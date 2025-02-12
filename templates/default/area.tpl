
<ZONE area_entry enabled>
  <form action="" method="post">
    <table width="100%" border="0" cellspacing="20" cellpadding="0">
      <tr>
        <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="middle" class="formtitlebg">Add Area</td>
                  </tr>
                  <tr>
                    <td class="sland">&nbsp;</td>
                  </tr>
				   <ZONE error enabled>
				    <tr>
                    <td class="error">Required field missing:<br /><br />
									  {error.name} 
									  {error.zone} 
									 
					</td>
                  </tr>
				 </ZONE error enabled> 
                  <tr>
                    <td class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                        <tr>
                          <td align="center"><table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                              
                              <tr>
                                <td align="right" class="formtext">Area Name :</td>
                                <td align="left"><input type="text" name="name" value="{name}" class="formtextfileds"/><span class="required">*</span>
                                </td>
                              </tr> 
							  <tr>
                                <td align="right" class="formtext">Zone :</td>
                                <td align="left">{select_zone}<span class="required">*</span>
                                </td>
                              </tr>
                            </table></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td class="formboot"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                        <tr>
                          <td width="49%" align="right" valign="top"><label>
                            <input name="submit" type="submit" class="formbutton" id="button" value=" Submit " />
                            </label></td>
                          <td width="51%" align="left" valign="top"><input name="button2" type="button" class="formbutton" id="button2" value=" Cancel " onclick="redirect('area.php')" /></td>
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
</ZONE area_entry enabled>

<ZONE listarea enabled> 
<table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                  <tr>
                    <td><tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="formtitlebg">Areas</td>
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
							 <input name="button4" type="submit" class="formbutton" id="button5" value=" Add New " onclick="redirect('area.php?action=add')" /></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class="glassyhead">
							 <td class="columnborder" width="10%">Sl No</td>
                              <td class="columnborder" width="40%">Area Name</td>    
							   <td class="columnborder" width="40%">Zone</td>                             
                              <td class="columnborder" width="10%">Action</td>
                            </tr>
							<zone arealist enabled>
							 <LOOP areas>
							 
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
							   <td class="columnborder" ><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext">{zonename}</td>
                                </tr>
                              </table></td> 
							  <td class="columnborder" align="center"> <a href="area.php?aid={id}&action=edit"> <img src="{theme}images/edit.png" alt="" width="26" height="26" border="0" /></a>
							  <a href="area.php?aid={id}&action=delete" class="deleteaction" style="text-decoration:none"><img src="{theme}images/close.png" alt="" width="26" height="26" border="0" /></a></td>						 
                            </tr>
							
							 </LOOP areas>
							 </zones arealist enabled>
							 <zone noareas enabled>
                             <tr class="columnrowone">
                            
                              <td class="columnborder" colspan="8" ><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext" align="center">No results available</td>
                                </tr>
                              </table></td></tr>
							</zone noareas enabled>
                             
                             
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
 
 
</ZONE listarea enabled>
 