<?php
/**
 * Redux Framework
 *
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package         Redux
 * @author          Daniel J Griffiths
 * @version         3.0.0
 * @textdomain      redux
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;


if( !class_exists( 'ReduxFramework' ) ) {

    /**
     * Main ReduxFramework class
     *
     * @author      Daniel J Griffiths
     * @since       3.0.0
     */
    final class ReduxFramework {


        /**
         * Class constructor
         *
         * @access      public
         * @author      Daniel J Griffiths
         * @since       3.0.0
         * @return      void
         */
        public function __construct() {
            $this->setup_constants();
            $this->includes();
            $this->load_textdomain();
        }


        /**
         * Setup plugin constants
         *
         * @access      private
         * @author      Daniel J Griffiths
         * @since       3.0.0
         * @return      void
         */
        private function setup_constants() {
            // Framework version
            if( !defined( 'REDUX_VERSION' ) )
                define( 'REDUX_VERSION', '3.0.0' );

            // Windows-proof constants: replace backslashes with forward slashes
            // Thanks to: https://github.com/peterbouwmeester
            $fslashed_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
            $fslashed_abs = trailingslashit( str_replace( '\\', '/', ABSPATH ) );

            // Framework path
            if( !defined( 'REDUX_DIR' ) )
                define( 'REDUX_DIR', $fslashed_dir );

            // Framework URL
            if( !defined( 'REDUX_URL' ) )
                define( 'REDUX_URL', site_url( str_replace( $fslashed_abs, '', $fslashed_dir ) ) );
        }


        /**
         * Include required files
         *
         * @access      private
         * @author      Daniel J Griffiths
         * @since       3.0.0
         * @return      void
         */
        private function includes() {
            echo 'hi';
        }


        /**
         * Load framework language files
         *
         * @access      public
         * @author      Daniel J Griffiths
         * @since       3.0.0
         * @return      void
         */
        public function load_textdomain() {
            // Set filter for languages directory
            $redux_lang_dir = REDUX_DIR . 'languages/';
            $redux_lang_dir = apply_filters( 'redux_languages_directory', $redux_lang_dir );

            // Traditional WordPress locale filter
            $locale = apply_filters( 'framework_locale', get_locale(), 'redux' );
            $mofile = sprintf( '%1$s-%2$s.mo', 'redux', $locale );

            // Setup paths
            $mofile_local = $redux_lang_dir . $mofile;
            $mofile_global = WP_LANG_DIR . '/redux/' . $mofile;

            if( file_exists( $mofile_global ) ) {
                // Look in global /wp-content/languages/redux folder
                load_textdomain( 'redux', $mofile_global );
            } elseif( file_exists( $mofile_local ) ) {
                // Look in local Redux-Framework/languages folder
                load_textdomain( 'redux', $mofile_local );
            }
        }
    }
}
