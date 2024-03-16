<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Gestion de visite</title>
    <meta name="Author" content="Aya Mimoune">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Appel de la feuille de style -->
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="all">
</head>
<body>
    <table>
        <h1>Inscription</h1>
		<form method="POST" action="../controleurs/c_inscription.php" enctype="application/x-www-form-urlencoded">
<tr>
	<td>Nom : </td>
	<td><input type='text' name='nom' size='20'></td>
</tr>
<tr>
	<td>Prénom : </td>
	<td><input type='text' name='prenom' size='20' value=''></td>
</tr>
<tr>
	<td>Email : </td>
	<td><input type='text' name='email' size='20' value=''></td>
</tr>
<tr>
	<td>Login :</td>
	<td><input type='text' name='login' size='20' value=''></td>
</tr>
<tr>
	<td>Mot de passe : </td>
	<td><input type='password' name='mdp' size='20' value=''></td>
</tr>
<tr>
	<td>Adresse : </td>
	<td><input type='text' name='adresse' size='20' value=''></td>
</tr>
<tr>
	<td>Tel : </td>
	<td><input type='text' name='tel' size='20' value=''></td>
</tr>
<tr>
	<td>Code postal : </td>
	<td><input type='text' name='cp' size='20' value=''></td>
</tr>
<tr>
	<td>Ville : </td>
	<td><input type='text' name='ville' size='20' value=''></td>
</tr>
<tr>
	<td>Date d'embauche: </td>
	<td><input type='date' name='date_embauche' size='20' value=''></td>
</tr>
<tr>
<td colspan="2"><input type='submit' value='Ajouter'></td>
</tr>
</form>
</table>
</body>
</html>