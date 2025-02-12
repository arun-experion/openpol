<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Terumo Penpol: QC</title>
<link href="{theme}css/thickbox.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table  width="100%" border="0" cellspacing="0" cellpadding="0" class="formborder">
<tr>
  <td valign="middle" class="secondformhead">
  <zone upload enabled>
  <form action="qc.php" method="post" enctype="multipart/form-data" name="uploadform" id="uploadform">
  <table width="100%" border="0" cellspacing="10" cellpadding="0">
      <tr><td class="successmessage" id="message"> </td>
       <td align="right">
        <ul>
        <li id="example1">
           <div>
                <div id="uploadbutton" class="button"><img src="{theme}/images/qcreport.jpg" /></div>
            </div>
        </li>
        </ul> 
        </td><input type="hidden" name="order_id" id="order_id" value="{order_id}" />
        <input type="hidden" name="filetypes" value="{filetypes}" id="filetypes" />
         </tr>
          <tr> <td colspan="2" id="error_message">  </td></tr>
  </table></form>
   </zone upload enabled>
  </td>
</tr>
<tr>
  <td align="left" valign="middle">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="glassyhead">
        <td class="columnborder" width="10%">Sl No</td>
        <td class="columnborder" width="65%">File Name</td>
         <td class="columnborder" width="25%">Download</td>                                    
      </tr>
      <input type="hidden" name="file_count" id="file_count" value="{total}" />
      <tr class="columnrowone" id="file_0" >
      </tr>
      <LOOP files>  
      <tr class="columnrow{class}" id="file_{slno}" >
      
        <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
            <tr>
              <td class="formtext">{slno}</td>
            </tr>
        </table></td>
        <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
            <tr>
              <td class="formtext">{file_name}</td>
            </tr>
        </table></td>
         
        <td class="columnborder"><table width="100%" border="0" cellspacing="10" cellpadding="0">
            <tr>
              <td class="formtext">
              <a href="#" class="qcreport" id="{path}" target="_self" >Download
             </a>
             </td>
            </tr>
        </table></td>                                     
      </tr> 
  </LOOP files> 
     <tr class="columnrowone">
     <td class="columnborder" colspan="8" id="nofile">
      <table width="100%" border="0" cellspacing="10" cellpadding="0">
        <tr>
          <td class="formtext" align="center">No files available  </td>
        </tr>
      </table></td></tr>
      </table></td>
    </tr>
</table>
</body>
</html>
