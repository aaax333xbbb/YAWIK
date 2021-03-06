<?php
/**
 * YAWIK
 *
 * @filesource
 * @copyright https://yawik.org/COPYRIGHT.php
 * @license   MIT
 */

/** Settings.php */
namespace Settings\Controller\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;
use Auth\Entity\UserInterface;

class Settings extends AbstractPlugin
{
    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function __invoke($moduleName = null)
    {
        $controllerClass = ltrim(get_class($this->getController()), '\\');
        $namespace       = substr($controllerClass, 0, strpos($controllerClass, '\\'));

        if (null == $moduleName) {
            $moduleName = $namespace;
        }
        $settings = $this->user->getSettings($moduleName);

        if ($namespace == $moduleName) {
            $settings->enableWriteAccess();
        }

        return $settings;
    }
}
