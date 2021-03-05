<?php

namespace LazyLoadOptimizer\Admin\Customizer;

class CustomizeDonate extends \WP_Customize_Control
{
    public function render_content()
    {
        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
        </label>
        <a href="https://www.paypal.me/processby">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" />
        </a>
        <?php
    }

}