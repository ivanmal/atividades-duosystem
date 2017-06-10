<?php
namespace Application\Form\View\Helper;

use Traversable;
use Zend\Form\View\Helper\AbstractHelper;
use Zend\View\Exception\DomainException;

/**
 * Custom Form Helper ErrorMessages para exibição de mensagens de erro traduzidas
 *
 * @author ivanx
 */
class ErrorMessages extends AbstractHelper
{

    /**
     * 
     * @param \Zend\Form\ElementInterfaceterface $element
     * @param \Zend\I18n\Translator\TranslatorInterface $translator
     * @return @return string|$this
     */
    public function __invoke($element = null, \Zend\I18n\Translator\TranslatorInterface $translator)
    {
        if (!$element) {
            return $this;
        }

        return $this->render($element, $translator);
    }

    /**
     * 
     * @param type $element
     * @param \Zend\I18n\Translator\TranslatorInterface $translator
     * @return string
     * @throws DomainException
     */
    public function render($element, \Zend\I18n\Translator\TranslatorInterface $translator)
    {
        $messages = $element->getMessages();
        if (empty($messages)) {
            return '';
        }

        if (!is_array($messages) && !$messages instanceof Traversable) {
            throw new DomainException(sprintf(
                '%s expects that $element->getMessages() will return an array or Traversable; received "%s"', __METHOD__, (is_object($messages) ? get_class($messages) : gettype($messages))
            ));
        }

        $escapeHtml = $this->getEscapeHtmlHelper();
        $messagesToPrint = array();
        array_walk_recursive($messages, function ($item) use (&$messagesToPrint, $escapeHtml, $translator) {
            $messagesToPrint[] = $escapeHtml($translator->translate($item, 'default', 'pt_BR'));
        });

        $markup = '';//'<ul%s><li>';
        $markup .= implode(''/*'</li><li>'*/, $messagesToPrint);
        $markup .= '';//'</li></ul>';

        return $markup;
    }
}
