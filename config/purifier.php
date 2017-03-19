<?php
return [
    'encoding' => 'UTF-8',
    'finalize' => true,
    'preload'  => false,
    'cachePath' => null,
    "settings" => [
        "default" => [
            'HTML.Doctype' => 'HTML 4.01 Transitional',
            'HTML.Allowed' => 'div,b,strong,i,em,a[href|class|title|target],ul,ol,li'
                .',p[style],br,span[style],img[width|height|alt|src],'
                . 'iframe[src|scrolling|style],h1,h2,h3,h4,h5,h6,'
                . 'dt,dl',
            "HTML.SafeIframe" => 'true',
            "URI.SafeIframeRegexp" => "%^(http://|https://|//)(mellowads.com|coinurl.com|a-ads.com|ad.a-ads.com|bee-ads.com)%",
        ],
        "generalFields" => [
            'HTML.Doctype' => 'HTML 4.01 Transitional',
            'HTML.Allowed' => '',
            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.Linkify' => false,
        ]
    ],
];
