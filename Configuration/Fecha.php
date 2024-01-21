<?php
//test_locales.php by torvista
//testing locales...down the rabbit hole you go (on Windows)

//add more testing names as required
//English
$english = array(
    'en', 'english_gbr', 'english_britain', 'english_england', 'english_great britain', 'english_uk', 'english_united kingdom', 'english_united-kingdom', 'en_GB.utf8',
    'en_US', 'en_US.utf8', 'en_us_utf8', 'en.UTF-8', 'english_usa', 'english_america', 'english_united states', 'english_united-states', 'english_us');

//Dutch
$dutch = array('nl_NL.utf8', 'nl', 'nl-NL', 'nld_nld');

//German
$german = array('de', 'de_DE@euro', 'de_DE', 'deu_deu');

//Spanish
$spanish = array('es_utf8', 'es', 'es-ES', 'Spanish_Modern_Sort', 'es_utf8', 'es_ES@euro', 'esp_esp', 'esp_spain', 'spanish_esp', 'spanish_spain', 'es_ES.utf8', 'es-es');
//----------------------------------------------------------------------------------------------

function list_nix_locales($code, $language)
{
    echo "<h3>$language: using <em>system('locale -a | grep -i $code')</em></h3>";
    echo "<p>The available 'locale' strings for '$code' on this server are:</p>";
    echo "<pre>";
    system("locale -a | grep -i $code");
    echo "</pre>";
}

function check_locales($test_names, $language)
{
    echo '<hr />';
    echo "<h3>$language</h3>";
    foreach ($test_names as $value) {

        echo '<hr style="margin-left:0;width:30%" />';
        echo "<p>Trying: '<em>$value</em>'</p>";
        $locale_found = setlocale(LC_TIME, $value);

        if ($locale_found) {
            echo "<p>locale '<em><strong>$locale_found</strong></em>' found for '<em>$value</em>'. ";
            echo 'eg.: ' . strftime("%A %d %B %Y", mktime(0, 0, 0, 12, 23, 1978)) . '</p>';
        } else {
            echo "<p>No locale found for '<em>$value</em>'</p>";
        }
    }
}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo(stristr(PHP_OS, "win") ? 'Windows' : 'Unix'); ?> Server - Test
        Locales<?php echo(stristr(PHP_OS, "win") ? '- Windows' : '- Unix'); ?></title>
    <style type="text/css">body {
            padding: 1em;
            font-family: Verdana, Geneva, sans-serif;
            font-size: .8em
        }

        code, pre {
            font-size: 1.4em
        }

        h1 {
            font-size: 1.1em;
            text-decoration: underline;
        }

        h2 {
            font-size: 1em
        }

        h3 {
            font-size: .9em
        }
    </style>
</head>
<body>

<h1>Testing Locales</h1>
<p>In this script are defined lists of possible locales for both Windows and Unix-based servers. The tests will try them
    all to show the possible values to use for LC_TIME on this server in the main language file.</p>
<?php
if (!stristr(PHP_OS, "win")) { ?>
    <h2>UNIX server</h2>
    <?php
    //English en
    list_nix_locales('en', 'English');

    //Dutch en
    list_nix_locales('nl', 'Dutch');

    //German de
    list_nix_locales('de', 'German');

    //Spanish es
    list_nix_locales('es', 'Spanish');


} else { ?>

    <h2>WINDOWS server</h2>
    <p>It is possible to get a listing of all the installed locales in Windows with the Windows Powershell (requires
        .net), as detailed <a
            href="http://powershell.org/getting-a-list-of-windows-language-locales-with-windows-powershell/"
            target="_blank">here</a>:</p>
    <p>Open Windows Powershell console, eg: <code>PS C:\Users\Steve></code></p>
    <p><code>E</code>nter the command as shown to get the listing:</p>
    <p><code>[System.Globalization.Cultureinfo]::GetCultures('AllCultures')</code></p>
    <p>To be clever and get a csv file of this full listing (change the destination as required), use this set of
        commands on one line (the semicolons concatenate the commnds):</p>
    <code>Function global:GET-CULTURE {
        [System.Globalization.Cultureinfo]::GetCultures('AllCultures') }; $locales=GET-CULTURE; $locales | EXPORT-CSV
        D:locales.csv</code>
    <p>See the references at the foot of this page to go some way towards convincing you to dump your Windows-based
        hosting and it's lack of support for utf-8:</p>
    <p> Quote from Microsoft <a href="https://msdn.microsoft.com/en-us/library/x99tb11d.aspx" target="_blank">here</a>.
        <blockquote>
    <p>"The locale argument can take a locale name, a language string, a language string and country/region code, a code
        page, or a language string, country/region code, and code page. The set of available locale names, languages,
        country/region codes, and code pages includes all those supported by the Windows NLS API except code pages that
        require more than two bytes per character, such as UTF-7 and UTF-8.<br>
        <strong>If you provide a code page value of UTF-7 or UTF-8, setlocale will fail, returning NULL</strong>."</p>
    </blockquote>
    <?php
}

