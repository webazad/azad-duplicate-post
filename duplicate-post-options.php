<?php
defined( 'ABSPATH' ) || exit;

if(is_admin()){
    add_action('admin_menu','duplicate_post_menu');
    add_action('admin_init','duplicate_post_register_settings');
}

function duplicate_post_register_settings(){
    register_setting('duplicate_post_group','duplicate_post_copytitle');
    register_setting('duplicate_post_group','duplicate_post_copydate');
    register_setting('duplicate_post_group','duplicate_post_copystatus');
    register_setting('duplicate_post_group','duplicate_post_copyslug');
    register_setting('duplicate_post_group','duplicate_post_copyexcerpt');
    register_setting('duplicate_post_group','duplicate_post_copycontent');
    register_setting('duplicate_post_group','duplicate_post_copythumbnail');
    register_setting('duplicate_post_group','duplicate_post_copytemplate');
    register_setting('duplicate_post_group','duplicate_post_copyformat');
    register_setting('duplicate_post_group','duplicate_post_copyauthor');
    register_setting('duplicate_post_group','duplicate_post_copypassword');
    register_setting('duplicate_post_group','duplicate_post_copyattachment');
    register_setting('duplicate_post_group','duplicate_post_copymenuorder');
    register_setting('duplicate_post_group','duplicate_post_blacklist');
    register_setting('duplicate_post_group','duplicate_post_taxonomies_blacklist');
    register_setting('duplicate_post_group','duplicate_post_title_prefix');
    register_setting('duplicate_post_group','duplicate_post_title_suffix');
    register_setting('duplicate_post_group','duplicate_post_increase_menu_order_by');
    register_setting('duplicate_post_group','duplicate_post_roles');
    register_setting('duplicate_post_group','duplicate_post_types_enabled');
    register_setting('duplicate_post_group','duplicate_post_show_row');
    register_setting('duplicate_post_group','duplicate_post_show_adminbar');
    register_setting('duplicate_post_group','duplicate_post_show_submitbox');
    register_setting('duplicate_post_group','duplicate_post_show_bulkactions');
    register_setting('duplicate_post_group','duplicate_post_show_notice');
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
            jQuery(document).on('click','.nav-tab-wrapper a',function(){
                jQuery('.nav-tab').removeClass('nav-tab-active');
                jQuery(this).addClass('nav-tab-active');
                jQuery('section').hide();
                jQuery('section').eq(jQuery(this).index()).show();
            });
        </script>
        <style>
            h2.nav-tab-wrapper{
                margin:22px 0 0 0;
            }
            h2 .nav-tab:focus{
                color: #555;
                box-shadow: none;
            }
            #sections{
                padding: 22px;
                background: #ffffff;
                border: 1px soild #cccccc;
                border-top: 0px;
            }
            section{
                display: none;
            }
            section:first-of-type{
                display: block;
            }
            .no-js h2.nav-tab-wrapper{
                display: none;
            }
            .no-js #sections{
                border-top: 1px solid #cccccc;
                margin-top: 22px;
            }
            .no-js section{
                border-top: 1px dashed #cccccc;
                margin-top: 22px;
                padding-top: 22px;
            }
            .no-js section:first-child{
                margin: 0px;
                border: 0px;
                padding: 0px;
            }
            label{
                display: block;
            }
            label.taxonomy_private{
                font-style: italic;
            }
            a.toggle_link{
                font-size: small;
            }
            img#donate-button{
                vertical-align: middle;
            }
        </style>
        <form class="" method="post" action="options.php" style="clear:both;">
            <h2 class="nav-tab-wrapper">
                <a class="nav-tab nav-tab-active" href="<?php echo admin_url() ?>/index.php?page=duplicate-post-what">
                    <?php esc_html_e('What to copy','azad-duplicate-post'); ?>
                </a>
                <a class="nav-tab" href="<?php echo admin_url() ?>/index.php?page=duplicate-post-who">
                    <?php esc_html_e('Permissions','azad-duplicate-post'); ?>
                </a>
                <a class="nav-tab" href="<?php echo admin_url() ?>/index.php?page=duplicate-post-where">
                    <?php esc_html_e('Display','azad-duplicate-post'); ?>
                </a>
            </h2>
            <section>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">
                            <?php esc_html_e('Post / Page elements to copy','azad-duplicate-post'); ?>
                        </th>
                        <td colspan="2">
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Title','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Date','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Status','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Slug','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Excerpt','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Content','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Featured image','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Template','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Format','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Author','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Password','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Attachment','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Children','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Comments','azad-duplicate-post'); ?>
                            </label>
                            <label>
                                <input type="checkbox" name="duplicate_post_show_row" value="1" />
                                <?php esc_html_e('Menu order','azad-duplicate-post'); ?>
                            </label>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <?php esc_html_e('Title prefix','azad-duplicate-post'); ?>
                        </th>
                        <td>
                            <input type="text" name="duplicate_post_show_notice" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <?php esc_html_e('Title prefix','azad-duplicate-post'); ?>
                        </th>
                        <td>
                            <input type="text" name="duplicate_post_show_notice" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <?php esc_html_e('Title prefix','azad-duplicate-post'); ?>
                        </th>
                        <td>
                            <input type="text" name="duplicate_post_show_notice" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <?php esc_html_e('Title prefix','azad-duplicate-post'); ?>
                        </th>
                        <td>
                            <input type="text" name="duplicate_post_show_notice" />
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