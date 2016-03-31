<?php
/*
Plugin Name: Customizer Demo
Plugin URI: https://geek.hellyer.kiwi/
Description: Demonstrates how to show/hide WordPress customizer settings based on existing settings.
Author: Ryan Hellyer
Version: 1.0
Author URI: https://geek.hellyer.kiwi/

Copyright (c) 2016 Ryan Hellyer

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License version 2 as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
license.txt file included with this plugin for more information.

*/



/**
 * Customizer Demo.
 */
class Customizer_Demo {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'theme_customizer' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'script' ) );
		add_action( 'customize_controls_print_styles', array( $this, 'customizer_styles' ), 999 );
	}

	/**
	 * Adds some styles to the WordPress Customizer.
	 */
	public function customizer_styles() {
		if ( 'version_2' != get_theme_mod( 'demo_setup' ) ) {
			?>
			<style>
				#customize-control-demo_setup_extra {
					display: none !important;
				}
			</style><?php
		}

	}

	/**
	 * Adding the customizer script.
	 */
	public function script() {

		wp_enqueue_script( 
			'customizer-demo',
			plugin_dir_url( __FILE__ ) . 'customizer-demo.js',
			array( 'jquery','customize-preview' ),
			'1.0',
			true
		);
	}

	/**
	 * Theme customizer settings with real-time update.
	 *
	 * @param  object  $wp_customize  The customiser object
	 */
	public function theme_customizer( $wp_customize ) {

		// Section
		$wp_customize->add_section(
			'demo_options',
			array (
				'title'         => __( 'Version', 'customizer-demo' ),
				'priority'      => 1,
			)
		);

		$wp_customize->add_setting(
			'demo_setup',
			array(
				'default'   => 'version_0',
				'transport' => 'refresh',
				'sanitize_callback' => 'esc_html'
			)
		);

		$wp_customize->add_control(
			'demo_setup',
			array(
				'section'   => 'demo_options',
				'label'     => __( 'Choose version', 'customizer-demo' ),
				'setting'   => 'demo_setup',
				'type'      => 'radio',
				'choices'   => $layout = array(
					'version_1' => __( 'Version 1', 'customizer-demo' ),
					'version_2' => __( 'Version 2', 'customizer-demo' ),
					'version_3' => __( 'Version 3', 'customizer-demo' ),
				)
			)
		);

		$wp_customize->add_setting(
			'demo_setup_extra',
			array(
				'default'   => 'version_0',
				'transport' => 'refresh',
				'sanitize_callback' => 'esc_html'
			)
		);

		$wp_customize->add_control(
			'demo_setup_extra',
			array(
				'section'   => 'demo_options',
				'label'     => __( 'Choose version', 'customizer-demo' ),
				'setting'   => 'demo_setup',
				'type'      => 'radio',
				'choices'   => $layout = array(
					'version_4' => __( 'Version 4', 'customizer-demo' ),
					'version_5' => __( 'Version 5', 'customizer-demo' ),
					'version_6' => __( 'Version 6', 'customizer-demo' ),
				)
			)
		);

	}

}
new Customizer_Demo;
