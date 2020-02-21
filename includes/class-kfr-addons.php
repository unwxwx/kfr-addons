<?php

/**
 * @since      1.0.0
 *
 * @package    Kfr_Addons
 */

/**
 * The core plugin class.
 *
 * This is used to define public-facing site hooks.
 *
 * @since      1.0.0
 * @package    Kfr_Addons
 */
class Kfr_Addons {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Kfr_Addons_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, and set the hooks for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {
        if ( defined( 'KFR_ADDONS_VERSION' ) ) {
            $this->version = KFR_ADDONS_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'kfr-addons';

        $this->load_dependencies();
        $this->define_hooks();

    }

    /**
     * Load the required dependencies for this plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-kfr-addons-loader.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-kfr-addons-public.php';

        $this->loader = new Kfr_Addons_Loader();

    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_hooks() {
        $plugin_public = new Kfr_Addons_Public( $this->get_plugin_name(), $this->get_version() );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

        $this->loader->add_action( 'init', $this, 'register_widgets', 0 );
    }

    /**
     * Register Elementor Widgets
     *
     * @since    1.0.0
     * @access   private
     */
    public function register_widgets() {
        // check if the Elementor plugin has been installed / activated.
        if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base'))
        {
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/widgets/SingleltemWidget.php';
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/widgets/StyledListWidget.php';
        }
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Kfr_Addons_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

}