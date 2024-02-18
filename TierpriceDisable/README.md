# Mage2 Module Risecommerce TierpriceDisable

When  Customer Applied Coupon Code then the Tier Price disable.
 
 
Developed by Amarjeet Prajapati (amarjeet.wdev@gmail.com)

## Installation
\* = in production please use the `--keep-generated` option

 - Unzip the zip file in `app/code/Risecommerce`
 - Enable the module by running `php bin/magento module:enable Risecommerce_TierpriceDisable`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

## Specifications

 - Observer
	- salesrule_validator_process > Risecommerce\TierpriceDisable\Observer\Salesrule\ValidatorProcess



