<?php

use MailPoetVendor\Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use MailPoetVendor\Symfony\Component\DependencyInjection\ContainerInterface;
use MailPoetVendor\Symfony\Component\DependencyInjection\Container;
use MailPoetVendor\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use MailPoetVendor\Symfony\Component\DependencyInjection\Exception\LogicException;
use MailPoetVendor\Symfony\Component\DependencyInjection\Exception\RuntimeException;
use MailPoetVendor\Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 *
 * @final since Symfony 3.3
 */
class CachedContainer extends Container
{
    private $parameters;
    private $targetDirs = array();

    public function __construct()
    {
        $this->services = array();
        $this->normalizedIds = array(
            'mailpoet\\api\\json\\api' => 'MailPoet\\API\\JSON\\API',
            'mailpoet\\api\\json\\v1\\automatedlatestcontent' => 'MailPoet\\API\\JSON\\v1\\AutomatedLatestContent',
            'mailpoet\\api\\json\\v1\\customfields' => 'MailPoet\\API\\JSON\\v1\\CustomFields',
            'mailpoet\\api\\json\\v1\\forms' => 'MailPoet\\API\\JSON\\v1\\Forms',
            'mailpoet\\api\\json\\v1\\importexport' => 'MailPoet\\API\\JSON\\v1\\ImportExport',
            'mailpoet\\api\\json\\v1\\mailer' => 'MailPoet\\API\\JSON\\v1\\Mailer',
            'mailpoet\\api\\json\\v1\\mp2migrator' => 'MailPoet\\API\\JSON\\v1\\MP2Migrator',
            'mailpoet\\api\\json\\v1\\newsletters' => 'MailPoet\\API\\JSON\\v1\\Newsletters',
            'mailpoet\\api\\json\\v1\\newslettertemplates' => 'MailPoet\\API\\JSON\\v1\\NewsletterTemplates',
            'mailpoet\\api\\json\\v1\\segments' => 'MailPoet\\API\\JSON\\v1\\Segments',
            'mailpoet\\api\\json\\v1\\sendingqueue' => 'MailPoet\\API\\JSON\\v1\\SendingQueue',
            'mailpoet\\api\\json\\v1\\services' => 'MailPoet\\API\\JSON\\v1\\Services',
            'mailpoet\\api\\json\\v1\\settings' => 'MailPoet\\API\\JSON\\v1\\Settings',
            'mailpoet\\api\\json\\v1\\setup' => 'MailPoet\\API\\JSON\\v1\\Setup',
            'mailpoet\\api\\json\\v1\\subscribers' => 'MailPoet\\API\\JSON\\v1\\Subscribers',
            'mailpoet\\api\\mp\\v1\\api' => 'MailPoet\\API\\MP\\v1\\API',
            'mailpoet\\config\\accesscontrol' => 'MailPoet\\Config\\AccessControl',
            'mailpoet\\cron\\daemon' => 'MailPoet\\Cron\\Daemon',
            'mailpoet\\cron\\daemonhttprunner' => 'MailPoet\\Cron\\DaemonHttpRunner',
            'mailpoet\\newsletter\\automatedlatestcontent' => 'MailPoet\\Newsletter\\AutomatedLatestContent',
            'mailpoet\\router\\endpoints\\crondaemon' => 'MailPoet\\Router\\Endpoints\\CronDaemon',
            'mailpoet\\router\\endpoints\\subscription' => 'MailPoet\\Router\\Endpoints\\Subscription',
            'mailpoet\\router\\endpoints\\track' => 'MailPoet\\Router\\Endpoints\\Track',
            'mailpoet\\router\\endpoints\\viewinbrowser' => 'MailPoet\\Router\\Endpoints\\ViewInBrowser',
            'mailpoet\\subscribers\\confirmationemailmailer' => 'MailPoet\\Subscribers\\ConfirmationEmailMailer',
            'mailpoet\\subscribers\\newsubscribernotificationmailer' => 'MailPoet\\Subscribers\\NewSubscriberNotificationMailer',
            'mailpoet\\subscribers\\requiredcustomfieldvalidator' => 'MailPoet\\Subscribers\\RequiredCustomFieldValidator',
        );
        $this->methodMap = array(
            'MailPoet\\API\\JSON\\API' => 'getAPIService',
            'MailPoet\\API\\JSON\\v1\\AutomatedLatestContent' => 'getAutomatedLatestContentService',
            'MailPoet\\API\\JSON\\v1\\CustomFields' => 'getCustomFieldsService',
            'MailPoet\\API\\JSON\\v1\\Forms' => 'getFormsService',
            'MailPoet\\API\\JSON\\v1\\ImportExport' => 'getImportExportService',
            'MailPoet\\API\\JSON\\v1\\MP2Migrator' => 'getMP2MigratorService',
            'MailPoet\\API\\JSON\\v1\\Mailer' => 'getMailerService',
            'MailPoet\\API\\JSON\\v1\\NewsletterTemplates' => 'getNewsletterTemplatesService',
            'MailPoet\\API\\JSON\\v1\\Newsletters' => 'getNewslettersService',
            'MailPoet\\API\\JSON\\v1\\Segments' => 'getSegmentsService',
            'MailPoet\\API\\JSON\\v1\\SendingQueue' => 'getSendingQueueService',
            'MailPoet\\API\\JSON\\v1\\Services' => 'getServicesService',
            'MailPoet\\API\\JSON\\v1\\Settings' => 'getSettingsService',
            'MailPoet\\API\\JSON\\v1\\Setup' => 'getSetupService',
            'MailPoet\\API\\JSON\\v1\\Subscribers' => 'getSubscribersService',
            'MailPoet\\API\\MP\\v1\\API' => 'getAPI2Service',
            'MailPoet\\Config\\AccessControl' => 'getAccessControlService',
            'MailPoet\\Cron\\Daemon' => 'getDaemonService',
            'MailPoet\\Cron\\DaemonHttpRunner' => 'getDaemonHttpRunnerService',
            'MailPoet\\Newsletter\\AutomatedLatestContent' => 'getAutomatedLatestContent2Service',
            'MailPoet\\Router\\Endpoints\\CronDaemon' => 'getCronDaemonService',
            'MailPoet\\Router\\Endpoints\\Subscription' => 'getSubscriptionService',
            'MailPoet\\Router\\Endpoints\\Track' => 'getTrackService',
            'MailPoet\\Router\\Endpoints\\ViewInBrowser' => 'getViewInBrowserService',
            'MailPoet\\Subscribers\\ConfirmationEmailMailer' => 'getConfirmationEmailMailerService',
            'MailPoet\\Subscribers\\NewSubscriberNotificationMailer' => 'getNewSubscriberNotificationMailerService',
            'MailPoet\\Subscribers\\RequiredCustomFieldValidator' => 'getRequiredCustomFieldValidatorService',
        );

        $this->aliases = array();
    }

