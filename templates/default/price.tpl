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
                        <td align="center" class="blacktextnormal">(Valid from {from} to {to})<br /><span class="errortext">{message}</span></td>
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
                        <td width="67%" align="right" class="successmessage">{success}
                        <input type="hidden" name="quarter_id" id="quarter_id"  value="{quarter_id}"  />
                        <input type="hidden" name="action"  id="action" value="{action}"  />
                        <input type="hidden" name="ptype" id="ptype"  value="{ptype}"  /></td>
                      </tr>
                    </table></form>
                    </td> 
                  </tr>
                  <tr>
                  
                  <ZONE list enabled>
                    <td class="formcolour">
                    <form action="" method="post" name="price" id="price" >
		   <input type="hidden" name="edpercent" value="{ed_percent}" id="edpercent" />
		    <input type="hidden" name="cstpercent" value="{cst_percent}" id="cstpercent" />
		   
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr class="glassyhead">
                        <td align="left" class="columnborder" width="5%">Sl No </td>
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
                       <LOOP quarters> 
                      <tr class="columnrow{class}">
                        <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                            <tr>
                              <td class="formtext"> <input type="hidden" name="slno[]"   value="{slno}"/>{slno}</td>
                            </tr>
                        </table></td>
                        <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                            <tr>
                              <td align="left" class="formtext"><input type="hidden" name="name[]"   value="{name}"/>{name}</td>
                            </tr>
                        </table></td>
                        <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                            <tr>
                              <td class="formtext"> <input type="hidden" name="code[]"   value="{code}"/>{code}</td>
                            </tr>
                        </table></td>
                        <td align="center" class="columnborder"><table width="69%" border="0" cellspacing="10" cellpadding="0">
                          <tr>
                            <td class="formtext" align="right" ><label>
                            <input type="text" name="rate[]" class="rateval"  value="{rate}" id="rate_{slno}" />
                            </label></td>
                          </tr>
                        </table></td>
						<zone showtax enabled>
                        <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                          <tr>
                            <td class="formtext" align="right" > <input type="hidden" name="ed[]" class="ed"   value="{ed}"/>
                            <span id="ed_{slno}">{ed}</span></td>
                          </tr>
                        </table></td>
                        <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                          <tr>
                            <td class="formtext" align="right"><input type="hidden" name="cst[]"  class="cst"   value="{cst}"/>
                            <span id="cst_{slno}">{cst}</span> </td>
                          </tr>
                        </table></td>
						</zone showtax enabled>
                        <td  class="columnborder"><table width="69%" border="0" cellspacing="10" cellpadding="0">
                          <tr>
                            <td class="formtext"><label>
                             <input type="text" name="hospital_price[]"  class="hosp" id="hosp_{slno}"   value="{hospital_price}" />
                            </label></td>
                          </tr>
                        </table></td>
                        <td align="center" class="columnborder"><table width="69%" border="0" cellspacing="10" cellpadding="0">
                          <tr>
                            <td class="formtext"><label>
                              <input type="text" name="mrp[]" value="{mrp}" class="mrp" id="mrp_{slno}" />
                              <input type="hidden" name="product_id[]" value="{product_id}"/>
                            </label></td>
                          </tr>
                        </table></td>
                      </tr>
                      
                       </LOOP quarters> 
                   </table></td>
                   </ZONE list enabled>
                  </tr>
                  <tr>
                    <td class="formboot" ><table width="100%" border="0" cellspacing="5" cellpadding="0">
                      <tr>
                        <td width="49%" height="24" align="right" valign="top"><label>
                         <ZONE list enabled> 
                          <input name="price" type="button" class="formbutton" id="submitbutton" value=" Submit " />
                          </ZONE list enabled> 
                        </label></td>
                        <td width="51%" align="left" valign="top"><input name="button2" type="reset" class="formbutton" id="button2" value=" Back " onclick="redirect('list_quarters.php')" /></td>
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



    
     	