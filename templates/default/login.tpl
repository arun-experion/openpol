<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Terumo Penpol: Login</title>
<link href="{theme}css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
</head>
<body>
<form action="" method="post" name="login" id="login" >
<input type="hidden" name="actions" id="actions" value="login" />

<table width="801" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="{theme}images/logintop.jpg" alt="" width="801" height="80" /></td>
        </tr>
        <tr>
          <td valign="top" class="logincentral"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="loginwidth">&nbsp;</td>
              <td><table width="100%" border="0" cellpadding="0" cellspacing="5" id="loginfeilds">
                <tr>
                  <td width="781"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="2%"><img src="{theme}images/lock.jpg" alt="" width="17" height="15" /></td>
                        <td width="98%" valign="bottom" class="login">Login</td>
                      </tr>
                  </table></td>
                </tr>
				 <ZONE loginerror enabled>
                        <tr>
                		  <td class="error">{error}</td>
                        </tr>
                 </ZONE loginerror enabled>
                 <tr>
                  <td class="forgotpassword"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="loginboxholder">
                      <tr>
                        <td valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td class="smalltext">&nbsp;</td>
                            </tr>
                            <tr>
                              <td><table width="100%" border="0" cellspacing="3" cellpadding="0">
                                  <tr>
                                    <td width="37%" align="right" valign="middle" class="greytext">Username :</td>
                                    <td width="63%"><label>
                                        <input name="username" type="text" class="logintextfileds" id="username" />
                                    </label></td>
                                  </tr>
                                  <tr>
                                    <td align="right" valign="middle" class="greytext">Password :</td>
                                    <td><input name="password" type="password" class="logintextfileds" id="textfield2" /></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td align="left"><label>
                                      <input name="button" type="submit" class="formbutton" id="button" value=" Submit "/>
                                    </label></td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td class="forgotpassword"><a href="#" id="forgotpass">Forgot password?</a></td>
                </tr>
              </table>
			  
			<!--  Forgotpass-->
			  
			  <table width="100%" border="0" cellpadding="0" cellspacing="5" id="passwordforgot">
                <tr>
                  <td width="781"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="2%"><img src="{theme}images/forgot.jpg" alt="" width="17" height="15" /></td>
                        <td width="98%" valign="bottom" class="login">Forgot Password</td>
                      </tr>
                  </table></td>
                </tr>
				 <ZONE forgoterror enabled>
                        <tr>
                		  <td class="error">{ferror}</td>
                        </tr>
                 </ZONE forgoterror enabled>
				  <ZONE forgoterror disabled>
                        <tr>
                		  <td class="successmessage">Password reset successful. </td>
                        </tr>
                 </ZONE forgoterror disabled>
                 <tr>
                  <td class="forgotpassword"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="loginboxholder">
                      <tr>
                        <td valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td class="smalltext">&nbsp;</td>
                            </tr>
                            <tr>
                              <td><table width="100%" border="0" cellspacing="3" cellpadding="0">
                                  <tr>                                  
                                    <td width="63%" valign="middle" class="forgotpasswordtext" colspan="2"><label>
                                     Please enter your email id for sending the new password.
                                    </label></td>
                                  </tr>
                                  <tr>
                                    <td align="right" valign="middle" class="greytext" width="37%">Email :</td>
                                    <td width="63%"><input name="email" type="text" class="logintextfileds" id="email" /></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td align="left"><label>
                                      <input name="button" type="submit" class="formbutton" id="button" value=" Submit "/>
                                    </label></td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td class="forgotpassword"><a href="#" id="loginlink">Login?</a></td>
                </tr>
              </table>
			  
			  
			  </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td valign="top" class="loginboot"><table width="100%" border="0" cellspacing="8" cellpadding="0">
              <tr>
                <td class="copyright">&copy; Copyright 2010 Terumo Penpol. All rights reserved.</td>
                <td align="right"><span class="poweredby">Powered by</span> <a href="http://www.experionglobal.com/" target="_blank" class="copyright">Experion Technologies</a></td>
              </tr>
            </table></td>
        </tr>
    </table></td>
  </tr>
</table>
</form>
 </body>
</html>