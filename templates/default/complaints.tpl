
<zone complaintlist enabled>
  <table width="100%" border="0" cellspacing="20" cellpadding="0">
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                <tr>
                  <td><form action="" method="get">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td valign="middle" class="formtitlebg">Complaints</td>
                        </tr>
                        <tr>
                          <td align="left" valign="middle" class="glassyhead">Refine your search</td>
                        </tr>
                        <tr>
                          <td class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                              <tr>
                                <td align="center"><table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                                    <tr>
                                      <td align="right" class="formtext">Search Customer  :</td>
                                      <td align="left"><label>
                                        <input name="q" type="text" class="formtextfileds" id="custname" value="{custname}" />
                                        </label></td>
                                      <td align="right" class="formtext">From :</td>
                                      <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="48%" class="smaaltextfieldholder"><label>
                                              <input name="from" type="text" class="date-pick" id="fromdate" value="{from}" />
                                              </label></td>
                                            <td width="52%" align="left"><!--<img src="images/calendar.jpg" alt="" width="23" height="23" />--></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                    <tr>
                                      <td align="right" class="formtext">FIR No :</td>
                                      <td align="left"><input name="firno" type="text" class="formtextfileds" id="firno" /></td>
                                      <td align="right" class="formtext">To :</td>
                                      <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="48%" class="smaaltextfieldholder"><label>
                                              <input name="to" type="text" class="date-pick" id="todate" value="{to}" />
                                              </label></td>
                                            <td width="52%" align="left"><!--<img src="images/calendar.jpg" alt="" width="23" height="23" />--></td>
                                          </tr>
                                        </table></td>
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
                                <td width="51%" align="left" valign="top"><input name="button2" type="button" class="formbutton" id="button2" value=" Reset " onclick="redirect('complaints.php')" /></td>
                              </tr>
                            </table></td>
                        </tr>
                      </table>
                    </form></td>
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
                        <td valign="middle" class="secondformhead">
						 <zone addcomplaint enabled>
						<table width="100%" border="0" cellspacing="10" cellpadding="0">
                            <tr>
							 <td class="successmessage">{message}</td>
                              <td align="right"><input name="button4" type="submit" class="formbutton" id="button5" value=" Add New " onclick="redirect('add_complaint.php')" /></td>
                            </tr>
                          </table>
						  </zone addcomplaint enabled> 
						  </td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class="glassyhead">
                              <td width="6%" class="columnborder">Sl No</td>
                              <td width="25%" class="columnborder">FIR No</td>
                              <td width="22%" class="columnborder">Customer Name</td>
                              <td width="12%" class="columnborder">Date</td>
                              <td width="14%" class="columnborder">TPL Person</td>
                              <td width="14%" class="columnborder">Created By</td>
                              <td width="9%" class="columnborder">&nbsp;</td>
                            </tr>
                            <zone showlist enabled>
                              <LOOP complaints>
                                <tr class="columnrow{class}">
                                  <td align="center" class="columnborder"><table border="0" cellspacing="5" cellpadding="0">
                                      <tr>
                                        <td class="formtext">{slno}</td>
                                      </tr>
                                    </table></td>
                                  <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                      <tr>
                                        <td class="formtext">{fir_no}</td>
                                      </tr>
                                    </table></td>
                                  <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                      <tr>
                                        <td class="formtext">{customer_name}</td>
                                      </tr>
                                    </table></td>
                                  <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                      <tr>
                                        <td class="formtext">{created_date}</td>
                                      </tr>
                                    </table></td>
                                  <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                      <tr>
                                        <td class="formtext">{service_engineer}</td>
                                      </tr>
                                    </table></td>
                                  <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                      <tr>
                                        <td class="formtext">{createdby}</td>
                                      </tr>
                                    </table></td>
                                  <td class="columnborder"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                      <tr>
                                        <td align="center"><span class="details"><a href="complaints.php?id={id}">Details</a></span></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </LOOP complaints>
                            </zone showlist enabled>
                            <zone noresults enabled>
                              <tr class="columnrowone">
                                <td class="columnborder" colspan="7"><table width="100%" border="0" cellspacing="10" cellpadding="0">
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
                <tr>
                  <td align="left" class="whitetext">{total} Result(s)</td>
                  <td align="right" class="whitetext">{split_results}</td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</zone complaintlist enabled>
