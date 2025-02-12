
<table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
           <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td align="center" valign="middle" class="formtitlebg">Quarter Price</td>
                            </tr>
                            <tr>
                        <td valign="middle" class="secondformhead"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                  <td class="successmessage">{message}</td>
                                    <td align="right">
                             <input name="button4" type="submit" class="formbutton" id="button5" onclick="redirect('quarter.php')"  value=" Add Quarter Product Price "  /></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr class="glassyhead">
                                    <td class="columnborder">Sl No</td>
                                    <td class="columnborder">Quarter</td>
                                    <td class="columnborder">Valid From</td>
                                    <td class="columnborder">Valid To</td>
                                    <td class="columnborder">Actions</td>
                                  </tr>
                                  <ZONE showlist enabled>  
                                   <LOOP quarters>   
                                  <tr class="columnrow{class}">
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{slno}</td>
                                        </tr>
                                    </table></td>
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{name}</td>
                                        </tr>
                                    </table></td>
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{from_date}</td>
                                        </tr>
                                    </table></td>
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{to_date}</td>
                                        </tr>
                                    </table></td>
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                        <tr>
                                          <td align="center"><a href="price.php?quarter_id={id}&action=edit&product_type_id=1" ><font size="1"> Edit Price List</font></a>&nbsp;&nbsp;<a href="price.php?quarter_id={id}&action=view&product_type_id=1" ><font size="1"> View Price List</font></a>&nbsp;&nbsp;<a href="quarter.php?qid={id}"><font size="1">Edit Quarter</font></a>&nbsp;&nbsp;</td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                    </LOOP quarters>  
                                    </ZONE showlist enabled>
                                                     
                                 <zone noresults enabled>
                                <tr class="columnrowone">
                                
                             <td class="columnborder" colspan="8" ><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                <td class="formtext" align="center">No results available</td>
                                </tr>
                                </table></td></tr>
                                </zone noresults enabled>
                                 </table></td>
                            </tr>
                        </table></td>
                      </tr>
                    </table>
                      <table width="907" border="0" cellspacing="5" cellpadding="0">
                         <tr> <td align="left" class="whitetext">{total} Result(s)</td>
                          <td align="right" class="whitetext">{split_results}</td>
                        </tr>
                    </table></td>
                </tr>
            </table></td>
    </tr>        
    </table>       
 

