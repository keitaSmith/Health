<?php
/**
 * The template for displaying search forms in Infruit
 *
 * @package Infruit
 */
?>

<div class="search-form">
    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	    <div class="input-group add-on">
		    <input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'infruit' ); ?>" value="<?php the_search_query(); ?>" name="s">
		    <div class="input-group-btn">
			    <button class="btn btn-default" type="submit">
				    <i class="fa fa-search"></i>
			    </button>
	        </div>
        </div>
    </form>
</div>