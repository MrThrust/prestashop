<?php
/*
*
*	Essential Prestashop Functions
*
*	Prestashop has lots of time-saving functions that we can use when developing modules or extensions.
*	but the documentation sucks!..
*	
*	Just wanted to add this list of great functions to speed up Development!
*	
*	http://nemops.com/prestashop-functions-1/
*/

/**
*
* Managing Configuration values in Prestashop
*
*/

// Updating a single/multiple value/s
Configuration::updateValue($key, $values, $html = false, $id_shop_group = null, $id_shop = null);
 
// Getting a single value
Configuration::get($key, $id_lang = null, $id_shop_group = null, $id_shop = null);
 
// Getting Multiple Values
Configuration::getMultiple($keys, $id_lang = null, $id_shop_group = null, $id_shop = null);
 
// Getting the same key in all languages
Configuration::getInt($key, $id_shop_group = null, $id_shop = null);
 
// Erase the given entry
Configuration::deleteByName($key);

// Example Usage
// Saving a normal string
$my_text = 'This is some text';
Configuration::updateValue('MY_CONFIG_PARAMETER', $my_text);
 
// Saving an html string
$my_text = '<p>This is some text</p>';
Configuration::updateValue('MY_CONFIG_PARAMETER', $my_text, true);
 
// Saving multiple values, KEYS represend ID_LANG
$my_texts = array(
    1 => 'This is some text',
    2 => 'This is some text in another language'
);
Configuration::updateValue('MY_CONFIG_PARAMETER_MULTILANG', $my_text);
 
 
// Getting a single value
$my_text = Configuration::get('MY_CONFIG_PARAMETER');
 
// Getting a single value for the current language only
$my_text = Configuration::get('MY_CONFIG_PARAMETER', $this->context->language->id);
 
// Getting Multiple Values
$keys_to_get = array('MY_CONFIG_PARAMETER', 'OTHER_CONFIG_PARAMETER');
Configuration::getMultiple($keys_to_get);
 
// Delete the given key
Configuration::deleteByName('MY_CONFIG_PARAMETER');


/** 
*
* Getting POST and GET in Prestashop 
*
*/
Tools::getValue($key, $default_value = false);
// Example Usage
// Getting either POST or GET with the key 'myvalue', the second parameter is what to assign then nothing is found.
$value = Tools::getValue('myvalue', 4);
// If no 'myvalue' POST or GET variable is set, $value will be 4.


/**
*
* Checking for submitted data in Prestashop
*
*/
Tools::isSubmit($key);
// Example Usage
if( Tools::isSubmit('myvalue') )
{
    // do something
}


/**
*
* Displaying Errors in Prestashop
*
*/
Tools::displayError($string = 'Fatal error', $htmlentities = true, Context $context = null);
// Example Usage
if($myvalue != 1)
{
    // will need to be displayed later on
    $error_string = Tools::displayError('It is different from 1');
}

/**
*
* Displaying Confirmations in Prestashop Modules
*
*/
$this->displayConfirmation($string);
// Example Usage
// this is inside a module's method
if($myvalue == 1)
{
    // will need to be displayed later on
    $conf_string = $this->displayConfirmation('Updated!');
}

/**
*
* Adding CSS in Prestashop
*
*/
ControllerCore::addCSS($css_uri, $css_media_type = 'all', $offset = null, $check_path = true);

// Example Usage
// this is inside a module's method
$this->context->controller->addCSS($this->_path.'css/myfile.css', 'all');
// this is inside a controller's method
$this->addCSS(_THEME_CSS_DIR_.'product.css');
// adding multiple files
$files = array(
    _THEME_CSS_DIR_.'product.css' => 'all',
    _THEME_CSS_DIR_.'other_css.css' => 'all'
);
$this->addCSS($files);



/**
*
* Adding Javascript in Prestashop
*
*/
ControllerCore::addJS($js_uri, $check_path = true);
// Example Usage
// this is inside a module's method
$this->context->controller->addCSS($this->_path.'css/myfile.css', 'all');
 
