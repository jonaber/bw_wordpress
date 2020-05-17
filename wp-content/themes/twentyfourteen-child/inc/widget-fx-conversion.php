<?php


function forex_conversion_register_widget() {
    register_widget( 'forex_conversion_widget' );
}

add_action( 'widgets_init', 'forex_conversion_register_widget' );


class forex_conversion_widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'forex_conversion_widget',
            'Forex Conversion Widget',
            array ('description' => 'Foreign Exchange Conversion Widget')
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
            <div class="container" style="background:#3e444a; padding:20px;">
                <div class="row">
                	<div class="col-sm-12 text-center" style="padding:5px;">
                    	<span><input id="eurLabel" type="text" disabled value="EUR"></span>
                    	<span><input type="text" id="euroValue" name="euroValue" value="1" onblur="validatenumber(this);"></span>
                	</div>
                	<div class="col-sm-12 text-center" style="padding:5px;">
                    	<select class="currency">
                        <?php 
                        	foreach ($response->rates as $curr=>$val ){
                        	    echo('<option value="'.$val.'">'.$curr.'</option>');
                        	}
                        ?>    	
                        </select>
                    	<span><input type="text" id="currValue" disabled></span>
                	</div>
                	<div class="col-sm-12 text-center" style="padding:5px;">
                		<button type="button" id="convert">CONVERT</button>
                	</div>
                </div>
            </div>
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