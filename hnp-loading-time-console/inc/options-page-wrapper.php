<div class="hnp_lt_wrap">
   <div class="hnp_lt_icon">
      <img src="<?php echo plugins_url('/img/hnp-logo.png', dirname(__FILE__)); ?>" alt="Plugin Icon">
   </div>
   <h2 class="hnp_lt_backend-heading"> HNP Ladezeiten-Messung</h2>
   <?php settings_errors(); ?>
   <?php
   if (isset($_GET['tab'])) {
      $active_tab = $_GET['tab'];
   } else {
      $active_tab = 'profile_1';
   }
   ?>
   <div class="hnp_lt_nav-tab-wrapper">
      <div class="hnp-tab">
         <h2><a href="?page=hnp_lt_options&tab=profile_1" class="hnp-nav-tab <?php echo isset($active_tab) && $active_tab == 'profile_1' ? 'hnp-nav-tab-active' : ''; ?>">Einstellungen</a></h2> 
      </div>
      <div class="hnp-tab">
         <h2>
            <a href="?page=hnp_lt_options&tab=profile_3" class="hnp-nav-tab <?php echo isset($active_tab) && $active_tab == 'profile_3' ? 'hnp-nav-tab-active' : ''; ?>">Kontakt</a>
         </h2>
      </div>
   </div>
   <form id="featured_upload" method="post" action="">
      <?php
         if ($active_tab == 'profile_1') {
            $options = get_option('hnp-loading-time-console');
            if (!isset($options['hnp_loading_time_checked'])) {
               $options['hnp_loading_time_checked'] = '';
            }
            if (!isset($options['hnp_loading_time_more_checked'])) {
               $options['hnp_loading_time_more_checked'] = '';
            }
      ?>
      <input type="hidden" name="pgnyt_form_submitted" value="Y">
     
      <div class="hnp-option-container hnp-option-spacing hnp_30_pro">
         </br><label for="activate">Ladezeit-Messung aktivieren?</label>
         <input name="hnp_loading_time_checked" type="checkbox" id="hnp_loading_time_checked" value="1" <?php checked($options['hnp_loading_time_checked'], 1); ?> onchange="toggleSecondCheckbox(this);" />
      </div>
	  
      <div class="hnp-option-container hnp-option-spacing hnp_30_pro">
         </br><label for="more"> Erweiterte Metriken messen?</label>
         <input name="hnp_loading_time_more_checked" type="checkbox" id="hnp_loading_time_more_checked" value="1" <?php checked($options['hnp_loading_time_more_checked'], 1); ?> <?php if ($options['hnp_loading_time_checked'] != '1') echo 'disabled'; ?> />
      </div>
      </br>
      <div class="hnp-option-container hnp-option-spacing hnp_30_pro">
         <input class="hnp-button-primary" type="submit" name="form_submit" value="Aktualisieren/Speichern" />
      </div>
	  <div class="hnp-option-container hnp-option-spacing hnp_30_pro">
		</br></br><div class="hnp-lt-info">
			Die klassische Ladezeit Messung kann dauerhaft aktiviert bleiben, denn die Ladezeiten sollten dadurch nicht erhöht werden. Die erweiterten Metriken, könnten (vielleicht) in seltenen Fällen, die Ladezeit ein bisschen erhöhen. Sollte also vor einer dauerhaften Aktivierung geprüft werden.
			</br>
			</br><strong>So funktioniert es: </strong></br>
			1. Aktivieren Sie die Messungsoption im Plugin, anschließend öffnen Sie eine Unterseite Ihrer Wahl.</br>
			2. Chrome -> Rechter Mausklick -> untersuchen -> Console. </br> Oder: Firefox -> Rechter Mausklick -> Element untersuchen -> Konsole</br>
			3. Rechter Mausklick -> neu laden / Seite neu laden</br>
			4. Werte werden nun in der Konsole angezeigt</br>
			</br><strong>Um tatsächliche Ladezeiten zu erhalten, sollten Sie, beim Ablesen der Werte, nicht eingeloggt sein. Nutzen Sie einen neuen, privaten Tab oder loggen Sie sich aus. Nur dann erhalten Sie tatsächliche Werte.</strong></br>
		</div>
	</div>
      <?php } elseif ($active_tab == 'profile_3') { ?>
         <div class="info-container">
            <p>
               <strong>Sie haben Fragen? Sie möchten ein individuelles Plugin oder eine individuelle Funktion für WordPress / WooCommerce? Schreiben Sie uns eine E-Mail: <a href="mailto:info@Homepage-nach-Preis.de">info@Homepage-nach-Preis.de</a></strong>
            </p>
            <p>
               WordPress Webseite ab 299 Euro & SEO Optimierung ab 249 Euro: <a href="https://homepage-nach-preis.de/">Homepage-nach-Preis.de</a>
            </p>
            <p>
               Fertige Webseiten ab 129 Euro & Wordpress Plugins: <a href="https://shop.homepage-nach-preis.de/">Shop.Homepage-nach-Preis.de</a>
            </p>
         </div>
      <?php } ?>
   </form> 
</div>
