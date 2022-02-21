<?php
/**
 * Elementor Property Enquiry Form Link Widget.
 *
 * @since 1.0.0
 */
class Elementor_Property_Enquiry_Form_Link_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'property-enquiry-form-link';
	}

	public function get_title() {
		return __( 'Enquiry Form Link', 'propertyhive' );
	}

	public function get_icon() {
		return 'fa fa-keyboard';
	}

	public function get_categories() {
		return [ 'property-hive' ];
	}

	public function get_keywords() {
		return [ 'property hive', 'propertyhive', 'property', 'enquiry', 'form' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Link', 'propertyhive' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'label' => __( 'Typography', 'propertyhive' ),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} a',
			]
		);

		$this->add_control(
			'color',
			[
				'label' => __( 'Colour', 'propertyhive' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'propertyhive' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'propertyhive' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'propertyhive' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'propertyhive' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Colour', 'propertyhive' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} a' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'padding',
			[
				'label' => __( 'Link Padding', 'propertyhive' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} a' => 'display:inline-block; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default' => [
					'top' => 5,
					'right' => 5,
					'bottom' => 5,
					'left' => 5,
					'isLinked' => true,
				],
			]
		);
$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'propertyhive' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-eye',
					'library' => 'solid',
				],
			]
		);
		$this->end_controls_section();

	}

	protected function render() {

		global $property;

		$settings = $this->get_settings_for_display();

		if ( !isset($property->id) ) {
			return;
		}

?>
		<div class="enquiry-button-modal-wrapper">
			<a data-fancybox data-src="#makeEnquiry<?php echo $property->id; ?>" href="javascript:;" class="enquiry_modal">
			<div class="enquiry-icon iconbox">
							<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
			</div>
			<div class="enquiry-icon text">
				Make an<br> Enquiry
		</div>
		</a>
</div>

    <!-- LIGHTBOX FORM -->
    <div id="makeEnquiry<?php echo $property->id; ?>" style="display:none;">
        
        <h2><?php _e( 'Make Enquiry', 'propertyhive' ); ?></h2>
        
        <p><?php _e( 'Please complete the form below and a member of staff will be in touch shortly.', 'propertyhive' ); ?></p>
        
        <?php propertyhive_enquiry_form(); ?>
        
    </div>
    <!-- END LIGHTBOX FORM -->
<?php

	}

}