    public function getRemovedIds()
    {
        return array(
            'MailPoetVendor\\Psr\\Container\\ContainerInterface' => true,
            'MailPoetVendor\\Symfony\\Component\\DependencyInjection\\ContainerInterface' => true,
        );
    }

    public function compile()
    {
        throw new LogicException('You cannot compile a dumped container that was already compiled.');
    }

    public function isCompiled()
    {
        return true;
    }

    public function isFrozen()
    {
        @trigger_error(sprintf('The %s() method is deprecated since Symfony 3.3 and will be removed in 4.0. Use the isCompiled() method instead.', __METHOD__), E_USER_DEPRECATED);

        return true;
    }

    /**
     * Gets the public 'MailPoet\API\JSON\API' shared autowired service.
     *
     * @return \MailPoet\API\JSON\API
     */
    protected function getAPIService()
    {
        return $this->services['MailPoet\API\JSON\API'] = new \MailPoet\API\JSON\API($this, ${($_ = isset($this->services['MailPoet\Config\AccessControl']) ? $this->services['MailPoet\Config\AccessControl'] : $this->services['MailPoet\Config\AccessControl'] = new \MailPoet\Config\AccessControl()) && false ?: '_'});
    }

    /**
     * Gets the public 'MailPoet\API\JSON\v1\AutomatedLatestContent' shared autowired service.
     *
     * @return \MailPoet\API\JSON\v1\AutomatedLatestContent
     */
    protected function getAutomatedLatestContentService()
    {
        return $this->services['MailPoet\API\JSON\v1\AutomatedLatestContent'] = new \MailPoet\API\JSON\v1\AutomatedLatestContent(${($_ = isset($this->services['MailPoet\Newsletter\AutomatedLatestContent']) ? $this->services['MailPoet\Newsletter\AutomatedLatestContent'] : $this->services['MailPoet\Newsletter\AutomatedLatestContent'] = new \MailPoet\Newsletter\AutomatedLatestContent()) && false ?: '_'});
    }

