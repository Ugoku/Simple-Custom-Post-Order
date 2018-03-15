<?php
$scporder_options = get_option('scporder_options');
$scporder_objects = isset($scporder_options['objects']) ? $scporder_options['objects'] : [];
$scporder_tags = isset($scporder_options['tags']) ? $scporder_options['tags'] : [];
?>

<div class="wrap">
    <h2><?php _e('Simple Custom Post Order Settings', 'scporder'); ?></h2>
    <?php if (isset($_GET['msg'])) : ?>
        <div id="message" class="updated below-h2">
            <?php if ($_GET['msg'] == 'update') : ?>
                <p><?php _e('Settings Updated.','scporder'); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <form method="post">

        <?php if (function_exists('wp_nonce_field')) wp_nonce_field('nonce_scporder'); ?>

        <div id="scporder_select_objects">

            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row"><?php _e('Check to Sort Post Types', 'scporder') ?></th> 
                        <td>
                            <label><input type="checkbox" id="scporder_allcheck_objects"> <?php _e('Check All', 'scporder') ?></label><br>
                            <?php
                            $post_types = get_post_types([
                                'show_ui' => true,
                                'show_in_menu' => true,
                            ], 'objects');

                            foreach ($post_types as $post_type) {
                                if ($post_type->name == 'attachment')
                                    continue;
                            ?>
                                <label><input type="checkbox" name="objects[]" value="<?php echo $post_type->name; ?>" <?php
                                    if (isset($scporder_objects) && is_array($scporder_objects)) {
                                        if (in_array($post_type->name, $scporder_objects)) {
                                            echo 'checked="checked"';
                                        }
                                    }
                                    ?>>&nbsp;<?php echo $post_type->label; ?></label><br>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>


        <div id="scporder_select_tags">
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row"><?php _e('Check to Sort Taxonomies', 'scporder') ?></th> 
                        <td>
                            <label><input type="checkbox" id="scporder_allcheck_tags"> <?php _e('Check All', 'scporder') ?></label><br>
                            <?php
                            $taxonomies = get_taxonomies([
                                'show_ui' => true,
                            ], 'objects');

                            foreach ($taxonomies as $taxonomy) {
                                if ($taxonomy->name == 'post_format')
                                    continue;
                            ?>
                                <label><input type="checkbox" name="tags[]" value="<?php echo $taxonomy->name; ?>" <?php
                                    if (isset($scporder_tags) && is_array($scporder_tags)) {
                                        if (in_array($taxonomy->name, $scporder_tags)) {
                                            echo 'checked="checked"';
                                        }
                                    }
                                    ?>>&nbsp;<?php echo $taxonomy->label ?></label><br>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div> 
        <p class="submit">
            <input type="submit" class="button-primary" name="scporder_submit" value="<?php _e('Update', 'scporder'); ?>">
        </p>

    </form>
</div>

<script>
    (function ($) {
        $('#scporder_allcheck_objects').on('click', function() {
            var items = $('#scporder_select_objects input');
            $(items).prop('checked', $(this).is(':checked'));
        });

        $('#scporder_allcheck_tags').on('click', function() {
            var items = $('#scporder_select_tags input');
            $(items).prop('checked', $(this).is(':checked'));
        });
    })(jQuery);
</script>
