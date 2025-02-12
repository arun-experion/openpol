<form action="" method="post" name="chooseDateForm" id="chooseDateForm" > 
<table width="100%" border="0" cellspacing="20" cellpadding="0" height="100%">
          <tr>
            <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="middle" class="formtitlebg">{quarter}</td>
                  </tr>
                  <tr>
                    <td class="sland">&nbsp;</td>
                  </tr>
   				   <ZONE error enabled>
				    <tr>
                    <td class="error">Required field missing:<br /><br />
									  {error.quarter_name}
									  {error.start-date}
									  {error.end-date}
									  {error.ed_tax_equipment}
									  {error.ed_tax_blood_bag}
									  {error.cst_tax_equipment}
                                      {error.cst_tax_blood_bag}
					</td>
                  </tr>
				 </ZONE error enabled> 
                 
                 
                  <tr>
                    <td class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                      <tr>
                        <td align="center"><table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                          <tr>
                            <td align="right" class="formtext">Quarter Name   :</td>
                            <td align="left"><label>
                          <input name="quarter_name" type="text" class="formtextfileds" id="quarter_name" value="{quarter_name}" />
                            </label><br/></td>
                            <td align="right" class="formtext">&nbsp;</td>
                            <td align="left">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="right" class="formtext">Valid From :</td>
                            <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td  width="98%" class="smaaltextfieldholder"><label>
                            <input name="start-date" id="start-date" style="width: 125px;height:20px;"  class="date-pick"  value="{from}"/>    
                                </label><br />
                            </td>
                           <td width="2%" align="left"></td>
                              </tr>
                            </table></td>
                            <td align="right" class="formtext">Valid To :</td>
                            <td align="left">
                                <input name="end-date" id="end-date" class="date-pick" style="width: 125px;height:20px;"   value="{to}" />
                                 </label><br />
                                 </td>
                          </tr>
                          <tr>
                            <td align="right" class="formtext">ED for Equipment :</td>
                            <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="48%" class="smaaltextfieldholder"><label>
                                   <input name="ed_tax_equipment"  class="formtextfiledsmall" id="ed_tax_equipment"  value="{ed_tax_equipment}" />                                </label></br>
          </td>
                                <td width="52%" align="left" class="formtext">%</td>
                              </tr>
                            </table></td>
                            <td align="right" class="formtext">ED for Blood Bags :</td>
                            <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="48%" class="smaaltextfieldholder"><label>
                                <input name="ed_tax_blood_bag" class="formtextfiledsmall"   id="ed_tax_blood_bag"  value="{ed_tax_blood_bag}" />
                                </label></br>
           </td>
                                <td width="52%" align="left" class="formtext">%</td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td align="right" class="formtext">CST for Equipment :</td>
                            <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="48%" class="smaaltextfieldholder"><label>
                               <input name="cst_tax_equipment" class="formtextfiledsmall"  id="cst_tax_equipment"  value="{cst_tax_equipment}" /> 
                                 
                                </label></br>
         </td>
                                <td width="52%" align="left" class="formtext">%</td>
                              </tr>
                            </table></td>
                            <td align="right" class="formtext">CST for Blood Bags :</td>
                            <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="48%" class="smaaltextfieldholder"><label>
                                <input name="cst_tax_blood_bag" class="formtextfiledsmall"  id="cst_tax_blood_bag"  value="{cst_tax_blood_bag}" />
                                
                                </label></br>
          </td>
                                <td width="52%" align="left" class="formtext">%</td>
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
                          <input name="submit" type="submit" class="formbutton" id="submit" value=" Submit "  />
                        </label></td> 
                        <td width="51%" align="left" valign="top">
                        <input name="Reset" type="reset" class="formbutton" id="Reset" value=" Cancel " 
                        onclick="redirect('list_quarters.php')" /></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table>
</form>
