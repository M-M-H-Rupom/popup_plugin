<?php
class popupdetailsMetabox {
	private $meta_fields = array(
		array(
			'label' => 'Display popup ',
			'id' => 'displaypopup_text',
			'type' => 'text',
		),
		array(
			'label' => 'URL',
			'id' => 'url_text',
			'type' => 'text',
		),
		array(
			'label' => 'Auto hide',
			'id' => 'autohide_checkbox',
			'type' => 'checkbox',
		),
		array(
			'label' => 'Display on Exit',
			'id' => 'displayonexit_checkbox',
			'type' => 'checkbox',
		),
        array(
			'label' => 'Popup size',
			'id' => 'popupsize_select',
			'type' => 'select',
			'options' => array(
				'Landscape',
				'Square',
			),
		),
	);

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
        add_action( 'init',array($this,'register_popup_size') );
	}
    function register_popup_size(){
        add_image_size('popup_landscape', '500', '700', true);
        add_image_size('popup_square', '400', '400', true);
    }
	public function add_meta_boxes() {
			add_meta_box(
				'popupdetails',
				__( 'Popup details', 'textdomain' ),
				array( $this, 'meta_box_callback' ),
				"popup",
				'advanced',
				'default'
			);
	}

	public function meta_box_callback( $post ) {
		$this->field_generator( $post );
	}

	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
            $input = '';
			switch ( $meta_field['type'] ) {
				case 'checkbox':
					$input = sprintf(
						'<input %s id=" %s" name="%s" type="checkbox" value="1">',
						$meta_value === '1' ? 'checked' : '',
						$meta_field['id'],
						$meta_field['id']
						);
					break;
                case 'select':
                    $input = sprintf(
                        '<select id="%s" name="%s">',
                        $meta_field['id'],
                        $meta_field['id']
                    );
                    foreach ( $meta_field['options'] as $key => $value ) {
                        $meta_field_value = !is_numeric( $key ) ? $key : $value;
                        $input .= sprintf(
                            '<option %s value="%s">%s</option>',
                            $meta_value === $meta_field_value ? 'selected' : '',
                            $meta_field_value,
                            $value
                        );
                    }
                    $input .= '</select>';
                    break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
            $output .= $label . $input;
		}
        echo $output ;
	}

	public function save_fields( $post_id ) {
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}
}

new popupdetailsMetabox();

?>