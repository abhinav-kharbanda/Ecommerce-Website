<?php
   /**
    * The template for displaying search forms in Tareq\'s Planet - 2013
    *
    * @package dokan
    * @package dokan - 2014 1.0
    */
?>
<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" role="search" style="width: 100%">
    <div class="col-md-9 search-home ">
        <input placeholder="Search ..." value="" name="s" id="s" type="text">
        <input id="location" value="cambridge-uk" name="location" type="hidden">
        <input  value="" name="category_name" type="hidden">
        <input type="hidden" name="sentence" value="1" />
        <div class="btn-group show-box-category">
            <button class="btn btn-default dropdown-toggle" type="button" >
                All Categories<i class="fa fa-arrow-down"></i>
            </button>
            <ul class="dropdown-menu" role="menu">            
                <li class="checked" data-slug="">
                    <span class="icon" data-icon="3"></span>
                    All Categories                                                   
                </li>
                <li data-slug="electronics"><span class="text">Electronics</span></li>
                <li data-slug="events-notices"><span class="text">Events &amp; Notices</span></li>
                <li data-slug="services-professionals"><span class="text">Services &amp; Professionals</span></li>
                <li data-slug="recreation-vehicles"><span class="text">Recreation Vehicles</span></li>
                <li data-slug="home-garden"><span class="text">Home &amp; Garden</span></li>
                <li data-slug="collectibles-art"><span class="text">Collectibles &amp; art</span></li>
                <li data-slug="entertainment"><span class="text">Entertainment</span></li>
                <li data-slug="other-categories"><span class="text">Other categories</span></li>
            </ul>
        </div>
    </div>              
    <div class="btn btn-primary  button-search search-top">
        <i class="fa fa-search"></i>
    </div>
    <!-- <div class="input-group">
         <input type="text" class="form-control" name="s" value="<?php echo esc_attr(get_search_query()); ?>" id="s" placeholder="<?php esc_attr_e('Search &hellip;', 'dokan'); ?>" autocomplete="off" />
         <input type=""
 </div>
         <span class="input-group-btn">
             <button class="search_button" id="searchsubmit" type="submit"><i class="fa fa-search"></i></button>
         </span>
    <!-- /input-group -->
</form>