    /**
     * Gets the public 'MailPoet\API\JSON\v1\CustomFields' shared autowired service.
     *
     * @return \MailPoet\API\JSON\v1\CustomFields
     */
    protected function getCustomFieldsService()
    {
        return $this->services['MailPoet\API\JSON\v1\CustomFields'] = new \MailPoet\API\JSON\v1\CustomFields();
    }

    /**
     * Gets the public 'MailPoet\API\JSON\v1\Forms' shared autowired service.
     *
     * @return \MailPoet\API\JSON\v1\Forms
     */
    protected function getFormsService()
    {
        return $this->services['MailPoet\API\JSON\v1\Forms'] = new \MailPoet\API\JSON\v1\Forms();
    }

    /**
     * Gets the public 'MailPoet\API\JSON\v1\ImportExport' shared autowired service.
     *
     * @return \MailPoet\API\JSON\v1\ImportExport
     */
    protected function getImportExportService()
    {
        return $this->services['MailPoet\API\JSON\v1\ImportExport'] = new \MailPoet\API\JSON\v1\ImportExport();
    }

    /**
     * Gets the public 'MailPoet\API\JSON\v1\MP2Migrator' shared autowired service.
     *
     * @return \MailPoet\API\JSON\v1\MP2Migrator
     */
    protected function getMP2MigratorService()
    {
        return $this->services['MailPoet\API\JSON\v1\MP2Migrator'] = new \MailPoet\API\JSON\v1\MP2Migrator();
    }

    /**
     * Gets the public 'MailPoet\API\JSON\v1\Mailer' shared autowired service.
     *
     * @return \MailPoet\API\JSON\v1\Mailer
     */
    protected function getMailerService()
    {
        return $this->services['MailPoet\API\JSON\v1\Mailer'] = new \MailPoet\API\JSON\v1\Mailer();
    }

    /**
     * Gets the public 'MailPoet\API\JSON\v1\NewsletterTemplates' shared autowired service.
     *
     * @return \MailPoet\API\JSON\v1\NewsletterTemplates
     */
    protected function getNewsletterTemplatesService()
    {
        return $this->services['MailPoet\API\JSON\v1\NewsletterTemplates'] = new \MailPoet\API\JSON\v1\NewsletterTemplates();
    }

    /**
     * Gets the public 'MailPoet\API\JSON\v1\Newsletters' shared autowired service.
     *
     * @return \MailPoet\API\JSON\v1\Newsletters
     */
    protected function getNewslettersService()
    {
        return $this->services['MailPoet\API\JSON\v1\Newsletters'] = new \MailPoet\API\JSON\v1\Newsletters();
    }

    /**
     * Gets the public 'MailPoet\API\JSON\v1\Segments' shared autowired service.
     *
     * @return \MailPoet\API\JSON\v1\Segments
     */
    protected function getSegmentsService()
    {
        return $this->services['MailPoet\API\JSON\v1\Segments'] = new \MailPoet\API\JSON\v1\Segments();
    }

