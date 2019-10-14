<?php
defined( 'ABSPATH' ) || exit;

if(is_admin()){
    add_action('admin_menu','duplicate_post_menu');
    add_action('admin_init','duplicate_post_register_settings');
}

function duplicate_post_register_settings(){
    register_setting('duplicate_post_group','asdf');
    register_setting('duplicate_post_group','asdf');
    register_setting('duplicate_post_group','asdf');
    register_setting('duplicate_post_group','asdf');
    register_setting('duplicate_post_group','asdf');
    register_setting('duplicate_post_group','asdf');
    register_setting('duplicate_post_group','asdf');
    register_setting('duplicate_post_group','asdf');
    register_setting('duplicate_post_group','asdf');
}
function duplicate_post_menu(){
    add_options_page(__('Duplicate Post Options','azad-duplicate-post'), __('Duplicate Post','azad-duplicate-post'), 'manage_options','duplicatepost','duplicate_post_options');
}
function duplicate_post_options(){ ?>
    <div class="wrap">
        <div id="icon-options-general" class="icon32"><br/></div>
        <h1><?php esc_html_e('Duplidcate Post Options','azad-duplicate-post'); ?></h1>
        <div class="" style="margin:9px 15px 4px 0px;padding:5px 30px;text-align:center;float:left;clear:left;border:3px solid #cccccc;width:600px;">
            <p>
                <?php esc_html_e('Help me develop the plugin, Add new features and improve support!','azad-duplicate-post'); ?><br/>
                <?php esc_html_e('Donate whatever sum you choose, even just 10 dollars.','azad-duplicate-post'); ?><br/>
                <a href="https://duplicate-post.lopo.it/donate"><img id="donate-button" style="margin: 0px auto;" src="<?php echo plugins_url( 'donate.png', __FILE__ ); ?>" alt="Donate"/></a><br/>
                <a href="https://duplicate-post.lopo.it/"><?php esc_html_e('Documentation', 'duplicate-post'); ?></a>
		 - <a href="https://translate.wordpress.org/projects/wp-plugins/duplicate-post"><?php esc_html_e('Translate', 'duplicate-post'); ?></a>		 
		 - <a href="https://wordpress.org/support/plugin/duplicate-post"><?php esc_html_e('Support Forum', 'duplicate-post'); ?></a>
            </p>
        </div>
        <script>

        </script>
        <style>

        </style>
        <form class="" method="post" action="options.php" style="clear:both;">
            <h2 class="nav-tab-wrapper">
                <a class="nav-tab nav-tab-active" href="" >
                    <?php esc_html_e('What to copy','azad-duplicate-post'); ?>
                </a>
                <a class="nav-tab" href="" >
                    <?php esc_html_e('Permissions','azad-duplicate-post'); ?>
                </a>
                <a class="nav-tab" href="" >
                    <?php esc_html_e('Display','azad-duplicate-post'); ?>
                </a>
            </h2>
            <section>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">
                            <?php esc_html_e('Post / Page elements to copy','azad-duplicate-post'); ?>
                        </th>
                        <td>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Post list','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Edit screen','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Bulk actions','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                            </label>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <?php esc_html_e('Show update notice','azad-duplicate-post'); ?>
                        </th>
                        <td>
                            <input type="checkbox" name="duplicate_post_show_notice" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <?php esc_html_e('Show update notice','azad-duplicate-post'); ?>
                        </th>
                        <td>
                            <input type="checkbox" name="duplicate_post_show_notice" />
                        </td>
                    </tr>
                </table>
            </section>
            <section>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">
                            <?php esc_html_e('Show links in','azad-duplicate-post'); ?>
                        </th>
                        <td>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Post list','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Edit screen','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Bulk actions','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                            </label>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <?php esc_html_e('Show update notice','azad-duplicate-post'); ?>
                        </th>
                        <td>
                            <input type="checkbox" name="duplicate_post_show_notice" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <?php esc_html_e('Show update notice','azad-duplicate-post'); ?>
                        </th>
                        <td>
                            <input type="checkbox" name="duplicate_post_show_notice" />
                        </td>
                    </tr>
                </table>
            </section>
            <section>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">
                            <?php esc_html_e('Show links in','azad-duplicate-post'); ?>
                        </th>
                        <td>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Post list','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Edit screen','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Bulk actions','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                            </label>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <?php esc_html_e('Show update notice','azad-duplicate-post'); ?>
                        </th>
                        <td>
                            <input type="checkbox" name="duplicate_post_show_notice" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <?php esc_html_e('Show update notice','azad-duplicate-post'); ?>
                        </th>
                        <td>
                            <input type="checkbox" name="duplicate_post_show_notice" />
                        </td>
                    </tr>
                </table>
            </section>
            <p class="submit">
                <input type="button" class="button button-primary" value="<?php esc_html_e('Save Changes','azad-duplicate-post'); ?>"/>
            </p>
        </form>
    </div>    
<?php }