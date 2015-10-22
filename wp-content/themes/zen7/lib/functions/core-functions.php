<?php

/**
 * Count words based on wp_trim_words() function.
 *
 * @param $text string
 * @param $num_words int
 *
 * @return int
 */
function st_count_words( $text, $num_words = 55 ) {
    $text = wp_strip_all_tags( $text );
    /* translators: If your word count is based on single characters (East Asian characters),
       enter 'characters'. Otherwise, enter 'words'. Do not translate into your own language. */
    if ( 'characters' == _x( 'words', 'word count: words or characters?', LANGUAGE_ZONE ) && preg_match( '/^utf\-?8$/i', get_option( 'blog_charset' ) ) ) {
        $text = trim( preg_replace( "/[\n\r\t ]+/", ' ', $text ), ' ' );
        preg_match_all( '/./u', $text, $words_array );
        $words_array = array_slice( $words_array[0], 0, null );
    } else {
        $words_array = preg_split( "/[\n\r\t ]+/", $text, -1, PREG_SPLIT_NO_EMPTY );
    }

    return count( $words_array );
}