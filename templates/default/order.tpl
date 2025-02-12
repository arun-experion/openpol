<form name="order" id="order" method="post" autocomplete="off" >
<table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="formtitlebg">Purchase Order</td>
                            </tr>
                            <tr>
                              <td align="left" valign="middle" class="ordernumber">
                              <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td width="21%" align="right" class="formtext"><div align="left">FR-MKT-41/B</div></td>
                                  <td width="79%" align="right" class="formtext"><span class="bluetextbold"></span> 
                                  <input type="hidden" name="order_no" value="{order_no}" />
                                   <input type="hidden" name="product_category" id="product_category" value="0" /></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td align="left" valign="middle" class="sland">&nbsp;</td>
                            </tr>
                             <tr>
                              <td align="left" valign="middle" class="dlbox"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="303"><table width="300" border="0" cellspacing="5" cellpadding="0">
                                    <tr>
                                      <td width="19%" class="formtext">DL No :</td>
                                      <td width="13%" align="center" class="blacktextnormal">20B</td>
                                      <td width="29%"><input name="dl_20b" type="text" class="textboxsmall" id="textfield10" maxlength="15" /></td>
                                      <td width="11%" align="center" class="blacktextnormal">21B</td>
                                      <td width="28%"><input name="dl_21b" type="text" class="textboxsmall" id="textfield9" maxlength="15"/></td>
                                    </tr>
                                  </table></td>
                                  <td width="11" class="whitedivider">&nbsp;</td>
                                  <td width="587"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                    <tr>
                                      <td class="formtext">CST No :</td>
                                      <td>
                                      <input name="cst" type="text" class="formtextfiledsmall" id="textfield11" maxlength="15"/></td>
                                      <td class="formtext">TIN No :</td>
                                      <td>
                                      <input name="tin" type="text" class="formtextfiledsmall" id="textfield12" maxlength="15"/></td>
                                      <td class="formtext">BBL No:</td>
                                      <td>
                                      <input name="bbl" type="text" class="formtextfiledsmall" id="textfield13" maxlength="15"/></td>
                                    </tr>
                                  </table></td>
                                </tr>
                              </table>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        
                         <tr>
                            <td class="rowtwo"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td align="left" width="17%" class="formtext">Select Category : </td>
								<td align="left" width="36%"  class="formtext">{product_type}</td>
                                <td align="right" width="36%"  class="formtext"> Credit : </td>
                                 <td align="left" width="14%" class="formtext">{select_user} </td>
                              </tr>
                            </table></td></tr> 
							
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr class="glassyhead">
                                    <td class="columnborder" width="5%">Sl</td>
                                    <td class="columnborder" width="25%">Product</td>
                                    <td class="columnborder" width="15%">Product Code</td>
                                    <td class="columnborder" width="7%">Carton</td>
                                    <td class="columnborder" width="10%">Quantity</td>
                                    <td class="columnborder" width="10%">Rate</td>
                                    <td class="columnborder" width="18%">Value (Rs)</td>
                                  </tr>
                              <tr  id="productadd_0" >
                                        <input type="hidden" name="product_count" id="product_count" value="0" />
                             </tr>
                            </table> 
                             </td></tr>
                              </table>
                                </div></td>
                            </tr>
                              <tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                 <td class="formcolour">
                                    <table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                         <td class="formcolour">&nbsp;</td>
                                          <td class="formcolour">&nbsp;</td>
                                    <td class="formcolour">&nbsp;</td>
                                    <td align="center" class="formcolour">&nbsp;</td>
                                    <td align="center" class="formcolour">&nbsp;</td>
                                          <td align="right" class="formtext">Total : <span id="total_value">0.00</span></td>
                                         
                                        </tr>
                                    </table></td>
                            </tr>
                        
                            <tr>
                              <td class="formcolour"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td class="formboot"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                          <tr>
                                            <td width="49%" align="right" valign="top">
                                              <label>
                                <input name="add_product" type="button" class="formbutton" id="add_product" value=" Add Products " />
                                              </label></td>
                                          </tr>
                                      </table></td>
                                    </tr>
                                </table></td>
                            </tr>
                        </table></td>
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
                            <td valign="middle" class="subheading"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                   
                                    <td width="23%" align="left" class="formtext">Rate exclusive of ED and Tax against</td>
                                   
                                    <td width="1%" align="left"><span class="formtext">
                                      <input type="radio" name="tax_type" id="tax_type" value="1" />
                                    </span></td>
                                    <td width="8%" align="left" class="formtext">C Form</td>
                                    <td width="1%" align="left"><span class="formtext">
                                      <input type="radio" name="tax_type" id="tax_type" value="2" />
                                    </span></td>
                                    <td width="10%" align="left"><span class="formtext">D Form  </span> <span class="blacktextnormal"></span> <span class="formtext"> </span></td>
                                  </tr>
                                </table></td>
                                <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td align="right"><span class="blacktextnormal">(We shall provide you</span> <span class="formtext">C/D Form</span><span class="blacktextnormal">)</span></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>

                      </table>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        
                         <tr>
                            <td class="rowtwo"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td align="right" class="formtext">Customer Name :</td>
                              </tr>
                            </table></td>
                            <td align="left" class="rowtwo"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="26%" align="left"><label>
                                      <input name="name" type="text"  class="date-pick"  id="textfield7" />
                                    </label></td>
                                    <td width="74%" align="left"></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td width="42%" class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                            
                            
                              <tr>
                                <td align="right" class="formtext">Address :</td>
                              </tr>
                            </table></td>
                            <td width="58%" class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                              
                              
                                <td align="left"><label>
                                  <textarea name="address" cols="45" rows="5" class="textareamedium" id="textarea"></textarea>
                                </label></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                             <td class="rowtwo"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td align="right" class="formtext">Preferred Delivery Date :</td>
                              </tr>
                            </table></td>
                            <td align="left" class="rowtwo"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="26%" align="left"><label>
                                    <input readonly="readonly" name="prefered_date" type="text"  class="date-pick" id="prefered_date" />
                                    </label></td>
                                    <td width="74%" align="left"></td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td align="right" class="formtext">Other Instructions :</td>
                              </tr>
                            </table></td>
                            <td class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td align="left"><label>
                                <textarea name="instructions" cols="45" rows="5" class="textareamedium" id="textarea2"></textarea>
                                </label></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table>
						
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="left" class="glassyhead">Payment Details</td>
                          </tr>
                        </table>
						
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="ordernumber"><table width="300" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td width="8%" align="left"><input type="radio" name="payment_type" checked="checked" id="payment_type" value="1" /></td>
                                <td width="20%" align="left" class="formtext">Cheque</td>
                                <td width="8%" align="left" class="formtext"><input type="radio" name="payment_type" id="payment_type"   value="2" /></td>
                                <td width="64%" align="left" class="formtext">DD</td>
                              </tr>
                            </table></td>
                          </tr>
                        </table>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="dlbox">
                          <tr>
                            <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td width="13%" class="formtext">Cheque/DD No :</td>
                                <td width="21%" align="left"><label>
                                <input name="payment_no" type="text" class="no" id="payment_no" maxlength="20" />
                                </label></td>
                                <td width="6%" class="formtext">Dated :</td>
                                <td width="15%"><input readonly="readonly" name="payment_date" type="text" class="date-pick" id="paymentdate" /></td>
                                <td width="3%"></td>
                                <td width="11%" class="formtext">Amount (Rs) :</td>
                                <td width="31%" align="left">
                                <input name="payment_amount" maxlength="10" type="text" class="amount" id="payment_amount" /></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="42%" class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td align="right" class="formtext">Payment Terms :</td>
                              </tr>
                            </table></td>
                            <td width="58%" class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td align="left"><label>
                                  <textarea name="payment_terms" cols="45" rows="5" class="textareamedium" id="textarea3"></textarea>
                                </label></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table>
						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dlbox">
                          <tr>
                            <td class="ordernumber"><div id="bloodbagtermschk"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td class="formtext" valign="top"  align="left">&nbsp;<input type="checkbox" name="payment_term" id="bloodbagterms"  value="1"  /> <span class="formtext">&nbsp;{terms1}</span> <span class="error" id="bloodbagtermserror"></span></td>                                 
                              </tr>
							
                            </table></div></td>
                          </tr>
                          <tr>
                            <td class="ordernumber"><div id="eqptermschk" ><table width="100%" border="0" cellspacing="5" cellpadding="0">
                            
							  <tr>
                                <td class="formtext" valign="top" align="left">&nbsp;<input type="checkbox" name="payment_term" id="eqpterms" value="2"/><span class="formtext">&nbsp;{terms2}</span><span class="error" id="eqptermserror"></span></td>                                 
                              </tr>
                            </table></div></td>
                          </tr>
                        </table>
						
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="formboot">
                          <tr>
                            <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td width="49%" align="right" valign="top"><label>
                                  <input name="addorder" type="button" class="formbutton" id="addorder" value=" Preview "  />
                                </label></td>
 <td width="51%" align="left" valign="top"><input name="button" type="button" onclick="redirect('list_orders.php')" class="formbutton" id="button6" value=" Cancel " /></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                   </td>
                </tr>
            </table>
          </td>
      </tr>
 </table>
 <input type="hidden" name="tax_status" value="2" />
 <input name="tax_rate" type="hidden" value="" />
 </form>