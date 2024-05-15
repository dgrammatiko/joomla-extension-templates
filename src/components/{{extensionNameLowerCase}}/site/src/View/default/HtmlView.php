<?php

/**
 * @copyright  {{copyright}}
 * @license    {{license}}
 */

namespace {{companyNamePascal}}\Component\{{extensionNamePascal}}\Site\View\Default;

\defined('_JEXEC') || die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

/**
 * Default HTML view class
 */
class HtmlView extends BaseHtmlView
{
  /**
   * Display the view
   *
   * @param   string  $tpl  The name of the template file to parse
   *
   * @return  mixed  A string if successful, otherwise a JError object.
   */
  public function display($tpl = null)
  {
    $app    = Factory::getApplication();
    $params = $app->getParams();
    $title  = $params->get('page_title', '');

    if (empty($title)) {
      $title = $app->get('sitename');
    } elseif ($app->get('sitename_pagetitles', 0) == 1) {
      $title = Text::sprintf('JPAGETITLE', $app->get('sitename'), $title);
    } elseif ($app->get('sitename_pagetitles', 0) == 2) {
      $title = Text::sprintf('JPAGETITLE', $title, $app->get('sitename'));
    }

    $this->document->setTitle($title);

    if ($params->get('menu-meta_description')) {
      $this->document->setDescription($params->get('menu-meta_description'));
    }

    if ($params->get('robots')) {
      $this->document->setMetaData('robots', $params->get('robots'));
    }

    return parent::display($tpl);
  }
}