    /**
     * Gets the public 'MailPoet\API\JSON\v1\SendingQueue' shared autowired service.
     *
     * @return \MailPoet\API\JSON\v1\SendingQueue
     */
    protected function getSendingQueueService()
    {
        return $this->services['MailPoet\API\JSON\v1\SendingQueue'] = new \MailPoet\API\JSON\v1\SendingQueue();
    }

    /**
     * Gets the public 'MailPoet\API\JSON\v1\Services' shared autowired service.
     *
     * @return \MailPoet\API\JSON\v1\Services
     */
    protected function getServicesService()
    {
        return $this->services['MailPoet\API\JSON\v1\Services'] = new \MailPoet\API\JSON\v1\Services();
    }

    /**
     * Gets the public 'MailPoet\API\JSON\v1\Settings' shared autowired service.
     *
     * @return \MailPoet\API\JSON\v1\Settings
     */
    protected function getSettingsService()
    {
        return $this->services['MailPoet\API\JSON\v1\Settings'] = new \MailPoet\API\JSON\v1\Settings();
    }

    /**
     * Gets the public 'MailPoet\API\JSON\v1\Setup' shared autowired service.
     *
     * @return \MailPoet\API\JSON\v1\Setup
     */
    protected function getSetupService()
    {
        return $this->services['MailPoet\API\JSON\v1\Setup'] = new \MailPoet\API\JSON\v1\Setup();
    }

    /**
     * Gets the public 'MailPoet\API\JSON\v1\Subscribers' shared autowired service.
     *
     * @return \MailPoet\API\JSON\v1\Subscribers
     */
    protected function getSubscribersService()
    {
        return $this->services['MailPoet\API\JSON\v1\Subscribers'] = new \MailPoet\API\JSON\v1\Subscribers();
    }

    /**
     * Gets the public 'MailPoet\API\MP\v1\API' shared autowired service.
     *
     * @return \MailPoet\API\MP\v1\API
     */
    protected function getAPI2Service()
    {
        return $this->services['MailPoet\API\MP\v1\API'] = new \MailPoet\API\MP\v1\API(${($_ = isset($this->services['MailPoet\Subscribers\NewSubscriberNotificationMailer']) ? $this->services['MailPoet\Subscribers\NewSubscriberNotificationMailer'] : $this->services['MailPoet\Subscribers\NewSubscriberNotificationMailer'] = new \MailPoet\Subscribers\NewSubscriberNotificationMailer()) && false ?: '_'}, ${($_ = isset($this->services['MailPoet\Subscribers\ConfirmationEmailMailer']) ? $this->services['MailPoet\Subscribers\ConfirmationEmailMailer'] : $this->services['MailPoet\Subscribers\ConfirmationEmailMailer'] = new \MailPoet\Subscribers\ConfirmationEmailMailer()) && false ?: '_'}, ${($_ = isset($this->services['MailPoet\Subscribers\RequiredCustomFieldValidator']) ? $this->services['MailPoet\Subscribers\RequiredCustomFieldValidator'] : $this->services['MailPoet\Subscribers\RequiredCustomFieldValidator'] = new \MailPoet\Subscribers\RequiredCustomFieldValidator()) && false ?: '_'});
    }

    /**
     * Gets the public 'MailPoet\Config\AccessControl' shared autowired service.
     *
     * @return \MailPoet\Config\AccessControl
     */
    protected function getAccessControlService()
    {
        return $this->services['MailPoet\Config\AccessControl'] = new \MailPoet\Config\AccessControl();
    }

    /**
     * Gets the public 'MailPoet\Cron\Daemon' shared autowired service.
     *
     * @return \MailPoet\Cron\Daemon
     */
    protected function getDaemonService()
    {
        return $this->services['MailPoet\Cron\Daemon'] = new \MailPoet\Cron\Daemon();
    }

    /**
     * Gets the public 'MailPoet\Cron\DaemonHttpRunner' shared autowired service.
     *
     * @return \MailPoet\Cron\DaemonHttpRunner
     */
    protected function getDaemonHttpRunnerService()
    {
        return $this->services['MailPoet\Cron\DaemonHttpRunner'] = new \MailPoet\Cron\DaemonHttpRunner(${($_ = isset($this->services['MailPoet\Cron\Daemon']) ? $this->services['MailPoet\Cron\Daemon'] : $this->services['MailPoet\Cron\Daemon'] = new \MailPoet\Cron\Daemon()) && false ?: '_'});
    }

