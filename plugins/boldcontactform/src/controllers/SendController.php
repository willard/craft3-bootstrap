<?php
/**
 * Bold Contact Form plugin for Craft CMS 3.x
 *
 * Simple contact form
 *
 * @link      https://iamwillard.com
 * @copyright Copyright (c) 2019 Willard Macay
 */

namespace willard\boldcontactform\controllers;

use willard\boldcontactform\BoldContactForm;

use Craft;
use craft\web\Controller;

/**
 * Send Controller
 *
 * Generally speaking, controllers are the middlemen between the front end of
 * the CP/website and your plugin’s services. They contain action methods which
 * handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering
 * post data, saving it on a model, passing the model off to a service, and then
 * responding to the request appropriately depending on the service method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what
 * the method does (for example, actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 *
 * @author    Willard Macay
 * @package   BoldContactForm
 * @since     1.0.0
 */
class SendController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['index', 'do-something'];

    // Public Methods
    // =========================================================================

    /**
     * Handle a request going to our plugin's index action URL,
     * e.g.: actions/bold-contact-form/send
     *
     * @return mixed
     */
    public function actionIndex()
    {
        //validate request using rules --> check Yii Validate
        $name = Craft::$app->request->getBodyParam('name');
        $email = Craft::$app->request->getBodyParam('email');//validate
        $message = Craft::$app->request->getBodyParam('message');

        $subject = "New Message from Contac Form"; //subject should be set in control panel setting

        $email = "willardmacay@gmail.com";//email should be set in the control panel setting

        $html = "<div><p><strong>name:</strong> {$name}</p></div>";
        $html .= "<div><p><b>email:</b> {$email}</p></div>";
        $html .= "<div><p>{$message}</p></div>";

        //save data as entry

        /*
        if(db.save(post)){
            sendmail
        }else{
            return error
        }
        **/

        if ($this->sendMail($html, $subject, $email)) {
            return $this->redirectToPostedUrl();
        } else {
            return "message not sent"; //return error to form,
        }
    }

    /**
     * Handle a request going to our plugin's actionDoSomething URL,
     * e.g.: actions/bold-contact-form/send/do-something
     *
     * @return mixed
     */
    public function actionDoSomething()
    {
        $result = 'Welcome to the SendController actionDoSomething() method';

        return $result;
    }

    /**
     * @param string $html
     * @param string $subject
     * @param array|string|\craft\elements\User $mail
     *
     * @return bool
     */
    public function sendMail(string $html, string $subject, $mail): bool
    {
        return Craft::$app
            ->getMailer()
            ->compose()
            ->setTo($mail)
            ->setSubject($subject)
            ->setHtmlBody($html)
            ->send();
    }
}
