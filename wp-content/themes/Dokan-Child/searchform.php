<?php
/**
 * The template for displaying search forms in Tareq\'s Planet - 2013
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
    <div class="input-group">
        <input type="text" class="form-control" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'What are you looking for?', 'dokan' ); ?>" autocomplete="off" />
        <span class="input-group-btn">
            <button class="search_button" id="searchsubmit" type="submit"><i class="fa fa-search"></i></button>
        </span>
    </div><!-- /input-group -->
</form>
