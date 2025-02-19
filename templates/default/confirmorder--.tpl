<table width="100%" border="0" cellspacing="20" cellpadding="0">
  <tr>
    <td align="center">
        <div class="preview"><img src="{theme}images/preview.png" alt="" /></div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td valign="middle" class="formtitlebg">Confirm Your Order</td>
                    </tr>
                    <ZONE success enabled>
                      <tr>
                        <td valign="middle" class="secondformhead"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td class="successmessage">{message}</td>
                            </tr>
                          </table></td>
                      </tr>
                    </ZONE success enabled>
                    <ZONE success disabled>
                      <tr>
                        <td valign="middle" class="secondformhead"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td class="canceltext" align="center" colspan="2">{baname} has requested for cancellation of this order</td>
                            </tr>
                             
                          </table></td>
                      </tr>
                    </ZONE success disabled>
                    <ZONE error enabled>
                      <tr>
                        <td class="error">Required field missing:<br />
                          <br />
                          {error.status} </td>
                      </tr>
                    </ZONE error enabled>
                    <tr>
                      <td align="left" valign="middle" class="ordernumber"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                          <tr>
                            <td align="right" class="formtext"><span class="bluetextbold">Order No:</span> {order_no}</td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td align="left" valign="middle" class="sland">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left" valign="middle" class="dlbox"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="303"><table width="310" border="0" cellspacing="8" cellpadding="0">
                                <tr>
                                  <td width="21%" class="formtext">DL No :</td>
                                  <td width="11%" align="center" class="blacktextnormal">20B</td>
                                  <td width="29%" class="formtext">{dl_20b}</td>
                                  <td width="11%" align="center" class="blacktextnormal">21B</td>
                                  <td width="28%" class="formtext">{dl_21b}</td>
                                </tr>
                              </table></td>
                            <td width="11" class="whitedivider">&nbsp;</td>
                            <td width="587"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td width="12%" class="formtext">CST No :</td>
                                  <td width="21%" align="left" class="formtext">{cst}</td>
                                  <td width="11%" class="formtext">TIN No :</td>
                                  <td width="22%" align="left" class="formtext">{tin}</td>
                                  <td width="11%" class="formtext">BBL No :</td>
                                  <td width="23%" align="left" class="formtext">{bbl}</td>
                                </tr>
                              </table></td>
                          </tr>
                        </table>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr class="glassyhead">
                            <td nowrap="nowrap" class="columnborder"> Sl No</td>
                            <td class="columnborder" width="25%">Product</td>
                            <td class="columnborder" >Product Code</td>
                            <td class="columnborder" width="14%">Bags / Carton</td>
                            <td class="columnborder">Qty</td>
                            <td class="columnborder">Rate</td>
                            <td class="columnborder" align="right">Value (Rs)</td>
                          </tr>
                          <LOOP products>
                            <tr class="whitecolumnrow{class}">
                              <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td class="formtext">{slno}</td>
                                  </tr>
                                </table></td>
                              <td class="columnborder"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td align="left" class="blacktextnormal">{productname}</td>
                                  </tr>
                                </table></td>
                              <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td class="blacktextnormal">{code}</td>
                                  </tr>
                                </table></td>
                              <td align="center" class="columnborder"><table width="69%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td class="blacktextnormal"><label>{carton_no}</label></td>
                                  </tr>
                                </table></td>
                              <td align="center" class="columnborder"><table width="69%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td class="blacktextnormal"><label>{quantity}</label></td>
                                  </tr>
                                </table></td>
                              <td align="center" class="columnborder"><table width="69%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td class="blacktextnormal"><label>{rate}</label></td>
                                  </tr>
                                </table></td>
                              <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td class="blacktextnormal" align="right">{value} </td>
                                  </tr>
                                </table></td>
                            </tr>
                          </LOOP products>
                          <tr class="whitecolumnrowtwo">
                            <td class="formcolour">&nbsp;</td>
                            <td class="formcolour">&nbsp;</td>
                            <td class="formcolour">&nbsp;</td>
                            <td align="center" class="formcolour">&nbsp;</td>
                            <td align="center" class="formcolour">&nbsp;</td>
                            <td align="center" class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td align="right" class="formtext">Total:</td>
                                </tr>
                              </table></td>
                            <td class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext" align="right">{total} </td>
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
                <td><table width="100%" border="0" cellpadding="0" cellspacing="20" bgcolor="#DCE0EB">
                    <tr>
                      <td class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                          <tr>
                            <td align="center" class="formtext">Sales Tax <span class="blacktextnormal">{salestax} Of </span>{tax_rate}% ST / CST <span class="blacktextnormal">against </span>{form}</td>
                          </tr>
                        </table>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="36%" valign="top"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td align="right" class="formtext" valign="top">Customer Name &amp; Address :</td>
                                </tr>
                              </table></td>
                            <td width="64%"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td align="left" class="blacktextnormal">{name} </td>
                                </tr>
								<tr>
                                  <td align="left" class="blacktextnormal">{address}</td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td align="right" class="formtext">Preferred Delivery Date :</td>
                                </tr>
                              </table></td>
                            <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td align="left" class="blacktextnormal">{prefered_date}</td>
                                </tr>
                              </table></td>
                          </tr>
                           <tr>
                            <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td align="right" class="formtext">Payment Agreement :</td>
                                </tr>
                              </table></td>
                            <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td align="left" class="blacktextnormal">{payment_term_type}</td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td align="right" class="formtext">Payment Terms :</td>
                                </tr>
                              </table></td>
                            <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td align="left" class="blacktextnormal">{payment_terms}</td>
                                </tr>
                              </table></td>
                          </tr>
                         
                             <tr>
                            <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td align="right" class="formtext">Order Credit :</td>
                                </tr>
                              </table></td>
                            <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td align="left" class="blacktextnormal">{order_credit}</td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td align="right" class="formtext">Payment Details :</td>
                                </tr>
                              </table></td>
                            <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td width="33%" align="left" class="formtext">Cheque No : {payment_no}</td>
                                  <td width="28%" align="left" class="formtext">Dated : {payment_date}</td>
                                  <td width="39%" align="left" class="formtext">Amount (Rs) : {payment_amount}</td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td align="right" class="formtext">Other Instructions :</td>
                                </tr>
                              </table></td>
                            <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td align="left" class="blacktextnormal"> {instructions}</td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                  <!--<table width="100%" border="0" cellpadding="0" cellspacing="10" bgcolor="#BCC4D7">
                    <tr>
                      <td align="left" class="subheadinginner">Update Status</td>
                    </tr>
                  </table>-->
				   
                  <!--<table width="100%" border="0" cellpadding="0" cellspacing="20" bgcolor="#DCE0EB">
                    <zone reqcancel enabled>
				    <tr class="columnrowtwo"><td><table cellpadding="5" cellspacing="10" style="border:1px solid red;" width="100%">
					<tr><td align="left">This order has been <strong style="color:red;">Requested to cancel</strong> by {reqcancelmadeby} on {reqcanceldate} </td></tr><tr><td align="left">Comment: {cancel_comment} </td></tr>
					<zone cancelreqrecommend enabled>
					<tr><td align="left"> This order has been <strong style="color:red;">{recommend_action}</strong> by {recommendby} on {recommend_date} </td></tr><tr><td align="left">Comment: {recommend_comment} </td></tr>
					</zone cancelreqrecommend enabled>
					</table></td></tr>
					</zone reqcancel enabled>
					<tr>
                      <td class="leftborder">
					  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr class="glassyhead">
                            <td width="15%" class="columnborder">Date</td>
                            <td width="40%" class="columnborder">Comment</td>
                            <td width="32%" class="columnborder">Action Taken</td>
                            <td width="10%" class="columnborder">Status</td>
                          </tr>
                          <LOOP orderstatus>
                            <tr class="columnrow{class}">
                              <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td class="formtext">{updated_date}</td>
                                  </tr>
                                </table></td>
                              <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td align="left" class="blacktextnormal"> {comment}</td>
                                  </tr>
                                </table></td>
                              <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td class="blacktextnormal">{action} by <span class="formtext">{first_name} ({doneby}) </span></td>
                                  </tr>
                                </table></td>
                              <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td class="formtext">{status}</td>
                                  </tr>
                                </table></td>
                            </tr>
                          </LOOP orderstatus>
                        </table></td>
                    </tr>
                  </table>-->
                  <zone orderupdateform enabled>
                    <form action="" method="post" name="statuschangeform">
                      <input type="hidden" name="orderid" value="{id}" />
					  <input type="hidden" name="aid" value="{area_id}" />
					   <input type="hidden" name="zid" value="{zone_id}" />
					   <input type="hidden" name="orderno" value="{order_no}" />
                        <input type="hidden" name="ordernum" value="{order_no}" />
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <zone recommendcancellation enabled>
				 	  <tr>
                          <td width="42%" class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td align="right" class="formtext">Change Status</td>
                              </tr>
                            </table></td>
                          <td width="58%" class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td align="left">
								<input type="hidden" name="statusaction" value="zhrecommend" />
								<select name="status">
								<option value=" ">--Select--</option>
								<option value="1">Recommend to cancel order</option>
								<option value="2">Not recommend to cancel order</option>
								</select></td>
                              </tr>
                            </table></td>
                        </tr> 		 
				  </zone recommendcancellation enabled>
				  
				    <zone cancelaction enabled>
				 	  <tr>
                          <td width="42%" class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td align="right" class="formtext">Change Status</td>
                              </tr>
                            </table></td>
                          <td width="58%" class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td align="left">
								<input type="hidden" name="statusaction" value="cancelaction" />
								<select name="status">
								<option value=" ">--Select--</option>
								<option value="1">Cancel order</option>
 								</select></td>
                              </tr>
                            </table></td>
                        </tr> 		 
				  </zone cancelaction enabled>
				  
				  <zone recommendcancellation disabled>
                        <tr>
                          <td width="42%" class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td align="right" class="formtext">Change Status</td>
                              </tr>
                            </table></td>
                          <td width="58%" class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td align="left"><label>
								{select_status} </label></td>
                              </tr>
                            </table></td>
                        </tr>
				 </zone recommendcancellation disabled>
                       <!-- enter delivery date   -->
					    <zone deliverydateentrysection enabled>
					   <tr><td colspan="2" id="deliverydatesection"><table width="100%" border="0" cellpadding="0" cellspacing="0">
					   <tr class="rowone"><td colspan="2" style="padding-left:12px;"><table cellpadding="0" cellspacing="10"><tr><td class="formtext">Enter delivery date of each product</td></tr></table></td></tr>
						<tr class="rowone"><td colspan="2" align="center">
						<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr class="glassyhead">
                            <td nowrap="nowrap" class="columnborder"> Sl No</td>
                            <td class="columnborder">Product</td>
                            <td class="columnborder">Product Code</td>
							 <td class="columnborder" align="center">Quantity</td>
                            <td class="columnborder">Delivery Date</td>                          
                          </tr>
                          <LOOP deliverydate_products>
						  <input type="hidden" name="slno" value="{slno}" class="slno" />
						  <input type="hidden" name="prod_id[]" value="{prod_id}" />
						  <input type="hidden" name="qty[]" value="{quantity}" />
						  
                            <tr class="whitecolumnrow{class}">
                              <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td class="formtext">{slno}</td>
                                  </tr>
                                </table></td>
                              <td class="columnborder"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td align="left" class="blacktextnormal">{productname}</td>
                                  </tr>
                                </table></td>
                              <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td class="blacktextnormal">{code}</td>
                                  </tr>
                                </table></td>
								
							<td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td class="blacktextnormal" align="center">{quantity}</td>
                                  </tr>
                                </table></td>
                                <td class="columnborder" style="border-right:1px solid #8fa4cf;"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td class="blacktextnormal"> <input name="deliverydate[]" type="text"  class="date-pick" id="deliverydate{slno}" value="{delivery_date}" /></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </LOOP deliverydate_products>
                            <tr class="whitecolumnrowtwo">
                            <td class="formcolour" colspan="5" style="border-top:1px solid #8fa4cf;">&nbsp;</td>                            
                          </tr>
                        </table>
						</td></tr>
						</table></td></tr>
						</zone deliverydateentrysection enabled>
						<tr>
                          <td class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td align="right" class="formtext">Status Comment :</td>
                              </tr>
                            </table></td>
                          <td class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td align="left"><label>
                                  <textarea name="comments" cols="45" rows="5" class="textareamedium" id="textarea"></textarea>
                                  </label></td>
                              </tr>
                            </table></td>
                        </tr>
                      </table>
                      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="formboot">
                        <tr>
                          <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                              <tr>
                                <td width="49%" align="right" valign="top"><label>
                                  <input name="submit" type="submit" class="formbutton" id="statuschange" value="  Submit  " />
                                  </label></td>
                                <td width="51%" align="left" valign="top"><input name="cancel" type="button" class="formbutton" id="button6" value="  Cancel  " onclick="redirect('list_orders.php')" /></td>
                              </tr>
                            </table></td>
                        </tr>
                      </table>
                    </form>
                  </zone orderupdateform enabled>
				 

				  
				  
				  
				  
				  
                  <zone updateorderstatus disabled>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="formboot">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="5" cellpadding="0">
                            <tr>
                              <td align="right" width="45%">
                                  <input name="button" type="button" class="formbutton" id="button6" value=" Confirm Order " onclick="redirect('confirm_order.php?do=confirm&id={id}')" />
                                </td>
                                <zone deletebutton enabled><td width="10%" align="center" valign="top"><input name="button" type="button" class="formbutton" id="button6" value=" Delete Order " onclick="cancelOrder({id})" /></td></zone deletebutton enabled>
                              <td width="45%" align="left" valign="top"><input name="button" type="button" class="formbutton" id="button6" value=" Edit Order " onclick="redirect('edit_order.php?id={id}&a={statusglag}')" /></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table>
                  </zone updateorderstatus disabled>
                </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>