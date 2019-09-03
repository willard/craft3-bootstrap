<?php
/**
 * Bold Contact Form plugin for Craft CMS 3.x
 *
 * Simple contact form
 *
 * @link      https://iamwillard.com
 * @copyright Copyright (c) 2019 Willard Macay
 */

namespace willard\boldcontactform\models;

use willard\boldcontactform\BoldContactForm;

use Craft;
use craft\base\Model;

/**
 * BoldContactForm Settings Model
 *
 * This is a model used to define the plugin's settings.
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Willard Macay
 * @package   BoldContactForm
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * Some field model attribute
     *
     * @var string
     */
    public $toEmail = 'Email';

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['toEmail', 'string'],
            ['toEmail', 'default', 'value' => 'hello@triploqal.com'],
        ];
    }
}
