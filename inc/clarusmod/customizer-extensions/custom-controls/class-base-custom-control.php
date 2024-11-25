<?php

/**
 * Custom Control Base Class
 *
 * @author Zeddy Emmanuel <https://zeddyemy.github.io/>
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */
class Clarusmod_Customize_Control extends WP_Customize_Control
{
    protected $clarusmodCustomCtrlsVersions = array(
        'css'    => '1.0.2',
        'js'     => '1.0.2'
    );

    protected function clarusmod_customizer_assets_url($type)
    {
        return trailingslashit(clarusmod_customizer_assets($type));
    }
}