// this is inside a controller's method
$this->addCSS(_THEME_CSS_DIR_.'product.css');


/**
*
* Adding jQuery Plugins in Prestashop
*
*/
ControllerCore::addJqueryPlugin($name, $folder = null, $css = true);
// Example Usage
// this is inside a module's method, multiple files
$this->context->controller->addjqueryPlugin('fancybox');
 
// this is inside a controller's method
$this->addjqueryPlugin('fancybox');
 
// this is inside a controller's method, multiple values
$this->addjQueryPlugin(array('scrollTo', 'alerts', 'chosen', 'autosize', 'fancybox' ));
 
// this is inside a controller's method, without loading the plugin's CSS
$this->addjQueryPlugin('growl', null, false);



/**
*
* Adding jQuery UI Components in Prestashop
*
*/
ControllerCore::addJqueryUI($component, $theme = 'base', $check_dependencies = true);
// Example Usage
// this is inside a module's method, single file
$this->context->controller->addjQueryUI('ui.datepicker');
 
// this is inside a controller's method, multiple files
$this->addJqueryUI(array('ui.slider', 'ui.datepicker'));





// Retrieving an array of values from the given table
Db::getInstance()->executeS($sql, $array = true, $use_cache = true);
 
// Retrieving a single value
Db::getInstance()->getValue($sql, $use_cache = true);
 
// Retrieving a whole row
Db::getInstance()->getRow($sql, $use_cache = true);
 
// Executing a generic query, returns true if succeeded, false if failed
Db::getInstance()->execute($sql, $use_cache = true);
 
// Inserting a row
Db::getInstance()->insert($table, $data, $null_values = false, $use_cache = true, $type = Db::INSERT, $add_prefix = true);
 
// Updating values
Db::getInstance()->update($table, $data, $where = '', $limit = 0, $null_values = false, $use_cache = true, $add_prefix = true);
 
// Erase the given entry
Db::getInstance()->delete($table, $where = '', $limit = 0, $use_cache = true, $add_prefix = true);
 
// Escape data
Db::getInstance()->escape($string, $html_ok = false, $bq_sql = false);
 
// Get the primary key of the last item you added
Db::getInstance()->Insert_ID();


// Example Usage
// Returns an array with each item correspinding to a single database row
// It should only be used to retrieve values, use execute or the other helpers to insert/update them
$customers = Db::getInstance()->executeS('SELECT * FROM '._DB_PREFIX_.'customers');
 
