<?php
/*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

require('./../../config/config.inc.php');

$id_cart = pSQL(Tools::getValue('id'));
$city = pSQL(Tools::getValue('city'));

if (Tools::getValue('token') == '' || Tools::getValue('token') != Configuration::get('TNT_CARRIER_TOKEN'))
	die('Invalid Token');

$cart = new Cart($id_cart);
$address = new Address($cart->id_address_delivery);
$address->city = $city;

if (strpos($city, 'PARIS') === 0 || strpos($city, 'MARSEILLE') === 0 || strpos($city, 'LYON') === 0)
	{
		$code = substr($city, -2);
		$address->postcode = substr($address->postcode, 0, 3).$code;
	}
if ($address->save())
	echo "ok";
else
	echo "null";