<zone viewcomplaint enabled>
  <table width="100%" border="0" cellspacing="20" cellpadding="0">
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td valign="middle" class="formtitlebg">Quality Complaint Report</td>
                      </tr>
                      <tr>
                        <td valign="middle" class="ordernumber"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                            <tr>
                              <td width="21%" align="right" class="formtext"><div align="left">FR-MKT-18/D</div></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle" class="sland">&nbsp;</td>
                      </tr>
                      <ZONE success enabled>
                        <tr>
                          <td valign="middle" class="secondformhead"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="complaintsuccess">{message}</td>
                              </tr>
                            </table></td>
                        </tr>
                      </ZONE success enabled>
                      <ZONE error enabled>
                        <tr>
                          <td class="error">Required field missing:<br />
                            <br />
                            {error.status} 
							{error.file_extension}
							{error.file}</td>
                        </tr>
                      </ZONE error enabled>
                      <tr>
                        <td class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                            <tr>
                              <td align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="5">
                                  <tr>
                                    <td width="223" align="right" class="formtext">Customer Name :</td>
                                    <td width="231" align="left" class="blacktextnormal"><label> {customer_name} </label></td>
                                    <td width="238" align="right" class="formtext">Customer Contact :</td>
                                    <td width="264" align="left" class="blacktextnormal">{customer_contact}</td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="formtext">Batch No :</td>
                                    <td align="left" class="blacktextnormal">{batch_no}</td>
                                    <td align="right" class="formtext">Sterilization Load No :</td>
                                    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td  class="blacktextnormal"><label> {sterilization_load_no} </label></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="formtext">Mfg. Date :</td>
                                    <td align="left" class="blacktextnormal">{mfg_date}</td>
                                    <td align="right" class="formtext">Date of Incident :</td>
                                    <td align="left" class="blacktextnormal"> {dateofincident}</td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="formtext" valign="top">Product :</td>
                                    <td align="left" class="blacktextnormal">{product}</td>
                                    <td align="right" class="formtext">TPL Contact Person :</td>
                                    <td align="left" class="blacktextnormal"> {tplperson}</td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="formtext">Number of Defects :</td>
                                    <td align="left" class="blacktextnormal">{defective_no}</td>
                                    <td align="right" class="formtext">&nbsp;</td>
                                    <td align="left" class="blacktextnormal">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="formtext" valign="top"> Complaint Description :</td>
                                    <td colspan="3" align="left" class="blacktextnormal"><label> {description} </label></td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="formtext" valign="top">Defect pictures :</td>
                                    <td colspan="3" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td> {picturelinks} </td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table>
                          <table width="100%" border="0" cellpadding="0" cellspacing="10" class="subheadinginner">
                            <tr>
                              <td align="left">Complaint Categorization</td>
                            </tr>
                          </table>
                          <table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                            <tr>
                              <td width="265" align="right" class="formtext">Defect Noticed :</td>
                              <td width="420" align="left" class="blacktextnormal">{defect_noticed}</td>
                            </tr>
                            <tr id="leaktr">
                              <td align="right" class="formtext">Leak :</td>
                              <td align="left" class="blacktextnormal">{leak}</td>
                            </tr>
                            <tr id="kinktr">
                              <td align="right" class="formtext">Tube Kink :</td>
                              <td align="left" class="blacktextnormal">{tubekink}</td>
                            </tr>
                            <tr id="microbialtr">
                              <td align="right" class="formtext">Microbial Contamination :</td>
                              <td align="left" class="blacktextnormal">{microbial_contamination}</td>
                            </tr>
                            <tr id="rupturetr">
                              <td align="right" class="formtext">Sheet Rupture During Centrifugation</td>
                              <td align="left" class="blacktextnormal">{sheet_rupture}</td>
                            </tr>
                          </table>
						   <ZONE qareport enabled>
						   <form action="" method="post" enctype="multipart/form-data">
						   <input type="hidden" name="uploadreport" value="1" />
						   <input type="hidden" value="{id}" name="cmpid" />
						     <table width="100%" border="0" cellpadding="0" cellspacing="10" bgcolor="#BCC4D7">
                            <tr>
                              <td align="left" class="subheadinginner">Upload Quality Analysis Document</td>
                            </tr>
                          </table>
						  <table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                            <tr>
                              <td width="265" align="right" class="formtext">Upload report:</td>
                              <td width="250" align="left" class="blacktextnormal"><input type="file" name="uploadfile" /></td>
							  <td align="left"><input name="button4" type="submit" class="formbutton" id="button5" value=" Upload " /></td>
                            </tr> 						                     
                          </table>
						  </form>
						  </ZONE qareport enabled>
						   <ZONE qareportdownload enabled>						  
					 <table width="100%" border="0" cellpadding="0" cellspacing="10" bgcolor="#BCC4D7">
                            <tr>
                              <td align="left" class="subheadinginner">Quality Reports uploaded</td>
                            </tr>
                          </table>
						   <table width="70%" border="0" align="center" cellpadding="0" cellspacing="10">
						     <LOOP qareports>
                            <tr>
                              <td width="265" align="left" class="formtext">{filename}</td><td class="formtext">{qaperson}</td> <td class="formtext">{updated_date} </td><td class="formtext"><a href="downloadfile.php?download_file={report_path}">Download</a> </td>                          
                            </tr> 	
							 </LOOP qareports>					                     
                          </table>
						  </ZONE qareportdownload enabled>  
                          <table width="100%" border="0" cellpadding="0" cellspacing="10" bgcolor="#BCC4D7">
                            <tr>
                              <td align="left" class="subheadinginner">Update Status</td>
                            </tr>
                          </table>
                          <table width="100%" border="0" cellpadding="0" cellspacing="20" bgcolor="#DCE0EB">
                            <tr>
                              <td class="leftborder"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr class="glassyhead">
                                    <td width="15%" class="columnborder">Date</td>
                                    <td width="40%" class="columnborder">Comment</td>
                                    <td width="32%" class="columnborder">Action Taken</td>
                                    <td width="10%" class="columnborder">Status</td>
                                  </tr>
                                  <LOOP complaintstatus>
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
                                            <td class="formtext">{cstatus}</td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                  </LOOP complaintstatus>
                                </table></td>
                            </tr>
                          </table>
                          <zone updatecomplaintstatus enabled>
                            <form action="" method="post">
                              <input type="hidden" name="cmpid" value="{id}" />
							  <input type="hidden" value="{ptype}" name="product_type" />
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="42%" class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                      <tr>
                                        <td align="right" class="formtext">Change Status</td>
                                      </tr>
                                    </table></td>
                                  <td width="58%" class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                      <tr>
                                        <td align="left"><label> {select_status} </label></td>
                                      </tr>
                                    </table></td>
                                </tr>
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
                                          <input name="submit" type="submit" class="formbutton" id="button" value="Submit" />
                                          </label></td>
                                        <td width="51%" align="left" valign="top"><input name="cancel" type="button" class="formbutton" id="button6" value="Cancel" onclick="redirect('complaints.php')" /></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table>
                            </form>
                          </zone updatecomplaintstatus enabled>
                          <zone updatecomplaintstatus disabled>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="formboot"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                    <tr>
                                      <td align="right" valign="top"><input name="button4" type="button" class="formbutton" id="button6" value=" Back to complaints " onclick="redirect('complaints.php')" /></td>
                                    </tr>
                                  </table></td>
                              </tr>
                            </table>
                          </zone updatecomplaintstatus disabled>
                        </td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
  </table>
</zone viewcomplaint enabled>
