<?php
/**
 * @file
 * Translatable UI string definitions.
 */


// -----------------------------------------------------------------------------
// Primary locale.

// Common UI.
$str['primary']['site-name']             = 'Example website, yay';
$str['primary']['site-tagline-1']        = "Site tagline numero uno";
$str['primary']['Home page']             = 'Home page';
$str['primary']['Menu']                  = 'Menu';
$str['primary']['Jump to']               = 'Jump to';
$str['primary']['To page top']           = 'To page top';
$str['primary']['Contents']              = 'Contents';
$str['primary']['In section:']           = 'In section';
$str['primary']['page-langswitch-short'] = 'Magyarul';
$str['primary']['page-langswitch-long']  = 'Az oldal tartalma magyarul';
$str['primary']['Jump to content']       = 'Jump to content';
$str['primary']['Jump to menu']          = 'Jump to menu';
$str['primary']['website-lastmod']       = 'Date of last change on the website';
$str['primary']['Image']                 = 'Image';

// Data Fields.
$str['primary']['fl--date-uploaded']     = 'Upload date';
$str['primary']['fl--date-published']    = 'Publication date';
$str['primary']['fl--date-lastmod']      = 'Last modified';
$str['primary']['fl--preview-text']      = 'Preview text';
$str['primary']['fl--preview-image']     = 'Preview image';
$str['primary']['fl--title']             = 'Title';
$str['primary']['fl--subtitle']          = 'Subtitle';
$str['primary']['fl--body']              = 'Body';
$str['primary']['fl--description']       = 'Description';
$str['primary']['fl--author']            = 'Author';

// Language switchers.
$str['primary']['Languages']             = 'Languages';
$str['primary']['Site language']         = 'Site language';
$str['primary']['Home page']             = 'Home page';
$str['primary']['Translations']          = 'Translations';
$str['primary']['no-translations']       = 'No translations.';

$str['primary']['global-langswitch-link-text']  = 'In English';
$str['primary']['global-langswitch-link-title'] = 'The homepage in English';
$str['primary']['page-langswitch-short'] = 'In English';
$str['primary']['page-langswitch-long']  = 'The contents of this page in English';

// Flexilist.
$str['primary']['Preview image for']     = 'Preview image for';
$str['primary']['Jump to the following'] = 'Jump to the following';
$str['primary']['flexilist-empty-result'] = 'No results were found.';

// Error messages.
$str['primary']['http-403']              = 'The requested content is not accessible.';
$str['primary']['http-404']              = 'The requested content cannot be found on this website.';
$str['primary']['http-410']              = 'The requested content has ceased to exist on this website.';

// Misc.
$str['primary']['deprecated-description'] = '<p>PLEASE NOTE:</p><p>This content is considered deprecated and is not being maintained.</p><p>The accuracy of the information within might be questionable.</p>';

// -----------------------------------------------------------------------------
// Secondary locale.

// Common UI.
$str['secondary']['site-name']             = 'Példa webhely, juhé';
$str['secondary']['site-tagline-1']        = 'Webhely jelmondat numero egy';
$str['secondary']['Home page']             = 'Kezdőlap';
$str['secondary']['Menu']                  = 'Menü';
$str['secondary']['Jump to']               = 'Ugrás';
$str['secondary']['To page top']           = 'Oldal tetejére';
$str['secondary']['Contents']              = 'Tartalom';
$str['secondary']['In section:']           = 'Szekció';
$str['secondary']['page-langswitch-short'] = 'In English';
$str['secondary']['page-langswitch-long']  = 'The contents of this page in English';
$str['secondary']['Jump to content']       = 'Ugrás a tartalomhoz';
$str['secondary']['Jump to menu']          = 'Ugrás a menühöz';
$str['secondary']['website-lastmod']       = 'Utolsó módosítás a webhelyen';
$str['secondary']['Image']                 = 'Kép';

// Data Fields.
$str['secondary']['fl--date-uploaded']     = 'Feltöltés dátuma';
$str['secondary']['fl--date-published']    = 'Közzététel dátuma';
$str['secondary']['fl--date-lastmod']      = 'Utolsó módosítás';
$str['secondary']['fl--preview-text']      = 'Összefoglaló szöveg';
$str['secondary']['fl--preview-image']     = 'Összefoglaló kép';
$str['secondary']['fl--title']             = 'Cím';
$str['secondary']['fl--subtitle']          = 'Alcím';
$str['secondary']['fl--body']              = 'Törzs';
$str['secondary']['fl--description']       = 'Leírás';
$str['secondary']['fl--author']            = 'Szerző';

// Language switchers.
$str['secondary']['Languages']             = 'Nyelvek';
$str['secondary']['Site language']         = 'Webhely nyelve';
$str['secondary']['Home page']             = 'Kezdőlap';
$str['secondary']['Translations']          = 'Fordítások';
$str['secondary']['no-translations']       = 'Nincsenek fordítások.';
$str['secondary']['global-langswitch-link-text']  = 'Magyarul';
$str['secondary']['global-langswitch-link-title'] = 'A kezdőlap magyarul';
$str['secondary']['page-langswitch-short'] = 'Magyarul';
$str['secondary']['page-langswitch-long']  = 'Ezen oldal tartalma magyarul';

// Flexilist.
$str['secondary']['Preview image for']     = 'Összefoglaló kép a következőhöz';
$str['secondary']['Jump to the following'] = 'Ugrás a következőhöz';
$str['secondary']['flexilist-empty-result'] = 'Nincs találat.';

// Error messages.
$str['secondary']['http-403']              = 'A kért tartalomhoz való hozzáférés nem engedélyezett.';
$str['secondary']['http-404']              = 'A kért tartalom nem található ezen a webhelyen.';
$str['secondary']['http-410']              = 'A kért tartalom megszűnt létezni ezen a webhelyen.';

// Misc.
$str['secondary']['deprecated-description'] = '<p>KÉREM VEGYE FIGYELEMBE:</p><p>Az alábbi tartalom elavultnak tekintendő, további karbantartására már nem kerül sor.</p><p>A közölt információk pontossága és naprakészsége megkérdőjelezhető lehet.</p>';


// #############################################################################
// Dis we need :S.

$string_translations = $str; // Importante!
unset($str);
