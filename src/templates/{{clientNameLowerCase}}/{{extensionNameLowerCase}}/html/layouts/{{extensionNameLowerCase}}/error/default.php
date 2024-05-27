<?php

/**
 * @copyright  {{copyright}}
 * @license    {{license}}
 */

defined('_JEXEC') || die();

use Joomla\CMS\Language\Text;

extract($displayData, EXTR_OVERWRITE);

// Get the error code
$errorCode = $doc->error->getCode();
$outputArr = [];

if ($doc->debug) {
  $outputArr = ['<div>', $doc->renderBacktrace()];

  if ($doc->error->getPrevious()) {
    $loop = true;
    // Reference $doc->_error here and in the loop as setError() assigns errors to this property and we need doc for the backtrace to work correctly
    // Make the first assignment to setError() outside the loop so the loop does not skip Exceptions
    $doc->setError($doc->_error->getPrevious());

    while ($loop === true) {
      $outputArr[] = '<p><strong>' . Text::_('JERROR_LAYOUT_PREVIOUS_ERROR') . '</strong></p>';
      $outputArr[] = '<p>' . htmlspecialchars($doc->_error->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
      $outputArr[] = $doc->renderBacktrace();
      $loop        = $doc->setError($doc->_error->getPrevious());
    }
    // Reset the main error object to the base error
    $doc->setError($doc->error);
  }
  $outputArr[] = '</div>';
}
?>
<h1 class="page-header"><?= Text::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h1>
<div class="card">
  <div class="card-body">
    <jdoc:include type="message" />
    <main>
      <p><strong><?= Text::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>
      <p><?= Text::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
      <ul>
        <li><?= Text::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
        <li><?= Text::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
        <li><?= Text::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
        <li><?= Text::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_doc_PAGE'); ?></li>
      </ul>
      <p><?= Text::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?></p>
      <p><a href="<?= $doc->baseurl; ?>/index.php"><?= Text::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
      <hr>
      <p><?= Text::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
      <blockquote>
        <span class="badge bg-secondary"><?= $errorCode; ?></span> <?= htmlspecialchars($doc->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?>
      </blockquote>
    </main>
  </div>
</div>
<?= implode('', $outputArr); ?>
