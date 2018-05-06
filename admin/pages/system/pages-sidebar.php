<?php
//Painel de controle
//Files
np_add_page("file", "pages/files/file_list.php", "Arquivos");
np_add_page("file-add", "pages/files/file_add.php", "Arquivos");
np_add_page("file-edit", "pages/files/file_edit.php", "Editar arquivo");
np_add_page("no-access", "pages/error-user.php", "Acesso negado");
//Páginas dos usuários
np_add_page("dashboard", "pages/users/dashboard.php", "Painel de controle");
np_add_page("profile", "pages/users/edit-user.php", "Editar meu perfil");
np_add_page("edit-user", "pages/users/edit-user.php", "Editar usuário");
np_add_page("users", "pages/users/users.php", "Usuários");
np_add_page("add-user", "pages/users/add-user.php", "Criar novo usuário");
np_add_page("user-delete", "pages/users/user-delete.php", "Criar novo usuário");

np_add_page("notifications", "pages/notifications.php", "Notificações não lidas");
np_add_page("notifications2", "pages/notifications2.php", "Notificações já lidas");
//Posts e páginas
np_add_page("post", "pages/posts/post.php", "Posts");
np_add_page("post-form", "pages/posts/post-form.php", "Criar publicação");
np_add_page("post-edit", "pages/posts/post-form-edit.php", "Editar publicação");
np_add_page("lixeira", "pages/posts/lixeira.php", "Lixeira");
np_add_page("page", "pages/posts/page.php", "Páginas");
//Categorias
np_add_page("category", "pages/categories/category.php", "Categorias");
np_add_page("add-category", "pages/categories/category-form.php", "Criar categoria");
np_add_page("edit-category", "pages/categories/category-edit.php", "Editar categoria");

np_add_page("post-edit-image", "pages/post-edit-image.php", "Editar imagem destacada");
//Mídias

np_add_page("midia", "midia/file-list-all.php", "Mídias");
np_add_page("view-midia", "midia/view-midia.php", "Visualizar arquivo");
//Módulos
np_add_page("mod", "pages/mod-list.php", "Módulos");
//Configurações
np_add_page("settings", "pages/settings.php", "Configurações do sistema");
np_add_page("settings-description", "pages/settings/description.php", "Descrições");
np_add_page("settings-thema", "pages/settings/thema.php", "Tema");
np_add_page("settings-lang", "pages/settings/lang.php", "Idioma");
np_add_page("settings-server", "pages/settings/server.php", "Servidor");
np_add_page("settings-update", "pages/settings/update.php", "Atualização");
?>