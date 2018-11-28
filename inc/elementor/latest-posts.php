<?php
namespace Elementor;

class Widget_Latest_Posts extends Widget_Base {

	public function get_name() {
		return 'latest_posts';
	}

	public function get_title() {
		return __( 'Latest Posts', 'vidiho-pro' );
	}

	public function get_icon() {
		return 'eicon-wordpress';
	}

	public function get_categories() {
		return [ 'vidiho-pro-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Latest Posts', 'vidiho-pro' ),
			]
		);

		$this->add_control(
			'html_msg',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __( 'Displays a number of the latest (or random) posts, optionally from a specific category.', 'vidiho-pro' ),
				'content_classes' => 'ci-description',
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => __( 'Title:', 'vidiho-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'vidiho-pro' ),
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'       => __( 'Subtitle:', 'vidiho-pro' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your subtitle', 'vidiho-pro' ),
			]
		);

		$this->add_control(
			'center_title',
			[
				'label'        => __( 'Center Title', 'vidiho-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Center', 'vidiho-pro' ),
				'label_off'    => __( 'Left', 'vidiho-pro' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'random',
			[
				'label'        => __( 'Display in random order', 'vidiho-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'vidiho-pro' ),
				'label_off'    => __( 'No', 'vidiho-pro' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'carousel',
			[
				'label'        => __( 'Display as a carousel', 'vidiho-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'vidiho-pro' ),
				'label_off'    => __( 'No', 'vidiho-pro' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'term_id',
			[
				'label'   => __( 'Category', 'vidiho-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => vidiho_pro_get_terms( 'category' ),
			]
		);

		$this->add_control(
			'count',
			[
				'label'   => __( 'Number of posts to show:', 'vidiho-pro' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range'   => [
					'min'  => 1,
					'max'  => 250,
					'step' => 1,
				],
			]
		);

		$this->add_control(
			'columns',
			[
				'label'   => __( 'Columns', 'vidiho-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'1' => __( 'One', 'vidiho-pro' ),
					'2' => __( 'Two', 'vidiho-pro' ),
					'3' => __( 'Three', 'vidiho-pro' ),
					'4' => __( 'Four', 'vidiho-pro' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Latest Posts Element Styles', 'vidiho-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Text Color', 'vidiho-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}};',
				],
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'   => 'typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		$title    = $settings['title'];
		$subtitle = $settings['subtitle'];
		$center   = 'yes' === $settings['center_title'] ? true : false;
		$random   = 'yes' === $settings['random'] ? true : false;
		$carousel = 'yes' === $settings['carousel'] ? true : false;
		$count    = $settings['count']['size'];
		$columns  = $settings['columns'];
		$term_id  = $settings['term_id'];

		if ( $title || $subtitle ) {
			$left_class = 'section-heading-left';
			if ( $center ) {
				$left_class = '';
			}
		    ?>
			<div class="section-heading <?php echo esc_attr( $left_class ); ?>">
				<div class="section-heading-content">
			<?php

			if ( $title ) {
				echo '<h2 class="section-title">' . esc_html( $title ) . '</h2>';
			}

			if ( $subtitle ) {
				echo '<p class="section-subtitle">' . esc_html( $subtitle ) . '</p>';
			}

		    ?>
		        </div>

				<?php if ( $carousel ) : ?>
					<div class="row-slider-nav"></div>
				<?php endif; ?>

		    </div>
		    <?php
		}

		echo do_shortcode( sprintf( '[latest-post-type post_type="%1$s" count="%2$s" columns="%3$s" random="%4$s" carousel="%5$s" taxonomy="%6$s" term_ids="%7$s"]',
			'post',
			$count,
			$columns,
			$random,
			$carousel,
			'category',
			$term_id
		) );
		?>
		<script>
			jQuery(document).ready(function(){
				jQuery(document).trigger('elementor/render/latest_posts','#ci-lp-<?php echo esc_attr( $this->get_id() ); ?>');
			});
		</script>
		<?php
	}

}
