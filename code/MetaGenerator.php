<?php
/**
 * Static MetaGeneratorClass to generate keywords from whereever you need.
 * Returns a lowercase string with keywords ordered by occurance in content seperated with comma's
 * Use MetaGenerator::generateKeywords($string);
 * 
 * @Author Martijn van Nieuwenhoven
 * @Alias Marvanni
 * @Email info@axyrmedia.nl
 */
class MetaGenerator{
	
	/**
	 * Extract Keywords
	 * Returns a lowercase string with keywords ordered by occurance in content seperated with comma's
	 * @var $string
	 * @var $min_word_char
	 * @var $keyword_amount
	 * @var $exclude_words
	 */
	public static function generateKeywords($string = '', $min_word_char = 4, $keyword_amount = 15,  $exclude_words = ''){
		return self::calculateKeywords($string, $min_word_char, $keyword_amount,  $exclude_words);
	}
	
	private function calculateKeywords($string = '', $min_word_char = 3, $keyword_amount = 15,  $exclude_words = '' ) {
		
		$exclude_words = explode(", ", $exclude_words);
		//add space before br tags so words aren't concatenated when tags are stripped
		$string = preg_replace('/\<br(\s*)?\/?\>/i', " <br />", $string); 
		// get rid off the htmltags
		$string = html_entity_decode(strip_tags($string), ENT_NOQUOTES , 'UTF-8');
		
		// count all words with str_word_count_utf8
		$initial_words_array  = self::str_word_count_utf8($string, 1);
		$total_words = sizeof($initial_words_array);
		
		$new_string = $string;
		
		//convert to lower case
		$new_string = mb_convert_case($new_string, MB_CASE_LOWER, "UTF-8");
		
		// strip excluded words
		foreach($exclude_words as $filter_word)	{
			$new_string = preg_replace("/\b".$filter_word."\b/i", "", $new_string); 
		}
		
		// calculate words again without the excluded words using str_word_count_utf8
		$words_array = self::str_word_count_utf8($new_string, 1);
		$words_array = array_filter($words_array, create_function('$var', 'return (strlen($var) >= '.$min_word_char.');'));
		
		$popularity = array();
		$unique_words_array = array_unique($words_array);
		
		// create density array
		foreach($unique_words_array as  $key => $word)	{
			preg_match_all('/\b'.$word.'\b/i', $string, $out);
			$count = count($out[0]);	
			$popularity[$key]['count'] = $count;
			$popularity[$key]['word'] = $word;
			
		}
		
		usort($popularity, array('MetaGenerator','cmp'));
		
		// sort array form higher to lower
		krsort($popularity);
		
		// create keyword array with only words
		$keywords = array();
		foreach($popularity as $value){
			$keywords[] = $value['word']; 
		}
					
		// glue keywords to string seperated by comma, maximum 15 words
		$keystring =  implode(', ', array_slice($keywords, 0, $keyword_amount));
		
		// return the keywords
		return $keystring;
	}
	
	/**
	 * Sort array by count value
	 */
	private static function cmp($a, $b) {
		return ($a['count'] > $b['count']) ? +1 : -1;
	}

	/** Word count for UTF8
	/* Found in: http://www.php.net/%20str_word_count#85592
	/* The original mask contained the apostrophe, not good for Meta keywords:
	/* "/\p{L}[\p{L}\p{Mn}\p{Pd}'\x{2019}..."
	*/
    private static function str_word_count_utf8($string, $format = 0) {
        switch ($format) {
        case 1:
            preg_match_all("/\p{L}[\p{L}\p{Mn}\p{Pd}]*/u", $string, $matches);
            return $matches[0];
        case 2:
            preg_match_all("/\p{L}[\p{L}\p{Mn}\p{Pd}]*/u", $string, $matches, PREG_OFFSET_CAPTURE);
            $result = array();
            foreach ($matches[0] as $match) {
                $result[$match[1]] = $match[0];
            }
            return $result;
        }
        return preg_match_all("/\p{L}[\p{L}\p{Mn}\p{Pd}]*/u", $string, $matches);
    }		
	
}