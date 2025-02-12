<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><table width="980" border="0" align="center" cellpadding="0" cellspacing="5">
              <tr>
                <td valign="top" class="sfleft">
				<ZONE reportsearch enabled>
				<table width="280" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left"><img src="{theme}images/search_filter.jpg" alt="" width="280" height="38" /></td>
                    </tr>
                    <tr>
                      <td valign="top" class="sfleftmiddle">
					  <form action="" method="get">
					  <table width="100%" border="0" cellspacing="8" cellpadding="0">
                        <tr>
                          <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><table width="100" border="0" align="center" cellpadding="3" cellspacing="9">
                                  <tr>
                                    <td width="17%" class="formtext">From:</td>
                                    <td width="22%"><label>
                                      <input name="startdate" type="text" class="date-pick"  id="formtextfiledsomall" value="{startdate}" />
                                    </label></td>
                                    <td width="10%" class="formtext">To:</td>
                                    <td width="40%"><input name="enddate" type="text" id="totextfiledsomall" class="date-pick" value="{enddate}" /></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td>
							  
							  <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td align="center"><label>
                                     {select_orderstatus}
                                    </label></td>
                                  </tr>
                                  <tr>
                                    <td align="center">{select_ba}</td>
                                  </tr>
                                  <tr>
                                    <td align="center">{products}</td>
                                  </tr>
                              </table></td>
                            </tr>

                            <tr>
                              <td align="left">
							  <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td align="center"> <input name="reportsearch" type="submit" class="formbutton" id="button" value=" Search "  />&nbsp;<input name="reset" type="button" class="formbutton" id="button" value=" Reset " onclick="redirect('reports.php')"  /></td>
                                   </tr>
                                  
                              </table>
							  
							 </td>
                            </tr>
                          </table></td>
                          </tr>
                        
                        
                      </table></form></td>
                    </tr>
                    <tr>
                      <td valign="top" align="left"><img src="{theme}images/sfleftbottom.jpg" alt="" width="280" height="10" /></td>
                    </tr>
                </table>
				</ZONE reportsearch enabled>
				<ZONE deliverydatesearch enabled>                    
                   
				<table width="280" border="0" cellspacing="0" cellpadding="0" style="padding-top:5px;">
                    <tr>
                      <td align="left"><img src="{theme}images/deliverydate.jpg" alt="" width="280" height="38" /></td>
                    </tr>
                    <tr>
                      <td valign="top" class="sfleftmiddle">
					  <form action="" method="get">
					  <table width="100%" border="0" cellspacing="8" cellpadding="0">
                        <tr>
                          <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><table width="100" border="0" align="center" cellpadding="3" cellspacing="9">
                                  <tr>
                                    <td width="17%" class="formtext">From:</td>
                                    <td width="22%"><label>
                                      <input name="from" type="text" class="date-pick"  id="deliveryfromdate" value="{from}" />
                                    </label></td>
                                    <td width="10%" class="formtext">To:</td>
                                    <td width="40%"><input name="to" type="text" id="deliverytodate" class="date-pick" value="{to}" /></td>
                                </tr>
                              </table></td>
                            </tr>
                            

                            <tr>
                              <td align="left">
							  <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td align="center"> <input name="deliverydatesearch" type="submit" class="formbutton" id="button" value=" Search "  />&nbsp;<input name="reset" type="button" class="formbutton" id="button" value=" Reset " onclick="redirect('reports.php')"  /></td>
                                  </tr>
                                  
                              </table>
							  
							 </td>
                            </tr>
                          </table></td>
                          </tr>
                        
                        
                      </table></form></td>
                    </tr>
                    <tr>
                      <td valign="top" align="left"><img src="{theme}images/sfleftbottom.jpg" alt="" width="280" height="10" /></td>
                    </tr>
                </table>
				 </ZONE deliverydatesearch enabled>
				</td>
                <td valign="top"><table width="690" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td valign="middle" class="sfrighttop"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                        <tr>
                          <td width="24%" align="left" class="formtitlebgno">Reports</td>
                          <td width="36%" class="formtext">Total Orders: <span class="blacktextnormal">{totalorders} ({prdcnt} products)</span></td>
                          <td width="32%"><span class="formtext">Total Amount: <span class="blacktextnormal">{ordertotalsum}</span></span></td>
                          <td width="18%" align="right">
						     <zone export enabled>
                              <a href="#" class="reportsearch" style="text-decoration:none" target="_self">
                              <input name="button2" type="reset" class="formbutton" id="button2" value=" Export to Excel "/>  </a> 
							   </zone export enabled>
                           <input type="hidden" name="qry" id="qry" value="{qry}" />
 						  </td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td class="sfrightmiddle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="sland">&nbsp;</td>
                        </tr>
                      </table>
                      <table width="690" border="0" cellspacing="8" cellpadding="0">
                          <tr>
                            <td> 
							
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr class="glassyhead">
                                    <td class="columnborder" width="8%">Sl No&nbsp;</td> 
                                    <td class="columnborder">Order No</td>								 
                                    <td class="columnborder">Product Name</td>
                                    <td class="columnborder">Product Code</td>
									<td class="columnborder">Value</td>
                                    <td class="columnborder" width="16%" align="left">Delivery Date&nbsp;</td>                                    
                                 </tr>
                                  <LOOP orders>  
								  <tr class="columnrow{class}">
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{slno}</td>
                                        </tr>
                                    </table></td>
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{order_no}</td>
                                        </tr>
                                    </table></td>
									 
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
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
                                          <td class="formtext" align="right">{value}</td>
                                        </tr>
                                    </table></td>
                                    
                                           <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{delivery_date}</td>
                                        </tr>
                                    </table></td>
                                     
                                  </tr>
                                  </LOOP orders>  
                                  <zone noorders enabled>
								   <tr class="columnrowone">
                                     <td class="columnborder" colspan="7">
                                     <table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext" align="center">No results available</td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                 </zone noorders enabled> 
                              </table>
							
							</td>
                          </tr>
                          <tr>
                            <td align="right" class="whitedarktext">
							 <table width="100%" border="0" cellspacing="5" cellpadding="0">
                        		 <tr><td align="left" class="">{total} Result(s)</td>
                        		   <td align="right" class="">{split_results}</td>
                      	  </tr>
                   		 </table>
						</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td valign="top"><img src="{theme}images/sfrightbottom.jpg" alt="" width="690" height="10" /></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table>