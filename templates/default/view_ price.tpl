<table width="100%" border="0" cellspacing="20" cellpadding="0" height="100%">
<tr>
<td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="middle" class="formtitlebg"><table width="100%" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td align="center" class="heading">Price List For {quarter_name}</td>
          </tr>
          <tr>
            <td align="center" class="blacktextnormal">(Valid from {from} to {to})<br /><span class="errortext">{success}</span></td>
          </tr>
         
        </table></td>
      </tr>
  <tr>
    <td class="sland">&nbsp;</td>
  </tr>
  <tr>
 <td class="greybox"><form action="" method="post">
    <table width="100%" border="0" cellspacing="5" cellpadding="0">
      <tr>
        <td width="6%" align="right" class="formtext">Type :</td>
        <td width="27%" align="left">{select_producttype}</td>
        <td width="47%" align="right" class="successmessage">{message}
        <input type="hidden" name="quarter_id" id="quarter_id"  value="{quarter_id}"  />
       <input type="hidden" name="ptype" id="ptype"  value="{ptype}"  />
         <input type="hidden" name="action"  id="action" value="{action}"  /> <input name="button2" type="reset" class="formbutton" id="button2" value=" Back " onclick="redirect('list_quarters.php')"  /></td> <td width="20%" align="right" class="formtext"><zone export enabled>  <a href="#" id="{quarter_id}&ptype={ptype}"  class="pricepdf" target="_self"><input name="button2" type="reset" class="formbutton" id="button2" value=" Export as PDF "/>  </a></zone export enabled> </td>
      </tr>
    </table></form>
    </td> 
  </tr>
                  <tr>
                    <td class="formcolour">
           <form action="" method="post" name="price" id="price" >
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr class="glassyhead">
                        <td align="left" class="columnborder">Sl No</td>
                        <td align="left" class="columnborder">Product</td>
                        <td align="left" class="columnborder">Product Code</td>
                        <td align="left" class="columnborder">Rate (Rs)</td>
						<zone showtax enabled>
                        <td align="left" class="columnborder">ED ({ed_percent}%)</td>
                        <td align="left" class="columnborder">CST ({cst_percent}%)</td>
						</zone showtax enabled>
                        <td align="left" class="columnborder">Hospital Price</td>
                        <td align="left" class="columnborder">MRP</td>
                      </tr>
                      <zone showpricelist enabled> 
                       <LOOP quarters> 
                      <tr class="columnrow{class}">
                        <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                            <tr>
                              <td class="formtext">{slno}</td>
                            </tr>
                        </table></td>
                        <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                            <tr>
                              <td align="left" class="formtext">{name}</td>
                            </tr>
                        </table></td>
                        <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                            <tr>
                              <td class="formtext">{code}</td>
                            </tr>
                        </table></td>
                        <td align="center" class="columnborder"><table width="69%" border="0" cellspacing="10" cellpadding="0">
                          <tr>
                            <td class="rupees">
                           <span class="rupees">{rate}</span>
                            </td>
                          </tr>
                        </table></td>
						<zone showtax enabled>
                        <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                          <tr>
                            <td class="rupees">{ed}</td>
                          </tr>
                        </table></td>
                        <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                          <tr>
                            <td class="rupees">{cst} </td>
                          </tr>
                        </table></td>
						</zone showtax enabled>
                        <td align="center" class="columnborder"><table width="69%" border="0" cellspacing="10" cellpadding="0">
                          <tr>
                            <td class="rupees">{hospital_price}</td>
                          </tr>
                        </table></td>
                        <td align="center" class="columnborder"><table width="69%" border="0" cellspacing="10" cellpadding="0">
                          <tr>
                            <td class="rupees">{mrp}
                              <input type="hidden" name="product_id[]" value="{product_id}"/>
                           </td>
                          </tr>
                        </table></td>
                      </tr>
                      
                       </LOOP quarters> 
                      </zone showpricelist enabled> 
                      <zone showmessage enabled> 
                      <tr class="columnrow{class}">
                        <td class="columnborder" colspan="8" ><table width="100%" border="0" cellspacing="10" cellpadding="0">
                            <tr>
                              <td class="formtext"  align="center">Price List not added</td>
                            </tr>
                        </table></td>    
                        </tr> 
                          
                     </zone showmessage enabled> 
                   </table></td>
                  </tr>
                  <tr>
                    <td class="formboot"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                      <tr>
                        <td width="49%" height="24" align="right" valign="top"><label>
                          
                        </label></td>
                        <td width="51%" align="left" valign="top"></td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
                 </form> 
                </td>
              </tr>
            </table></td>
     </tr>
</table>
