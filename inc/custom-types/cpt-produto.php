<?php

function flora_ndb_register_cpt_produto() {
	/**
	 * Post Type: Produtos.
	 */
	$labels = array(
		'name'                     => __( 'Produtos', 'flora_ndb' ),
		'singular_name'            => __( 'Produto', 'flora_ndb' ),
		'menu_name'                => __( 'Produtos', 'flora_ndb' ),
		'all_items'                => __( 'Todos Produtos', 'flora_ndb' ),
		'add_new'                  => __( 'Adicionar novo', 'flora_ndb' ),
		'add_new_item'             => __( 'Novo Produto', 'flora_ndb' ),
		'edit_item'                => __( 'Editar Produto', 'flora_ndb' ),
		'new_item'                 => __( 'Novo Produto', 'flora_ndb' ),
		'view_item'                => __( 'Ver Produto', 'flora_ndb' ),
		'view_items'               => __( 'Ver Produtos', 'flora_ndb' ),
		'search_items'             => __( 'Buscar Produtos', 'flora_ndb' ),
		'not_found'                => __( 'Nenhum Produto encontrado', 'flora_ndb' ),
		'not_found_in_trash'       => __( 'Nenhum Produto encontrado na lixeira', 'flora_ndb' ),
		'featured_image'           => __( 'Imagem destacada do Produto', 'flora_ndb' ),
		'set_featured_image'       => __( 'Definir imagem destacada do Produto', 'flora_ndb' ),
		'remove_featured_image'    => __( 'Remover imagem destacada deste Produto', 'flora_ndb' ),
		'use_featured_image'       => __( 'Usar como imagem destacada para este Produto', 'flora_ndb' ),
		'archives'                 => __( 'Arquivos de Produtos', 'flora_ndb' ),
		'insert_into_item'         => __( 'Inserir no Produto', 'flora_ndb' ),
		'uploaded_to_this_item'    => __( 'Enviar para este Produto', 'flora_ndb' ),
		'filter_items_list'        => __( 'Filtrar lista de Produtos', 'flora_ndb' ),
		'items_list_navigation'    => __( 'Navegação pela lista de Produtos', 'flora_ndb' ),
		'items_list'               => __( 'Lista de Produtos', 'flora_ndb' ),
		'attributes'               => __( 'Atributos de Produtos', 'flora_ndb' ),
		'name_admin_bar'           => __( 'Produto', 'flora_ndb' ),
		'item_published'           => __( 'Produto publicado', 'flora_ndb' ),
		'item_published_privately' => __( 'Produto publicado em privado.', 'flora_ndb' ),
		'item_reverted_to_draft'   => __( 'Produto convertido em rascunho.', 'flora_ndb' ),
		'item_scheduled'           => __( 'Produto agendado.', 'flora_ndb' ),
		'item_updated'             => __( 'Produto atualizado.', 'flora_ndb' ),
	);

	$args = array(
		'label'                 => __( 'Produtos', 'flora_ndb' ),
		'labels'                => $labels,
		'description'           => '',
		'public'                => true,
		'publicly_queryable'    => true,
		'show_ui'               => true,
		'show_in_rest'          => true,
		'rest_base'             => 'produtos',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'has_archive'           => false,
		'show_in_menu'          => true,
		'show_in_nav_menus'     => true,
		'delete_with_user'      => false,
		'exclude_from_search'   => false,
		'capability_type'       => 'post',
		'map_meta_cap'          => true,
		'hierarchical'          => false,
		'can_export'            => true,
		'rewrite'               => array(
			'slug'       => 'produto',
			'with_front' => true,
		),
		'query_var'             => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-products',
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'author' ),
		'yarpp_support'         => true,
		'show_in_graphql'       => true,
	);
	register_post_type( 'produto', $args );
}
add_action( 'init', 'flora_ndb_register_cpt_produto' );


