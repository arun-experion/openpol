<table width="100%" border="0" cellspacing="20" cellpadding="0">
          <tr>
            <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td align="left" valign="middle" class="formtitlebg">Brochures</td>
                            </tr>
                            <tr>
                              <td align="left" valign="middle" class="sland">&nbsp;</td>
                            </tr>
                               <tr>
                              <td align="left" valign="middle" class="greybox">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>
                                  
                                  <form name="searchfile" method="post">
                                  
                                  <table width="100%" border="0" cellspacing="15" cellpadding="0">
                                
                                    <tr>
                                      <td  align="right">
                                      <input name="searchvalue" type="text" class="formtextfileds" id="textfield4" value="" />
                                     
                                      <input name="searchfile" type="submit" class="formbutton" id="searchfile" value=" Search " />
                                    </td><td>&nbsp;</td></tr>
                                 
                                  </table>
                                  
                                  </form>
                                  
                                  </td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td class="formcolour">
                              
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr class="glassyhead">
							 <td class="columnborder" width="8%">Sl No</td>
                              <td class="columnborder" width="15%">Name</td>    
                              <td class="columnborder" width="55%"> Description</td>    
							   <td class="columnborder" width="14%" align="left">Uploaded Date</td>                             
                              <td class="columnborder"  width="10%" >Action</td>
                            </tr>
                            
                            <zone showlist enabled>
							 <LOOP brochures>
                                <tr class="columnrow{class}">
                             <td class="columnborder" ><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext">{slno}</td>
                                </tr>
                              </table></td> 
                              <td class="columnborder" ><table width="100%" border="0" cellspacing="10" cellpadding="0">
                              <tr>
                                  <td class="formtext">{name}</td>
                                </tr>
                              </table></td> 
                              <td class="columnborder" ><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                
                                <tr>
                                  <td class="formtext">{description}</td>
                                </tr>
                              </table></td> 
							   <td class="columnborder" ><table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                  <td class="formtext">{uploaded_date}</td>
                                </tr>
                              </table></td> 
							  <td class="columnborder" align="center"><a href="#" class="download"  id="{path}" target="_self" >
                   <img src="{theme}images/download.png"  border="0"/></a>  </td>						 
                            </tr>
                      
                             </LOOP brochures>
							 </zone showlist enabled>
                          </table>
                              </td>
                            </tr>
                        </table></td>
                      </tr>
                  </table>
                    <table width="907" border="0" cellspacing="5" cellpadding="0">
                        <tr><td width="60%" class="whitetext" align="left">{total} Result(s)</td>
                      <td align="right" class="whitetext">{split_results}</td>
                    </table></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="center">
                  <zone upload enabled> 
                 <form name="upload"  action="" id="upload" method="post" enctype="multipart/form-data" >
                  <table width="907" border="0" cellpadding="0" cellspacing="0" class="formborder">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="secondformhead">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td align="left" class="glassyhead">Upload Brochure</td>
                                  
                                </tr>
                              </table>
                                <table width="100%" border="0" cellspacing="10" cellpadding="0">
                                
                                <tr><td align="center" class="successmessage">{message} </td> </tr>
                              <ZONE error enabled>             
                                <tr>
                                <td class="error">Required field missing:<br /><br />
                                                  {error.brochure_name}
                                                  {error.brochure_description}
                                                  {error.file}
                                                  {error.nofile}
                                                  {error.file_duplicate}
                                                  {error.file_extension}
                                                
                                </td>
                              </tr>
                             </ZONE error enabled>
                             <tr>
                                    <td align="center" valign="middle" class="formcolour"><table width="700" border="0" align="center" cellpadding="0" cellspacing="5">
                                      <tr>
                                        <td width="234" align="right" class="formtext">Brochure Name :</td>
                                        <td width="451" align="left"><label>
                                          <input name="brochure_name" type="text" class="formtextfileds" id="name" value="{brochure_name}" />
                                        </label></td>
                                        </tr> <tr>
                                        <td align="right" class="formtext">Description :</td>
                                        <td align="left"><label>
                                        <textarea name="brochure_description" cols="45" rows="5" class="textareasmall" id="description">{brochure_description}</textarea>
                                        </label></td>
                                        </tr>
                                        <tr>
                                          <td align="right" class="formtext">&nbsp;</td>
                                          <td align="left"><table width="330" border="0" align="left" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td width="186" valign="top"><label>
                                                <input name="uploadfile" type="file" class="formtextfileds" id="uploadfile" />
                                              </label></td>
                                              <td width="72" align="left" valign="top"><label>
                                                                                   </label></td>
                                              <td width="72" align="left" valign="top">&nbsp;</td>
                                            </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td align="right" class="formtext">&nbsp;</td>
                                          <td align="left">
                          <input type="hidden" name="action" value="upload"  />
                          <input name="uploadbrochure" type="submit" class="formbutton" id="uploadbrochure" value=" Submit " /></td>
                                        </tr>

                                    </table>
                                      </td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                    </table>
                    </form>
                    </zone upload enabled> 
                      </td>
                </tr>
            </table></td>
          </tr>
        </table>