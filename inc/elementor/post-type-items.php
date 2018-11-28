<?php
namespace Elementor;

class Widget_Post_Type_Items extends Widget_Base {

	public function get_name() {
		return 'post_type_items';
	}

	public function get_title() {
		return __( 'Post Type Items', 'vidiho-pro' );
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
				'label' => __( 'Post Type Items', 'vidiho-pro' ),
			]
		);

		$this->add_control(
			'html_msg',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __( 'Displays a hand-picked selection of posts from a selected post type.', 'vidiho-pro' ),
				'content_classes' => 'ci-description',
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => __( 'Element Title', 'vidiho-pro' ),
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
			'post_type',
			[
				'label'   => __( 'Post Type', 'vidiho-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'post',
				'options' => vidiho_pro_get_available_post_types(),
			]
		);

		$this->add_control(
			'selected_items',
			[
				'label'    => __( 'Select Items', 'vidiho-pro' ),
				'type'     => Controls_Manager::SELECT2,
				'options'  => '',
				'multiple' => true,
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

		$this->add_control(
			'view',
			[
				'label'   => __( 'View', 'vidiho-pro' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Post Type Items Element Styles', 'vidiho-pro' ),
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

		if ( empty( $settings['selected_items'] ) ) {
			return;
		}

		$title           = $settings['title'];
		$subtitle        = $settings['subtitle'];
		$center          = 'yes' === $settings['center_title'] ? true : false;
		$carousel        = 'yes' === $settings['carousel'] ? true : false;
		$columns         = intval( $settings['columns'] );
		$post_type_items = $settings['selected_items'];
		$post_type       = $settings['post_type'];

		$slider_class = '';
		if ( $carousel ) {
			$slider_class = 'row-slider';
		}

		if ( $title || $subtitle ) {
			$left_class = 'section-heading-left';
			if ( $center ) {
				$left_class = '';
			}
			?>
			<div class="section-heading <?php echo esc_attr( $left_class ); ?>">
				<div class="section-heading-content">
			<?php

				if ( $title ) { ?>
					<h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
				<?php }

				if ( $subtitle ) { ?>
					<p class="section-subtitle"><?php echo esc_html( $subtitle ); ?></p>
				<?php }
			?>
				</div>

				<?php if ( $carousel ) : ?>
					<div class="row-slider-nav"></div>
				<?php endif; ?>

			</div>
			<?php
		}

		$q = new \WP_Query( array(
			'post_type'      => $post_type,
			'posts_per_page' => - 1,
			'post__in'       => $post_type_items,
			'orderby'        => 'post__in',
		) );

		if ( $q->have_posts() ) {
			?><div class="row row-items <?php echo esc_attr( $slider_class ); ?>"><?php

				while ( $q->have_posts() ) {
					$q->the_post();

					?><div class="<?php echo esc_attr( vidiho_pro_get_columns_classes( $columns ) ); ?>"><?php

					if ( 1 === $columns ) {
						get_template_part( 'template-parts/widgets/home-item-media', get_post_type() );
					} else {
						get_template_part( 'template-parts/widgets/home-item', get_post_type() );
					}

					?></div><?php
				}
				wp_reset_postdata();

			?></div><?php
		}

		?>
		<script>
			jQuery(document).ready(function(){
				jQuery(document).trigger('elementor/render/post_type_items','#ci-pti-<?php echo esc_attr( $this->get_id() ); ?>');
			});
		</script>
		<?php
	}

}