function flora_ndb_register_taxes_categoria_produto() {
	/**
	 * Taxonomy: Categorias de Produtos.
	 */
	$labels = array(
		'name'                       => __( 'Categorias de Produtos', 'flora_ndb' ),
		'singular_name'              => __( 'Categoria de Produtos', 'flora_ndb' ),
		'menu_name'                  => __( 'Categorias de Produtos', 'flora_ndb' ),
		'all_items'                  => __( 'Todas Categorias de Produtos', 'flora_ndb' ),
		'edit_item'                  => __( 'Editar Categoria de Produtos', 'flora_ndb' ),
		'view_item'                  => __( 'Ver Categoria de Produtos', 'flora_ndb' ),
		'update_item'                => __( 'Atualizar Categoria de Produtos name', 'flora_ndb' ),
		'add_new_item'               => __( 'Adicionar nova Categoria de Produtos', 'flora_ndb' ),
		'new_item_name'              => __( 'Nome da nova Categoria de Produtos', 'flora_ndb' ),
		'parent_item'                => __( 'Categoria de Produtos pai', 'flora_ndb' ),
		'parent_item_colon'          => __( 'Categoria de Produtos pai:', 'flora_ndb' ),
		'search_items'               => __( 'Buscar Categorias de Produtos', 'flora_ndb' ),
		'popular_items'              => __( 'Categorias de Produtos populares', 'flora_ndb' ),
		'separate_items_with_commas' => __( 'Separa Categorias de Produtos com vírgula', 'flora_ndb' ),
		'add_or_remove_items'        => __( 'Adicionar ou remover Categorias de Produtos', 'flora_ndb' ),
		'choose_from_most_used'      => __( 'Escolha entre as Categorias de Produtos mais usadas', 'flora_ndb' ),
		'not_found'                  => __( 'Nenhuma Categoria de Produtos encontrada', 'flora_ndb' ),
		'no_terms'                   => __( 'Nenhuma Categoria de Produtos', 'flora_ndb' ),
		'items_list_navigation'      => __( 'Navegação da lista de Categorias de Produtos', 'flora_ndb' ),
		'items_list'                 => __( 'Lista de Categorias de Produtos', 'flora_ndb' ),
		'back_to_items'              => __( 'Voltar para Categorias de Produtos', 'flora_ndb' ),
		'name_field_description'     => __( 'O nome como ele aparece em seu site.', 'flora_ndb' ),
		'parent_field_description'   => __( 'Atribua um termo pai para criar uma hierarquia. O termo Jazz, por exemplo, seria o pai do Bebop e da Big Band.', 'flora_ndb' ),
		'slug_field_description'     => __( 'O slug é a versão amigável para URL do nome. Geralmente é tudo em minúsculas e contém apenas letras, números e hífens.', 'flora_ndb' ),
		'desc_field_description'     => __( 'A descrição não é proeminente por padrão; no entanto, alguns temas podem mostrá-lo.', 'flora_ndb' ),
	);

	$args = array(
		'label'                 => __( 'Categorias de Produtos', 'flora_ndb' ),
		'labels'                => $labels,
		'public'                => true,
		'publicly_queryable'    => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_nav_menus'     => true,
		'query_var'             => true,
		'rewrite'               => array(
			'slug'       => 'categoria_produto',
			'with_front' => true,
		),
		'show_admin_column'     => true,
		'show_in_rest'          => true,
		'show_tagcloud'         => true,
		'rest_base'             => 'categorias_produtos',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'show_in_quick_edit'    => true,
		'sort'                  => false,
		'show_in_graphql'       => true,
	);
	register_taxonomy( 'categoria_produto', array( 'produto' ), $args );
}
add_action( 'init', 'flora_ndb_register_taxes_categoria_produto' );


