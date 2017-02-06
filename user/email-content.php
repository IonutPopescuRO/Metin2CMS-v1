<?php
	require '../inc/config.php';
	$sqlHp = new mysqli(SQL_HP_HOST,  SQL_HP_USER,  SQL_HP_PASS);
?>
<div tabindex="0" class="thread-body" role="presentation">
    <div class="body undoreset" tabindex="0">
        <div class="email-wrapped">
            <div>
                <div>
                    <style type="text/css">
                        #yiv8835080492 html {} #yiv8835080492 body {
                            width: 100%;
                            margin: 0 auto;
                            padding: 0;
                        }
						img.displayed {
							display: block;
							margin-left: auto;
							margin-right: auto }
                    </style>
                    <table style="table-layout:fixed;" dir="ltr" width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td style="min-width:500px;" valign="top" align="center">

                                    <table width="500" bgcolor="#d9ecfa" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td>
													<?php 
													$url = $_SERVER['REQUEST_URI']; //returns the current URL
													$parts = explode('/',$url);
													$dir = $_SERVER['SERVER_NAME'];
													for ($i = 0; $i < count($parts) - 2; $i++) {
													 $dir .= $parts[$i] . "/";
													}
													echo '<img src="http://'.$dir.'images/logo.png" class="displayed">'; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>


                                    <table width="500" bgcolor="#f4f3f8" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="yiv8835080492m1930" style="font-family:Helvetica, Verdana, Arial, sans-serif;font-size:19px;line-height:23px;color:#464958;padding-left:30px;padding-right:30px;">
                                                        Salut <?php echo $name=$_GET['name']; ?>,
														<br>
														<table cellpadding="0" cellspacing="0">
															<tbody>
																<tr>
																	<td style="line-height:24px;" height="24"></td>
																</tr>
															</tbody>
														</table>
														Acceseaza link-ul urmator pentru 
														<?php
															$action = $_GET['action'];
															$code = $_GET['code'];
															switch ($action) {
																case 1:
																	echo 'a genera o nou&#259; parol&#259;:<br><a href="http://'.$dir.'index.php?page=passwordlost&name='.$name.'&code='.$code.'">http://'.$dir.'index.php?page=passwordlost&name='.$name.'&code='.$code.'</a>';
																	break;
																case 2:
																	echo 'a genera o nou&#259; parol&#259;:<br><a href="http://'.$dir.'index.php?page=password&code='.$code.'">http://'.$dir.'index.php?page=password&code='.$code.'</a>';
																	break;
																case 3:
																	echo 'a-&#355;i schimba adresa de email:<br><a href="http://'.$dir.'index.php?page=email&code='.$code.'">http://'.$dir.'index.php?page=email&code='.$code.'</a>';
																	break;
																default:
																	echo "Eroare! Te rugam sa contactezi un administrator.";
															}
														?>
														<a href=""> </a>
														<br>
														<table cellpadding="0" cellspacing="0">
															<tbody>
																<tr>
																	<td style="line-height:24px;" height="24"></td>
																</tr>
															</tbody>
														</table>
                                                        Cu drag,<br>Echipa <?php include("name_sv.php");?>.
														<br>
														<table cellpadding="0" cellspacing="0">
															<tbody>
																<tr>
																	<td style="line-height:24px;" height="24"></td>
																</tr>
															</tbody>
														</table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>


                                    <table width="500" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div style="color:#838383;font-family:Helvetica, Verdana, Arial, sans-serif;font-size:14px;padding:30px 30px;">
                                                        La raspunsurile trimise catre aceasta adresa de e-mail nu se poate raspunde.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>