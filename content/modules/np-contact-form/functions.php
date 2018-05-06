<?php
//Link do formulário

$qtform = $tr = np_count(NP."contact_form");
if($qtform >= 1){
	$qt = "({$qtform})";
}else{ $qt = null; }
np_add_link("Mensagens {$qt}", "np-contact-list&paging", "chat");
np_add_page("np-contact-list", "../content/modules/np-contact-form/np-contact-list.php", "Mensagens do site");

np_add_page("np-contact-view", "../content/modules/np-contact-form/np-contact-view.php", "Detalhes da mensagem");

np_page_app("contact", "np-contact-form/form.php", "Fale conosco!");
np_link_app("Contato", "contact");



?>