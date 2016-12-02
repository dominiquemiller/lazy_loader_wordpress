<?php 
// template to be displayed in admin
function lazy_loader_settings_page() {

  echo "<div class='wrap'>";
  echo "<h2>Lazy Loader Settings</h2>";

  echo  "<form method='post' action='options.php'>";
  
  settings_fields( 'lazy-loader-settings-group' );
  do_settings_sections( 'lazy-loader-settings-group' );
?>     
  <table class='form-table'>
    <tr valign='top'>
      <th scope='row'>Fetch Count:</th>
      <th scope='row'>number of posts to load each AJAX call</th>
        <td><input type='number' name='fetch_count'
                   value='<?php echo esc_attr( get_option('fetch_count') ) ?>'/></td>
    </tr>

    <tr valign='top'>
      <th scope='row'>Element ID:</th>
      <th scope='row'>ID of container of posts. Format: #myid</th>
        <td><input type='text' name='container_id'
                   value='<?php echo esc_attr( get_option('container_id') ) ?>' /></td>
    </tr>

    <tr valign='top'>
      <th scope='row'>Post Index Page:</th>
      <th scope='row'>Select posts index page</th>
        <td><select name='lazy_posts_index'>
            <option>Select page</option>
            <?php $pages = get_pages(); ?> 
            <?php foreach ( $pages as $page ) { ?>
              <option value="<?php echo $page->post_title?>" <?php selected(get_option('lazy_posts_index'), $page->post_title); ?> >
              <?php echo $page->post_title; ?>
              </option>
	          <?php } ?>

            </select></td>
    </tr>
    </table>

    <h1>Feeling extra lazy?</h1>
    <h2 id="lazy-click" class="lazy-click">Click me to add a shiny new loading spinner</h2>
    <div id="lazy-drop-down-container" class="lazy-drop-down-container">
      <div class="create-spinner-container">
        <div class="spinner-settings">
          <label>Choose a color</label>
          <input type="text"
                 id="ell-spinner-color"
                 name="lazy_spinner_color" 
                 value="<?php echo esc_attr( get_option('lazy_spinner_color') ); ?>" 
                 placeholder="#fff">
          <label>Choose spinner height</label>
          <input type="number"
                 id="ell-spinner-height"
                 name="lazy_spinner_height" 
                 value="<?php echo esc_attr( get_option('lazy_spinner_height') ); ?>" 
                 placeholder="2">
          <label>Choose speed of animation in ms</label>
          <input type="number"
                 id="ell-spinner-speed" 
                 name="lazy_spinner_speed"
                 value="<?php echo esc_attr( get_option('lazy_spinner_speed') ); ?>" 
                 placeholder="1">
        </div><!-- spinner settings -->
        
        <div class="spinner-preview">
          <div class="lazy-spinner-container-preview">
            <div class="lazy-spinner">
          </div>
        </div>
      </div><!-- end create-spinner-container -->
    </div> 
  </div>
  <?php submit_button(); ?>

  </form>
</div><!-- end wrap -->
  

<?php } 

