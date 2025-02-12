<div id="pageloader">
	<img src="templates/default/images/loader.gif" alt="processing">
</div>
<table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table width="1100" border="0" cellpadding="0" cellspacing="0" class="formborder">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="formtitlebg">Orders</td>
                            </tr>
                            <tr>
                              <td align="left" valign="middle" class="glassyhead">Refine your search</td>
                            </tr>
							<form action="" method="get">
                            <tr>
                              <td class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                  <td align="center"><table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                                        <tr>
                                          <td align="right" class="formtext">Order No :</td>
                                          <td align="left"><label>
                                            <input name="q" type="text" class="" id="name" value="{name}" size="20" />
                                          </label></td>
                                          
										 <td align="right" class="formtext">Category :</td>
                                          <td align="left">
                                          {select_producttype}
                                          </td>	
										  <!-- <td align="right" class="formtext">Status :</td>
                                          <td align="left">{select_status}</td> -->
                                         
                                        </tr>
                                        <tr>
										<td align="right" class="formtext">From :</td>
                                          <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td width="48%" class="smaaltextfieldholder"><label>
                                                <input name="from" type="text" class="date-pick"  id="fromdate" value="{from}" />
                                               
                                              </label></td>
                                              <td width="52%" align="left">
                                              <!--<img src="{theme}images/calendar.jpg" alt="" width="23" height="23" />--></td>
                                            </tr>
                                          </table></td>
										  
                                         
                                          <td align="right" class="formtext">To :</td>
                                          <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td width="48%" class="smaaltextfieldholder"><label>
                                                <input name="to" type="text" class="date-pick" id="todate" value="{to}" />
                                              </label></td>
                                              <td width="52%" align="left">
                                              <!--<img src="{theme}images/calendar.jpg" alt="" width="23" height="23" />--></td>
                                            </tr>
                                          </table></td>
                                        </tr>
																				
										  <tr>
                      <zone balist enabled>		
										    <td align="right" class="formtext">Bussiness Associate :</td>
                                            
                          <td>
                            <div id="categorylist" class="categorylist">
                                <input type="hidden" name="ba" id="ba" value="{ba}"/>
                                <div class="searchcontainer">
                                    <input type="text" id="live_searchcategory" class="live_searchcategory" data-next="1" autocomplete="off">
                                    <div class="search_result_erp" id="category_result" style="display: none;">
                                    </div>
                                </div>
                            </div>
                          </td>
                        </zone balist enabled>		

                          <td align="right" class="formtext">Export Status :</td>
                          <td align="left">
                            {ex_status}  
                          </td>									   
                      </tr>
                                        
										
                                    </table></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td class="formboot"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td width="49%" align="right" valign="top"><label>
                                      <input name="submit" type="submit" class="formbutton" id="button1" value=" Search " />
                                    </label></td>
                                    <td width="51%" align="left" valign="top"><input name="reset" type="button" class="formbutton" id="button2" value=" Reset " onclick="redirect('list_erp_orders.php')" /></td>
                                  </tr>
                              </table></td>
                            </tr></form>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="center"><table width="1100" border="0" cellpadding="0" cellspacing="0" class="formborder">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="secondformhead"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr><td class="successmessage">{message}</td>
                              <td align="right">
                              <zone export enabled>
                              <a href="javascript:void(0)" class="orderreport" style="text-decoration:none" target="_self">
                              <input name="button2" type="reset" class="formbutton" id="button2" value=" Export to CSV "/>  </a>
                               
                          </zone export enabled> <input type="hidden" name="qry" id="qry" value="{qry}" />
                              </td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr class="glassyhead">
                                    <td class="columnborder">Sl No</td> 
                                    <td class="columnborder">Order No</td>
                                    
									                  <zone ba enabled>
                                      <td class="columnborder">Business Associate</td>
									                  </zone ba enabled>
                                    <td class="columnborder">ERP Number</td>
                                    <td class="columnborder">Product Code</td>
                                    <td class="columnborder">Qty</td>
                                    <td class="columnborder">Rate</td>
                                    <td class="columnborder">Business Unit</td>
                                    <td class="columnborder">Order Date</td>
                                    <td class="columnborder">Status</td>
                                    <td class="columnborder">Last Exported By</td>
                                    
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
                                    
									<zone ba enabled>
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{fname}</td>
                                        </tr>
                                    </table></td>
									</zone ba enabled>
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{erp_number}</td>
                                        </tr>
                                    </table></td>
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{code}</td>
                                        </tr>
                                    </table></td>
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{quantity}</td>
                                        </tr>
                                    </table></td>
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{rate}</td>
                                        </tr>
                                    </table></td>
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{category_name}</td>
                                        </tr>
                                    </table></td>
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{order_date}</td>
                                        </tr>
                                    </table></td>
                                     
                                    
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{exportstatus}</td>
                                        </tr>
                                    </table></td>

                                    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{exported_by}</td>
                                        </tr>
                                    </table></td>
          
                                  </tr>
                                  </LOOP orders>  
                                  <zone noorders enabled>
								   <tr class="columnrowone">
                                     <td class="columnborder" colspan="11">
                                     <table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext" align="center">No results available</td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                 </zone noorders enabled> 
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                    </table>
                      <table width="1000" border="0" cellspacing="5" cellpadding="0">
                         <tr><td align="left" class="whitetext">{total} Result(s)</td>
                           <td align="right" class="whitetext">{split_results}</td>
                        </tr>
                    </table></td>
                </tr>
            </table></td>
          </tr>
        </table>