<?php
//the settings page of theme
//register function settings
function theme_settings_init()
{
    register_setting('theme_settings', 'theme_settings');
}
// add page setting to menu
function add_settings_page() {
    add_menu_page( __( 'Theme Options' ), __( 'Theme Options' ), 'manage_options', 'settings', 'theme_settings_page');
}
//add action
add_action( 'admin_init', 'theme_settings_init' );
add_action( 'admin_menu', 'add_settings_page' );
//save settings
function theme_settings_page() {
    global $select_options; if ( ! isset( $_REQUEST['settings-updated'] ) ) $_REQUEST['settings-updated'] = false;
?>
<div>
    <h2 id="title">Настройка темы</h2>
    <?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
        <div id="message" class="updated">
            <p><strong>Настройки сохранены</strong></p>
        </div>
    <?php endif; ?>
    <form method="post" action="options.php">
        <?php settings_fields( 'theme_settings' ); ?>
        <?php $options = get_option( 'theme_settings' ); ?>
        <table>
            <tr valign="top">
                <td>Logo</td>
                <td><input id="theme_settings[custom_logo]" type="text" size="38" name="theme_settings[custom_logo]" value="<?php esc_attr_e( $options['custom_logo'] ); ?>" /></td>
                <td><label> - Please, write new path to your logo. </label></td>
            </tr>
            <tr valign="top">
                <td>Link for twitter</td>
                <td><input id="theme_settings[link_twitter]" type="text" size="38" name="theme_settings[link_twitter]" value="<?php esc_attr_e( $options['link_twitter'] ); ?>" /></td>
                <td><label> - Please, write link on your twitter. </label></td>
            </tr>
            <tr valign="top">
                <td>Link for linkedin</td>
                <td><input id="theme_settings[link_linkedin]" type="text" size="38" name="theme_settings[link_linkedin]" value="<?php esc_attr_e( $options['link_linkedin'] ); ?>" /></td>
                <td><label> - Please, write link on your linkedin. </label></td>
            </tr>
            <tr valign="top">
                <td>Link for facebook</td>
                <td><input id="theme_settings[link_facebook]" type="text" size="38" name="theme_settings[link_facebook]" value="<?php esc_attr_e( $options['link_facebook'] ); ?>" /></td>
                <td><label> - Please, write link on your facebook. </label></td>
            </tr>
            <tr valign="top">
                <td>Link for instagram</td>
                <td><input id="theme_settings[link_instagram]" type="text" size="38" name="theme_settings[link_instagram]" value="<?php esc_attr_e( $options['link_instagram'] ); ?>" /></td>
                <td><label> - Please, write link on your instagram. </label></td>
            </tr>
<!--            <tr valign="top">-->
<!--                <td>Текст в подвале</td>-->
<!--                <td><textarea id="theme_settings[footer]" name="theme_settings[footer]" rows="5" cols="36">--><?php //esc_attr_e( $options['footer'] ); ?><!--</textarea></td>-->
<!--                <td><label> - Можете ввести свой текст, ссылки и права на копирайт. Можно использовать html теги. </label></td>-->
<!--            </tr>-->
<!--            <tr valign="top">-->
<!--                <td>Метрика</td>-->
<!--                <td><textarea id="theme_settings[tracking]" name="theme_settings[tracking]" rows="5" cols="36">--><?php //esc_attr_e( $options['tracking'] ); ?><!--</textarea></td>-->
<!--                <td><label> - здесь можно прописать коды счетчиков или дополнительных скриптов</label></td>-->
<!--            </tr>-->
        </table>
        <p><input name="submit" id="submit" class="button button-primary" value="Upload" type="submit"></p>
    </form>
</div>
<?php } ?>

