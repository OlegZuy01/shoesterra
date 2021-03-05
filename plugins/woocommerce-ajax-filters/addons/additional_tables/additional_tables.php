<?php
class BeRocket_aapf_variations_tables_addon extends BeRocket_framework_addon_lib {
    public $addon_file = __FILE__;
    public $plugin_name = 'ajax_filters';
    public $php_file_name   = 'add_table';
    public $last_postion = 9;
    public $position_data = array(
        1 => array(
            'percentage' => 0
        ),
        2 => array(
            'percentage' => 7
        ),
        3 => array(
            'percentage' => 0
        ),
        4 => array(
            'percentage' => 90
        ),
        5 => array(
            'percentage' => 0
        ),
        6 => array(
            'percentage' => 2
        ),
        7 => array(
            'percentage' => 0
        ),
        8 => array(
            'percentage' => 1
        ),
        9 => array(
            'percentage' => 0
        ),
    );
    function __construct() {
        parent::__construct();
        $active_addons = apply_filters('berocket_addons_active_'.$this->plugin_name, array());
        $create_position = $this->get_current_create_position();
        if( in_array($this->addon_file, $active_addons) ) {
            if( $create_position < $this->last_postion ) {
                $this->activate();
                $this->activate_hooks();
            }
        } else {
            if( ! empty($create_position) ) {
                $this->deactivate();
            }
        }
    }
    function get_addon_data() {
        $data = parent::get_addon_data();
        return array_merge($data, array(
            'addon_name'    => __('Additional Tables (BETA)', 'BeRocket_AJAX_domain'),
            'tooltip'       => __('Create 4 additional tables.<ul><li>Table to speed up hierarchical taxonomies recount: <strong>Product categories</strong>, <strong>Brands</strong> etc</li><li>3 tables to speed up functions for variation filtering</li></ul>', 'BeRocket_AJAX_domain'),
        ));
    }
    function check_init() {
        $create_position = get_option('BeRocket_aapf_additional_tables_addon_position');
        if( $create_position >= $this->last_postion ) {
            parent::check_init();
        }
    }
    function get_current_create_position() {
        return get_option('BeRocket_aapf_additional_tables_addon_position');
    }
    function set_current_create_position($position) {
        update_option('BeRocket_aapf_additional_tables_addon_position', $position);
    }
    function get_current_create_position_data() {
        return get_option('BeRocket_aapf_additional_tables_addon_position_data');
    }
    function set_current_create_position_data($data) {
        update_option('BeRocket_aapf_additional_tables_addon_position_data', $data);
    }
    function activate($current_position = -1) {
        if( $current_position == -1 ) {
            $current_position = $this->get_current_create_position();
        }
        if( empty($current_position) ) {
            $this->create_table_braapf_product_stock_status_parent();
        } elseif( $current_position == 3 ) {
            $this->create_table_braapf_product_variation_attributes();
        } elseif( $current_position == 5 ) {
            $this->create_table_braapf_variation_attributes();
        } elseif( $current_position == 7 ) {
            $this->create_table_braapf_term_taxonomy_hierarchical();
        } elseif( $current_position == 8 ) {
            new berocket_information_notices(array(
                'name'  => $this->plugin_name.'_additional_table_status_end',
                'html'  => '<strong>BeRocket AJAX Product Filters</strong> '.__('Additional tables was succesfully generated. They will be used automatically when needed.', 'BeRocket_AJAX_domain'),
                'righthtml'  => '<a class="berocket_no_thanks">Got it</a>',
                'rightwidth'  => 50,
                'nothankswidth'  => 50,
                'contentwidth'  => 400,
                'subscribe'  => false,
                'height'  => 50,
            ));
            $this->set_current_create_position(9);
        }
    }
    function activate_hooks() {
        add_action('berocket_create_table_braapf_product_stock_status_parent', array($this, 'insert_table_braapf_product_stock_status_parent'), 10, 3);
        add_action('berocket_create_table_braapf_product_variation_attributes', array($this, 'insert_table_braapf_product_variation_attributes'), 10, 3);
        add_action('berocket_create_table_braapf_variation_attributes', array($this, 'insert_table_braapf_variation_attributes'), 10);
        //Notices
        add_filter('berocket_display_additional_notices', array($this, 'status_notice'));
        add_action( "wp_ajax_braapf_additional_table_status", array( $this, 'get_global_status_ajax' ) );
        add_action( "wp_footer", array( $this, 'script_update' ) );
        add_action( "admin_footer", array( $this, 'script_update' ) );
    }
    function status_notice($notices) {
        $current_status = $this->get_current_global_status();
        $notices[] = array(
            'start'         => 0,
            'end'           => 0,
            'name'          => $this->plugin_name.'_additional_table_status',
            'html'          => '<strong>BeRocket AJAX Product Filters</strong> '.sprintf(__('Additional tables are generating. They will be used after generation is completed. Current status is <strong><span class="braapf_additional_table_status">%d</span>%%</strong>', 'BeRocket_AJAX_domain'), $current_status),
            'righthtml'     => '',
            'rightwidth'    => 0,
            'nothankswidth' => 0,
            'contentwidth'  => 1600,
            'subscribe'     => false,
            'priority'      => 10,
            'height'        => 70,
            'repeat'        => false,
            'repeatcount'   => 1,
            'image'         => array(
                'local'  => '',
                'width'  => 0,
                'height' => 0,
                'scale'  => 1,
            )
        );
        return $notices;
    }
    function script_update() {
        echo '<script>
        if( jQuery(".braapf_additional_table_status").length ) {
            var braapf_additional_table_status = setInterval(function() {
                jQuery.get(ajaxurl, {action:"braapf_additional_table_status"}, function(data) {
                    data = parseInt(data);
                    jQuery(".braapf_additional_table_status").text(data);
                    if( data >= 100 ) {
                        clearInterval(braapf_additional_table_status);
                    }
                }).error(function() {
                    clearInterval(braapf_additional_table_status);
                    jQuery(".braapf_additional_table_status").parents(".berocket_admin_notice").remove();
                });
            }, 4000);
        }
        </script>';
    }
    function get_global_status_ajax() {
        echo $this->get_current_global_status();
        wp_die();
    }
    function get_current_global_status($current_position = -1) {
        if( $current_position == -1 ) {
            $current_position = $this->get_current_create_position();
        }
        $position_data = $this->get_current_create_position_data();
        $position_status = br_get_value_from_array($position_data, 'status', 0);
        $global_status = 0;
        foreach($this->position_data as $position_i => $position_data_arr) {
            if( $position_i < $current_position ) {
                $global_status += $position_data_arr['percentage'];
            } elseif( $position_i == $current_position ) {
                $global_status += ( $position_data_arr['percentage'] / 100 * $position_status );
            }
        }
        $global_status = intval($global_status);
        return $global_status;
    }
    function create_table_braapf_product_stock_status_parent() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        $table_name = $wpdb->prefix . 'braapf_product_stock_status_parent';
        $sql = "DROP TABLE IF EXISTS {$table_name};";
        $wpdb->query($sql);
        $sql = "CREATE TABLE $table_name (
        post_id BIGINT NOT NULL,
        parent_id BIGINT NOT NULL,
        stock_status TINYINT,
        PRIMARY KEY (post_id),
        INDEX stock_status (stock_status)
        ) $charset_collate;";
        dbDelta( $sql );
        $sql = "SELECT MIN({$wpdb->prefix}wc_product_meta_lookup.product_id) as min, MAX({$wpdb->prefix}wc_product_meta_lookup.product_id) as max FROM {$wpdb->prefix}wc_product_meta_lookup";
        $product_data = $wpdb->get_row($sql);
        $this->set_current_create_position_data(array('status' => 0));
        if( ! empty($product_data) && ! empty($product_data->min) && ! empty($product_data->max) ) {
            $this->set_current_create_position(2);
            $this->activate();
            wp_schedule_single_event( (time()+1), 'berocket_create_table_braapf_product_stock_status_parent', array($product_data->min, $product_data->min, $product_data->max) );
        } else {
            $this->set_current_create_position(3);
            $this->activate();
        }
    }
    function insert_table_braapf_product_stock_status_parent($start_id, $min_id, $max_id) {
        $end_id = $start_id + 50000;
        global $wpdb;
        $table_name = $wpdb->prefix . 'braapf_product_stock_status_parent';
        $charset_collate = $wpdb->get_charset_collate();
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        $sql = "INSERT INTO {$table_name}
        SELECT {$wpdb->posts}.ID as post_id, {$wpdb->posts}.post_parent as parent_id, IF({$wpdb->prefix}wc_product_meta_lookup.stock_status = 'instock', 1, 0) as stock_status FROM {$wpdb->prefix}wc_product_meta_lookup
        JOIN {$wpdb->posts} ON {$wpdb->prefix}wc_product_meta_lookup.product_id = {$wpdb->posts}.ID
        WHERE {$wpdb->prefix}wc_product_meta_lookup.product_id >= {$start_id} AND {$wpdb->prefix}wc_product_meta_lookup.product_id < {$end_id}";
        $wpdb->query($sql);
        $status = max(0, min(100, (($end_id - $min_id) / ($max_id - $min_id) * 100)));
        $this->set_current_create_position_data(array('status' => $status));
        if( $end_id <= $max_id ) {
            wp_schedule_single_event( (time()+1), 'berocket_create_table_braapf_product_stock_status_parent', array($end_id, $min_id, $max_id) );
        } else {
            $this->set_current_create_position(3);
            $this->activate();
        }
    }
    function create_table_braapf_product_variation_attributes() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        $table_name = $wpdb->prefix . 'braapf_product_variation_attributes';
        $sql = "DROP TABLE IF EXISTS {$table_name};";
        $wpdb->query($sql);
        $sql = "CREATE TABLE $table_name (
        post_id BIGINT NOT NULL,
        parent_id BIGINT NOT NULL,
        meta_key VARCHAR(255) NOT NULL,
        meta_value_id BIGINT NOT NULL,
        INDEX post_id (post_id),
        INDEX meta_key (meta_key),
        INDEX meta_value_id (meta_value_id)
        ) $charset_collate;";
        dbDelta( $sql );
        $sql = "SELECT MIN({$wpdb->postmeta}.meta_id) as min, MAX({$wpdb->postmeta}.meta_id) as max FROM {$wpdb->postmeta}";
        $postmeta_data = $wpdb->get_row($sql);
        $this->set_current_create_position_data(array('status' => 0));
        if( ! empty($postmeta_data) && ! empty($postmeta_data->min) && ! empty($postmeta_data->max) ) {
            $this->set_current_create_position(4);
            $this->activate();
            wp_schedule_single_event( (time()+1), 'berocket_create_table_braapf_product_variation_attributes', array($postmeta_data->min, $postmeta_data->min, $postmeta_data->max) );
        } else {
            $this->set_current_create_position(5);
            $this->activate();
        }
    }
    function insert_table_braapf_product_variation_attributes($start_id, $min_id, $max_id) {
        $end_id = $start_id + 50000;
        global $wpdb;
        $table_name = $wpdb->prefix . 'braapf_product_variation_attributes';
        $charset_collate = $wpdb->get_charset_collate();
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        $sql = "INSERT INTO {$table_name}
        SELECT {$wpdb->postmeta}.post_id as post_id, {$wpdb->posts}.post_parent as parent_id, {$wpdb->term_taxonomy}.taxonomy as meta_key, {$wpdb->terms}.term_id as meta_value_id FROM {$wpdb->postmeta}
        JOIN {$wpdb->term_taxonomy} ON CONCAT('attribute_', {$wpdb->term_taxonomy}.taxonomy) = {$wpdb->postmeta}.meta_key
        JOIN {$wpdb->terms} ON {$wpdb->terms}.term_id = {$wpdb->term_taxonomy}.term_id AND {$wpdb->postmeta}.meta_value = {$wpdb->terms}.slug
        JOIN {$wpdb->posts} ON {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID
        WHERE {$wpdb->postmeta}.meta_id >= {$start_id} AND {$wpdb->postmeta}.meta_id < {$end_id}
        AND {$wpdb->postmeta}.meta_key LIKE 'attribute_pa_%'";
        $wpdb->query($sql);
        $sql = "INSERT INTO {$table_name}
        SELECT {$wpdb->posts}.ID as post_id, {$wpdb->posts}.post_parent as parent_id, {$wpdb->term_taxonomy}.taxonomy as meta_key, {$wpdb->term_taxonomy}.term_id as meta_value_id
        FROM {$wpdb->postmeta}
        JOIN {$wpdb->posts} ON {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID
        JOIN {$wpdb->term_relationships} ON {$wpdb->posts}.post_parent = {$wpdb->term_relationships}.object_id
        JOIN {$wpdb->term_taxonomy} ON {$wpdb->term_relationships}.term_taxonomy_id = {$wpdb->term_taxonomy}.term_taxonomy_id 
            AND CONCAT('attribute_', {$wpdb->term_taxonomy}.taxonomy) = {$wpdb->postmeta}.meta_key
        WHERE {$wpdb->postmeta}.meta_id >= {$start_id} AND {$wpdb->postmeta}.meta_id < {$end_id}
        AND {$wpdb->postmeta}.meta_key LIKE 'attribute_pa_%' AND {$wpdb->postmeta}.meta_value = ''";
        $wpdb->query($sql);
        $status = max(0, min(100, (($end_id - $min_id) / ($max_id - $min_id) * 100)));
        $this->set_current_create_position_data(array('status' => $status));
        if( $end_id <= $max_id ) {
            wp_schedule_single_event( (time()+1), 'berocket_create_table_braapf_product_variation_attributes', array($end_id, $min_id, $max_id) );
        } else {
            $this->set_current_create_position(5);
            $this->activate();
        }
    }
    function create_table_braapf_variation_attributes() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        $table_name = $wpdb->prefix . 'braapf_variation_attributes';
        $sql = "DROP TABLE IF EXISTS {$table_name};";
        $wpdb->query($sql);
        $sql = "CREATE TABLE $table_name (
        post_id BIGINT(20) NOT NULL,
        taxonomy varchar(32) NOT NULL,
        INDEX post_id (post_id),
        INDEX taxonomy (taxonomy)
        ) $charset_collate;";
        dbDelta( $sql );
        $this->set_current_create_position_data(array('status' => 0));
        $this->set_current_create_position(6);
        $this->activate();
        wp_schedule_single_event( (time()+1), 'berocket_create_table_braapf_variation_attributes' );
    }
    function insert_table_braapf_variation_attributes() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'braapf_variation_attributes';
        $charset_collate = $wpdb->get_charset_collate();
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        $sql = "INSERT INTO {$table_name}
        SELECT parent_id as post_id, meta_key as taxonomy
        FROM {$wpdb->prefix}braapf_product_variation_attributes
        GROUP BY meta_key, parent_id";
        $wpdb->query($sql);
        $this->set_current_create_position_data(array('status' => 100));
        $this->set_current_create_position(7);
        $this->activate();
    }
    function create_table_braapf_term_taxonomy_hierarchical() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        $table_name = $wpdb->prefix . 'braapf_term_taxonomy_hierarchical';
        $sql = "DROP TABLE IF EXISTS {$table_name};";
        $wpdb->query($sql);
        $sql = "CREATE TABLE $table_name (
        term_taxonomy_id BIGINT(20) NOT NULL,
        term_id BIGINT(20) NOT NULL,
        term_taxonomy_child_id BIGINT(20) NOT NULL,
        term_child_id BIGINT(20) NOT NULL,
        taxonomy varchar(32) NOT NULL,
        INDEX term_taxonomy_id (term_taxonomy_id),
        INDEX term_taxonomy_child_id (term_taxonomy_child_id),
        INDEX child_parent_id (term_taxonomy_id, term_taxonomy_child_id)
        ) $charset_collate;";
        dbDelta( $sql );
        $this->set_current_create_position(8);
    }
    function deactivate() {
        global $wpdb;
        wp_unschedule_hook('berocket_create_table_braapf_product_stock_status_parent');
        wp_unschedule_hook('berocket_create_table_braapf_product_variation_attributes');
        wp_unschedule_hook('berocket_create_table_braapf_variation_attributes');
        $tables_drop = array(
            'braapf_product_stock_status_parent',
            'braapf_product_variation_attributes',
            'braapf_variation_attributes',
            'braapf_term_taxonomy_hierarchical'
        );
        foreach($tables_drop as $table_drop) {
            $table_name = $wpdb->prefix . $table_drop;
            $sql = "DROP TABLE IF EXISTS {$table_name};";
            $wpdb->query($sql);
        }
        $wpdb->query("DELETE FROM {$wpdb->prefix}options WHERE option_name LIKE '%br_custom_table_hierarhical_%';");
        $this->set_current_create_position(false);
    }
}
new BeRocket_aapf_variations_tables_addon();
