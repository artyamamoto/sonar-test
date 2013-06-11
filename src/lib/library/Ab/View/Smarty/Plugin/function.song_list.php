<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {song_list} function plugin
 *
 * Type:     function<br>
 * Name:     song_list<br>
 * Date:     May 14, 2011<br>
 * Purpose:  draw input text
 * @author   M/Kamoshida
 * @version  1.0
 * @param array
 * @param Smarty
 * @return string output
 */
function smarty_function_song_list($params, &$smarty)
{
    if(!isset($params['index'])) {
        return '';
    }

    $index = $params['index'];

    $songs = array(
        array(
            'All of me for you',
            'Baby Baby',
            'Baby Moonlight',
            'Big Sky Blues',
            'BJ',
            'BOY',
            'Brilliant Blue',
            'Carnival',
            'cinematic',
            'Cool magic city',
            'DREAMIN\' BLOOD',
            'Dye D?',
            'Eden',
            'Eightopop!!!!!!!',
            'ER',
            'Explosion',
            'Fight for the Eight',
            'Fly High',
            'F･T･O',
            'fuka-fuka Love the Earth',
            'Great Escape ～大脱走～',
            'Heat is on',
            'Heavenly Psycho',
            'Hi & high',
            'I to U',
            'I wish',
            'Jackhammer',
            'LIFE ～目の前の向こうへ～',
            'Merry go Round',
            'My Last Train  ',
            'ONE',
            'One day in winter',
            'Snow White',
            'Speedy Wonder',
            'Train in the rain',
            'T.W.L',
            'wander',
            'Water Drop',
            'Wonderful World!!',
        ),
        array(
            '愛でした｡',
            '愛に向かって',
            '蒼写真',
            'ｱｶｲｼﾝｷﾛｳ',
            'ｱﾆﾏﾙ･ﾏｼﾞｯｸ',
            'あの言葉に',
            '雨のち晴れ',
            'ありがとう｡',
            'ｲｴﾛｰﾊﾟﾝｼﾞｰｽﾄﾘｰﾄ',
            '一秒 KISS  ',
            'いつか､また...｡',
            'ｲｯﾂ ﾏｲ ｿｳﾙ',
            '浮世踊ﾘﾋﾞﾄ',
            '宇宙に行ったﾗｲｵﾝ',
            '∞ o\'clock 08',
            '∞ﾚﾝｼﾞｬｰ',
            'ｴﾈﾙｷﾞｰ',
            '桜援歌(Oh! ENKA)',
            '∞SAKAおばちゃんROCK',
            '大阪ﾚｲﾆｰﾌﾞﾙｰｽ',
            '大阪ﾛﾏﾈｽｸ',
        ),
        array(
            '輝ける舞台へ',
            '悲しい恋',
            '渇いた花   ',
            '関風ﾌｧｲﾃｨﾝｸﾞ',
            'ｷﾞｶﾞﾏｼﾞﾒ我ﾌｧｲﾄ  ',
            '君の歌をうたう',
            '急☆上☆Show!!',
            'ｹﾑﾘ',
            '強情にGO!',
            'ｺﾞﾘｺﾞﾘ',
        ),
        array(
            '咲いて生きよ    ',
            'ｻﾑﾗｲﾌﾞﾙｰｽ',
            'さよならはいつも',
            '365日家族',
            '地元の王様',
            '10年後の今日の日も',
            '情熱Party  ',
            '好きやねん､大阪｡',
            'ｽﾞｯｺｹ男道',
            'それでｲｲんじゃない',
        ),
        array(
            '太陽の子供',
            '旅の涯には',
            '旅人',
            '誰よりｷﾐが好きだから',
            '『って!!!!!!!』',
            'ﾂﾌﾞｻﾆｺｲ',
            'どんなに離れてたって傍にいるから',
        ),
        array(
            '泣かないで 僕のﾐｭｰｼﾞｯｸ',
            '七色ﾊﾟﾗﾒｰﾀ',
            '浪花いろは節',
            '願い',
        ),
        array(
            'ﾊﾟｽﾞﾙ',
            '果ﾃﾅｷ空',
            'ひとつのうた',
            '二人の涙雨',
            '冬恋',
            '冬のﾘｳﾞｨｴﾗ',
            'ﾌﾘｰﾀﾞﾑ理論',
            'ﾌﾞﾘｭﾚ ',
            'ﾌﾟﾛ∞ﾍﾟﾗ',
            'ほろりﾒﾛﾃﾞｨｰ',
        ),
        array(
            'ﾏｲﾅｽ100度の恋',
            'ﾏｲﾎｰﾑ',
            'ﾐｾﾃｸﾚ',
            '乱れ咲けﾛﾏﾝｽ',
            '道標',
            '未来の向こうへ',
            '無限大',
            '無責任ﾋｰﾛｰ',
            'ﾓﾉｸﾞﾗﾑ',
            'ﾓﾝじゃい･ﾋﾞｰﾄ',
        ),
        array(
            '雪をください',
            'ﾖﾘﾐﾁ',
        ),
        array(
            'ﾙﾗﾘﾗ',
            'ﾛｰﾘﾝｸﾞ･ｺｰｽﾀｰ',
        ),
        array(
            'ﾜｯﾊｯﾊｰ',
        ),
    );

    if(!isset($songs[$index - 1])) {
        return '';
    }

    $request = $smarty->get_template_vars('request');

    $ret = '';
    foreach($songs[$index - 1] as $song) {
        $ret .= '<a href="' . $request->getBaseUrl() . '/page/event_form/song/' . urlencode($song) . '?' . $request->getSearchParams() . '">'
              . htmlspecialchars($song) . '</a><br />';
    }

    return $ret;
}