// Returns product data of the ones that belong to the given category only (id = 4)
$products = Db::getInstance()->executeS('
    SELECT * FROM '._DB_PREFIX_.'product p
    LEFT JOIN '._DB_PREFIX_.'category_product cp ON (cp.id_product = p.id_product)
    WHERE cp.id_category = 4
');
 
 
// Retrieving the specific product name for our current language
$product_name = Db::getInstance()->getValue('SELECT name FROM '._DB_PREFIX_.'product_lang WHERE id_product = 1 AND id_lang = ' . $this->context->language->id);
 
// Get the whole row for customer id = 1
$customer = Db::getInstance()->getRow('SELECT * FROM '._DB_PREFIX_.'customer WHERE id_customer = 1');
 
 
// Insert some data manually (not recommended, unless you have some really specific SQL to use)
Db::getInstance()->execute('INSERT INTO '._DB_PREFIX_.'customer (id_customer, email, firstname, lastname) VALUES (9, "nemo@nemops.com", "Fabio", "Porta")');
 
// Inserting a row
// The $data array must be configured like 
//      column => value
 
$data = array(
    'id_customer' => 1,
    'email' => "nemo@nemops.com",
    'firstname' => "Fabio",
    'lastname' => "Porta",
);
Db::getInstance()->insert('customer', $data);
 
// Updating values, array configured as above
$data = array(
    'id_customer' => 1,
    'email' => "nemo@nemops.com",
    'firstname' => "Fabio",
    'lastname' => "Porta",
);
Db::getInstance()->update('customer', $data, 'id_customer = 1');
 
// Erase customer with id = 1
Db::getInstance()->delete('customer', 'id_customer = 1');
 
// Escape data
$sanitized = Db::getInstance()->escape('<div class="test"><div>', true);
// will return <div class=\"test\"><div>
 
// Get the primary key of the last item you added
 
$data = array(
    'email' => "nemo@nemops.com",
    'firstname' => "Fabio",
    'lastname' => "Porta",
);
Db::getInstance()->insert('customer', $data);
$last_id = Db::getInstance()->Insert_ID();
// $last_id will be the id_customer of the entry we just added

//The Query object in Prestashop
DbQuery::select($fields);
DbQuery::from($table, $alias = null);
DbQuery::join($fields);
DbQuery::leftJoin($table, $alias = null, $on = null);
DbQuery::where($restriction);
DbQuery::having($restriction);
DbQUery::orderBy($fields);
DbQUery::groupBy($fields);
DbQuery::limit($limit, $offset = 0);

// Example usage
// get all products with id > 3, with relative language data
 
$query = new DbQuery();
$query->select('p.*, pl.*')
    ->from('product', 'p')
    ->leftJoin('product_lang', 'pl', 'p.id_product = pl.id_product')
    ->where('p.id_product > 34')
    ->where('pl.id_lang = ' . $this->context->language->id)
    ->groupBy('p.id_product')
    ->limit(5);
 
$result = Db::getInstance()->getValue($query);

//Quick escape in a SQL query
pSQL($string, $htmlOK = false);
// Example usage
$search = '2" clamps';
// get aliases for the given search word, as you can see the above requires douple quotes to be escaped
$aliases = Db::getInstance()->executeS('
SELECT a.alias
FROM `'._DB_PREFIX_.'alias` a
WHERE `search` = \''.pSQL($search).'\'');


/**
*
*  PRODUCTS
*
*/
//Getting a Product’s Price
// It needs an instance
Product::getPrice($tax = true, $id_product_attribute = null, $decimals = 6,
        $divisor = null, $only_reduc = false, $usereduc = true, $quantity = 1);
 
// Static way
Product::getPriceStatic($id_product, $usetax = true, $id_product_attribute = null, $decimals = 6, $divisor = null,
        $only_reduc = false, $usereduc = true, $quantity = 1, $force_associated_tax = false, $id_customer = null, $id_cart = null,
        $id_address = null, &$specific_price_output = null, $with_ecotax = true, $use_group_reduction = true, Context $context = null,
        $use_customer_price = true);
//Example Usage
// get the product price, after instanciating a new object
 
$product = new Produc(4); // instanciate a product with id = 4
// get the price, but dynamically check if it needs to apply taxes or not
$product_price = $product->getPrice(Product::$_taxCalculationMethod == PS_TAX_INC);
// get the price of a specific combination, always with taxes
$product_attribute_price = $product->getPrice(true, 77);
 
 
// get price without instanciating an object
$products = array(
    0 => array('id_product' => 2),
    1 => array('id_product' => 86),
    2 => array('id_product' => 12),
);
 
foreach($products as $key => $product)
    $products[$key]['price'] = Product::getPriceStatic($product['id_product']);
	
//Getting a Product’s Name
Product::getProductName($id_product, $id_product_attribute = null, $id_lang = null);
//Example Usage
// Gets the name in the current language
$name = Product::getProductName(34);
 
// Gets the combination name in a chosen language
$name = Product::getProductName(34, 6, 2);

//Getting a Product’s Quantity
Product::getQuantity($id_product, $id_product_attribute = null, $cache_is_pack = null);
 
// This will consider a specific warehouse
Product::getRealQuantity($id_product, $id_product_attribute = 0, $id_warehouse = 0, $id_shop = null);

//Example Usage
// gets the quantity of all products in the array
$products = array(
    0 => array('id_product' => 2),
    1 => array('id_product' => 86),
    2 => array('id_product' => 12),
);
 
foreach($products as $key => $product)
    $products[$key]['qty'] = Product::getQuantity($product['id_product']);
 
 
// Gets quantity for a specific combination of a product (product id = 6, combination id = 99)
$quantity = Product::getQuantity(6, 99);
 
 
// Gets the quantity in stock for the specific warehouse ID
$quantity = Product::getRealQuantity(6, 0, 1);


//Getting and displaying Products Cover Image
// Returns an image ID
Product::getCover($id_product, Context $context = null);
 
// Uses the product rewrite and image id to get the actual image link
Link::getImageLink($name, $ids, $type = null);

// returns an array like array('id_image' => 66)
$cover = Product::getCover(5);
 
if($cover) // if there is an image
{
    // notice 'ipod-nano' is the product link_rewrite field here;
    $img_link = $this->context->link->getImageLink('ipod-nano', $cover['id_image']); // remember the previous is an array
}


// Getting Product Features for the front office
// Gets features so they can be properly displayed
Product::getFrontFeatures($id_lang);
 
// The same, but static
Product::getFrontFeaturesStatic($id_lang, $id_product);
//Example useage
$product = new Product(10);
$features = $product->getFrontFeatures($this->context->language->id);
 
 
// static way
$features = Product::getFrontFeaturesStatic($this->context->language->id, 10);


// Getting Product Categories
// Get ids of the categories this product belongs to
Product::getCategories();
 
// The same, Static
Product::getProductCategories($id_product);
 
// Get more data about categories, including name and link_rewrite
Product::getProductCategoriesFull($id_product, $id_lang = null);
 
// Get all parent categories, up to the root, in a single language. It will only consider the default one as starting point
Product::getParentCategories($id_lang = null);

$product = new Product(10);
// $categories will be ids only
$categories = $product->getCategories();
 
// Using the same Object, get all parents
$parent_categories = $product->getParentCategories();
 
// Static way, getting more data in the current language
$categories = Product::getProductCategoriesFull(10, $this->context->language->id);


/**
*
*  Getting products of a Category
*
*/

Category::getProducts($id_lang, $p, $n, $order_by = null, $order_way = null, $get_total = false, $active = true, $random = false, $random_number_products = 1, $check_access = true, Context $context = null);	
$category = new Category(5);
 
// Retrieves the first 15 products of a category
$products = $category->getProducts($this->context->language->id, 1, 15);
 
// Retrieves the first 15 products of a category, returning the number of total products for that category as well. Ordered by price, lowest to highest
$products = $category->getProducts($this->context->language->id, 1, 15, 'price', 'asc', true);
 
 
// Gets a random number of products, in random order (yes, even if we specified it)
$products = $category->getProducts($this->context->language->id, 1, 15, 'price', 'asc', false, true);

/**
*
*  Getting new products
*
*/
Product::getNewProducts($id_lang, $page_number = 0, $nb_products = 10, $count = false, $order_by = null, $order_way = null, Context $context = null);
// Example Usage
$newProducts = Product::getNewProducts((int) $this->context->language->id, 0, 10);


//Getting discounted products
Product::getPricesDrop($id_lang, $page_number = 0, $nb_products = 10, $count = false, $order_by = null, $order_way = null, $beginning = false, $ending = false, Context $context = null);
// Example Usage
// get the last 10 prices drop, ordered by position
$price_drops = Product::getPricesDrop((int) $this->context->language->id, 0, 10);
 
// get the last 10 prices drops, ordered by price, but only where the offer's start date is after july 23, 2015
$price_drops =  Product::getPricesDrop((int) $this->context->language->id, 0, 10, false, 'price', 'asc', '2015-7-23 10:45:32');


/**
*
*  Getting Best Sales
*
*/
ProductSale::getBestSales($id_lang, $page_number = 0, $nb_products = 10, $order_by = null, $order_way = null);
// get 10 best selling products, ordered by best selling
$products = ProductSale::getBestSales($this->context->language->id, 0, 10);


/**
*
*  Getting Best Sales (Light)
*
*/
ProductSale::getBestSalesLight($id_lang, $page_number = 0, $nb_products = 10, Context $context = null);
// get 5 best selling products, ordered by best selling, called from a hook method
$products = ProductSale::getBestSalesLight((int)$params['cookie']->id_lang, 0, 5));




