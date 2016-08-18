<?php
class UsersUltraMaintenance {

	var $options;

	function __construct() {
	
		/* Plugin slug and version */
		$this->slug = 'userultra';
		$this->subslug = 'uultra-maintenance';
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$this->plugin_data = get_plugin_data( uultra_maintenance_path . 'index.php', false, false);
		$this->version = $this->plugin_data['Version'];
		
		/* Priority actions */
		add_action('admin_menu', array(&$this, 'add_menu'), 9);
		add_action('admin_enqueue_scripts', array(&$this, 'add_styles'), 9);
		add_action('admin_head', array(&$this, 'admin_head'), 9 );
		add_action('admin_init', array(&$this, 'admin_init'), 9);		
		
		add_action( 'wp_ajax_uulra_do_integrity_checks', array(&$this, 'uulra_do_integrity_checks' ));		
		add_action( 'wp_ajax_delete_uultra_transtient', array( $this, 'delete_uultra_transtient' ));
		add_action( 'wp_ajax_delete_uultra_stats', array( $this, 'delete_uultra_stats' ));
		add_action( 'wp_ajax_delete_uultra_reviews', array( $this, 'delete_uultra_reviews' ));	
		
		
		
		
		
	}
	
	function admin_init() 
	{
	
		$this->tabs = array(
			'manage' => __('Maintenance','xoousers')
			
		);
		$this->default_tab = 'manage';		
		
	}
	
	
	function delete_uultra_transtient() 
	{
		delete_transient('uultra_users_online');
		$html = __("Finished!!. The transients have been cleaned.", "xoousers"); 
		echo $html;
		die();
			
	}
	
	function delete_uultra_stats() 
	{
		global $wpdb;
		
	    $query = "TRUNCATE TABLE " . $wpdb->prefix ."usersultra_stats  ";						
		$wpdb->query( $query );
		
		 $query = "TRUNCATE TABLE " . $wpdb->prefix ."usersultra_stats_raw  ";						
		$wpdb->query( $query );
			
		$html = __("Finished!!. The stats have been deleted.", "xoousers"); 
		echo $html;
		die();
			
	}
	
	function delete_uultra_reviews() 
	{
		global $wpdb;
		
	    $query = "TRUNCATE TABLE " . $wpdb->prefix ."usersultra_ajaxrating_vote  ";						
		$wpdb->query( $query );
		
		 $query = "TRUNCATE TABLE " . $wpdb->prefix ."usersultra_ajaxrating_votesummary  ";						
		$wpdb->query( $query );
			
		$html = __("Finished!!. The ratings have been deleted.", "xoousers"); 
		echo $html;
		die();
			
	}
	
	
	
	
	public function uulra_do_integrity_checks () 
	{
		global $wpdb;
		
		$sql = ' SELECT DISTINCT `user_id` FROM ' . $wpdb->prefix . 'usermeta  ' ;
		$rows = $wpdb->get_results( $sql );
		
		$html="";
		 
		 if ( !empty( $rows ) )
		 {
			foreach ( $rows as $item )
			{
				$user_id = $item->user_id;
				
				
				
				$total_u = $this->get_custom_user($user_id);
				
				if($total_u==0) //not found then delete meta
				{
					$html.='--- User ID: ' . $item->user_id.' NOT FOUND !!!<br>';
					$this->delete_all_user_meta($user_id);
				
				}else{ //found. don't delete
				
					$html.='--- User ID: ' . $item->user_id.' FOUND<br>';
					
				
				}
							
			
			}
		
		}else{
			
			$total = 0;	
			
	    }
		
		$html .= __("Finished!! . Please refresh this window.", "xoousers"); 
		
		echo  $html;
		die();
		
	
	}
	
	public function delete_all_user_meta ($uid) 
	{
		global $wpdb;
		
		$sql = ' DELETE FROM ' . $wpdb->prefix . 'usermeta WHERE user_id = "'.$uid.'" ' ;
		$wpdb->query( $sql );
		 
				
	}
	
	
	public function get_custom_user ($uid) 
	{
		global $wpdb;
		
		$sql = ' SELECT COUNT(*) as total FROM ' . $wpdb->prefix . 'users WHERE ID = "'.$uid.'" ' ;
		$rows = $wpdb->get_results( $sql );
		 
		 if ( !empty( $rows ) )
		 {
			foreach ( $rows as $item )
			{
				$total = $item->total;			
			
			}
		
		}else{
			
			$total = 0;	
			
	    }
		
		return $total;
		
	
	}
	
	
		
	
	public function get_all_from_meta () 
	{
		global $wpdb;
		
		$sql = ' SELECT COUNT(DISTINCT `user_id`) as total FROM ' . $wpdb->prefix . 'usermeta  ' ;
		$rows = $wpdb->get_results( $sql );
		 
		 if ( !empty( $rows ) )
		 {
			foreach ( $rows as $item )
			{
				$total = $item->total;			
			
			}
		
		}else{
			
			$total = 0;	
			
	    }
		
		return $total;
		
	
	}
	
