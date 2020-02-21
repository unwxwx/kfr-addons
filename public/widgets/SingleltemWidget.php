<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SingleltemWidget extends Widget_Base
{

    public function get_name() {
        return 'Single Item';
    }

    public function get_title() {
        return __( 'Single Item', 'kfr-addons' );
    }

    public function get_icon() {
        return 'fa fa-code';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'kfr-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        /*************************************/

        $this->add_control(
            'list_style',
            [
                'label' => __( 'Style', 'kfr-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style_01',
                'options' => [
                    'style_01'  => __( 'Style 01', 'kfr-addons' ),
                    'style_02' => __( 'Style 02', 'kfr-addons' ),
                    'style_03' => __( 'Style 03', 'kfr-addons' ),
                    'style_04' => __( 'Style 04', 'kfr-addons' ),
                ],
            ]
        );

        $this->add_control(
            'height',
            [
                'label' => __( 'Element height (p)', 'kfr-addons' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => __( '275', 'kfr-addons' ),
                'input_type' => 'text',
            ]
        );

        /******************************************/

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'kfr-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '', 'kfr-addons' ),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'kfr-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '', 'kfr-addons' ),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'kfr-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '#', 'kfr-addons' ),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __( 'Image', 'kfr-addons' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );
        $height = 'min-height: ' . abs($settings['height']) . 'px;';
        ?>
        <a id="<?php echo $id_int; ?>" href="<?php echo $settings['link']; ?>" class="insm-block-link">
            <div class="insm-block <?php echo $settings['list_style']; ?>" style="<?php echo $height; ?>">
                <div class="insm-block-bg" style="background-image: url('<?php echo $settings['image']['url']; ?>')"></div>
                <div class="insm-block-content">
                    <?php if (!empty($settings['title'])): ?>
                        <span class="insm-block-title"><?php echo $settings['title']; ?></span>
                    <?php endif; ?>
                    <?php if (!empty($settings['description'])): ?>
                        <span class="insm-block-description"><?php echo $settings['description']; ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </a>
        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new SingleltemWidget() );