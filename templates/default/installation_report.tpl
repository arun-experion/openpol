<form name="installation" id="installation" method="post" action="">
  <input type="hidden" name="productid" id="productid" value="{eqpmnt_id}" />
  <table width="100%" border="0" cellspacing="20" cellpadding="0">
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td valign="middle" class="formtitlebg">Installation Report</td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle" class="glassyhead">Installation Details</td>
                      </tr>
                      <tr>
                        <td class="formcolour"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                            <ZONE error enabled>
                              <tr>
                                <td class="error"><br />
                                  {error.order_no}
                                  {error.start_date}
                                  {error.end_date}
                                  {error.equipment_name}
                                  {error.name}
                                  {error.address}
                                  {error.contact_person}
                                  {error.tel_no}
                                  {error.date_range}
								  {error.notvalidemail}
                                 </td>
                              </tr>
                            </ZONE error enabled>
                            <tr> <td id="no_equipments" class="error" >  </td></tr>
                            <tr> <td id="on_proccessing" class="error" >  </td></tr>
                            <tr>
                              <td class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td width="18%" align="right" class="formtext">Order No :</td>
                                    <td width="32%" align="left"><input name="order_no" type="text" class="formtextfileds" id="order_no" value="{order_no}" /></td>
                                    <td width="16%" align="right" class="formtext">Order Date :</td>
                                    <td width="34%" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="132" class="smaaltextfieldholder"><label>
                                            <input name="order_date" type="text" class="formtextfiledsmall" id="order_date" value="{order_date}" />
                                            </label></td>
                                          <td width="165" align="left">&nbsp;</td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="formtext">Invoice No :</td>
                                    <td align="left"><input name="invoice_no" type="text" value="{invoice_no}" class="formtextfileds" id="textfield3" /></td>
                                    <td align="right" class="formtext">Invoice Date :</td>
                                    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="132" class="smaaltextfieldholder"><label>
                                            <input name="invoice_date" type="text" class="formtextfiledsmall" value="{invoice_date}" id="invoice_date" readonly="readonly" />
                                            </label></td>
                                          <td width="165" align="left">&nbsp;</td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="formtext"> Start Date :</td>
                                    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="48%" class="smaaltextfieldholder"><label>
                                            <input name="start_date" value="{start_date}" type="text" class="formtextfiledsmall" id="start_date" />
                                            </label></td>
                                          <td width="52%" align="left">&nbsp;</td>
                                        </tr>
                                      </table></td>
                                    <td align="right" class="formtext">Start Time :</td>
                                    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="20%" align="left"> {start_hour} </td>
                                          <td width="19%" align="left"> {start_minute} </td>
                                          <td width="61%" align="left"> {start_secs} </td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="formtext"> End Date :</td>
                                    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="48%" class="smaaltextfieldholder"><label>
                                            <input name="end_date" value="{end_date}" type="text" class="formtextfiledsmall" id="end_date" />
                                            </label></td>
                                          <td width="52%" align="left">&nbsp;</td>
                                        </tr>
                                      </table></td>
                                    <td align="right" class="formtext"> End Time :</td>
                                    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="20%" align="left"> {end_hour} </td>
                                          <td width="19%" align="left"> {end_minute} </td>
                                          <td width="61%" align="left"> {end_secs} </td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="formtext">Equipment Name :</td>
                                    <td align="left"><label>
                                      <div id="epmnt_list" style="width:180px;">
                                        <select name="eqpmnt_id" class="eqpmnt"  id="eqpmnt_id" style="width:180px ;">
                                          <option value="0">---Select---</option>
                                        </select>
                                      </div>
                                      </label></td>
                                    <td align="right" class="formtext">Serial No :</td>
                                    <td align="left"><input name="serial_no" value="{serial_no}"  type="text" class="formtextfileds" id="textfield13" /></td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="formtext">Model No :</td>
                                    <td align="left"><input name="model_no" type="text" value="{model_no}" class="formtextfileds" id="textfield11" /></td>
                                    <td align="right" class="formtext">Warranty Ends On :</td>
                                    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="132" class="smaaltextfieldholder"><label>
                                            <input name="warranty_date" type="text" class="formtextfiledsmall" value="{warranty_date}" id="warranty_date" />
                                            </label></td>
                                          <td width="165" align="left">&nbsp;</td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="formtext">Warranty No :</td>
                                    <td align="left"><input name="warranty_no" type="text" value="{warranty_no}" class="formtextfileds" id="textfield12" /></td>
                                    <td align="right" class="formtext">&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td align="right" class="formtext">Installation Summary :</td>
                                    <td colspan="3" align="left"><label>
                                      <textarea name="summary" cols="45" rows="5" class="textareabig" id="textarea3">{summary}</textarea>
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
                        <td align="left" valign="middle" class="glassyhead"> Customer Details</td>
                      </tr>
                      <tr>
                        <td class="formcolour"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="18%" class="rowtwo"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td align="right" class="formtext">Customer :</td>
                                  </tr>
                                </table></td>
                              <td width="33%" class="rowtwo"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td align="left"><input name="name" id="name" value="{name}" type="text" class="formtextfileds" id="textfield4" />
                                    </td>
                                  </tr>
                                </table></td>
                              <td width="14%" class="rowtwo"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td align="right" class="formtext">Email :</td>
                                  </tr>
                                </table></td>
                              <td width="35%" class="rowtwo"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td align="left"><input name="email" value="{email}" type="text" class="formtextfileds" id="textfield5" /></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td class="rowone"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td align="right" class="formtext">Customer Address :</td>
                                  </tr>
                                </table></td>
                              <td class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td align="left"><label>
                                      <textarea name="address"  cols="45" rows="5" class="textareasmall" id="address">
                                      {address}</textarea>
                                      </label></td>
                                  </tr>
                                </table></td>
                              <td class="rowone"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td align="right" class="formtext">Contact Person :</td>
                                  </tr>
                                </table></td>
                              <td class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td align="left"><label>
                                      <textarea name="contact_person" cols="45" rows="5" class="textareasmall" id="textarea2">{contact_person}</textarea>
                                      </label></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td class="rowtwo"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td align="right" class="formtext">Tel No :</td>
                                  </tr>
                                </table></td>
                              <td class="rowtwo"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td align="left"><input name="tel_no" value="{tel_no}" maxlength="16" type="text" class="formtextfileds" id="textfield6" /></td>
                                  </tr>
                                </table></td>
                              <td class="rowtwo"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td align="right" class="formtext">Fax No :</td>
                                  </tr>
                                </table></td>
                              <td class="rowtwo"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td align="left"><input name="fax" value="{fax}" type="text" class="formtextfileds" id="textfield7" /></td>
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
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="left" valign="middle" class="glassyhead">Training Report</td>
                      </tr>
                      <tr>
                        <td class="formcolour"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td class="greybox"><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                  <tr>
                                    <td align="left" class="formtext">Please tick the appropriate column</td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td width="5%" align="right" valign="bottom"><label>
                                      <input type="checkbox" name="trained_on_1" {checked1} value="Equipment Handling" id="checkbox" />
                                      </label>
                                    </td>
                                    <td width="18%" align="left" class="formtext">Equipment Handling</td>
                                    <td width="3%" align="right"><input type="checkbox" name="trained_on_2" {checked2}  value="Operation Equipment" id="checkbox3" /></td>
                                    <td width="19%" align="left" class="formtext">Operation Equipment</td>
                                    <td width="3%" align="right"><input type="checkbox" name="trained_on_3" {checked3}  value="Cleaning Operation" id="checkbox4" /></td>
                                    <td width="18%" align="left" class="formtext">Cleaning Operation</td>
                                    <td width="3%" align="right"><input type="checkbox"  name="trained_on_4"  {checked4}  value="Essential Preventive Maintanance" id="checkbox4" /></td>
                                    <td width="31%" align="left" class="formtext">Essential Preventive Maintenance</td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td class="rowtwo"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td width="39%" align="right" class="formtext"><label></label>
                                      Training Given To</td>
                                    <td width="3%" align="right"><label>
                                      <input type="radio" {trainee1} name="trained_to" id="radio" value="1" />
                                      </label>
                                    </td>
                                    <td width="6%" align="left" class="formtext">Doctor</td>
                                    <td width="3%" align="right"><input type="radio" {trainee2}  name="trained_to" id="radio2" value="2" /></td>
                                    <td width="49%" align="left" class="formtext">Bio Medical Dept/Technician</td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table>
                          <table width="100%" border="0" cellspacing="5" cellpadding="0">
                            <tr>
                              <td align="center"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td width="40%" align="right" class="formtext">Name :</td>
                                    <td width="60%" align="left"><input name="trained_name" value="{trained_name}" type="text" class="formtextfileds" id="textfield15" /></td>
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
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="left" valign="middle" class="glassyhead">Remarks</td>
                      </tr>
                      <tr>
                        <td class="formcolour"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td class="rowone"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td width="42%" align="right" class="formtext">Equipment is properly installed or demonstrated :</td>
                                    <td width="3%" align="right"><input type="radio" {remark1}  name="properly_installed" id="" value="1" /></td>
                                    <td width="15%" align="left" class="formtext">Yes</td>
                                    <td width="3%" align="right"><input type="radio"  {remark2}  name="properly_installed" id="" value="2" /></td>
                                    <td width="37%" align="left" class="formtext">No</td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td class="rowtwo"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td width="42%" align="right" class="formtext">Service rendered by Service Engineer / Technician :</td>
                                    <td width="3%" align="right"><input type="radio" {satisfaction1}  name="service_remark" id="radio3" value="1" /></td>
                                    <td width="15%" align="left" class="formtext">Satisfactory</td>
                                    <td width="3%" align="right"><input type="radio" {satisfaction2}  name="service_remark" id="radio4" value="2" /></td>
                                    <td width="37%" align="left" class="formtext">Not Satisfactory</td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table>
                          <table width="100%" border="0" cellspacing="5" cellpadding="0">
                            <tr>
                              <td align="center"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td width="41%" align="right" class="formtext">Any other details / suggestions :</td>
                                    <td width="59%" align="left"><label>
                                      <textarea name="suggestion" cols="45" rows="5" class="textareamedium" id="textarea4">{suggestion}</textarea>
                                      </label></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td class="formboot"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                                  <tr>
                                    <td width="49%" align="right" valign="top"><label>
                                      <input name="button" type="submit" class="formbutton" id="installation_report" value=" Submit " />
                                      </label></td>
                                    <td width="51%" align="left" valign="top"><input name="button" type="button" class="formbutton" id="button6" value=" Cancel " onclick="redirect('list_installation_report.php')" /></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