	public function get_all_from_users () 
	{
		global $wpdb;
		
		$sql = ' SELECT COUNT(DISTINCT `ID`) as total FROM ' . $wpdb->prefix . 'users  ' ;
		$rows = $wpdb->get_results( $sql );
		 
		 if ( !empty( $rows ) )
		 {
			foreach ( $rows as $item )
			{
				$total = $item->total;			
			
			}
		
		}else{
			
			$total = 0;	
			
	    }
		
		return $total;
		
	
	}
	
	function admin_head(){

	}

	function add_styles(){
	
		wp_register_script( 'uultra_maintenance_js', uultra_maintenance_url . 'admin/scripts/admin.js', array( 
			'jquery'
		) );
		wp_enqueue_script( 'uultra_maintenance_js' );
	
		wp_register_style('uultra_maintenance_css', uultra_maintenance_url . 'admin/css/admin.css');
		wp_enqueue_style('uultra_maintenance_css');
		
	}
	
	function add_menu()
	{
		add_submenu_page( 'userultra', __('Maintenance','xoousers'), __('Maintenance','xoousers'), 'manage_options', 'uultra-maintenance', array(&$this, 'admin_page') );
		
		do_action('userultra_admin_menu_hook');
		
		
	}

	function admin_tabs( $current = null ) {
			$tabs = $this->tabs;
			$links = array();
			if ( isset ( $_GET['tab'] ) ) {
				$current = $_GET['tab'];
			} else {
				$current = $this->default_tab;
			}
			foreach( $tabs as $tab => $name ) :
				if ( $tab == $current ) :
					$links[] = "<a class='nav-tab nav-tab-active' href='?page=".$this->subslug."&tab=$tab'>$name</a>";
				else :
					$links[] = "<a class='nav-tab' href='?page=".$this->subslug."&tab=$tab'>$name</a>";
				endif;
			endforeach;
			foreach ( $links as $link )
				echo $link;
	}

	function get_tab_content() {
		$screen = get_current_screen();
		if( strstr($screen->id, $this->subslug ) ) {
			if ( isset ( $_GET['tab'] ) ) {
				$tab = $_GET['tab'];
			} else {
				$tab = $this->default_tab;
			}
			require_once uultra_maintenance_path.'admin/panels/'.$tab.'.php';
		}
	}
	
	public function save()
	{
		global $wpdb, $xoouserultra;
		
		if(isset($_POST['ip_number']))
		{
		
			$ip_number = $_POST['ip_number'];			
			$new_array = array(
							'ip_id'     => null,
							'ip_number'   => $ip_number						
							
							
						);
						
			//check if already added			
			$amount = $xoouserultra->defender->check_ip($ip_number);
						
			if($amount==0 && $ip_number!=""){
				
				$wpdb->insert( $wpdb->prefix . 'usersultra_ip_defender', $new_array, array( '%d', '%s'));
				
			}
			
		}
	
	
	}
	
	
	function admin_page() {
	
		
		if (isset($_POST['add-ipnumber']) && $_POST['add-ipnumber']=='add-ipnumber') 
		{
			$this->save();
		}

		
		
	?>
	
		<div class="wrap <?php echo $this->slug; ?>-admin">
        
           <h2>USERS ULTRA PRO - <?php _e('MAINTENANCE','xoousers')?></h2>
           
           <div id="icon-users" class="icon32"></div>
			
						
			<h2 class="nav-tab-wrapper"><?php $this->admin_tabs(); ?></h2>

			<div class="<?php echo $this->slug; ?>-admin-contain">
				
				<?php $this->get_tab_content(); ?>
				
				<div class="clear"></div>
				
			</div>
			
		</div>

	<?php }

}

$uultra_maintenance = new UsersUltraMaintenance();