<?php
    if (isset($_POST['nom']))
    {

       $nom = $_POST['nom'];

shell_exec('sudo echo -e "'.$nom.'\tIN\tCNAME\tvincent47.fr." | sudo tee -a /etc/bind/db.vincent47.fr');
shell_exec('sudo touch /etc/apache2/sites-available/'.$nom.'.vincent47.fr.conf');
shell_exec('sudo mkdir /var/www/'.$nom.'.vincent47.fr');
shell_exec('sudo mkdir /var/www/'.$nom.'.vincent47.fr/public_html');
shell_exec('sudo echo -e "
        <VirtualHost *:80>\n
  ServerName "'.$nom.'".vincent47.fr\n
  ServerAlias www."'.$nom.'".vincent47.fr\n
  DocumentRoot /var/www/"'.$nom.'".vincent47.fr/public_html\n
  CustomLog /var/log/apache2/access.log combined\n
  ErrorLog /var/log/apache2/error.log\n
	</VirtualHost> " | sudo tee -a /etc/apache2/sites-available/"'.$nom.'".vincent47.fr.conf');
shell_exec("sudo a2ensite ".$nom.".vincent47.fr.conf");
shell_exec("sudo systemctl reload apache2");
shell_exec("sudo service bind9 restart");
   }
?>


<form action="index.php" method="post">
<label for="nom">Nom du sous domaine :</label>
<input type="text" name="nom" id="nom"/></br>
<input type="submit" value="Créer">
</form>

