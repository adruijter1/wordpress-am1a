<?php
 /*
	Plugin Name: simple-form-plugin
	Plugin URI: http://rra-plugins.org
	Description: This is a simple contact form. It sends it's info to adruijter@gmail.com. This plugin is free to use under the GNU.
	Version: 0.1
	Author: Arjan de Ruijter
	Author URI: http://adruijter.nl	
 */
 
 // Dit is een functie voor het maken van een shortcode
 register_activation_hook(__FILE__, 'jal_install');
 register_activation_hook(__FILE__, 'jal_install_data');
 add_shortcode('aanmeldformulier', 'formcode' );
 
 function formcode()
 {
	if ( isset($_POST['submit']))
	{
		$to = 'adruijter@gmail.com';
		
		$subject = 'Aanmelding Logopediepraktijk Uitgeest';
		
		$message = 'Geachte heer de Ruijter<br>';
		$message .= 'Wij hebben de onderstaande opdracht voor u ontvangen';
		$message .= '<table>
						<tr>
							<td>voornaam:</td>
							<td>'.$_POST['voornaam'].'</td>
						</tr>
						<tr>
							<td>tussenvoegsel:</td>
							<td>'.$_POST['tussenvoegsel'].'</td>
						</tr>
						<tr>
							<td>achternaam:</td>
							<td>'.$_POST['achternaam'].'</td>
						</tr>
						<tr>
							<td>telefoon:</td>
							<td>'.$_POST['telefoon'].'</td>
						</tr>
						<tr>
							<td>mobiel:</td>
							<td>'.$_POST['mobiel'].'</td>
						</tr>
						<tr>
							<td>email:</td>
							<td>'.$_POST['email'].'</td>
						</tr>
						<tr>
							<td>vraagstelling/klacht:</td>
							<td>'.$_POST['vraag'].'</td>
						</tr>
					</table><br><br>';
		$message .= 'Met vriendelijke groet,<br><b>Het systeem</b>';
		
		$headers = 'MIME-Version: 1.0'."\r\n";
		$headers .= 'Content-Type: text/html; charset=iso-8859-1'."\r\n";
		$headers .= 'From: '.$_POST['email']."\r\n";
		$headers .= 'Reply-To: '.$_POST['email']."\r\n";
		$headers .= 'X-mailer: PHP/'.phpversion()."\r\n";
		
		mail($to, $subject, $message, $headers);
		header('refresh:4;url=http://localhost/2013-2014/Blok4/wordpress-3.9/wordpress/nu-aanmelden');
		return 'Uw vraagstelling/klacht is verzonden.<br>Bedankt voor uw reactie.<br><br>
		Arjan de Ruijter<br>
		Logopedist - Klinisch Lingu&iuml;st';
	}
	else
	{	
		$form = "<form id='' method='post' action='../nu-aanmelden'>				 		
						voornaam:		 	
						<input type='text' name='voornaam' />					

						tussenvoegsel:			 	
						<input type='text' name='tussenvoegsel' />
						
				 		achternaam:
						<input type='text' name='achternaam' />
						
				 		telefoon:
				 		<input type='text' name='telefoon' />
					
						mobiel:
				 		<input type='text' name='mobiel' />
						
						e-mail:
				 		<input type='text' name='email' />
						
						vraagstelling/klacht:
				 		<textarea name='vraag'></textarea>
					
						<input type='submit' name='submit' />
			 </form>";	
	}
	return $form;
 }
 
 function jal_install()
 {
	// wpdb = wordpressdatabase
	global $wpdb;
	
	$table_name = $wpdb->prefix."register";
	
	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		voornaam VARCHAR(100) DEFAULT '' NOT NULL,
		tussenvoegsel VARCHAR(10) DEFAULT '' NOT NULL,
		achternaam VARCHAR(150) DEFAULT '' NOT NULL,
		telefoon VARCHAR(100) DEFAULT '' NOT NULL,
		mobiel VARCHAR(100) DEFAULT '' NOT NULL,
		email VARCHAR(20) DEFAULT '' NOT NULL,
		vraag text NOT NULL,
		UNIQUE KEY id (id)
		);";
		
	require_once(ABSPATH.'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	
	add_option("jal_db_version", "1.0");
 }
 
 function jal_install_data()
 {
	global $wpdb;
	$table_name = $wpdb->prefix."register";
	
	$rows_affected = $wpdb->insert($table_name, array( 'id' => NULL,
													   'voornaam' => 'Arjan',
													   'tussenvoegsel' => 'de',
													   'achternaam' => 'Ruijter',
													   'telefoon' => '0251-123456',
													   'mobiel' => '06-12345678',
													   'email' =>'adruijter@gmail.com',
													   'vraag' =>'Dit is mijn eerste record')); 
 }
 
 
 
?>