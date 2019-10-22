<?php

function scriptExclusion($content)
{
    // <script ... > 또는 </script ... > 를 <script ... > 또는 </script ... > 로 치환 한다.
    $pattern = '/<(?=\/?script)(.*?)>/sim';
    $replacement = '<${1}>';
    $content = preg_replace($pattern, $replacement, $content);
    
    $eventArr = array(
    'onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate',
    'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste',
    'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onbegin', 'onblur',
    'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontentready',
    'oncontentsave', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut',
    'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate',
    'ondetach', 'ondocumentready', 'ondrag', 'ondragdrop', 'ondragend',
    'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop',
    'onend', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish',
    'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onhide',
    'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload',
    'onlosecapture', 'onmediacomplete', 'onmediaerror', 'onmedialoadfailed', 'onmousedown',
    'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover',
    'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart',
    'onopenstatechange', 'onoutofsync', 'onpaste', 'onpause', 'onplaystatechange',
    'onpropertychange', 'onreadystatechange', 'onrepeat', 'onreset', 'onresize',
    'onresizeend', 'onresizestart', 'onresume', 'onreverse', 'onrowclick',
    'onrowenter', 'onrowexit', 'onrowout', 'onrowover', 'onrowsdelete',
    'onrowsinserted', 'onsave', 'onscroll', 'onseek', 'onselect',
    'onselectionchange', 'onselectstart', 'onshow', 'onstart', 'onstop',
    'onsubmit', 'onsyncrestored', 'ontimeerror', 'ontrackchange', 'onunload',
    'onurlflip'
    );
    
    // on...= 이벤트를 xon...= 이벤트로 치환한다.
    $pattern = '/('.implode('|', $eventArr).'[\s]?=)/sim';
    // $pattern = '/(on[^\=][^\s]+[\s]?=)/sim';
    $replacement = 'x${1}';
    $content = preg_replace($pattern, $replacement, $content);
    
    // javascript:..() 또는 vbscript:..() 이벤트를 치환
    $pattern = '/(java|vb+script:[0-9a-z\_\(\)])/sim';
    $replacement = 'x${1}';
    $content = preg_replace($pattern, $replacement, $content);
    
    // <iframe ... > 또는 </iframe ... > 를 <iframe ... > 또는 </iframe ... > 로 치환 한다.
    $pattern = '/<(?=\/?iframe)(.*?)>/sim';
    $replacement = '<${1}>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}

?>