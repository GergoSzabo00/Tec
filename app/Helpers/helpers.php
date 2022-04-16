<?php

    /**
       * 
       * Trims extra whitespaces and capitalizes every word in the given string
       *
       * @param string $string  The string that will be processed.
       * @return string
       */
    function trcw($string)
    {
        //remove extra whitespaces from string
        $removed_whitespace = preg_replace('/\s+/', ' ', $string);
        //capitalize each word and return the string
        return mb_convert_case($removed_whitespace, MB_CASE_TITLE, 'UTF-8');
    }

?>