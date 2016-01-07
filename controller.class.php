<?php
include_once 'controller.interface.php';
use Doctrine\ORM\EntityManager;
class controller implements controllerInterface{
  protected $em;
  protected $view;
  protected $accessList;
  /**
 * @InjectParams({
 *    "em" = @Inject("doctrine.orm.entity_manager")
 * })
 */
  public function __construct(EntityManager $em, $path)
  {
    $views = unserialize(VIEWS);
    $pathView[] = $path.'/views';                       // Load the views from the app or package you are using
    foreach ($views as $view) {
      $pathView[] = $view;                               // Can load anothers views from anothers packages
    }
    $cachePath = 'tmp/cache';     // compiled file path

    $compiler = new \Xiaoler\Blade\Compilers\BladeCompiler($cachePath);
    $engine = new \Xiaoler\Blade\Engines\CompilerEngine($compiler);
    $finder = new \Xiaoler\Blade\FileViewFinder($pathView);
    $factory = new \Xiaoler\Blade\Factory($engine, $finder);
    $this->view = $factory;

    $this->em = $em;
    $this->blade = $blade;
  }

  /**
   * Access is the default midleware
   * Midleware is a function that run before the controller, this function is used to verify if the user have permission to access the router
   * For edit the middleware you can set another name of the midleware on the routing call or overwrite this function in your controllers
   *
   * @param  [String] $functionName [The name of the function the route wants to run]
   * @param  [Array] $accessList [This is a associative array functionName => access level for each function in the class]
   * @param  [User] $me           [The object user for me, this object must have the method getLevel to check the level of the user]
   * @return [boolean]               [True for running the route, false for display error no permission]
   */
  public function access($functionName, $me){
    return true;
  }
}
