<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Terumo Penpol: Order</title>
<link href="{theme}css/terumo.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="100%" border="0" cellspacing="20" cellpadding="0">
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td valign="middle" class="formtitlebg">Order Details</td>
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
                            <td nowrap="nowrap" class="columnborder" style="border-bottom:1px solid #999999;border-top:1px solid #999999;"> Sl No</td>
                            <td class="columnborder" style="border-bottom:1px solid #999999;border-top:1px solid #999999;">Product</td>
                            <td class="columnborder" style="border-bottom:1px solid #999999;border-top:1px solid #999999;">Product Code</td>
                            <td class="columnborder" style="border-bottom:1px solid #999999;border-top:1px solid #999999;">Bags / Carton</td>
                            <td class="columnborder" style="border-bottom:1px solid #999999;border-top:1px solid #999999;">Qty</td>
                            <td class="columnborder" style="border-bottom:1px solid #999999;border-top:1px solid #999999;">Rate</td>
                            <td class="columnborder" align="right" style="border-bottom:1px solid #999999;border-top:1px solid #999999;">Value (Rs)</td>
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
                            <td class="formcolour"  style="border-top:1px solid #999999;">&nbsp;</td>
                            <td class="formcolour" style="border-top:1px solid #999999;">&nbsp;</td>
                            <td class="formcolour" style="border-top:1px solid #999999;">&nbsp;</td>
                            <td align="center" class="formcolour" style="border-top:1px solid #999999;">&nbsp;</td>
                            <td align="center" class="formcolour" style="border-top:1px solid #999999;">&nbsp;</td>
                            <td align="center" class="formcolour" style="border-top:1px solid #999999;"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td align="right" class="formtext">Total:</td>
                                </tr>
                              </table></td>
                            <td class="formcolour" style="border-top:1px solid #999999;"><table width="100%" border="0" cellspacing="10" cellpadding="0">
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
                  <table width="100%" border="0" cellpadding="0" cellspacing="10" bgcolor="#BCC4D7">
                    <tr>
                      <td align="left" class="subheadinginner">Update Status</td>
                    </tr>
                  </table>
				   
                  <table width="100%" border="0" cellpadding="0" cellspacing="20" bgcolor="#DCE0EB">
                    <zone reqcancel enabled>
				    <tr class="columnrowtwo"><td><table cellpadding="5" cellspacing="10" style="border:1px solid red;" width="100%">
					<tr><td align="left">This order has been <strong style="color:red;">Requested to cancel</strong> by {reqcancelmadeby} on {reqcanceldate} </td></tr><tr><td align="left">Comment: {cancel_comment} </td></tr>
					</table></td></tr>
					</zone reqcancel enabled>
					<tr>
                      <td class="leftborder">
					  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr class="glassyhead">
                            <td width="15%" class="columnborder" style="border-bottom:1px solid #999999;border-top:1px solid #999999;">Date</td>
                            <td width="40%" class="columnborder" style="border-bottom:1px solid #999999;border-top:1px solid #999999;">Comment</td>
                            <td width="32%" class="columnborder" style="border-bottom:1px solid #999999;border-top:1px solid #999999;">Action Taken</td>
                            <td width="10%" class="columnborder" style="border-bottom:1px solid #999999;border-top:1px solid #999999;">Status</td>
                          </tr>
                          <LOOP orderstatus>
                            <tr class="columnrow{class}">
                              <td class="columnborder" style="border-bottom:1px solid #999999;"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td class="formtext">{updated_date}</td>
                                  </tr>
                                </table></td>
                              <td class="columnborder" style="border-bottom:1px solid #999999;"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td align="left" class="blacktextnormal"> {comment}</td>
                                  </tr>
                                </table></td>
                              <td class="columnborder" style="border-bottom:1px solid #999999;"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td class="blacktextnormal">{action} by <span class="formtext">{first_name} ({doneby}) </span></td>
                                  </tr>
                                </table></td>
                              <td class="columnborder" style="border-bottom:1px solid #999999;"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td class="formtext">{status}</td>
                                  </tr>
                                </table></td>
                            </tr>
                          </LOOP orderstatus>
                        </table></td>
                    </tr>
                  </table>
                 </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
