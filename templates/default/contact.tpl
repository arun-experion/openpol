<form name="contactus" id="contactus" method="post" >
  <table width="100%" border="0" cellspacing="20" cellpadding="0">
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td valign="middle" class="formtitlebg">Contact Us</td>
                      </tr>
                      
                      <ZONE error enabled>
                        <tr>
                          <td colspan="2" align="center" class="error">Required field missing:<br /><br />
                          {error.subject}
                          {error.description}
                          {error.group}
                          </td>
                        </tr>
                      </ZONE error enabled>
                    <tr>
                        <td class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                          <tr>
                          <td colspan="2" align="center"  class="successmessage">
                          {message}
                           </td>
                          </tr>
                            <tr>
                              <td align="center"><table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                              
                        
                         
                      
                                    <tr>
                                    <td align="right" class="formtext">Select Group:</td>
                                    <td align="left"><label>
                                      {select_group}<span class="required">*</span>
                                      </label></td>
                                  </tr>
                                  
                                  <tr>
                                    <td align="right" class="formtext">Subject:</td>
                                    <td align="left"><label>
                                      <input name="subject" type="text" id="subject" value="{subject}" class="formtextfileds"  /><span class="required" >*</span>
                                      </label></td>
                                  </tr>
                                         <tr>
                                    <td align="right" class="formtext">Description:</td>
                                    <td align="left" valign="top"><label>
                                      <textarea name="description" cols="40" rows="5">{description}</textarea><span class="required">*</span>
                                      </label></td>
                                  </tr>
                                   
                                   
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td class="formboot"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                  <tr>
                        <td width="33%" align="right" valign="top"><label>
                          <input name="submit" type="submit" class="formbutton" id="addgroup" value=" Submit " />
                          </label></td>
                        <td width="67%" align="left" valign="top"><input name="button2" type="button" class="formbutton" id="button2" value=" Cancel " onclick="redirect('contact.php')" /></td>
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
</form>
