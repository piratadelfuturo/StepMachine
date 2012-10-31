<?php

namespace Boom\Bundle\LibraryBundle\Library;

/**
 * Description of DateTime
 *
 * @author daniel
 */
class DateTime extends \DateTime {

    //put your code here

    public function format($format) {
        try {
            $return = $this->extendedFormat($format);
        } catch (\Exception $e) {
            $return = parent::format($format);
        }
        return $return;
    }

    public function formatLocale($string, \Locale $locale) {
        return $this->extendedFormat($string, $locale);
    }

    private function extendedFormat($string, \Locale $locale = null) {
        $locale = $locale !== null ? $locale : \Locale::getDefault();
        $ftm = new \IntlDateFormatter(
                        $locale,
                        \IntlDateFormatter::FULL,
                        \IntlDateFormatter::FULL
        );
        $ftm->setPattern($string);
        return $ftm->format($this);
    }

}