//English
check_locales($english, 'English');

//Dutch
check_locales($dutch, 'Dutch');

//German
check_locales($german, 'German');

//Spanish
check_locales($spanish, 'Spanish');

?>
<hr/>
<h1>Resources</h1>
<p>PHP setlocale: <a href="http://php.net/manual/en/function.setlocale.php" target="_blank">http://php.net/manual/en/function.setlocale.php</a>
</p>
<p>Guide to getting PHP, utf-8 and mysql to play together: <a
        href="https://www.toptal.com/php/a-utf-8-primer-for-php-and-mysql" target="_blank">https://www.toptal.com/php/a-utf-8-primer-for-php-and-mysql</a>
</p>
<p>UTF-8 background: <a href="http://htmlpurifier.org/docs/enduser-utf8.html" target="_blank">http://htmlpurifier.org/docs/enduser-utf8.html</a>
</p>
<p>Character sets: <a href="http://www.phpwact.org/php/i18n/charsets" target="_blank">http://www.phpwact.org/php/i18n/charsets</a>
</p>
<p>Table of locales/codepages: <a href="https://docs.moodle.org/dev/Table_of_locales" target="_blank">https://docs.moodle.org/dev/Table_of_locales</a>
</p>
<h2>The Wacky World of Windows</h2>
<p><a href="http://stackoverflow.com/questions/10995953/php-setlocale-in-windows-7" target="_blank">http://stackoverflow.com/questions/10995953/php-setlocale-in-windows-7</a>
</p>
<p>Table of Locales: <a href="http://www.science.co.il/Language/Locale-codes.asp#definitions" target="_blank">http://www.science.co.il/Language/Locale-codes.asp#definitions</a>
</p>
<p>Globalization Step-by-Step: <a href="https://msdn.microsoft.com/en-gb/goglobal/bb688113.aspx" target="_blank">https://msdn.microsoft.com/en-gb/goglobal/bb688113.aspx</a>
</p>
<p> Windows Country/Region Strings: <a href="https://msdn.microsoft.com/en-us/library/cdax410z(v=vs.140).aspx"
                                       target="_blank">https://msdn.microsoft.com/en-us/library/cdax410z(v=vs.140).aspx</a>
</p>
<p>Windows Language Strings: <a href="https://msdn.microsoft.com/en-us/library/39cwe7zf.aspx" target="_blank">https://msdn.microsoft.com/en-us/library/39cwe7zf.aspx</a>
</p>
<p>National Language Support (NLS) API Reference: <a href="https://msdn.microsoft.com/en-us/goglobal/bb896001.aspx"
                                                     target="_blank">https://msdn.microsoft.com/en-us/goglobal/bb896001.aspx</a>
</p>
<p>Locale IDs, Input Locales, and Language Collections for Windows XP and Windows Server 2003: <a
        href="https://msdn.microsoft.com/en-us/goglobal/bb895996.asp" target="_blank">https://msdn.microsoft.com/en-us/goglobal/bb895996.asp</a>x
</p>
</body>
</html>