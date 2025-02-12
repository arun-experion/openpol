<table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="formtitlebg">Installation Reports</td>
                            </tr>
							<form action="" method="get"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        
                        <tr>
                          <td align="left" valign="middle" class="glassyhead">Refine your search</td>
                        </tr>
                        <tr> 
                          <td class="formcolour">  <table width="100%" border="0" cellspacing="10" cellpadding="0">
                              <tr>
                                <td align="center"><table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                                    <tr>
                                      <td align="right" class="formtext">Product Name :</td>
                                      <td align="left"><label>
                                        <input name="pname" type="text" class="formtextfileds" id="textfield" value="{pname}" />
                                      </label></td>
                                      <td align="right" class="formtext">Order No</td>
                                      <td align="left">
                                      <input name="number" type="text" class="formtextfileds" id="textfield" value="{number}" />
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
                                  <input name="submit" type="submit" class="formbutton" id="button" value=" Search " />
                                </label></td>
                                <td width="51%" align="left" valign="top">
								<input name="reset" type="button" class="formbutton" id="button2" value=" Reset " onclick="redirect('list_installation_report.php')" /></td>
                              </tr>
                          </table></td>
                        </tr>
                    </table>

 
 </form>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
                 
                <tr>
                  <td align="center">
                  
                  <table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="secondformhead"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr><td class="successmessage">{message} </td>
                                    <td align="right"><input name="button4" type="button" class="formbutton" id="button5" value=" Add New " onclick="redirect('installation_report.php')"  /></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr class="glassyhead">
                                    <td class="columnborder" nowrap="nowrap">Sl No</td>
                                    <td class="columnborder">Order No</td>
								    <td class="columnborder">Product Name</td>
                                     <zone ba enabled>  
                                    <td class="columnborder">Business Associate</td>
                                    </zone ba enabled> 
									<td class="columnborder">Installation Date</td>
                                     <td class="columnborder">&nbsp;</td>
                                  </tr>
                                  <LOOP reports>  
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
                                    <zone ba enabled> 
                                      <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{ba_name}</td>
                                        </tr>
                                    </table></td>
                                    </zone ba enabled> 
                                    
								    <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext">{install_date}</td>
                                        </tr>
                                    </table></td>
                                  
                                    <td class="columnborder"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                        <tr>
                                          <td align="center">
                                          <span class="details"><a href="view_installation_report.php?id={id}">Details</a></span>
                                          </td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  </LOOP reports>  
                                  <zone noresults enabled>
								   <tr class="columnrowone">
                                     <td class="columnborder" colspan="6"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                        <tr>
                                          <td class="formtext" align="center" colspan="2">No results available</td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                 </zone noresults enabled> 
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                    </table>
                      <table width="907" border="0" cellspacing="5" cellpadding="0">
                         <tr><td align="left" class="whitetext">{total} Result(s)</td>
                           <td align="right" class="whitetext">{split_results}</td>
                        </tr>
                    </table></td>
                </tr>
            </table></td>
          </tr>
        </table>