function flora_ndb_register_taxes_linha_produto() {
	/**
	 * Taxonomy: Linhas de Produtos.
	 */
	$labels = array(
		'name'                       => __( 'Linha', 'flora_ndb' ),
		'singular_name'              => __( 'Linha de Produtos', 'flora_ndb' ),
		'menu_name'                  => __( 'Linha de Produtos', 'flora_ndb' ),
		'all_items'                  => __( 'Todas Linhas de Produtos', 'flora_ndb' ),
		'edit_item'                  => __( 'Editar Linha de Produtos', 'flora_ndb' ),
		'view_item'                  => __( 'Ver Linha de Produtos', 'flora_ndb' ),
		'update_item'                => __( 'Atualizar Linha de Produtos name', 'flora_ndb' ),
		'add_new_item'               => __( 'Adicionar nova Linha de Produtos', 'flora_ndb' ),
		'new_item_name'              => __( 'Nome da nova Linha de Produtos', 'flora_ndb' ),
		'parent_item'                => __( 'Linha de Produtos pai', 'flora_ndb' ),
		'parent_item_colon'          => __( 'Linha de Produtos pai:', 'flora_ndb' ),
		'search_items'               => __( 'Buscar Linhas de Produtos', 'flora_ndb' ),
		'popular_items'              => __( 'Linhas de Produtos populares', 'flora_ndb' ),
		'separate_items_with_commas' => __( 'Separa Linhas de Produtos com vírgula', 'flora_ndb' ),
		'add_or_remove_items'        => __( 'Adicionar ou remover Linhas de Produtos', 'flora_ndb' ),
		'choose_from_most_used'      => __( 'Escolha entre as Linhas de Produtos mais usadas', 'flora_ndb' ),
		'not_found'                  => __( 'Nenhuma Linha de Produtos encontrada', 'flora_ndb' ),
		'no_terms'                   => __( 'Nenhuma Linha de Produtos', 'flora_ndb' ),
		'items_list_navigation'      => __( 'Navegação da lista de Linhas de Produtos', 'flora_ndb' ),
		'items_list'                 => __( 'Lista de Linhas de Produtos', 'flora_ndb' ),
		'back_to_items'              => __( 'Voltar para Linhas de Produtos', 'flora_ndb' ),
		'name_field_description'     => __( 'O nome como ele aparece em seu site.', 'flora_ndb' ),
		'parent_field_description'   => __( 'Atribua um termo pai para criar uma hierarquia. O termo Jazz, por exemplo, seria o pai do Bebop e da Big Band.', 'flora_ndb' ),
		'slug_field_description'     => __( 'O slug é a versão amigável para URL do nome. Geralmente é tudo em minúsculas e contém apenas letras, números e hífens.', 'flora_ndb' ),
		'desc_field_description'     => __( 'A descrição não é proeminente por padrão; no entanto, alguns temas podem mostrá-lo.', 'flora_ndb' ),
	);

	$args = array(
		'label'                 => __( 'Linhas de Produtos', 'flora_ndb' ),
		'labels'                => $labels,
		'public'                => true,
		'publicly_queryable'    => true,
		'hierarchical'          => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_nav_menus'     => true,
		'query_var'             => true,
		'rewrite'               => array(
			'slug'       => 'linha_produto',
			'with_front' => true,
		),
		'show_admin_column'     => true,
		'show_in_rest'          => true,
		'show_tagcloud'         => false,
		'rest_base'             => 'linhas_produtos',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'show_in_quick_edit'    => true,
		'sort'                  => false,
		'show_in_graphql'       => true,
	);
	register_taxonomy( 'linha_produto', array( 'produto' ), $args );
}
add_action( 'init', 'flora_ndb_register_taxes_linha_produto' );


add_action( 'after_switch_theme', 'flora_ndb_rewrite_flush' );
function flora_ndb_rewrite_flush() {
	flora_ndb_register_cpt_produto();
	flora_ndb_register_taxes_categoria_produto();
	flora_ndb_register_taxes_linha_produto();
	flush_rewrite_rules();
}

/**
 * Add Image Field on Taxonomy linha_produto
 */
require get_template_directory() . '/inc/custom-types/tax-linha-produto-image-field.php';


