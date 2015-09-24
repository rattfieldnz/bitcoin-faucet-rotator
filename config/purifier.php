<?php
return [
    "settings" => [
        "default" => [
            'HTML.Doctype' => 'HTML 5',
            'HTML.Allowed' => 'div,b,strong,i,em,a[href|class|title|target],ul,ol,li'
                .',p[style],br,span[style],img[width|height|alt|src],'
                . 'iframe[src|scrolling|style],src,b,strong,h1,h2,13,h4,h5,h6,'
                . 'dt,dl',
            "HTML.SafeIframe" => 'true',
            "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/|coinurl.com|a-ads.com|bee-ads.com)%",
        ],
        "titles" => [
            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.Linkify' => false,
        ]
    ],
];