    /**
     * Gets the public 'MailPoet\Newsletter\AutomatedLatestContent' shared autowired service.
     *
     * @return \MailPoet\Newsletter\AutomatedLatestContent
     */
    protected function getAutomatedLatestContent2Service()
    {
        return $this->services['MailPoet\Newsletter\AutomatedLatestContent'] = new \MailPoet\Newsletter\AutomatedLatestContent();
    }

    /**
     * Gets the public 'MailPoet\Router\Endpoints\CronDaemon' shared autowired service.
     *
     * @return \MailPoet\Router\Endpoints\CronDaemon
     */
    protected function getCronDaemonService()
    {
        return $this->services['MailPoet\Router\Endpoints\CronDaemon'] = new \MailPoet\Router\Endpoints\CronDaemon(${($_ = isset($this->services['MailPoet\Cron\DaemonHttpRunner']) ? $this->services['MailPoet\Cron\DaemonHttpRunner'] : $this->getDaemonHttpRunnerService()) && false ?: '_'});
    }

    /**
     * Gets the public 'MailPoet\Router\Endpoints\Subscription' shared autowired service.
     *
     * @return \MailPoet\Router\Endpoints\Subscription
     */
    protected function getSubscriptionService()
    {
        return $this->services['MailPoet\Router\Endpoints\Subscription'] = new \MailPoet\Router\Endpoints\Subscription();
    }

    /**
     * Gets the public 'MailPoet\Router\Endpoints\Track' shared autowired service.
     *
     * @return \MailPoet\Router\Endpoints\Track
     */
    protected function getTrackService()
    {
        return $this->services['MailPoet\Router\Endpoints\Track'] = new \MailPoet\Router\Endpoints\Track();
    }

    /**
     * Gets the public 'MailPoet\Router\Endpoints\ViewInBrowser' shared autowired service.
     *
     * @return \MailPoet\Router\Endpoints\ViewInBrowser
     */
    protected function getViewInBrowserService()
    {
        return $this->services['MailPoet\Router\Endpoints\ViewInBrowser'] = new \MailPoet\Router\Endpoints\ViewInBrowser(${($_ = isset($this->services['MailPoet\Config\AccessControl']) ? $this->services['MailPoet\Config\AccessControl'] : $this->services['MailPoet\Config\AccessControl'] = new \MailPoet\Config\AccessControl()) && false ?: '_'});
    }

    /**
     * Gets the public 'MailPoet\Subscribers\ConfirmationEmailMailer' shared autowired service.
     *
     * @return \MailPoet\Subscribers\ConfirmationEmailMailer
     */
    protected function getConfirmationEmailMailerService()
    {
        return $this->services['MailPoet\Subscribers\ConfirmationEmailMailer'] = new \MailPoet\Subscribers\ConfirmationEmailMailer();
    }

    /**
     * Gets the public 'MailPoet\Subscribers\NewSubscriberNotificationMailer' shared autowired service.
     *
     * @return \MailPoet\Subscribers\NewSubscriberNotificationMailer
     */
    protected function getNewSubscriberNotificationMailerService()
    {
        return $this->services['MailPoet\Subscribers\NewSubscriberNotificationMailer'] = new \MailPoet\Subscribers\NewSubscriberNotificationMailer();
    }

    /**
     * Gets the public 'MailPoet\Subscribers\RequiredCustomFieldValidator' shared autowired service.
     *
     * @return \MailPoet\Subscribers\RequiredCustomFieldValidator
     */
    protected function getRequiredCustomFieldValidatorService()
    {
        return $this->services['MailPoet\Subscribers\RequiredCustomFieldValidator'] = new \MailPoet\Subscribers\RequiredCustomFieldValidator();
    }
}
