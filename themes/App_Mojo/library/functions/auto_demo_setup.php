<?php
session_start();
ob_start();
$selected_theme = 'App_Mojo';

if(!function_exists('wpw_template_include_theme'))
{
	
	add_filter('template_include','wpw_template_include_theme');
	function wpw_template_include_theme($template)
	{
		global $selected_theme;
		if(isset($_GET['themeactived'] ) && $_SESSION['selected_theme']==$selected_theme && $_GET['import_sample']=='data1')
		{
			mobile_app_importer_init(82,'az_82_');//for aheadzen
			//mobile_app_importer_init(3,'wp_3_');//for local
			exit;
		}
		return $template;
	}
	
}

function mobile_app_importer_init($blog_id,$demo_db_prefix) {
	global $selected_theme;
	$user_id = get_current_user_id();
	if($user_id)
	{
		global $wpdb,$table_prefix;
		$demoblog = $demo_db_prefix; //'az_81_'; //for aheadzen
		$db_blog_id = $blog_id; //81;
		
		
		$siteurl = site_url();
		$options_sql = 'INSERT INTO `'.$wpdb->options.'` (SELECT * FROM `'.$demoblog.'options'.'` where '.$demoblog.'options'.'.option_id not in (select option_id from '.$wpdb->options.'))';
		$wpdb->query($options_sql);
		$siteurl_sql = 'update `'.$wpdb->options.'` set option_value="'.$siteurl.'" where option_name="siteurl"';
		$wpdb->query($siteurl_sql);
		
		$aheadzen_skin = $wpdb->get_var('SELECT option_value FROM `'.$demoblog.'options'.'` where option_name="aheadzen_skin"');
		$aheadzen_pattern = $wpdb->get_var('SELECT option_value FROM `'.$demoblog.'options'.'` where option_name="aheadzen_pattern"');
		$aheadzen_layout = $wpdb->get_var('SELECT option_value FROM `'.$demoblog.'options'.'` where option_name="aheadzen_layout"');
		
		update_option('aheadzen_skin',$aheadzen_skin);
		update_option('aheadzen_pattern',$aheadzen_pattern);
		update_option('aheadzen_layout',$aheadzen_layout);
		
		$post_sql = 'INSERT INTO `'.$wpdb->posts.'` (SELECT * FROM `'.$demoblog.'posts'.'` where '.$demoblog.'posts'.'.ID not in (select ID from '.$wpdb->posts.'))';
		$wpdb->query($post_sql);
		$postmeta_sql = 'INSERT INTO `'.$wpdb->postmeta.'` (SELECT * FROM `'.$demoblog.'postmeta'.'` where '.$demoblog.'postmeta'.'.meta_id not in (select meta_id from '.$wpdb->postmeta.'))';
		$wpdb->query($postmeta_sql);
		$terms_sql = 'INSERT INTO `'.$wpdb->terms.'` (SELECT * FROM `'.$demoblog.'terms'.'` where '.$demoblog.'terms'.'.term_id not in (select term_id from '.$wpdb->terms.'))';
		$wpdb->query($terms_sql);
		$term_taxonomy_sql = 'INSERT INTO `'.$wpdb->term_taxonomy.'` (SELECT * FROM `'.$demoblog.'term_taxonomy'.'` where '.$demoblog.'term_taxonomy'.'.term_taxonomy_id not in (select term_taxonomy_id from '.$wpdb->term_taxonomy.'))';
		$wpdb->query($term_taxonomy_sql);
		$term_relationships_sql = 'INSERT INTO `'.$wpdb->term_relationships.'` (SELECT * FROM `'.$demoblog.'term_relationships'.'` where '.$demoblog.'term_relationships'.'.object_id not in (select object_id from '.$wpdb->term_relationships.'))';
		$wpdb->query($term_relationships_sql);
		
		
		/*Plugin Settings*/
		$sql = "select option_value from ".$demoblog."options where option_name='active_plugins'";
		$active_pluginsres = $wpdb->get_var($sql);
		if($active_pluginsres)
		{
			$option_value =  unserialize($active_pluginsres);
			update_option('active_plugins',$option_value);
		
		}
		
		$blog_id = get_current_blog_id();				
		$revslider_css_table = $table_prefix.$blog_id."_revslider_css";
		$revslider_settings_table = $table_prefix.$blog_id."_revslider_settings";
		$revslider_sliders_table = $table_prefix.$blog_id."_revslider_sliders";
		$revslider_slides_table = $table_prefix.$blog_id."_revslider_slides";
		$revslider_layer_animations_table = $table_prefix.$blog_id."_revslider_layer_animations";
		  
		$revslider_layer_animations_table_res = $wpdb->get_results("SHOW CREATE TABLE `".$demoblog.$db_blog_id.'_revslider_layer_animations'."`");
		if($revslider_layer_animations_table_res[0])
		{
			$count=0;
			foreach($revslider_layer_animations_table_res[0] as $key=>$val)
			{
				$count++;
				if($count==2)
				{
					$revslider_layer_animations_table_create = str_replace($demoblog.$db_blog_id.'_revslider_layer_animations',$revslider_layer_animations_table,$val);
					$wpdb->query($revslider_layer_animations_table_create);
				}
				
			}
		}
		
		$revslider_css_table_res = $wpdb->get_results("SHOW CREATE TABLE `".$demoblog.$db_blog_id.'_revslider_css'."`");
		if($revslider_css_table_res[0])
		{
			$count=0;
			foreach($revslider_css_table_res[0] as $key=>$val)
			{
				$count++;
				if($count==2)
				{
					$revslider_css_table_create = str_replace($demoblog.$db_blog_id.'_revslider_css',$revslider_css_table,$val);
					$wpdb->query($revslider_css_table_create);
				}
				
			}
		}
		
		$revslider_settings_table_res = $wpdb->get_results("SHOW CREATE TABLE `".$demoblog.$db_blog_id.'_revslider_settings'."`");
		if($revslider_settings_table_res[0])
		{
			$count=0;
			foreach($revslider_settings_table_res[0] as $key=>$val)
			{
				$count++;
				if($count==2)
				{
					$revslider_settings_table_create = str_replace($demoblog.$db_blog_id.'_revslider_settings',$revslider_settings_table,$val);
					$wpdb->query($revslider_settings_table_create);
				}
				
			}
		}
		$revslider_sliders_table_res = $wpdb->get_results("SHOW CREATE TABLE `".$demoblog.$db_blog_id.'_revslider_sliders'."`");
		if($revslider_sliders_table_res[0])
		{
			$count=0;
			foreach($revslider_sliders_table_res[0] as $key=>$val)
			{
				$count++;
				if($count==2)
				{
					$revslider_sliders_table_create = str_replace($demoblog.$db_blog_id.'_revslider_sliders',$revslider_sliders_table,$val);
					$wpdb->query($revslider_sliders_table_create);
				}
				
			}
		}
		
		$revslider_slides_table_res = $wpdb->get_results("SHOW CREATE TABLE `".$demoblog.$db_blog_id.'_revslider_slides'."`");
		if($revslider_slides_table_res[0])
		{
			$count=0;
			foreach($revslider_slides_table_res[0] as $key=>$val)
			{
				$count++;
				if($count==2)
				{
					$revslider_slides_table_create = str_replace($demoblog.$db_blog_id.'_revslider_slides',$revslider_slides_table,$val);
					$wpdb->query($revslider_slides_table_create);
				}
				
			}
		}
		
		$revslider_css_sql = 'INSERT INTO `'.$revslider_css_table.'` (SELECT * FROM `'.$demoblog.$db_blog_id.'_revslider_css'.'` where '.$demoblog.$db_blog_id.'_revslider_css'.'.id not in (select id from '.$revslider_css_table.'))';
		$wpdb->query($revslider_css_sql);	
		$revslider_settings_sql = 'INSERT INTO `'.$revslider_settings_table.'` (SELECT * FROM `'.$demoblog.$db_blog_id.'_revslider_settings'.'` where '.$demoblog.$db_blog_id.'_revslider_settings'.'.id not in (select id from '.$revslider_settings_table.'))';
		$wpdb->query($revslider_settings_sql);
		$revslider_sliders_sql = 'INSERT INTO `'.$revslider_sliders_table.'` (SELECT * FROM `'.$demoblog.$db_blog_id.'_revslider_sliders'.'` where '.$demoblog.$db_blog_id.'_revslider_sliders'.'.id not in (select id from '.$revslider_sliders_table.'))';
		$wpdb->query($revslider_sliders_sql);
		$revslider_slides_sql = 'INSERT INTO `'.$revslider_slides_table.'` (SELECT * FROM `'.$demoblog.$db_blog_id.'_revslider_slides'.'` where '.$demoblog.$db_blog_id.'_revslider_slides'.'.id not in (select id from '.$revslider_slides_table.'))';
		$wpdb->query($revslider_slides_sql);

		// Create post object
		$my_post = array(
		  'post_title'    => 'Last Sample Post',
		  'post_content'  => 'This is my post.',
		  'post_status'   => 'publish',
		  'post_author'   => $user_id,
		  'post_category' => array(8,39)
		);

		// Insert the post into the database
		wp_insert_post( $my_post );
		
		global $wpdb;
		$user_id = get_current_user_id();
		$wpdb->query("update $wpdb->posts set post_author=\"$user_id\"");
		
		/*Add Widget Settings to database*/
		global $wpdb;
		$sql = "select * from ".$demoblog."options where option_name like \"%widget%\"";
		$res = $wpdb->get_results($sql);
		if($res)
		{
			foreach($res as $resobj)
			{
				$option_name = $resobj->option_name;
				$option_value =  unserialize($resobj->option_value);
				update_option($option_name,$option_value);
			}
		}
		
		/*Set Main Menu as Primary Menu*/
		
		$mainmenu = $wpdb->get_var("select t.term_id from ".$demoblog."terms t where t.name like 'Main Menu' limit 1");
		$footermenu = $wpdb->get_var("select t.term_id from ".$demoblog."terms t where t.name like 'Footer Menu' limit 1");
		$menu_option_arr = array();
		$menu_option_arr['nav_menu_locations'] = array('primary'=>$mainmenu,'footer'=>$footermenu);
		$stylesheet = $_SESSION['selected_theme'];
		update_option('theme_mods_'.$stylesheet,$menu_option_arr);
		?>
		<center>
		<br><br>
		<h1>Your site Created successfully. <br><br>
		Now system is preparing sample demo site for you.<br><br> 
		It may take some time, you will be redirected automatically to your site demo. 
		<br><br>Thanks for your co-operation.</h1>

		<br>
		<a href="<?php echo site_url();?>"><h3>Visit Your site >></h3></a>
		</center>
		<?php
		
		/*Blank the selected theme for auto setup*/
		$_SESSION['selected_theme'] = '';
		echo '<script>window.location.href="'.site_url().'";</script>';
		exit;
	}
			
}
?>