<?php
/**
 * Elementor Property Virtual Tours Link Widget.
 *
 * @since 1.0.0
 */
class Elementor_Property_Virtual_Tours_Link_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'property-virtual-tours-link';
	}

	public function get_title() {
		return __( 'Virtual Tours Link', 'propertyhive' );
	}

	public function get_icon() {
		return 'fa fa-video';
	}

	public function get_categories() {
		return [ 'property-hive' ];
	}

	public function get_keywords() {
		return [ 'property hive', 'propertyhive', 'property', 'virtual tour' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Virtual Tours', 'propertyhive' ),
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
			'walk_icon',
			[
				'label' => esc_html__( 'Walking Tour Icon', 'propertyhive' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-walking',
					'library' => 'solid',
				],
			]
		);
$this->add_control(
			'video_icon',
			[
				'label' => esc_html__( 'Video Tour Icon', 'propertyhive' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-video',
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

		$virtual_tours = $property->get_virtual_tours();

        if ( !empty( $virtual_tours ) )
        {
		echo '<div class="button_list">';
            foreach ($virtual_tours as $virtual_tour)
            {
				if ( strpos($virtual_tour['url'], 'vieweet') !== FALSE )
                {
					echo '<div class="walk-button-modal-wrapper">';
                    echo '<a href="' . $virtual_tour['url'] . '" title="Virtual Walkthrough - Opens in a new window" alt="title="Virtual Walkthrough - Opens in a new window"" target="_blank" rel="nofollow" class="virtual_button walk">';
					echo '<div class="walk-icon iconbox">';
					\Elementor\Icons_Manager::render_icon( $settings["walk_icon"], [ "aria-hidden" => "true" ] );
					echo '</div>
					<div class="walk-icon text">';
					echo 'Virtual <br> Walkthrough';
					echo '</div></a></div>';
                }else{	
					if ( strpos($virtual_tour['url'], 'yout') !== FALSE || strpos($virtual_tour['url'], 'vimeo') !== FALSE )
					{
					echo '<div class="video-button-modal-wrapper">';
					echo '<a href="' . $virtual_tour['url'] . '" target="_blank" rel="nofollow" class="virtual_button video" data-fancybox>';
					echo '<div class="video-icon iconbox">';
					\Elementor\Icons_Manager::render_icon( $settings["video_icon"], [ "aria-hidden" => "true" ] );
					echo '</div>
					<div class="video-icon text">';
					echo 'Virtual <br> Tour';
					echo '</div></a></div>';
					}

				}
			}
		echo '</div>'; //end of button list
		}

	}

}