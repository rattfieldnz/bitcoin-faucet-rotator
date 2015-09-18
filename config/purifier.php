<?php
return [
    "settings" => [
        "default" => [
            'HTML.Doctype' => 'HTML 5',
            'HTML.Allowed' => 'div,b,strong,i,em,a[href|title],ul,ol,li'
                .',p[style],br,span[style],img[width|height|alt|src],iframe[src|scrolling|style],src',
            "HTML.SafeIframe" => 'true',
            "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/|coinurl.com|a-ads.com|bee-ads.com)%",
        ],
        "titles" => [
            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.Linkify' => false,
        ]
    ],
];