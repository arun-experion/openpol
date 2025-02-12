<form name="order" id="order" method="post" autocomplete="off">
<table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="formtitlebg">Edit Your Purchase Order</td>
                            </tr>
                            <tr>
                                <td valign="middle" class="secondformhead"><table cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <zone timeremain enabled>
                                        <td class="successmessage noticemessage"><span></span>Your Order is in edit mode. Time remaining to edit</td>
                                        <td align="left" width="60%"><div id="defaultCountdown"></div></td>
                                        </zone timeremain enabled>
                                        <zone notconfirmed enabled>
                                        <td class="successmessage noticemessage"><span></span>Your Order has not been confirmed. Please confirm your order.</td>
                                        </zone notconfirmed enabled>
                                    </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                              <td align="left" valign="middle" class="ordernumber">
                              <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td width="21%" align="right" class="formtext"><div align="left">FR-MKT-41/B</div></td>
                                  <td width="79%" align="right" class="formtext"><span class="bluetextbold"></span> 
                                  <input type="hidden" name="order_no" value="{order_no}" />
                                  <input type="hidden" name="product_category" id="product_category" value="{product_type_id}" />
                                  <input type="hidden" name="order_id" id="order_id" value="{id}" />
                                  </td>
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
                                      <td width="29%"><input name="dl_20b" type="text" class="textboxsmall" id="textfield10" maxlength="15" value="{dl_20b}"/></td>
                                      <td width="11%" align="center" class="blacktextnormal">21B</td>
                                      <td width="28%"><input name="dl_21b" type="text" class="textboxsmall" id="textfield9" maxlength="15" value="{dl_21b}"/></td>
                                    </tr>
                                  </table></td>
                                  <td width="11" class="whitedivider">&nbsp;</td>
                                  <td width="587"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                    <tr>
                                      <td class="formtext">CST No :</td>
                                      <td>
                                      <input name="cst" type="text" class="formtextfiledsmall" id="textfield11" maxlength="15" value="{cst}"/></td>
                                      <td class="formtext">TIN No :</td>
                                      <td>
                                      <input name="tin" type="text" class="formtextfiledsmall" id="textfield12" maxlength="15" value="{tin}"/></td>
                                      <td class="formtext">BBL No:</td>
                                      <td>
                                      <input name="bbl" type="text" class="formtextfiledsmall" id="textfield13" maxlength="15" value="{bbl}"/></td>
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
                                  <input type="hidden" name="product_count" id="product_count" value="{totalProducts}" />
                                  <input type="hidden" name="redirectpage" id="redirectpage" value="edit" />      
                             </tr>
                            <ZONE loopProducts enabled>
                            <LOOP products>
                            <tr class="whitecolumnrow{class}" id="productadd_{slno}">
                                <td class="columnborder">
                                    <table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                            <td class="formtext"><span id="productslno_{slno}" class="productslno">{slno}</span></td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="columnborder">
                                    <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                        <tr>
                                            <td align="left" class="blacktextnormal">
                                                <div id="product_list_{slno}" class="productlist">
                                                    
                                                        {drop}
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="columnborder">
                                    <table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                            <td class="blacktextnormal">
                                                <div id="productcode_{slno}">{code}</div>
                                                <input id="productid_{slno}" class="code" type="hidden" value="{productid}" name="product_id[]">
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="center" class="columnborder">
                                    <table width="69%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                            <td class="blacktextnormal">
                                                <label>
                                                    <input id="cartonvalue_{slno}" class="carton" type="hidden" value="{carton_no}" name="carton_no[]">
                                                    <div id="carton_{slno}">{carton_no}</div>
                                                </label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="center" class="columnborder">
                                    <table width="69%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                            <td class="blacktextnormal">
                                                <label>
                                                    <input id="qty_{slno}" class="qty" type="text" name="quantity[]" value="{quantity}" />
                                                </label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="center" class="columnborder">
                                    <table width="69%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                            <td class="blacktextnormal">
                                                <label>
                                                    <input id="price_{slno}" class="rates" type="text" name="rate[]" value="{rate}" />
                                                </label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="columnborder">
                                    <table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                            <td class="blacktextnormal" align="right">
                                                <input type="hidden" value="{value}" name="value[]"><span id="total_{slno}" class="total">{value}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            </LOOP products>
                            </ZONE loopProducts enabled>

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
                                          <td align="right" class="formtext">Total : <span id="total_value">{total}</span></td>
                                         
                                        </tr>
                                    </table></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                      <td class="formcolour">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tr>
                                <td class="formboot">
                                    <table width="100%" cellspacing="5" cellpadding="0" border="0">
                                    <tr>
                                        <td width="49%" valign="top" align="right">
                                            <label>
                                                <input type="button" value=" Add Products " id="add_product" class="formbutton" name="add_product">
                                            </label>
                                        </td>
                                    </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                      </td>
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
                                    <td width="11%" class="formtext">Sales Tax :</td>
                                    <td width="12%" align="left"><label>
                                      <select name="tax_status" class="listmenus" id="select3">
                                        <option value="{value1}"> {salestax}</option>
                                        <option value="{value2}" >{salestax1}</option>
                                      </select>
                                    </label></td>
                                    <td width="32%" align="left" class="blacktextnormal">&nbsp;Of&nbsp;   
                                    <input name="tax_rate" type="text" class="textboxsmall" id="textfield2" maxlength="10" value="{tax_rate}"/>&nbsp;% ST /CST against&nbsp;</td>
                                    <td width="5%" align="left"><span class="formtext">
                                      <input type="radio" name="tax_type" id="tax_type" value="1" {cformChecked}/>
                                    </span></td>
                                    <td width="8%" align="left" class="formtext">C Form</td>
                                    <td width="5%" align="left"><span class="formtext">
                                      <input type="radio" name="tax_type" id="tax_type" value="2" {dformChecked}/>
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
                                      <input name="name" type="text"  class="date-pick"  id="textfield7" value="{name}"/>
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
                                  <textarea name="address" cols="45" rows="5" class="textareamedium" id="textarea">{address}</textarea>
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
                                    <input readonly="readonly" name="prefered_date" type="text"  class="date-pick" id="prefered_date" value="{prefered_date}"/>
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
                                <textarea name="instructions" cols="45" rows="5" class="textareamedium" id="textarea2">{instructions}</textarea>
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
                                <td width="8%" align="left"><input type="radio" name="payment_type" checked="checked" id="payment_type" value="1" {typecheque}/></td>
                                <td width="20%" align="left" class="formtext">Cheque</td>
                                <td width="8%" align="left" class="formtext"><input type="radio" name="payment_type" id="payment_type"   value="2" {typedd}/></td>
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
                                <input name="payment_no" type="text" class="no" id="payment_no" maxlength="20" value="{payment_no}"/>
                                </label></td>
                                <td width="6%" class="formtext">Dated :</td>
                                <td width="15%"><input readonly="readonly" name="payment_date" type="text" class="date-pick" id="paymentdate" value="{payment_date}"/></td>
                                <td width="3%"></td>
                                <td width="11%" class="formtext">Amount (Rs) :</td>
                                <td width="31%" align="left">
                                <input name="payment_amount" maxlength="10" type="text" class="amount" id="payment_amount" value="{payment_amount}"/></td>
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
                                  <textarea name="payment_terms" cols="45" rows="5" class="textareamedium" id="textarea3">{payment_terms}</textarea>
                                </label></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table>
						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dlbox">
                          <tr>
                            <td class="ordernumber"><div id="bloodbagtermschk" style="{style1}"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td class="formtext" valign="top"  align="left">&nbsp;<input type="checkbox" name="payment_term" id="bloodbagterms"  value="1" {payment1_checked} /> <span class="formtext">&nbsp;{payment_term_type_blood}</span> <span class="error" id="bloodbagtermserror"></span></td>                                 
                              </tr>
							
                            </table></div></td>
                          </tr>
                          <tr>
                            <td class="ordernumber"><div id="eqptermschk" style="{style2}"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                            
							  <tr>
                                <td class="formtext" valign="top" align="left">&nbsp;<input type="checkbox" name="payment_term" id="eqpterms" value="2" {payment2_checked}/><span class="formtext">&nbsp;{payment_term_type_eqp}</span><span class="error" id="eqptermserror"></span></td>                                 
                              </tr>
                            </table></div></td>
                          </tr>
                        </table>
						
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="formboot">
                          <tr>
                            <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td width="49%" align="right" valign="top"><label>
                                  <input name="addorder" type="button" class="formbutton" id="addorder" value=" Preview Order "  />
                                </label></td>
 <td width="51%" align="left" valign="top"><input name="button" type="button" onclick="redirect('{redirect}')" class="formbutton" id="button6" value=" Back to Orders " /></td>
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
<input type="hidden" id="timer" name="timer" value="{timer}" />
 </form>
