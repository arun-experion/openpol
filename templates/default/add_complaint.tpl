<form action="" method="post" name="form2" id="form2"  class="cmxform" enctype="multipart/form-data">
<input type="hidden" name="proname" id="prodname" value="{prodname}" /> 
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
                              <td valign="middle" class="ordernumber">
                              <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td width="21%" align="right" class="formtext"><div align="left">FR-MKT-18/D</div></td>
                                </tr>
                              </table>
                              </td>

                            </tr>
                            <tr>
                              <td align="left" valign="middle" class="sland">&nbsp;</td>
                            </tr>
							  <ZONE error enabled>
				    <tr>
                    <td class="error">Required field missing:<br /><br />
									  {error.custname}
									  {error.custcontact}
									  {error.batchno}
									  {error.dateofincident}
									  {error.mfgdate}
									  {error.numberofdefective}
									   {error.complaintdesc}
									   {error.product}
									   {error.service_engineers}
									   {error.file_error}
									  
									   
									 
					</td>
                  </tr>
				 </ZONE error enabled> 
                            <tr>
                              <td class="formcolour"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="5">
                                      <tr>
                                        <td width="223" align="right" class="formtext">Customer Name :</td>
                                        <td width="231" align="left"><label>
                                          <input name="custname" type="text" id="custname" class="formtextfileds" value="{custname}"/>
                                        </label></td>
                                        <td width="138" align="right" class="formtext">Customer Contact :</td>
                                        <td width="264" align="left"><input name="custcontact" type="text" class="formtextfileds" id="custcontact" value="{custcontact}" /></td>
                                      </tr>
                                      <tr>
                                        <td align="right" class="formtext">Batch No :</td>
                                        <td align="left"><input name="batchno" type="text" class="formtextfileds" id="batchno" value="{batchno}" /></td>
                                        <td align="right" class="formtext" width="17%">Sterilization Load No :</td>
                                        <td align="left">  <input name="sterilization" type="text" class="formtextfileds" id="sterilization" value="{sterilization}" /> </td>
                                      </tr>
                                      <tr>
                                        <td align="right" class="formtext">Mfg. Date :</td>
                                        <td align="left"><input name="mfgdate" type="text" class="formtextfileds" id="mfgdate" value="{mfgdate}" /></td>
                                        <td align="right" class="formtext">Date of Incident :</td>
                                        <td align="left">   <input name="dateofincident" type="text" class="formtextfileds" id="dateofincident" value="{dateofincident}" /></td>
                                      </tr>
                                      <tr>
                                        <td align="right" class="formtext">Product Type :</td>
                                        <td align="left">{select_producttype}</td>
                                        <td align="right" class="formtext">Product :</td>
                                        <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td class="smaaltextfieldholder" id="productname"> </td>
                                            
                                          </tr>
                                        </table></td>
                                      </tr>
                                      <tr>
									 	 <td align="right" class="formtext">Number of Defects :</td>
                                          <td align="left"><input name="numberofdefective" type="text" class="formtextfileds" id="numberofdefective" value="{numberofdefective}" /></td>
                                        <td align="right" class="formtext">TPL Contact Person :</td>
                                        <td align="left">{select_engineers}</td>
                                        
                                      </tr>
                                      <tr>
                                        <td align="right" class="formtext"> Complaint Description :</td>
                                        <td colspan="3" align="left"><label>
                                          <textarea name="complaintdesc" cols="45" rows="5" class="textareasmall" id="complaintdesc">{complaintdesc}</textarea>
                                        </label></td>
                                      </tr>
                                      <tr>
                                        <td align="right" class="formtext">Upload Defect pictures :</td>
                                        <td colspan="3" align="left">
 										<table width="57%" border="0" cellspacing="0" cellpadding="0">
                                            <tr >
                                              <td>
											  <span id="picfirst"><input type="file" name="defectpicture[]" id="defectpicture0" class="selectfile"/></span>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="formtext" onclick="resetfn('picfirst')">Reset</a>
                                    <div style="float:right">   <input name="button2" type="button" class="formbutton" id="addnewpic" value=" Add New " />  </div>
									   		  </td>
                                            </tr>
											<tr id="pic0"> </tr>
                                        </table>
 										</td>
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
                                      <td width="420" align="left">{select_defect}</td>
                                    </tr>
                                    <tr id="leaktr">
                                      <td align="right" class="formtext">Leak :</td>
                                      <td align="left">{select_leak}</td>
                                    </tr>
                                    <tr id="kinktr">
                                      <td align="right" class="formtext">Tube Kink :</td>
                                      <td align="left">{select_tubekink}</td>
                                    </tr>
                                    <tr id="microbialtr">
                                      <td align="right" class="formtext">Microbial Contamination :</td>
                                      <td align="left">{select_microbial}</td>
                                    </tr>
                                    <tr id="rupturetr">
                                      <td align="right" class="formtext">Sheet Rupture During Centrifugation</td>
                                      <td align="left">{select_sheetrupture}</td>
                                    </tr>
                                  </table>
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td class="formboot"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                          <tr>
                                            <td width="49%" align="right" valign="top"><label>
                                              <input name="addcomplaint" type="submit" class="formbutton" id="addcomplaint" value=" Submit "/>
                                            </label></td>
                                            <td width="51%" align="left" valign="top"><input name="button4" type="button" class="formbutton" id="button6" value=" Cancel " onclick="redirect('complaints.php')" /></td>
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
            </table></td>
          </tr>
        </table>
</form>