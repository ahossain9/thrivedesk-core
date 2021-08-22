<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly
class Advanced_Tab extends Widget_Base {

	public function get_name() {
		return 'td-advanced-tabs';
	}

	public function get_title() {
		return __( 'Advanced Tab', 'thrivedesk' );
	}

	public function get_icon() {
		return 'thrivedesk-icon eicon-tabs';
	}

	public function get_keywords() {
		return [ 
			'tabs',
			'section',
			'advanced',
			'advanced tab',
			'toggle'
		];
	}

	public function get_categories() {
		return [ 'thrivedesk' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'content_heading',
			[
				'label' => __( 'Heading', 'thrivedesk' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'tab_heading_switcher' => 'yes'
				]
			]
		);

		$this->add_control(
			'heading_title',
			[
				'type' => Controls_Manager::TEXT,
				'label' => __( 'Title', 'thrivedesk' ),
				'label_block' => true,
				'default' => __( 'Tab Heading', 'thrivedesk' ),
				'placeholder' => __( 'Type Tab Heading', 'thrivedesk' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'heading_desc',
			[
				'type' => Controls_Manager::TEXTAREA,
				'label' => __( 'Description', 'thrivedesk' ),
				'default' => __( 'Tab Description', 'thrivedesk' ),
				'placeholder' => __( 'Type Tab Description', 'thrivedesk' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'thrivedesk' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'type' => Controls_Manager::TEXT,
				'label' => __( 'Title', 'thrivedesk' ),
				'default' => __( 'Tab Title', 'thrivedesk' ),
				'placeholder' => __( 'Type Tab Title', 'thrivedesk' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'description',
			[
				'type' => Controls_Manager::WYSIWYG,
				'label' => __( 'Description', 'thrivedesk' ),
				'default' => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.', 'thrivedesk' ),
				'placeholder' => __( 'Type Tab Description', 'thrivedesk' ),
				'condition' => [
					'source' => 'editor',
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'thrivedesk' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'source',
			[
				'type' => Controls_Manager::SELECT,
				'label' => __( 'Content Source', 'thrivedesk' ),
				'default' => 'editor',
				'separator' => 'before',
				'options' => [
					'editor' => __( 'Editor', 'thrivedesk' ),
					'template' => __( 'Template', 'thrivedesk' ),
				]
			]
		);

		$repeater->add_control(
			'image',
			[
				'label' => __( 'Image', 'thrivedesk' ),
				'show_label' => false,
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'source' => 'editor',
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'template',
			[
				'label' => __( 'Section Template', 'thrivedesk' ),
				'placeholder' => __( 'Select a section template for as tab content', 'thrivedesk' ),
				'description' => sprintf( __( 'Wondering what is section template or need to create one? Please click %1$shere%2$s ', 'thrivedesk' ),
					'<a target="_blank" href="' . esc_url( admin_url( '/edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=section' ) ) . '">',
					'</a>'
				),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'condition' => [
					'source' => 'template',
				]
			]
		);

		$this->add_control(
			'tabs',
			[
				'show_label' => false,
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{title}}',
				'default' => [
					[
						'title' => 'Tab 1',
						'source' => 'editor',
						'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore <br><br>et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
						'image' => [
							'url' => Utils::get_placeholder_image_src()
						]
					],
					[
						'title' => 'Tab 2',
						'source' => 'editor',
						'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore <br><br>et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
						'image' => [
							'url' => Utils::get_placeholder_image_src()
						]
					]
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_options',
			[
				'label' => __( 'Options', 'thrivedesk' ),
			]
		);

		$this->add_control(
			'_enable_accordian_heading',
			[
				'label' => __( 'Accordian', 'thrivedesk' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'enable_accordian_switcher',
			[
				'label' => __( 'Enable', 'thrivedesk' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'thrivedesk' ),
				'label_off' => __( 'Off', 'thrivedesk' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'_enable_heading_title',
			[
				'label' => __( 'Heading', 'thrivedesk' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'enable_tab_heading_switcher',
			[
				'label' => __( 'Show Heading', 'thrivedesk' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'thrivedesk' ),
				'label_off' => __( 'Hide', 'thrivedesk' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'_heading_tab_title',
			[
				'label' => __( 'Tab Title', 'thrivedesk' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'nav_position',
			[
				'type' => Controls_Manager::CHOOSE,
				'label' => __( 'Position', 'thrivedesk' ),
				'description' => __( 'Only applicable for desktop', 'thrivedesk' ),
				'default' => 'top',
				'toggle' => false,
				'options' => [
					'left' => [
						'title' =>  __( 'Left', 'thrivedesk' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' =>  __( 'Top', 'thrivedesk' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' =>  __( 'Right', 'thrivedesk' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'nav_align_x',
			[
				'type' => Controls_Manager::CHOOSE,
				'label' => __( 'Alignment', 'thrivedesk' ),
				'default' => 'x-left',
				'toggle' => false,
				'options' => [
					'x-left' => [
						'title' =>  __( 'Left', 'thrivedesk' ),
						'icon' => 'eicon-h-align-left',
					],
					'x-center' => [
						'title' =>  __( 'Center', 'thrivedesk' ),
						'icon' => 'eicon-h-align-center',
					],
					'x-justify' => [
						'title' =>  __( 'Stretch', 'thrivedesk' ),
						'icon' => 'eicon-h-align-stretch',
					],
					'x-right' => [
						'title' =>  __( 'Right', 'thrivedesk' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}}.td-tabs--nav-top > .td-tabs__nav' => 'justify-content: {{VALUE}};'
				],
				'selectors_dictionary' => [
					'x-left' => 'flex-start',
					'x-right' => 'flex-end',
					'x-center' => 'center',
					'x-justify' => 'space-evenly'
				],
				'condition' => [
					'nav_position' => ['top', 'bottom'],
				],
				'style_transfer' => true,
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'nav_align_y',
			[
				'type' => Controls_Manager::CHOOSE,
				'label' => __( 'Alignment', 'thrivedesk' ),
				'default' => 'y-top',
				'toggle' => false,
				'options' => [
					'y-top' => [
						'title' =>  __( 'Top', 'thrivedesk' ),
						'icon' => 'eicon-v-align-top',
					],
					'y-center' => [
						'title' =>  __( 'Center', 'thrivedesk' ),
						'icon' => 'eicon-v-align-middle',
					],
					'y-bottom' => [
						'title' =>  __( 'Right', 'thrivedesk' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors' => [
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}}.td-tabs--nav-left > .td-tabs__nav' => 'justify-content: {{VALUE}};',
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}}.td-tabs--nav-right > .td-tabs__nav' => 'justify-content: {{VALUE}};',
				],
				'selectors_dictionary' => [
					'y-top' => 'flex-start',
					'y-center' => 'center',
					'y-bottom' => 'flex-end',
				],
				'condition' => [
					'nav_position' => ['left', 'right'],
				],
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'nav_text_align',
			[
				'type' => Controls_Manager::CHOOSE,
				'label' => __( 'Text Alignment', 'thrivedesk' ),
				'default' => 'center',
				'toggle' => false,
				'options' => [
					'left' => [
						'title' =>  __( 'Left', 'thrivedesk' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' =>  __( 'Center', 'thrivedesk' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' =>  __( 'Right', 'thrivedesk' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title--desktop' => 'justify-content: {{VALUE}};',
				],
				'selectors_dictionary' => [
					'left' => 'flex-start',
					'center' => 'center',
					'right' => 'flex-end',
				],
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'_heading_tab_icon',
			[
				'label' => __( 'Tab Icon', 'thrivedesk' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'nav_icon_position',
			[
				'type' => Controls_Manager::CHOOSE,
				'label' => __( 'Position', 'thrivedesk' ),
				'default' => 'left',
				'toggle' => false,
				'options' => [
					'left' => [
						'title' =>  __( 'Left', 'thrivedesk' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' =>  __( 'Top', 'thrivedesk' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' =>  __( 'Bottom', 'thrivedesk' ),
						'icon' => 'eicon-v-align-bottom',
					],
					'right' => [
						'title' =>  __( 'Right', 'thrivedesk' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'style_transfer' => true,
			]
		);

		$this->end_controls_section();

		// Start Style Tab
		$this->start_controls_section(
			'_section_nav_heading',
			[
				'label' => __( 'Heading', 'thrivedesk' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'tab_heading_switcher' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'tab_heading_align',
			[
				'label' => esc_html__( 'Alignment', 'thrivedesk' ),
				'type'  => Controls_Manager::CHOOSE,
				'default'  =>'center' ,
				'options'  => [
					'left'    => [
						'title' => esc_html__( 'Left', 'thrivedesk' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'thrivedesk' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'thrivedesk' ),
						'icon'  => 'eicon-text-align-left',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tab-heading' => 'text-align: {{VALUE}};',
				]
			]
        );

		$this->add_control(
			'nav_heading_title_color',
			[
				'label' => __( 'Color', 'thrivedesk' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-heading h3' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'nav_heading_typography',
				'selector' => '{{WRAPPER}} .tab-heading h3',
				'scheme' => Typography::TYPOGRAPHY_2,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'nav_heading_text_shadow',
				'label' => __( 'Text Shadow', 'thrivedesk' ),
				'selector' => '{{WRAPPER}} .tab-heading h3',
			]
		);

		$this->add_responsive_control(
			'nav_heading_title_spacing',
			[
				'label' => __( 'Spacing', 'thrivedesk' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .tab-heading h3' => 'margin-bottom: {{SIZE}}px;'
				],
			]
		);

		$this->add_control(
			'nav_heading_desc_color',
			[
				'label' => __( 'Color', 'thrivedesk' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-heading p' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'nav_heading_desc_typography',
				'selector' => '{{WRAPPER}} .tab-heading p',
				'scheme' => Typography::TYPOGRAPHY_2,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'nav_heading_desc_text_shadow',
				'label' => __( 'Text Shadow', 'thrivedesk' ),
				'selector' => '{{WRAPPER}} .tab-heading p',
			]
		);

		$this->add_responsive_control(
			'nav_heading_desc_spacing',
			[
				'label' => __( 'Spacing', 'thrivedesk' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .tab-heading p' => 'margin-bottom: {{SIZE}}px;'
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_tab_nav',
			[
				'label' => __( 'Title & Description', 'thrivedesk' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'nav_title_heading',
				[
					'label' => __( 'Title', 'thrivedesk' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
		);

		$this->add_control(
			'nav_title_color',
			[
				'label' => __( 'Color', 'thrivedesk' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title .td-tab__title-text h4, {{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__title .td-tab__title-text h4' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'nav_title_active_color',
			[
				'label' => __( 'Active Color', 'thrivedesk' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title.td-tab--active .td-tab__title-text h4, {{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__title.td-tab--active .td-tab__title-text h4' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'nav_typography',
				'selector' => '{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title .td-tab__title-text h4, {{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__title .td-tab__title-text h4',
				'scheme' => Typography::TYPOGRAPHY_2,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'nav_text_shadow',
				'label' => __( 'Text Shadow', 'thrivedesk' ),
				'selector' => '{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title .td-tab__title-text h4, {{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__title .td-tab__title-text h4',
			]
		);

		$this->add_control(
			'nav_title_spacing',
			[
				'label' => __( 'Spacing', 'thrivedesk' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .td-tabs.enable-accordian .td-tabs__nav > .td-tab__title.td-tab--active .td-tab__title-text h4,{{WRAPPER}} .td-tabs.disable-accordian .td-tabs__nav > .td-tab__title .td-tab__title-text h4' => 'margin-bottom: {{SIZE}}px;'
				],
			]
		);

		$this->add_control(
			'nav_description',
				[
					'label' => __( 'Description', 'thrivedesk' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
		);

		$this->add_control(
			'nav_desc_color',
			[
				'label' => __( 'Color', 'thrivedesk' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title .td-tab__title-desc' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'nav_desc_active_color',
			[
				'label' => __( 'Active Color', 'thrivedesk' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title.td-tab--active .td-tab__title-desc' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'nav_desc_typography',
				'separator' =>'before',
				'selector' => '{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title .td-tab__title-desc, {{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__title .td-tab__title-desc, {{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title .td-tab__title-desc p, {{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__title .td-tab__title-desc p',
				'scheme' => Typography::TYPOGRAPHY_2,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'nav_desc_text_shadow',
				'label' => __( 'Text Shadow', 'thrivedesk' ),
				'selector' => '{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title .td-tab__title-desc, {{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__title .td-tab__title-desc, {{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title .td-tab__title-desc p, {{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__title .td-tab__title-desc p',
			]
		);

		$this->add_control(
			'nav_title_desc_global_heading',
				[
					'label' => __( 'Global', 'thrivedesk' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
		);

		$this->add_responsive_control(
			'nav_tab_width',
			[
				'label' => __( 'Width', 'thrivedesk' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .td-tabs--nav-left>.td-tabs__nav, {{WRAPPER}} .td-tabs--nav-right>.td-tabs__nav' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .td-tabs--nav-left>.td-tabs__content, {{WRAPPER}} .td-tabs--nav-right>.td-tabs__content' => 'flex: 0 0 calc(100% - {{SIZE}}{{UNIT}});'
				],
			]
		);

		$this->add_responsive_control(
			'nav_margin_x',
			[
				'label' => __( 'Horizontal Margin (px)', 'thrivedesk' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 'any',
				'selectors' => [
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}}.td-tabs--nav-top > .td-tabs__nav > .td-tab__title:not(:last-child)' => 'margin-right: {{VALUE}}px;',
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}}.td-tabs--nav-bottom > .td-tabs__nav > .td-tab__title:not(:last-child)' => 'margin-right: {{VALUE}}px;',
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}}.td-tabs--nav-left > .td-tabs__nav > .td-tab__title' => 'margin-right: {{VALUE}}px;',
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}}.td-tabs--nav-right > .td-tabs__nav > .td-tab__title' => 'margin-left: {{VALUE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'nav_margin_y',
			[
				'label' => __( 'Vertical Margin (px)', 'thrivedesk' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 'any',
				'selectors' => [
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}}.td-tabs--nav-top > .td-tabs__nav > .td-tab__title' => 'margin-bottom: {{VALUE}}px;',
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}}.td-tabs--nav-bottom > .td-tabs__nav > .td-tab__title' => 'margin-top: {{VALUE}}px;',
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}}.td-tabs--nav-left > .td-tabs__nav > .td-tab__title:not(:last-child)' => 'margin-bottom: {{VALUE}}px;',
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}}.td-tabs--nav-right > .td-tabs__nav > .td-tab__title:not(:last-child)' => 'margin-bottom: {{VALUE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'nav_padding',
			[
				'label' => __( 'Padding', 'thrivedesk' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'nav_border_radius',
			[
				'label' => __( 'Border Radius', 'thrivedesk' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( '_tab_nav_stats' );
		$this->start_controls_tab(
			'_tab_nav_normal',
			[
				'label' => __( 'Normal', 'thrivedesk' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'nav_bg_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .td-tabs--nav-left > .td-tabs__nav > .td-tab__title, {{WRAPPER}} .td-tabs--nav-right > .td-tabs__nav > .td-tab__title',
			]
		);

		$this->add_control(
			'nav_border_style',
			[
				'label' => __( 'Border Style', 'thrivedesk' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => __( 'None', 'thrivedesk' ),
					'solid' => __( 'Solid', 'thrivedesk' ),
					'double' => __( 'Double', 'thrivedesk' ),
					'dotted' => __( 'Dotted', 'thrivedesk' ),
					'dashed' => __( 'Dashed', 'thrivedesk' ),
				],
				'default' => 'none',
				'render_type' => 'ui',
			]
		);

		$this->add_control(
			'nav_border_width',
			[
				'label' => __( 'Border Width', 'thrivedesk' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'condition' => [
					'nav_border_style!' => 'none'
				],
				'render_type' => 'ui',
			]
		);

		$this->add_control(
			'nav_border_color',
			[
				'label' => __( 'Border Color', 'thrivedesk' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'nav_border_style!' => 'none'
				],
				'selectors' => [
					'{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__title, {{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title' => 'border-style: {{nav_border_style.VALUE}}; border-color: {{VALUE}};',
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title' => 'border-width: {{nav_border_width.TOP}}px {{nav_border_width.RIGHT}}px {{nav_border_width.BOTTOM}}px {{nav_border_width.LEFT}}px;',
				],
				'default' => '#e8e8e8',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nav_box_shadow',
				'label' => __( 'Box Shadow', 'thrivedesk' ),
				'selector' => '{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'_tab_nav_hover',
			[
				'label' => __( 'Hover', 'thrivedesk' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'nav_hover_bg_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .td-tabs--nav-left > .td-tabs__nav > .td-tab__title, {{WRAPPER}} .td-tabs--nav-right > .td-tabs__nav > .td-tab__title:hover',
			]
		);

		$this->add_control(
			'nav_hover_border_style',
			[
				'label' => __( 'Border Style', 'thrivedesk' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => __( 'None', 'thrivedesk' ),
					'solid' => __( 'Solid', 'thrivedesk' ),
					'double' => __( 'Double', 'thrivedesk' ),
					'dotted' => __( 'Dotted', 'thrivedesk' ),
					'dashed' => __( 'Dashed', 'thrivedesk' ),
				],
				'default' => 'none',
				'render_type' => 'ui',
			]
		);

		$this->add_control(
			'nav_hover_border_width',
			[
				'label' => __( 'Border Width', 'thrivedesk' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'condition' => [
					'nav_hover_border_style!' => 'none'
				],
				'render_type' => 'ui',
			]
		);

		$this->add_control(
			'nav_hover_border_color',
			[
				'label' => __( 'Border Color', 'thrivedesk' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'nav_hover_border_style!' => 'none'
				],
				'selectors' => [
					'{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__title, {{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title:hover' => 'border-style: {{nav_border_style.VALUE}}; border-color: {{VALUE}};',
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title:hover' => 'border-width: {{nav_border_width.TOP}}px {{nav_border_width.RIGHT}}px {{nav_border_width.BOTTOM}}px {{nav_border_width.LEFT}}px;',
				],
				'default' => '#e8e8e8',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nav_hover_box_shadow',
				'label' => __( 'Box Shadow', 'thrivedesk' ),
				'selector' => '{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title:hover',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'_tab_nav_active',
			[
				'label' => __( 'Active', 'thrivedesk' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'nav_active_bg_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .td-tabs--nav-left > .td-tabs__nav > .td-tab__title.td-tab--active, {{WRAPPER}} .td-tabs--nav-right > .td-tabs__nav > .td-tab__title.td-tab--active',
			]
		);

		$this->add_control(
			'nav_active_border_style',
			[
				'label' => __( 'Border Style', 'thrivedesk' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => __( 'None', 'thrivedesk' ),
					'solid' => __( 'Solid', 'thrivedesk' ),
					'double' => __( 'Double', 'thrivedesk' ),
					'dotted' => __( 'Dotted', 'thrivedesk' ),
					'dashed' => __( 'Dashed', 'thrivedesk' ),
				],
				'default' => 'none',
				'render_type' => 'ui',
			]
		);

		$this->add_control(
			'nav_active_border_width',
			[
				'label' => __( 'Border Width', 'thrivedesk' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'condition' => [
					'nav_active_border_style!' => 'none'
				],
				'render_type' => 'ui',
			]
		);

		$this->add_control(
			'nav_active_border_color',
			[
				'label' => __( 'Border Color', 'thrivedesk' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'nav_active_border_style!' => 'none'
				],
				'selectors' => [
					'{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__title.td-tab--active, {{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title.td-tab--active' => 'border-style: {{nav_active_border_style.VALUE}}; border-color: {{VALUE}};',
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title.td-tab--active' => 'border-width: {{nav_active_border_width.TOP}}px {{nav_active_border_width.RIGHT}}px {{nav_active_border_width.BOTTOM}}px {{nav_active_border_width.LEFT}}px;',
				],
				'default' => '#e8e8e8',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nav_active_box_shadow',
				'label' => __( 'Box Shadow', 'thrivedesk' ),
				'selector' => '{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav > .td-tab__title:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
			'_section_nav_icon',
			[
				'label' => __( 'Title Icon', 'thrivedesk' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'nav_icon_color',
			[
				'label' => __( 'Color', 'thrivedesk' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .td-tabs .td-tab__title-icon>svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .td-tabs .td-tab__title-icon>i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'nav_icon_active_color',
			[
				'label' => __( 'Active Color', 'thrivedesk' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .td-tabs .td-tab--active .td-tab__title-icon>svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .td-tabs .td-tab--active .td-tab__title-icon>i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'nav_icon_spacing',
			[
				'label' => __( 'Margin', 'thrivedesk' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .td-tabs .td-tab__title-icon>svg, {{WRAPPER}} .td-tabs .td-tab__title-icon>i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'nav_icon_size',
			[
				'label' => __( 'Size', 'thrivedesk' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__nav .td-tab__title-icon' => 'font-size: {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_tab_image',
			[
				'label' => __( 'Image', 'thrivedesk' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'_heading_image',
			[
				'label' => __( 'Image', 'thrivedesk' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'tab_img_align',
			[
				'label' => esc_html__( 'Alignment', 'thrivedesk' ),
				'type'  => Controls_Manager::CHOOSE,
				'default'  =>'center' ,
				'options'  => [
					'left'    => [
						'title' => esc_html__( 'Left', 'thrivedesk' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'thrivedesk' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'thrivedesk' ),
						'icon'  => 'eicon-text-align-left',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .td-tab__content .td-tab-image' => 'text-align: {{VALUE}};',
				]
			]
        );

		$this->add_responsive_control(
			'tab_img_width',
			[
				'label' => __( 'Width', 'thrivedesk' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .td-tab__content .td-tab-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_image_border',
				'label' => __( 'Border', 'thrivedesk' ),
				'selector' => '{{WRAPPER}} .td-tab__content .td-tab-image img',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'thrivedesk' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__content img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'label' => __( 'Box Shadow', 'thrivedesk' ),
				'selector' => '{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__content img',
			]
		);

		$this->add_control(
			'_heading_image_wrap',
			[
				'label' => __( 'Image Wrap', 'thrivedesk' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'thrivedesk' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_border_style',
			[
				'label' => __( 'Border Style', 'thrivedesk' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => __( 'None', 'thrivedesk' ),
					'solid' => __( 'Solid', 'thrivedesk' ),
					'double' => __( 'Double', 'thrivedesk' ),
					'dotted' => __( 'Dotted', 'thrivedesk' ),
					'dashed' => __( 'Dashed', 'thrivedesk' ),
				],
				'default' => 'none',
				'render_type' => 'ui',
			]
		);

		$this->add_control(
			'content_border_width',
			[
				'label' => __( 'Border Width', 'thrivedesk' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'condition' => [
					'content_border_style!' => 'none'
				],
				'render_type' => 'ui',
			]
		);

		$this->add_control(
			'content_border_color',
			[
				'label' => __( 'Border Color', 'thrivedesk' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'content_border_style!' => 'none'
				],
				'selectors' => [
					'{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__content' => 'border-style: {{content_border_style.VALUE}}; border-color: {{VALUE}};',
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__content' => 'border-width: {{content_border_width.TOP}}px {{content_border_width.RIGHT}}px {{content_border_width.BOTTOM}}px {{content_border_width.LEFT}}px;',
				],
				'default' => '#e8e8e8',
			]
		);

		$this->add_control(
			'content_border_radius',
			[
				'label' => __( 'Border Radius', 'thrivedesk' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .td-tabs-{{ID}} > .td-tabs__content > .td-tab__content',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tabs = (array) $settings['tabs'];
		$id_int = substr( $this->get_id_int(), 0, 3 );

		$this->add_render_attribute( 'tabs_wrapper', 'class', [
			'td-tabs-' . $this->get_id(),
			'td-tabs', $settings['enable_accordian_switcher'] == 'yes' ? 'enable-accordian':'disable-accordian',
			'td-tabs--nav-' . $settings['nav_position'],
			in_array( $settings['nav_position'], ['top', 'bottom'] ) ? 'td-tabs--nav-' . $settings['nav_align_x'] : '',
			in_array( $settings['nav_position'], ['left', 'right'] ) ? 'td-tabs--nav-' . $settings['nav_align_y'] : '',
			'td-tabs--icon-' . $settings['nav_icon_position'],
		] );

		$this->add_render_attribute( 'tabs_wrapper', 'role', 'tablist' );
		?>
		<div <?php $this->print_render_attribute_string( 'tabs_wrapper' ); ?>>
			<div class="td-tabs__nav">
				<?php if(!empty($settings['heading_title'] || $settings['heading_desc']) && $settings['tab_heading_switcher'] == 'yes'):?>
				<div class="tab-heading">
					<h3><?php echo $settings['heading_title'];?></h3>
					<p><?php echo $settings['heading_desc'];?></p>
				</div>
				<?php endif;?>
				<?php
				foreach ( $tabs as $index => $item ) :
					$tab_count = $index + 1;

					$tab_title_setting_key = $this->get_repeater_setting_key( 'title', 'tabs', $index );
					$tab_content_id = 'td-tab__content-' . $id_int . $tab_count;

					$this->add_render_attribute( $tab_title_setting_key, [
						'id' => 'td-tab-title-' . $id_int . $tab_count,
						'class' => [ 'td-tab__title', 'td-tab__title--desktop', 'elementor-repeater-item-' . $item['_id'] ],
						'data-tab' => $tab_count,
						'role' => 'tab',
						'aria-controls' => $tab_content_id,
					] );
					?>
					<div <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
						<?php if ( ! empty( $item['icon'] ) && ! empty( $item['icon']['value'] ) ) : ?>
							<div class="td-tab__title-icon">
								<?php Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</div>
						<?php endif; ?>
						<div class="td-tab__title-text">
							<h4><?php echo $item['title']; ?>
							<?php if($settings['enable_accordian_switcher'] == 'yes'):?>
							<span class="arrow-icon"><i class="fas fa-angle-down"></i><i class="fas fa-angle-up"></i></span>
							<?php endif;?>
							</h4>
							<span class="td-tab__title-desc"><?php echo $item['description'];?></span>
						</div>
					</div>					
				<?php endforeach; ?>
			</div>
			<div class="td-tabs__content">
				<?php
				foreach ( $tabs as $index => $item ) :
					$tab_count = $index + 1;

					if ( $item['source'] === 'editor' ) {
						$tab_content_setting_key = $this->get_repeater_setting_key( 'editor', 'tabs', $index );
						$this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );
					} else {
						$tab_content_setting_key = $this->get_repeater_setting_key( 'section', 'tabs', $index );
					}

					$tab_title_mobile_setting_key = $this->get_repeater_setting_key( 'tab_title_mobile', 'tabs', $tab_count );

					$this->add_render_attribute( $tab_content_setting_key, [
						'id' => 'td-tab-content-' . $id_int . $tab_count,
						'class' => [ 'td-tab__content', 'td-clearfix', 'elementor-repeater-item-' . $item['_id'] ],
						'data-tab' => $tab_count,
						'role' => 'tabpanel',
						'aria-labelledby' => 'td-tab-title-' . $id_int . $tab_count,
					] );

					$this->add_render_attribute( $tab_title_mobile_setting_key, [
						'class' => [ 'td-tab__title', 'td-tab__title--mobile', 'elementor-repeater-item-' . $item['_id'] ],
						'data-tab' => $tab_count,
						'role' => 'tab',
					] );
					?>

					
					<div <?php echo $this->get_render_attribute_string( $tab_title_mobile_setting_key ); ?>>
						<?php if ( ! empty( $item['icon'] ) && ! empty( $item['icon']['value'] ) ) : ?>
						<span class="td-tab__title-icon"></span>
						<?php endif; ?>
						<span class="td-tab__title-text"><?php echo  $item['title']; ?></span>
						<span class="td-tab__title-desc"><?php echo $item['description'];?></span>
					</div>
					<div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
					<?php
						if ( $item['source'] === 'editor' ) :
					?>
						<div class="td-tab-image">
							<img src="<?php echo $item['image']['url'];?>" alt="">
						</div>
						<?php
						elseif ( $item['source'] === 'template' && $item['template'] ) :
							echo '';
						endif;
						?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}
