<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Emailing Imprint SIGNS</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body bgcolor="#f9f8f8">
<div style="max-width: 600px; margin: 0 auto;">
  <table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" bgcolor="#ffffff">
    <tbody>
      <tr>
        <td style="padding-left:25px; padding-right:25px;" align="center">
          <img src="http://54.160.118.65/img/logo-top-imprint-signs.png"width="171" height="84" alt=""/>
          <hr style="border-color:#ffffff;">
        </td>
      </tr>
      <tr>
        <td align="left" style="padding-left:25px; padding-right:25px;">		  
          <p style="font-family: Arial, sans-serif; font-weight: normal; line-height: 19px; color: #1F1F1F; margin: 0px; font-size: 18px; padding-bottom: 10px; padding-top: 15px;"><strong>¡Bienvenido al portal de compras Imprint SIGNS! {{$user->last_name}}</strong><strong></strong></p>
          <p style="font-family: Arial, sans-serif; font-weight: normal; line-height: 19px; color: #cc2735; margin: 0px; font-size: 18px; padding-bottom: 10px; padding-top: 15px;"><strong>Credenciales de acceso:</strong><strong></strong></p>
          <p style="font-family: Arial, sans-serif; font-weight: normal; line-height: 19px; color: #cc2735; margin: 0px; font-size: 18px; padding-bottom: 10px; padding-top: 15px;"><strong>Email: </strong>{{$user->email}}</p>
          <p style="font-family: Arial, sans-serif; font-weight: normal; line-height: 19px; color: #cc2735; margin: 0px; font-size: 18px; padding-bottom: 10px; padding-top: 15px;"><strong>Clave: </strong>12345678</p>
          <hr/>
        </td>
      </tr>
      <tr>
        <td style="padding:25px;" align="center">
          <strong>
            <a href="http://54.160.118.65/login" style="color: #ffffff; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border: 4px solid #cc2735; padding: 6px 25px; font-size: 15px; font-family: Arial, sans-serif; line-height: 21px; background-color: #b4212e; border-radius: 10px; display: inline-block;">
              Ingresar
            </a>
          </strong>
        </td>
      </tr>
      <tr>
        <td height="20" align="center" bgcolor="#cc2735">
          <p style="font-family: Arial, sans-serif; font-weight: normal; line-height: 19px; color: #ffffff; margin: 0px; font-size: 16px; padding: 5px;">
            {{$empresa->company}}! - Plataforma Imprint SIGNS
          </p>
        </td>
      </tr>
    </tbody>
  </table>
</div>
</body>
</html>