/**
*
*  Adding variables to the cookie object
*
*/
Cookie::__set($key, $value);
// you might want to trigger this when a user clicks on the cookie loaw banner (where any), so that you are not prompting him to accept it on every page
$this->context->cookie->__set('cookielawaccepted', 1);
 
// The value can hold strings as well (arrays can be saved by serializing them)
$this->context->cookie->__set('mycustomoptionmode', 'test');


//Checking cookie variables
Cookie::__get($key);
// Following up the previous example, you can use this to avoid prompting the user again
if(!$this->context->cookie->__get('cookielawaccepted'))
{
    // display the message 
}

//Clearing a cookie variable
Cookie::__unset($key);
// removes the cookie law entry,
$this->context->cookie->__unset('cookielawaccepted')


//Logging a user out
Customer::logout();
// Clears all of the current session data for this customer
$this->context->customer->logout();



/**
*
*  Assigning variables to smarty from PHP
*
*/
$this->context->smarty->assign('variablenameinsmarty', $myvalue); // you will be able to access this as {$variablenameinsmarty} in the template
 
// same as above, but in batch
$this->context->smarty->assign(array(
    'variablenameinsmarty' => $myvalue,
    'anothervariablenameinsmarty' => $myothervalue,
));




/**
*
*  Creating translatable strings
*
*/
/*
	{l s='This is my string'} 									// theme template
	{l s='This is my string' mod='modulename'}     				// module template
	{l s='There are %s errors' sprintf=[$account_error|@count]} // theme template with variable replacement
	{l s='No file selected' js=1} 								// supposed to be used in a javascript script, only within addJsDef (see below)
	{l s='Billing Address' pdf='true'} 							// only used within PDF templates
*/

