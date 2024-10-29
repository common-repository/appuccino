<?php 

class Appuccino_Theme {

    /**
     * Theme which we want to activate
     */
    private $theme;

    /**
     * Cookie name
     */
    private $cookie;

    /**
     * GET parameter name
     */
    private $get;

    /**
     * Switched
     */
    private $switched;

    /**
     * Class constructor
     */
    public function __construct() {

        /**
         * Get default theme
         */
        $this->theme = get_option('template');

        /**
         * Define cookie name
         */
        $this->cookie = 'theme';

        /**
         * Define get parameter name
         */
        $this->get = 'theme';

        /**
         * Define if theme is already switched
         */
        $this->switched = false;

        $this->handle_url();
        $this->switch_theme();

        /**
         * Define plugin related hooks
         */
        $this->define_hooks();
    }

    /**
     * Get theme
     */
    public function get_theme() {

        return $this->theme;
    }

    /**
     * Handle for theme change
     *
     * When the user clicks special link with theme name we will
     * store this theme name in user cookies and 
     */
    public function handle_url() {

        if( isset( $_GET[$this->get] ) && !empty( $_GET[$this->get] ) ) {

            $theme = filter_input(INPUT_GET, $this->get, FILTER_SANITIZE_STRING );

            // This part require some additional checking e.g if theme exits or is allowed.

            $this->theme = $theme;
            $this->switched = true;

            // Store theme in cookie to remember choice
            setcookie( $this->cookie, $theme, time() + ( 365 * DAY_IN_SECONDS ), COOKIEPATH, COOKIE_DOMAIN );
        }
    }

    /**
     * Switch theme
     *
     * Check if user has cookie with theme name and eventualy switch theme
     */
    public function switch_theme() {

        if( isset( $_COOKIE[ $this->cookie ] ) && !$this->switched ) {

            $theme = filter_input( INPUT_COOKIE, $this->cookie, FILTER_SANITIZE_STRING );

            // This part require some additional checking e.g if theme exits or is allowed.

            $this->theme = $theme;
        }
    }

    /**
     * Define plugin related hooks
     */
    private function define_hooks() {

        /**
         * This filters will replace theme name across all WordPress
         */
        add_filter( 'template', array( $this, 'get_theme' ) );
        add_filter( 'stylesheet', array( $this, 'get_theme' ) );
    }
}
