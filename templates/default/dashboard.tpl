<table width="100%" border="0" cellspacing="20" cellpadding="0">
  <tr>
    <td align="center"><table width="850" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="dashtop"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5%"><img src="{theme}images/dashicon.jpg" alt="" width="43" height="43" /></td>
                <td width="10%" align="left" class="mainhead">Dashboard</td>
                <td width="85%" align="left" valign="bottom" class="mainhead"><table width="175" border="0" align="right" cellpadding="0" cellspacing="0">
                    <!--<tr>
                        <td width="36"><img src="{theme}images/cpassword.jpg" alt="" width="36" height="27" /></td>
                        <td width="139" valign="middle" class="cpass"><a href="#">Change Password</a></td>
                        </tr>-->
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td bgcolor="#F5F4F9" class="dashbot"><table width="100%" border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td bgcolor="#c7cede"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>
                      <form name="dsahboard" id="dashboard" method="post" >
                      <table width="100%" border="0" cellpadding="0" cellspacing="10" bgcolor="#8FA4CF">
                          <tr>
                            <td align="left" class="dashheading">Orders</td>
                             <td align="right"><ZONE select enabled>{select_zone}&nbsp;&nbsp; {select_producttype}</ZONE select enabled></td>
                          </tr>
                          
                        </table>
                      </form>  
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr class="glassyhead">
                            <td align="left" class="columnborder" width="20%">Orders</td>
                            <td align="left" class="columnborder" width="26%">This Month</td>
                            <td align="left" class="columnborder"  width="27%">This Quarter</td>
                            <td align="left" class="columnborder"  width="28%">This Year</td>
                          </tr>
                          <tr>
                            <td valign="top" class="columnborder"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="80%" align="left" class="orderitemstop">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td align="left" class="orderitems">Orders</td>
                                </tr>
                                <tr>
                                  <td align="left" class="orderitems">Fulfilled Orders</td>
                                </tr>
                                <tr>
                                  <td align="left" class="orderitems">Cancelled Orders</td>
                                </tr>
                              </table></td>
                            <td class="columnborder"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="20%" align="left" class="innertabhead">Nos</td>
                                  <td width="80%" align="center" class="innertabhead">Total</td>
                                </tr>
                                <tr>
                                  <td align="left" class="number">{thismonthallorderlink}</td>
                                  <td align="right" class="totals">{thismonthtotal}</td>
                                </tr>
                                <tr>
                                  <td align="left" class="number">{thismonthfullfiledorderlink}</td>
                                  <td align="right" class="totals">{thismonth_fulfilledtotal}</td>
                                </tr>
                                <tr>
                                  <td align="left" class="number"> {thismonthcancelledorderlink}</td>
                                  <td align="right" class="totals">{thismonth_cancelledtotal}</td>
                                </tr>
                              </table></td>
                            <td class="columnborder"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="20%" align="left" class="innertabhead">Nos</td>
                                  <td width="80%" align="center" class="innertabhead">Total</td>
                                </tr>
                                <tr>
                                  <td align="left" class="number">{thisquaterallorderlink}</td>
                                  <td align="right" class="totals">{thisquartertotal}</td>
                                </tr>
                                <tr>
                                  <td align="left" class="number"> {thisquaterfulfiledorderlink}</td>
                                  <td align="right" class="totals">{thisquarter_fulfilledtotal}</td>
                                </tr>
                                <tr>
                                  <td align="left" class="number">{thisquatercancelledorderlink}</td>
                                  <td align="right" class="totals">{thisquarter_cancelledtotal}</td>
                                </tr>
                              </table></td>
                            <td class="columnborder"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="20%" align="left" class="innertabhead">Nos</td>
                                  <td width="80%" align="center" class="innertabhead">Total</td>
                                </tr>
                                <tr>
                                  <td align="left" class="number"> {thisyearallorderlink}</td>
                                  <td align="right" class="totals">{thisyeartotal}</td>
                                </tr>
                                <tr>
                                  <td align="left" class="number">{thisyearfulfiledorderlink} </td>
                                  <td align="right" class="totals">{thisyear_fulfilledtotal}</td>
                                </tr>
                                <tr>
                                  <td align="left" class="number"> {thisyearcancelledorderlink}</td>
                                  <td align="right" class="totals">{thisyear_cancelledtotal}</td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="100%" border="0" cellpadding="0" cellspacing="10" bgcolor="#8FA4CF">
                          <tr>
                            <td align="left" class="dashheading">Complaints</td>
                          </tr>
                        </table>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr class="glassyhead">
                            <td align="left" class="columnborder"  width="20%">Complaints</td>
                            <td align="left" class="columnborder" width="26%">This Month</td>
                            <td align="left" class="columnborder" width="27%">This Quarter</td>
                            <td align="left" class="columnborder" width="28%">This Year</td>
                          </tr>
                          <tr>
                            <td valign="top" class="columnborder"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="left" class="orderitems">Complaints</td>
                                </tr>
                              </table></td>
                            <td class="columnborder" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="left" class="number"><a href="complaints.php?q=&from={firstdayofmonth}&firno=&to={lastdayofmonth}&submit=+Search+">{thismonthcomplaint}</a></td>
                                </tr>
                              </table></td>
                            <td class="columnborder" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="left" class="number"><a href="complaints.php?q=&from={quarterstartdate}&firno=&to={quarterenddate}&submit=+Search+">{thisquartercomplaint}</a></td>
                                </tr>
                              </table></td>
                            <td class="columnborder" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="left" class="number" ><a href="complaints.php?q=&from={yearstartdate}&firno=&to={yearenddate}&submit=+Search+">{thisyearcomplaint}</a></td><td style="background-color: #EFF1F5; border-bottom:1px solid #8FA4CF">&nbsp;</td>
                                </tr>
                              </table></td>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
