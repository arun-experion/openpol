 <form action="" method="post">
 <input type="hidden" name="ord_no" value="{onumber}" />
  <input type="hidden" name="ord_madeby" value="{ord_firstname}" />
    <input type="hidden" name="zoneid" value="{zoneid}" />
  
	<table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="formtitlebg" align="left">Request To Cancel Order</td>
                            </tr>
							<ZONE error enabled>
								<tr>
								<td class="error">Required field missing:<br /><br />
								{error.cancelreason}  					
							    </td>
								</tr>
							</ZONE error enabled> 
							 
                            <tr>
                              <td class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
							  <tr><td colspan="2" class="formtext" align="left">{cancelordertext}</td></tr>
							  <tr><td class="formtext" align="right">Reason for cancel: <span class="required">*</span></td><td valign="top" align="left">  <textarea name="cancelreason" cols="45" rows="5" class="textareamedium" id="textarea"></textarea></td></tr>
  							  <tr><td>&nbsp;</td><td align="left"><input type="submit" name="submit" value=" Send " class="formbutton" />
							<input type="button" name="cancel" value=" Cancel " class="formbutton" onclick="redirect('vieworder.php?id={id}')"  /></td></tr>  
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