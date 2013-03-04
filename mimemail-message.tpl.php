<?php
/**
 * @file
 * Default theme implementation to format an HTML mail.
 *
 * Copy this file in your default theme folder to create a custom themed mail.
 * Rename it to mimemail-message--[mailkey].tpl.php to override it for a
 * specific mail.
 *
 * Available variables:
 * - $subject: The message subject.
 * - $body: The message body in HTML format.
 * - $mailkey: The message identifier.
 * - $recipient: An email address or user object who is receiving the message.
 * - $css: Internal style sheets.
 *
 * @see template_preprocess_mimemail_message()
 */
global $base_url;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title><?php print $subject ?></title>
  <style type="text/css">
  /* Client-specific Styles */
  #outlook a {padding: 0;}  /* Force Outlook to provide a "view in browser" button. */
  body {width: 100% !important;}
  .ReadMsgBody {width: 100%;}
  .ExternalClass {width: 100%;}  /* Force Hotmail to display emails at full width */
  body {  -webkit-text-size-adjust: none;}  /* Prevent Webkit platforms from changing default text sizes. */
  /* Reset Styles */
  body {margin: 0;padding: 0;}
  img {border: 0;height: auto;line-height: 100%;outline: none;text-decoration: none;}
  table td {border-collapse: collapse;}
  </style>
</head>
<body style="color: #666666;font-family: Arial, Helvetica, 'Nimbus Sans L', sans-serif;font-size: 14px;">
<center>
<table border="0" cellpadding="0" cellspacing="0" width="100%" id="wrapper">
  <tr>
    <td align="center" valign="top">
      <table border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #DDDDDD;background-color: #FFFFFF;">
        <tr>
          <td align="center" valign="top">
            <table border="0" cellpadding="20" cellspacing="0" width="600" style="background-color: #008ac9; border-bottom: 4px solid #00a1fe;">
          <tr>
          <td class="logo">
            <?php if ($logo): ?>
               <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
            <?php endif; ?>
          </td>
          <td class="headercontent"></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="center" valign="top">
      <table border="0" cellpadding="20" cellspacing="0" width="600" id="content">
        <tr>
          <td valign="top" style="color: #666666;"><?php print $body; ?></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="center" valign="top">
      <table border="0" cellpadding="20" cellspacing="0" width="600" style="background-color: #00538b;border-top: 4px solid #00a1fe;color: #FFFFFF;">
        <tr>
          <td valign="top">
            <a href="/home" style="color: #FFFFFF;">Club de excelencia de gestión</a> | <a href="/groups" style="color: #FFFFFF;">Comunidad</a>
          </td>
          <td align="right">
            <a href="http://www.nivaria.com" title="Nivaria"><img src="<?php print $base_url . '/'. path_to_theme();?>/images/nws_by_nivaria.png" alt="Nivaria" /></a>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
  </td>
  </tr>
</table>
</center>
</body>
</html>