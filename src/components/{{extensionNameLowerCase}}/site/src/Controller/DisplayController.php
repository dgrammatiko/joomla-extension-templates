<?php

/**
 * {{copyright}}
 * {{license}}
 */

namespace {{companyNamePascal}}\Component\{{extensionNamePascal}}\Site\Controller;

\defined('_JEXEC') || die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\BaseController;

class DisplayController extends BaseController
{
  /**
   * Method to display a view.
   *
   * @param   boolean  $cachable   If true, the view output will be cached
   * @param   array    $urlParams  An array of safe url parameters and their variable types, for valid values see FilterInput::clean().
   *
   * @return  $this
   *
   * @see     FilterInput::clean()
   */
  public function display($cachable = false, $urlParams = [])
  {
    // Set the default view name and format from the Request.
    $this->input->set('view', $this->input->get('view', 'default'));

    if ($this->app->getIdentity()->get('id')) {
      $cachable = false;
    }

    /*
     * If the user's requesting a non-existing page and is using this as their default menu item, they'll get a "view not found" error.
     * If that's the error they received, convert it to a more generic and human friendly "content not found" message.
     */
    try {
      return parent::display($cachable, $urlParams);
    } catch (\Exception $e) {
      $trace = $e->getTrace();

      $thrower = $trace[0];

      // If this is the "view not found" error, the thrower is JControllerLegacy::getView(); standardize to lowercased strings just in case
      if (strtolower($thrower['class']) === 'basecontroller' && strtolower($thrower['function']) === 'getview') {
        throw new \Exception(Text::_('JERROR_LAYOUT_REQUESTED_RESOURCE_WAS_NOT_FOUND'), 404, $e);
      }

      // Some other error, just let it bubble up
      throw $e;
    }
  }
}
