<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/default/css/foo-style.css">
        
        <style>
            * {
                margin:0px;
                padding:5px;
            }
            body {
                color: #000 !important;
            }
            table {
                width:100%;
            }
            #header table {
                width:100%;
                padding: 0px;
            }
            #header table td, .amount-summary td {
                vertical-align: text-top;
                padding: 5px;
            }
            #company-name{
                color:#000;
                font-size: 18px; 
            }
            #invoice-to td {
                text-align: left
            }
            #invoice-to {
                margin-bottom: 15px;
            }
            #invoice-to-right-table td {
                padding-right: 5px;
                padding-left: 5px;
                text-align: right;
            }
            .seperator {
                height: 25px
            }
            .top-border {
                border-top: none;
            }
            .no-bottom-border {
                border:none !important;
                background-color: white !important;
            }
	    #footer {
 		position: fixed;
		bottom: 0px
		background: #f9f9f9;
		padding: 10px;
	    }
            #ticket-items {
                padding-right: 5px;
                padding-left: 5px;
                padding-top: 5px;
                padding-bottom: 5px;
             }
            #ticket-items table {
		padding:20px;
                width: 100%;
            }
            #ticket-items table th{
                border-top: 1px solid;
                border-bottom: 1px solid;
                height: 30px;
            }
            #ticket-items table td{
                height: 30px;
            }
        </style>

	</head>
	<body>

        <div id="header">
            <table>
                <tr>
                    <td id="company-name">
                        <?php echo invoice_logo(); ?>

			<!-- foo.li in blauem Text, Logo ohne Text -->
			<h4 style="text-align: left; color:#4e81ba;"><?php echo $invoice->user_name; ?></h4>
                        <p>
                            <?php if ($invoice->user_address_1) { echo $invoice->user_address_1 . '<br>'; } ?>
                            <?php if ($invoice->user_address_2) { echo $invoice->user_address_2 . '<br>'; } ?>
                            <?php if ($invoice->user_zip) { echo $invoice->user_zip . ' '; } ?>
                            <?php if ($invoice->user_city) { echo $invoice->user_city . ' '; } ?>
                            <?php if ($invoice->user_state) { echo $invoice->user_state . '<br> '; } ?>
			    <?php /* if ($invoice->user_zip) { echo $invoice->user_zip . '<br>'; } */ ?>
                            <?php /* if ($invoice->user_phone) { ?><abbr>P: </abbr><?php echo $invoice->user_phone; ?><br><?php } */ ?>
                            <?php /* if ($invoice->user_fax) { ?><abbr>F: </abbr><?php echo $invoice->user_fax; ?><?php } */ ?>
                        </p>
			<td style="text-align: right;"><h3><?php echo lang('invoice'); ?> <?php echo $invoice->invoice_number; ?></h3>

			<?php if ($invoice->invoice_balance <= 0) { ?>
			 	<p style="font-size: 18px; letter-spacing: 2px; color: #04B404; background: #EFFBEF; padding: 10px; border: 0px solid #04B404;"><b>BEZAHLT</b></h3></p>
			<?php } ?>

			</td>
			</h3></p></td>
		    </td>
                </tr>
            </table>
        </div>
	
 	<?php /* Anpassungen Empfaenger: Abstand bei Text Empfaenger, Firma fett und custom_contact (Ansprechperson) und Kundennummer (eigene Variablen) */ ?>
        <div id="invoice-to">
            <table style="width: 100%;">
                <tr>
                    <td style="padding-left: 5px;">
			<div class="seperator"></div>				
                        <p><?php echo lang('bill_to'); ?>:</p>
                        <p><b><?php echo $invoice->client_name; ?></b><br>
			    <?php if ($invoice->client_custom_contact) { echo 'z.H. ' . $invoice->client_custom_contact . '<br>'; } ?>
                            <?php if ($invoice->client_address_1) { echo $invoice->client_address_1 . '<br>'; } ?>
                            <?php if ($invoice->client_address_2) { echo $invoice->client_address_2 . '<br>'; } ?>
                            <?php if ($invoice->client_zip) { echo $invoice->client_zip . ' '; } ?>
                            <?php if ($invoice->client_city) { echo $invoice->client_city . '<br> '; } ?>
                            <?php if ($invoice->client_state) { echo $invoice->client_state . '<br> '; } ?>
			    <?php //if ($invoice->client_country != "Liechtenstein")) { echo $invoice->client_country . '<br>'; } ?>
			    <?php if (!preg_match("/Liechtenstein|Schweiz/i",$invoice->client_country)) { echo $invoice->client_country . '<br>'; } ?>
                            <?php /* if ($invoice->client_zip) { echo $invoice->client_zip . '<br>'; } */ ?>
			    <?php /* if ($invoice->client_phone) { ?><abbr>P: </abbr><?php echo $invoice->client_phone; ?><?php } */ ?>
                            <?php /* if ($invoice->client_fax) { ?><abbr>F: </abbr><?php echo $invoice->client_fax; ?><br><?php } */ ?>
                        </p>
                        </p>
                    </td>
                    <td style="width:40%;"></td>
                    <td style="text-align: right;">
                        <table id="invoice-to-right-table">
                            <tbody>
                                <tr>
                                    <td><?php echo lang('invoice_date'); ?>: </td>
                                    <td><?php echo date_from_mysql($invoice->invoice_date_created, TRUE); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('due_date'); ?>: </td>
                                    <td><?php echo date_from_mysql($invoice->invoice_date_due, TRUE); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo lang('amount_due'); ?>: </td>
                                    <td><?php echo format_currency($invoice->invoice_balance); ?></td>
                                </tr>
				<?php /* if ($invoice->client_custom_custnr) {  ?>
                                <tr>
                                    <td><?php echo 'Kundennummer'; ?>: </td>
                                    <td><?php echo $invoice->client_custom_custnr; ?></td>
                                </tr>
				<?php } */ ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div id="invoice-items">
            <table class="table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th><?php echo lang('item'); ?></th>
                        <th><?php echo lang('description'); ?></th>
                        <th style="text-align: right;"><?php echo lang('qty'); ?></th>
                        <th style="text-align: right;"><?php echo lang('price'); ?></th>
                        <th style="text-align: right;"><?php echo lang('total'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td><?php echo $item->item_name; ?></td>
                            <td><?php echo $item->item_description; ?></td>
                            <td style="text-align: right;"><?php echo $item->item_quantity; ?></td>
			    <!-- ohne width Angabe werden dreistellige Betraege umgebrochen, schaut scheisse aus -->
			    <!-- 15% reicht fuer 4stellige Betraege aus. Bei 5stelligen wird auch hier umgebrochen, naja... ;-) -->
                            <td style="text-align: right; width:15%"><?php echo format_currency($item->item_price); ?></td>
                            <td style="text-align: right; width:15%"><?php echo format_currency($item->item_subtotal); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <table>
                <tr>
                    <td style="text-align: right;">
                        <table class="amount-summary">
                            <tr>
                                <td style="text-align: right;"><?php echo lang('subtotal'); ?>:</td>
                                <td style="text-align: right;"><?php echo format_currency($invoice->invoice_item_subtotal); ?></td>
                            </tr>
                            <?php if ($invoice->invoice_item_tax_total > 0) { ?>
                            <tr>
                                <td style="text-align: right;"><?php echo lang('item_tax'); ?></td>
                                <td style="text-align: right;"><?php echo format_currency($invoice->invoice_item_tax_total); ?></td>
                            </tr>
                            <?php } ?>
                            <?php foreach ($invoice_tax_rates as $invoice_tax_rate) : ?>
                                <tr>    
                                    <td style="text-align: right;"><?php echo $invoice_tax_rate->invoice_tax_rate_name . ' ' . $invoice_tax_rate->invoice_tax_rate_percent; ?>%</td>
                                    <td style="text-align: right;"><?php echo format_currency($invoice_tax_rate->invoice_tax_rate_amount); ?></td>
                                </tr>
                            <?php endforeach ?>
                            <tr>
                                <td style="text-align: right;"><?php echo lang('total'); ?>:</td>
                                <td style="text-align: right;"><?php echo format_currency($invoice->invoice_total); ?></td>
			    </tr>
			    <?php if ($invoice->invoice_balance <= 0) { ?>
			    <tr>
				<!-- standard uebersetzung fuer bezahlt ist ausgeglichen...scheiss wort... -->
			        <td style="text-align: right;"><?php echo 'Bezahlt'; ?>:</td> 
				<td style="text-align: right;"><?php echo format_currency($invoice->invoice_paid); ?> </td>
			    </tr>
			    <?php } ?>
                            <tr>
                                <td style="text-align: right;"><?php echo lang('balance'); ?>:</td>
                                <td style="text-align: right;"><strong><?php echo format_currency($invoice->invoice_balance) ?></strong></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

	    <br>

	<!-- Rechnung ist offen / nicht bezahlt -->
	    <div class="separator"></div>
	    <h4><?php echo 'Bankverbindung'; ?></h4>
	    <?php echo 'blahblah'; ?><br>
	    <?php echo 'foo.li Anstalt, '; ?>
	    <?php echo 'Konto: blahblah'; ?><br>
	    <?php echo 'IBAN: blahblah'; ?>
	    <?php echo '(roter Einzahlungsschein)'; ?>

            <div class="seperator"></div>
            <?php if ($invoice->invoice_terms) { ?>
            <h4><?php echo lang('terms'); ?></h4>
            <p><?php echo $invoice->invoice_terms; ?></p>
            <?php } ?>
            </div>
	<p><?php echo 'Sie können diese Rechung  jederzeit <a href='; ?><?php echo site_url('guest/view/invoice/' . $invoice->invoice_url_key); ?><?php echo '>online einsehen oder als PDF-Dokument herunterladen</a>.'; ?></p>


	<!-- redmine connection -->
	<?php if ($invoice->invoice_custom_ticket != '') { ?>
	    <!--<div class="seperator"></div>-->
            <h4><?php echo "Aufwände foo.li"; ?></h4>
            <p><?php echo "detaillierte Aufwandsbuchungen siehe nachfolgende Seiten."; ?><br />
            <?php echo "Die Aufwandsbuchungen können auch jederzeit im <a href='https://support.foo.li'>foo.li Ticketsystem</a> abgefragt werden."; ?></p>
            </div>

		<?php 
		//multiple tickets (comma-separated list) ? -> create an array
		$ticketcount = explode(',', $invoice->invoice_custom_ticket);
		$ticketarray = implode(',', $ticketcount);
		//more than one ticket - get array size
		$tickets = count($ticketcount)
		?>
		
		<pagebreak />

		<?php
		// Check connection
		// sql permissions on redmine: GRANT SELECT ON redmine.* TO user@'redmine-ip' IDENTIFIED BY 'password';
		$tickhost = 'redmine-ip';
		$tickuser = 'user';
		$tickpasswd = 'password';
		$tickdb = 'redmine';

		$con=mysqli_connect($tickhost,$tickuser,$tickpasswd,$tickdb);
		
		//weekdays in german language
		mysqli_query($con, "SET lc_time_names = 'de_DE'");

		//$qry = "SELECT (SELECT name FROM projects WHERE id=project_id) AS Kunde,(SELECT subject FROM issues WHERE id=issue_id) AS Auftrag, (SELECT CONCAT(firstname,' ',lastname) FROM users where id=user_id) AS User,DATE_FORMAT(spent_on,'%a, %d.%m.%Y') AS Datum,comments, ROUND(hours,2) AS Aufwand FROM time_entries WHERE issue_id=$invoice->invoice_custom_ticket";
		if ($invoice->invoice_custom_ticket_from_date != '') {
			//query with date range
			$qry = "SELECT (SELECT name FROM projects WHERE id=project_id) AS Kunde,(SELECT subject FROM issues WHERE id=issue_id) AS Auftrag, (SELECT CONCAT(firstname,' ',lastname) FROM users where id=user_id) AS User,DATE_FORMAT(spent_on,'%a, %d.%m.%Y') AS Datum, issue_id,comments, ROUND(hours,2) AS Aufwand FROM time_entries WHERE issue_id IN ($ticketarray) AND spent_on >= STR_TO_DATE('$invoice->invoice_custom_ticket_from_date','%d.%m.%Y') and spent_on <= str_to_date('$invoice->invoice_custom_ticket_to_date','%d.%m.%Y')ORDER BY spent_on ASC";
			$summe = mysqli_query($con,"SELECT ROUND(SUM(hours),2) AS Total from time_entries where issue_id IN ($ticketarray) AND spent_on >= STR_TO_DATE('$invoice->invoice_custom_ticket_from_date','%d.%m.%Y') and spent_on <= str_to_date('$invoice->invoice_custom_ticket_to_date','%d.%m.%Y')");
		} else {
			//no date range - get all entries
			$qry = "SELECT (SELECT name FROM projects WHERE id=project_id) AS Kunde,(SELECT subject FROM issues WHERE id=issue_id) AS Auftrag, (SELECT CONCAT(firstname,' ',lastname) FROM users where id=user_id) AS User,DATE_FORMAT(spent_on,'%a, %d.%m.%Y') AS Datum, issue_id,comments, ROUND(hours,2) AS Aufwand FROM time_entries WHERE issue_id IN ($ticketarray) ORDER BY spent_on ASC";
			$summe = mysqli_query($con,"SELECT ROUND(SUM(hours),2) AS Total from time_entries where issue_id IN ($ticketarray)");
		}

		$result = mysqli_query($con,$qry); 
		?>

		<?php echo "<h4>Detaillierte Aufwände  "; 
		if (($invoice->invoice_custom_ticket_from_date !='') and ($invoice->invoice_custom_ticket_to_date != '')) {
		echo "(Zeitraum: " . $invoice->invoice_custom_ticket_from_date . " bis " . $invoice->invoice_custom_ticket_to_date . ")";
		}
		echo " für Ticket / Auftrag:</h4><br>";
			for ($x=0; $x<$tickets;$x++) { 
				echo "<font size='4'><a href='https://support.foo.li/issues/" . $ticketcount[$x] . "'>&nbsp;&nbsp;&nbsp; #" . $ticketcount[$x] . "</a>: ";
				$subj = "SELECT subject AS Titel FROM issues WHERE id=$ticketcount[$x]";
				$subject = mysqli_query($con, $subj);
					while ($sub = mysqli_fetch_array($subject)) {
						echo $sub['Titel'] . "</p>";
					}
			}
			//final break
			echo "</p></font><br>" ?>

        <div id="ticket-items">
		            <table class="table table-striped" style="width: 100%;">
		                <thead>
	        	            <tr>
	                        	<th><?php echo "Datum"; ?></th>
					<?php if ($tickets > 1) {
	                        		echo "<th>Ticket</th>";
					} ?>
		                        <th><?php echo "Bearbeiter"; ?></th>
	        	                <th><?php echo "Beschreibung"; ?></th>
        	        	        <th style="text-align: right;"><?php echo "Aufwand"; ?></th>
		                    </tr>
	        	        </thead>

	                	<tbody>
	 	<?php while($row1 = mysqli_fetch_array($result)) { ?>
	        	                <tr>
	        	                    <td style="width:17%"><?php echo $row1['Datum']; ?></td>
					    <?php if ($tickets > 1) {
						    echo "<td style='width:8%'><a href='https://support.foo.li/issues/" . $row1['issue_id'] . "/time_entries'> " . $row1['issue_id'] ."</a></td>"; 
					    } ?>
		                            <td style="width:17%"><?php echo $row1['User']; ?></td>
		                            <td><?php echo $row1['comments']; ?></td>
		                            <td style="text-align: right; width:5%"><?php echo $row1['Aufwand']; ?></td>
        	                	</tr>
		<!--</div> -->
		                            
		<?php } ?>
		<?php while ($row2 = mysqli_fetch_array($summe)) { ?>
			<tr>
	        	    <td><?php // echo ; ?></td>
	        	    <td><?php //echo ; ?></td>
				<!-- more than one ticket -->
				<?php if ($tickets > 1) {
					echo "<td style='width:10%'>  </td>";
				} ?>
	        	    <td style="text-align: right;"><?php echo "<b>Aufwand Total:</b>"; ?></td>
			    <td style="text-align: right; width:5%;"> <?php echo "<b>" . $row2['Total'] . " h</b>"; ?></td>
			</tr>
        	        </tbody>
	            </table>
		<?php } ?>
		</div>
		<?php } ?>
	</body>
</html>
