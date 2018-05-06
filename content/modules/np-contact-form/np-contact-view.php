<h2><i class="material-icons">chat</i>Mensagem</h2>
<?php
$id = np_iget("id");
$message = new Read;
$message->exeRead(NP."contact_form", "WHERE ID = {$id}"); 
if($message->getRowCount() == 1){ 
foreach($message->getResult() as $row){
 echo "<table class='table bordered striped'>
        <tr><td>Assunto:</td> <td>{$row['subject']}</td></tr>
		<tr><td>Protocolo:</td> <td>{$row['protocol']}</td></tr>
		<tr><td>Nome:</td> <td>{$row['name']}</td></tr>
		<tr><td>E-mail:</td> <td>{$row['email']}</td></tr>
		<tr><td>Data e hora:</td> <td>".np_time($row['datetime'], "time+")."</td></tr>
		<tr><td>Mensagem:</td> <td>{$row['message']}</td></tr>
      </table>"; 	  
	}}
?>