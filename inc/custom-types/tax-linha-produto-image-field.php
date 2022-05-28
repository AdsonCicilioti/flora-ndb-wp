<?php

//Add image field in taxonomy page
add_action( 'linha_produto_add_form_fields', 'flora_ndb_add_custom_taxonomy_image', 10, 2 );
function flora_ndb_add_custom_taxonomy_image( $taxonomy ) {
	?>
	<div class="form-field term-group">

		<label for="image_id"><?php _e( 'Imagem', 'flora_ndb' ); ?></label>
		<input type="hidden" id="image_id" name="image_id" class="custom_media_url" value="">

		<div id="image_wrapper"></div>

		<p>
			<input type="button" class="button button-secondary taxonomy_media_button" id="taxonomy_media_button" name="taxonomy_media_button" value="<?php _e( 'Adicionar Imagem', 'flora_ndb' ); ?>">
			<input type="button" class="button button-secondary taxonomy_media_remove" id="taxonomy_media_remove" name="taxonomy_media_remove" value="<?php _e( 'Remover Imagem', 'flora_ndb' ); ?>">
		</p>

	</div>
	<?php
}

//Save the taxonomy image field
add_action( 'created_linha_produto', 'flora_ndb_save_custom_taxonomy_image', 10, 2 );
function flora_ndb_save_custom_taxonomy_image( $term_id, $tt_id ) {
	if ( isset( $_POST['image_id'] ) && '' !== $_POST['image_id'] ) {
		$image = $_POST['image_id'];
		add_term_meta( $term_id, 'image_id', $image, true );
	}
}

//Add the image field in edit form page
add_action( 'linha_produto_edit_form_fields', 'flora_ndb_update_custom_taxonomy_image', 10, 2 );
function flora_ndb_update_custom_taxonomy_image( $term, $taxonomy ) {
	?>
	<tr class="form-field term-group-wrap">
		<th scope="row">
			<label for="image_id"><?php _e( 'Imagem', 'flora_ndb' ); ?></label>
		</th>
		<td>

		<?php $image_id = get_term_meta( $term->term_id, 'image_id', true ); ?>
			<input type="hidden" id="image_id" name="image_id" value="<?php echo $image_id; ?>">

			<div id="image_wrapper">
		<?php if ( $image_id ) { ?>
				<?php echo wp_get_attachment_image( $image_id, 'thumbnail' ); ?>
		<?php } ?>

			</div>

			<p>
				<input type="button" class="button button-secondary taxonomy_media_button" id="taxonomy_media_button" name="taxonomy_media_button" value="<?php _e( 'Adicionar imagem', 'flora_ndb' ); ?>">
				<input type="button" class="button button-secondary taxonomy_media_remove" id="taxonomy_media_remove" name="taxonomy_media_remove" value="<?php _e( 'Remover Imagem', 'flora_ndb' ); ?>">
			</p>

		</div></td>
	</tr>
		<?php
}

//Update the taxonomy image field
add_action( 'edited_linha_produto', 'flora_ndb_updated_custom_taxonomy_image', 10, 2 );
function flora_ndb_updated_custom_taxonomy_image( $term_id, $tt_id ) {
	if ( isset( $_POST['image_id'] ) && '' !== $_POST['image_id'] ) {
		$image = $_POST['image_id'];
		update_term_meta( $term_id, 'image_id', $image );
	} else {
		update_term_meta( $term_id, 'image_id', '' );
	}
}

//Enqueue the wp_media library
add_action( 'admin_enqueue_scripts', 'flora_ndb_custom_taxonomy_load_media' );
function flora_ndb_custom_taxonomy_load_media() {
	if ( ! isset( $_GET['taxonomy'] ) || 'linha_produto' !== $_GET['taxonomy'] ) {
		return;
	}
	wp_enqueue_media();
}

//Custom script

function flora_ndb_image_taxonomy_script() {
	if ( ! isset( $_GET['taxonomy'] ) || 'linha_produto' !== $_GET['taxonomy'] ) {
		return;
	}

	if ( ! did_action( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
	}
	wp_enqueue_script( 'media-handler-script', get_stylesheet_directory_uri() . '/inc/custom-types/tax-linha-produto-media-handler.js', array( 'jquery' ), null, false );
}
add_action( 'admin_enqueue_scripts', 'flora_ndb_image_taxonomy_script' );


//Add new column heading
add_filter( 'manage_edit-linha_produto_columns', 'flora_ndb_display_custom_taxonomy_image_column_heading' );
function flora_ndb_display_custom_taxonomy_image_column_heading( $columns ) {

	$new = array();
	foreach ( $columns as $key => $title ) {
		if ( 'description' === $key ) { // Put the Thumbnail column before the Author column
			$new['linha_produto_image'] = __( 'Imagem', 'flora_ndb' );
		}
		$new[ $key ] = $title;
	}
	return $new;
}

//Display new columns values
add_action( 'manage_linha_produto_custom_column', 'flora_ndb_display_custom_taxonomy_image_column_value', 10, 3 );
function flora_ndb_display_custom_taxonomy_image_column_value( $columns, $column, $id ) {
	if ( 'linha_produto_image' === $column ) {
		$image_id = esc_html( get_term_meta( $id, 'image_id', true ) );
		$columns  = wp_get_attachment_image( $image_id );
	}
	return $columns;
}
