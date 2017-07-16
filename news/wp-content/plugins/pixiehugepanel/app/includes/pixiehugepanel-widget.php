<?php

class PixieHugePanel_LatestNews_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'pixiehuge_latest_news_widget',
			// Widget name will appear in UI
			esc_html__('PixieHuge | Latest News', 'pixiehugepanel'),

			// Widget description
			array('description' => esc_html__( 'This is your most popular news widget', 'pixiehugepanel' ), 'classname' => 'latest-article')
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if(!empty($title))
			echo $args['before_title'] . $title . $args['after_title'];


        $twoPosts = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 5,
            'order' => 'DESC',
            'orderby' => 'date'
        ));

        echo '<ul class="widget">';
        if( $twoPosts->have_posts() ): // if there is posts

            while( $twoPosts->have_posts() ): // posts loop
                $twoPosts->the_post();

                $cat = get_the_category(); // Get categories
                $categories = ''; // Default = '';

                if(!empty($cat)) {
                    $catNum = 0;
                    foreach( $cat as $catItem ){
                        $categories .= '<a href="' . esc_url(get_category_link($catItem->term_id)) . '" class="category">' .esc_attr($catItem->name). '</a>';
                        $catNum ++;
                        if(count($cat) != $catNum) {
                            $categories .='<i class="bull">&bull;</i> ';
                        }
                    }
                } // if is not empty

                // Show Categories
                $cats = $categories;

                // Get title
                $getTitle = get_the_title();
        ?>
            <li>
                <div class="thumbnail" style="background-image: url('<?php the_post_thumbnail_url( get_the_ID(), 'pixiehuge-widget-thumbnail'); ?>');"></div>
                <div class="details">
                    <span class="categories">
                        <?php echo $cats; ?>
                    </span>
                    <a href="<?php the_permalink(); ?>" class="title">
                        <?php the_title(); ?>
                    </a>
                    <span class="date"><?php echo esc_attr(get_the_date()); ?></span>
                </div>
            </li>
        <?php
            endwhile;  // end post loop

        else: // if there is no posts
            esc_html_e('There is no posts, yet.', 'pixiehugepanel');
        endif;

        echo '</ul>';

		// This is where you run the code and display the output
		echo $args['after_widget'];
	}
		
	public function form( $instance ) {
		if (isset($instance[ 'title' ])) {
			$title = $instance[ 'title' ];
		}
		else { 
			$title = esc_html__( 'Latest News', 'pixiehugepanel' );
		}
		// Widget admin form
		?>
			<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
		<?php 
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}

class PixieHugePanel_PopularNews_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'pixiehuge_most_popular_news_widget',
			// Widget name will appear in UI
			esc_html__('PixieHuge | Most popular news', 'pixiehugepanel'),

			// Widget description
			array( 'description' => esc_html__( 'This is your latest news widget', 'pixiehugepanel' ), 'classname' => 'most-popular')
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];


        $twoPosts = new WP_Query( array(
            'post_type' => 'post',
            'posts_per_page' => 5,
            'order' => 'DESC',
            'orderby' => 'comment_count'
        ) );

        echo '<ul class="widget most-popular">';
        if( $twoPosts->have_posts() ): // if there is posts

            while( $twoPosts->have_posts() ): // posts loop
                $twoPosts->the_post();

                $cat = get_the_category(); // Get categories
                $categories = ''; // Default = '';

                if(!empty($cat)) {
                    $catNum = 0;
                    foreach( $cat as $catItem ){
                        $categories .= '<a href="' . esc_url(get_category_link($catItem->term_id)) . '" class="category">' .esc_attr($catItem->name). '</a>';
                        $catNum ++;
                        if(count($cat) != $catNum) {
                            $categories .='<i class="bull">&bull;</i> ';
                        }
                    }
                } // if is not empty

                // Show Categories
                $cats = $categories;
        ?>
            <li>
                <div class="details">
                    <span class="categories">
                        <?php echo $cats; ?>
                    </span>
                    <a href="<?php the_permalink(); ?>" class="title">
                        <?php the_title(); ?>
                    </a>
                    <span class="date"><?php echo esc_attr(get_the_date()); ?></span>
                </div>

                <a href="<?php the_permalink(); ?>" class="right">
                    <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12px" height="10px"><path fill-rule="evenodd"  fill="rgb(175, 175, 188)" d="M6.245,0.240 C5.910,0.565 5.910,1.092 6.245,1.418 L9.065,4.160 L0.855,4.160 C0.382,4.160 -0.001,4.533 -0.001,4.993 C-0.001,5.453 0.382,5.826 0.855,5.826 L9.065,5.826 L6.245,8.569 C5.910,8.894 5.910,9.421 6.245,9.746 C6.579,10.071 7.121,10.071 7.456,9.746 L11.738,5.582 C11.893,5.431 11.989,5.223 11.989,4.993 C11.989,4.763 11.893,4.555 11.738,4.404 L7.456,0.240 C7.121,-0.085 6.579,-0.085 6.245,0.240 Z"/></svg>
                </a>
            </li>

        <?php
            endwhile;  // end post loop

        else: // if there is no posts
            esc_html_e('There is no posts, yet.', 'pixiehype');
        endif;

        echo '</ul>';

		// This is where you run the code and display the output
		echo $args['after_widget'];
	}
		
	public function form( $instance ) {
		if (isset($instance[ 'title' ])) {
			$title = $instance[ 'title' ];
		}
		else { 
			$title = esc_html__( 'Most popular News', 'pixiehugepanel' );
		}
		// Widget admin form
		?>
			<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
		<?php 
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}

// Register and load the widget
function pixiehuge_load_widget() {
	register_widget( 'PixieHugePanel_LatestNews_Widget' );
	register_widget( 'PixieHugePanel_PopularNews_Widget' );
}

add_action( 'widgets_init', 'pixiehuge_load_widget' );