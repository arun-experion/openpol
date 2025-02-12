
<ZONE product_entry enabled>
  <form action="" method="post">
    <table width="100%" border="0" cellspacing="20" cellpadding="0">
      <tr>
        <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="middle" class="formtitlebg">Add Products</td>
                  </tr>
                  <tr>
                    <td class="sland">&nbsp;</td>
                  </tr>
				   <ZONE error enabled>
				    <tr>
                    <td class="error">Required field missing:<br /><br />
									  {error.product_name}
									  {error.product_code}
									  {error.weight}
									  {error.carton}
									  {error.duplicateproduct}
									 
					</td>
                  </tr>
				 </ZONE error enabled> 
                  <tr>
                    <td class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                        <tr>
                          <td align="center"><table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                              <tr>
                                <td align="right" class="formtext" width="50%">Choose Product Type :</td>
                                <td align="left"> {select_producttype}</td>
                              </tr>
                              <tr>
                                <td align="right" class="formtext">Product Name :</td>
                                <td align="left"><input type="text" name="product_name" value="{product_name}" class="formtextfileds"/><span class="required">*</span>
                                </td>
                              </tr>
                              <tr>
                                <td align="right" class="formtext">Product Code :</td>
                                <td align="left"><input type="text" name="product_code" value="{product_code}"  class="formtextfileds" /><span class="required">*</span>
                              </td>
                              </tr>
                              <tr id="pcategory">
                                <td align="right" class="formtext">Category :</td>
                                <td align="left">{select_cattype}</td>
                              </tr>
                              <tr>
                                <td align="right" class="formtext">Weight :</td>
                                <td align="left"><input type="text" name="weight" value="{weight}" class="formtextfileds"/><span id="weightrequired" class="required">*</span>
                              </td>
                              </tr>
                              <tr>
                                <td align="right" class="formtext">Carton :</td>
                                <td align="left"><input type="text" name="carton" value="{carton}" class="formtextfileds" /><span id="cartonrequird" class="required">*</span>
                              </td>
                              </tr>
							  <zone status enabled>
							  <tr>
                                <td align="right" class="formtext">Status :</td>
                                <td align="left"> {select_status}
                                 </td>
                              </tr>
							  </zone status enabled>
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
                          <td width="51%" align="left" valign="top"><input name="button2" type="button" class="formbutton" id="button2" value=" Cancel " onclick="redirect('product.php')"  /></td>
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
</ZONE product_entry enabled>

<ZONE listproduct enabled> 
<table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                  <tr>
                    <td><tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="formtitlebg">Products</td>
                            </tr>
                            <tr>
                              <td align="left" valign="middle" class="glassyhead"> Search</td>
                            </tr>
                            <tr>
                              <td class="formcolour">
							  <form action="" method="post">
							  <table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td align="center"><table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                                        <tr>
                                          <td width="315" align="right" class="formtext">Product Name :</td>
                                          <td width="370" align="left"><label>
                                            <input name="pname" type="text" class="formtextfileds" id="textfield" value="{pname}" />
                                          </label></td>
                                        </tr>
                                        <tr>
                                          <td align="right" class="formtext">Product Type :</td>
                                          <td align="left">{select_producttype}</td>
                                        </tr>
                                        <tr>
                                          <td align="right" class="formtext">&nbsp;</td>
                                          <td align="left"><input name="search" type="submit" class="formbutton" id="button" value=" Search " /></td>
                                        </tr>
                                    </table>
									</form>
									</td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr></td>
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
							  <input name="button4" type="submit" class="formbutton" id="button5" value=" Add New " onclick="redirect('product.php?action=add')" /></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class="glassyhead">
                              <td class="columnborder" width="30%">Product Name</td>
                              <td class="columnborder">Product Code</td>
                              <td class="columnborder">Type</td>
							   <td class="columnborder">Category</td>
							   <td class="columnborder">Weight</td>
							   <td class="columnborder">Carton</td>
                              <td class="columnborder">Status</td>
                              <td class="columnborder">Action</td>
                            </tr>
							<zone productsvail enabled>
							 <LOOP products>
							 
                            <tr class="columnrow{class}">
                            
                              <td class="columnborder" ><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext">{name}</td>
                                </tr>
                              </table></td>
                              <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext">{code}</td>
                                </tr>
                              </table></td>
                              <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext">{prtype}</td>
                                </tr>
                              </table></td>
                              <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext">{pcat}</td>
                                </tr>
                              </table></td>
							  <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
							<tr>
							  <td class="formtext">{weight}</td>
							</tr>
							  </table></td>
							   <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
							<tr>
							  <td class="formtext">{carton}</td>
							</tr>
							  </table></td>
                              <td class="columnborder"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td align="center"><span class="details">{status}</span></td>
                                </tr>
                              </table></td>
							  
							  <td class="columnborder" align="center"> <a href="product.php?pid={id}&action=edit"> <img src="{theme}images/edit.png" alt="" width="26" height="26" border="0" /></a></td>
							  
							 
                            </tr>
							
							 </LOOP products>
							 </zone productsvail enabled>
							 <zone noproducts enabled>
                             <tr class="columnrowone">
                            
                              <td class="columnborder" colspan="8" ><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext" align="center">No results available</td>
                                </tr>
                              </table></td></tr>
							</zone noproducts enabled>
                             
                             
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
 
 
</ZONE listproduct enabled>
 