//Adding javascript variable definitions
/*

	{addJsDef wishlistProductsIds=$wishlist_products}
	{addJsDef mySliderCount=7}
	{addJsDefL name='youhavelides'}{l s='You save Slides!' js=1}{/addJsDefL}

*/
// will alert "You have slides!" in the current language
/*
	if(mySliderCount > 0)
		alert(youhavelides);
*/

//Displaying a formatted price
/*
	{convertPrice price=$price} // display Price in the current currency
	{displayPrice price=$price currency=$id_currency} // specify the currency
	
	// default currency is $, id 2 is Euros
	{convertPrice price=1} // $1.00
	{displayPrice price=1 currency=2} // 1,00 €
*/

//Displaying a formatted date
/*
	{dateFormat date=$date full =1} // display a date formatted like specified in the back office
	
	// chosen date format is dd/mm/yyyy H:i
	{dateFormat date="2015-01-07 22:45:01" } // 07/01/2015
	{dateFormat date="2015-01-07 22:45:01" full=1} // 07/01/2015 22:45
*/


//Getting a page Link
/*
	{$link->getPageLink('pagename', ssl, id_lang, "GET string or Array")}
	
	// Gets a link for step 3 of the order process, with ssl
	{$link->getPageLink('order', true, NULL, "step=3")}
	 
	// link to the contact us page
	<a href="{$link->getPageLink('contact'}" title="{l s='Contact us'}">{l s='Contact us'}</a>
*/



//Getting a Product Image
/*
	{$link->getImageLink(link_rewrite, id_image, 'image_type')}
	
	// gets the home_default image type, having a product as array
	<img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home_default')}"/>
*/


//Adding a new hook
/*
	// will process any hookDisplaySomething method
	{hook h='displaySomething'}
	
	 // will pass a variable named "parameter" with value "my string" later available using "params['mystring']" in the hook method
	{hook h='displaySomething' parameter='my string'} 
*/




/**
*
*	Conclusion
*	This batch concludes our series on Useful Prestashop Functions. 
*	Bear in mind logic should be kept off the templates as much as possible, to preserve the MVC pattern 
*	(Prestashop is heading towards it with Prestashop 1.7 removing plenty of modifiers next year). 
*	Therefore, whenever possible, try using the PHP counterpart of these functions, preprocessing 
*	the output and only using template for displaying data.
*
*/