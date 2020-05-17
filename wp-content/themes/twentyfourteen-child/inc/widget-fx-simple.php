<?php


function forex_register_widget() {
    register_widget( 'forex_widget' );
}

add_action( 'widgets_init', 'forex_register_widget' );


class forex_widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'forex_widget',
            'Forex Simple Widget',
            array ('description' => 'Foreign Exchange Widget')
        );
    }
    
    
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        //if title is present
        if (!empty ($title)) {
            echo '<h2>'.$title.'</h2>';
        } else {
            echo '<h2>Foreign Exchange Currency Rates</h2>';
        }
        
        $response = $this->make_api_request();
        
        if (empty($response)){ ?>
            <div class="marquee" style="text-align:center;">
            	NO DATA AVAILABLE AT THE MOMENT!
            </div>
            
        <?php
        } else { ?>
        	Base Currency: EUR &nbsp;&nbsp;&nbsp;&nbsp;
        	Date: <?php echo($response->date); ?>
			<table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th>Currency</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                        if(!empty($response)){
                            foreach ($response->rates as $curr=>$val ){
                                echo('<tr><td>' . $curr . '</td>');
                                echo('<td>' . $val . '</td></tr>');
                            }
                        } else {
                            echo('<tr><td colspan=2> NO DATA CURRENTLY THIS TIME! </td></tr>');
                        }
                        ?>         
                </tbody>
            </table>
        <?php
        }
    }
        
    
    public function form( $instance ) {
        if (isset( $instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = 'Default Title';
        }
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
   	
   	
   	private function make_api_request() {
   	    try {
   	        $response = wp_remote_get( 'http://data.fixer.io/api/latest?access_key=4f7ef87b783cb8d2989e4a575b5196c9');
   	        $json = json_decode( $response['body']);
   	        if(!empty($json->error)){
   	            $json = null;
   	        }
   	    } catch (\Exception $ex) {
   	        $json = null;
   	    }
   	    
   	    return $json;  	    
   	}
    
 
   
}